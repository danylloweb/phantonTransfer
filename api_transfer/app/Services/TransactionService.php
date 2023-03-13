<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Enums\TransactionStatusEnum;
use App\Enums\TransferStatusEnum;
use App\Enums\UserTypeEnum;
use App\Integrations\AuthorizerTransactionIntegration;
use App\Integrations\NotificationTransactionIntegration;
use App\Repositories\TransactionRepository;
use App\Repositories\TransferRepository;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * TransactionService
 */
class TransactionService extends AppService
{
    protected $repository;
    protected $transferService;
    protected $userService;
    protected $authorizerTransactionIntegration;
    protected $notificationTransactionIntegration;

    /**
     * @param TransactionRepository $repository
     * @param AuthorizerTransactionIntegration $authorizerTransactionIntegration
     * @param NotificationTransactionIntegration $notificationTransactionIntegration
     * @param TransferService $transferService
     * @param UserService $userService
     */
    public function __construct(TransactionRepository $repository,
                                AuthorizerTransactionIntegration $authorizerTransactionIntegration,
                                NotificationTransactionIntegration $notificationTransactionIntegration,
                                TransferService $transferService,
                                UserService  $userService)
    {
        $this->repository      = $repository;
        $this->userService     = $userService;
        $this->transferService = $transferService;
        $this->authorizerTransactionIntegration   = $authorizerTransactionIntegration;
        $this->notificationTransactionIntegration = $notificationTransactionIntegration;
    }

    /**
     * @param int $limit
     * @return mixed
     * @throws RepositoryException
     */
    public function all(int $limit = 20)
    {
        return $this->repository
            ->resetCriteria()
            ->pushCriteria(app(AppRequestCriteria::class))
            ->paginate($limit);
    }

    /**
     * @param array $data
     * @param bool $skipPresenter
     * @return array|mixed
     */
    public function create(array $data, bool $skipPresenter = false)
    {
        try {
            if ($data['payer_id'] == $data['payee_id'] ){
                return ['error'=> true , 'message' => "Não é possível transferir pra si mesmo"];
            }
            $data['transaction_status_id'] = TransactionStatusEnum::CREATED;
            $transaction = $this->repository->skipPresenter()->create($data);

            $payer = $this->userService->find($data['payer_id'],true);
            $payee = $this->userService->find($data['payee_id'],true);


            if ($payer->user_type_id == UserTypeEnum::COMPANY){
                $response = ['error' => true,'message' => 'Logista não pode realizar transferencias'];
                $transaction->transaction_status_id = TransactionStatusEnum::CANCELED;
                $transaction->save();

            }else{
                if (($payer->balance - $transaction->value) < 0 ){
                    $response = ['error' => true, 'message' => 'sem saldo suficiente'];
                    $transaction->transaction_status_id = TransactionStatusEnum::CANCELED;
                    $transaction->save();
                }
                else{
                     $transfer = $this->transferService->create([
                         'payer_id'           => $payer->id,
                         'payee_id'           => $payee->id,
                         'value'              => $transaction->value,
                         'transaction_id'     => $transaction->id,
                         'transfer_status_id' => TransferStatusEnum::PROCESSING,
                         'balance_prior_to_payer_transfer'          => $payer->balance,
                         'balance_prior_to_transfer_from_recipient' => $payee->balance,
                     ],true);

                     if($this->authorizerTransactionIntegration->handle()){

                         $this->userService->withdrawBalance($payer->id, $transaction->value);
                         $this->userService->receiveBalance($payee->id, $transaction->value);
                         $transfer->transfer_status_id       = TransferStatusEnum::FINISH;
                         $transaction->transaction_status_id = TransactionStatusEnum::FINISH;
                         $this->notificationTransactionIntegration->handle();
                     }else{
                         $transfer->transfer_status_id       = TransferStatusEnum::CANCELED;
                         $transaction->transaction_status_id = TransactionStatusEnum::CANCELED;
                     }
                    $transfer->save();
                    $transaction->save();
                    $response = ['transaction_id' => $transaction->id, 'message' => "Transferência realizada com Sucesso"];
             }
            }
            return $response;
        }catch (\Exception $exception ){
            return ['error'=> true , 'message' => $exception->getMessage()];
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function revertTransaction($id):array
    {
        $transaction = $this->repository->skipPresenter()->find($id);
        if ($transaction->transaction_status_id == TransactionStatusEnum::FINISH){
            $transfer = $this->transferService->findWhere(['transaction_id' => $transaction->id],true);

            $this->userService->withdrawBalance($transaction->payee_id, $transaction->value);
            $this->userService->receiveBalance($transaction->payer_id,  $transaction->value);

            $transaction->transaction_status_id = TransactionStatusEnum::CANCELED;
            $transfer->transfer_status_id       = TransferStatusEnum::CANCELED;

            $transfer->save();
            $transaction->save();

            return ['transaction_id' => $transaction->id, 'message' => 'Transferência Revertida com sucesso'];
        }
        return ['transaction_id' => $transaction->id, 'message' => 'Não pode realizar essa operação','error' => true];
    }

}

<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Repositories\TransferStatusRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * TransactionStatusService
 */
class TransferStatusService extends AppService
{
    protected $repository;

    /**
     * @param TransferStatusRepository $repository
     */
    public function __construct(TransferStatusRepository $repository) {
        $this->repository = $repository;
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

}

<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Transfer;

/**
 * Class TransferTransformer.
 *
 * @package namespace App\Transformers;
 */
class TransferTransformer extends TransformerAbstract
{
    /**
     * Transform the Transfer entity.
     *
     * @param \App\Entities\Transfer $model
     *
     * @return array
     */
    public function transform(Transfer $model)
    {
        return [
            'id'                 => (int) $model->id,
            'payer_id'           => $model->payer_id,
            'payee_id'           => $model->payee_id,
            'transaction_id'     => $model->transaction_id,
            'transfer_status_id' => $model->transfer_status_id,
            'status'             => $model->transferStatus->name,
            'value'              => $model->value,
            'created_at'         => $model->created_at->toDateTimeString(),
            'updated_at'         => $model->updated_at->toDateTimeString()
        ];
    }
}

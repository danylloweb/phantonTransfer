<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TransferStatus;

/**
 * Class TransferStatusTransformer.
 *
 * @package namespace App\Transformers;
 */
class TransferStatusTransformer extends TransformerAbstract
{
    /**
     * Transform the TransferStatus entity.
     *
     * @param \App\Entities\TransferStatus $model
     *
     * @return array
     */
    public function transform(TransferStatus $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString()
        ];
    }
}

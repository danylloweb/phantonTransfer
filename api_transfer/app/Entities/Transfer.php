<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Transfer.
 *
 * @package namespace App\Entities;
 */
class Transfer extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'payer_id',
        'payee_id',
        'transaction_id',
        'transfer_status_id',
        'balance_prior_to_payer_transfer',
        'balance_prior_to_transfer_from_recipient',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transferStatus():\Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TransferStatus::class);
    }
}

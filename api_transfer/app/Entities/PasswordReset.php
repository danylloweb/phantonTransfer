<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PasswordReset
 * @package namespace App\Entities;
 */
class PasswordReset extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'email',
        'token',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}

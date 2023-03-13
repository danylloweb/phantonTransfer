<?php

namespace App\Repositories;

use App\Presenters\TransferStatusPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransferStatusRepository;
use App\Entities\TransferStatus;
use App\Validators\TransferStatusValidator;

/**
 * Class TransferStatusRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TransferStatusRepositoryEloquent extends AppRepository implements TransferStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TransferStatus::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TransferStatusValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return TransferStatusPresenter::class;
    }

}

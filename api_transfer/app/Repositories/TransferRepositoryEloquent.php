<?php

namespace App\Repositories;

use App\Presenters\TransferPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransferRepository;
use App\Entities\Transfer;
use App\Validators\TransferValidator;

/**
 * Class TransferRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TransferRepositoryEloquent extends AppRepository implements TransferRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transfer::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TransferValidator::class;
    }

    /**
     * @return string
     */
    public function presenter()
    {
        return TransferPresenter::class;
    }

}

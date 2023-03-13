<?php

namespace App\Services;

use App\Criterias\AppRequestCriteria;
use App\Repositories\TransferRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * TransferService
 */
class TransferService extends AppService
{
    protected $repository;

    /**
     * @param TransferRepository $repository
     */
    public function __construct(TransferRepository $repository) {
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

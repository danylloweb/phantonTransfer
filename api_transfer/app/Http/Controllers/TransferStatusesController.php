<?php

namespace App\Http\Controllers;

use App\Services\TransferStatusService;
use App\Validators\TransferStatusValidator;

/**
 * Class TransferStatusesController.
 *
 * @package namespace App\Http\Controllers;
 */
class TransferStatusesController extends Controller
{
    /**
     * @var TransferStatusService
     */
    protected $service;

    /**
     * @var TransferStatusValidator
     */
    protected $validator;

    /**
     * TransferStatusesController constructor.
     *
     * @param TransferStatusService $service
     * @param TransferStatusValidator $validator
     */
    public function __construct(TransferStatusService $service, TransferStatusValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }

}

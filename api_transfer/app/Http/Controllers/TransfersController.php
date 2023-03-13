<?php

namespace App\Http\Controllers;

use App\Services\TransferService;
use App\Validators\TransferValidator;

/**
 * Class TransfersController.
 *
 * @package namespace App\Http\Controllers;
 */
class TransfersController extends Controller
{
    /**
     * @var TransferService
     */
    protected $service;

    /**
     * @var TransferValidator
     */
    protected $validator;

    /**
     * TransfersController constructor.
     *
     * @param TransferService $service
     * @param TransferValidator $validator
     */
    public function __construct(TransferService $service, TransferValidator $validator)
    {
        $this->service   = $service;
        $this->validator = $validator;
    }


}

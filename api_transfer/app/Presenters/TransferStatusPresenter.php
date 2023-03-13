<?php

namespace App\Presenters;

use App\Transformers\TransferStatusTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TransferStatusPresenter.
 *
 * @package namespace App\Presenters;
 */
class TransferStatusPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TransferStatusTransformer();
    }
}

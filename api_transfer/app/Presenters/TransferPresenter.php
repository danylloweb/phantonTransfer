<?php

namespace App\Presenters;

use App\Transformers\TransferTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TransferPresenter.
 *
 * @package namespace App\Presenters;
 */
class TransferPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TransferTransformer();
    }
}

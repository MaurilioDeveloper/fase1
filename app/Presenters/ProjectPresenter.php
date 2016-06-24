<?php

namespace App\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
/**
 * Description of ProjectTransformer
 *
 * @author samuel
 */
class ProjectPresenter extends FractalPresenter
{
    /**
     * 
     * @return \App\Presenters\ProjectTransformer
     * Camada de representação dos dados.
     * Apresenta o Transformer.
     */
    public function getTransformer() {
        // Retorna uma instancia do ProjectTransformer
        return new ProjectTransformer();
    }

}

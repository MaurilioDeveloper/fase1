<?php

namespace App\Presenters;

use App\Models\User;
use League\Fractal\TransformerAbstract;
/**
 * Description of ProjectTransformer
 * Classe responsável por realizar a formatação de dados,
 * assim, deixando eles do jeito que quisermos que mostre
 * em JSON.
 * 
 * @author Maurilio
 */
class ProjectMemberTransformer extends TransformerAbstract
{
     /**
      * 
      * @param User $member
      * @return transform
      * Retorna um array de dados
      * que serão exibidos pelo 'ProjectPresenter'.
      */
    public function transform(User $member)
    {
        return [
            'member_id' => $member->id,
            'name' => $member->name,
        ];
    }
    
    
}
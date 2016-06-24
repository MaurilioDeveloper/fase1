<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;
    
    protected $guarded = ['id'];
    
    
    /**
     * -------------------------------------------------------------------------
     * @return Members
     * Retorna a ligação da tabela de Arquivos com os Projetos.
     * Com isso, atribui o arquivo para um determinado projeto.
     * -------------------------------------------------------------------------
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

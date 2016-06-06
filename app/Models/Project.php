<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;
    
    protected $guarded = ['id'];
    
    /**
     * 
     * @return Notes
     * Retorna a ligação das tabelas de Notes
     * Com Projects. Retornando que um projeto
     * possui varias notas.
     */
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }
}

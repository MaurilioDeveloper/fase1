<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectNote extends Model implements Transformable
{
    use TransformableTrait;
    
    protected $guarded = ['id'];
    
    /**
     * 
     * @return Project
     * Responsavel por relacionar as notas
     * do Projeto, com o Projeto.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

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
     * -------------------------------------------------------------------------
     * @return Notes
     * Retorna a ligação das tabelas de Notes
     * Com Projects. Retornando que um projeto
     * possui varias notas.
     * -------------------------------------------------------------------------
     */
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }
    
    /**
     * -------------------------------------------------------------------------
     * @return Members
     * Retorna a ligação da tabela de Membros com os Projetos,
     * Project -> 'project_id' Member -> 'member_id', utilizando
     * a tabela de 'User' e 'project_members'.
     * -------------------------------------------------------------------------
     */
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }
}

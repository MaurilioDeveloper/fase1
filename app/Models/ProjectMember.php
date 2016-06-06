<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $guarded = ['id'];
    
    /**
     * -------------------------------------------------------------------------
     * Inserção de um usuario a um projeto, tornando-o membro
     * assim, possuindo acesso ao mesmo (Usuario 1, membro agora do projeto 10):
     * App\Models\ProjectMemeber::create(['member_id' => 1, 'project_id' => 10]);
     * -------------------------------------------------------------------------
     */
}

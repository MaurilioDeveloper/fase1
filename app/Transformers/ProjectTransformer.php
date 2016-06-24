<?php

namespace App\Presenters;

use App\Models\Project;
use League\Fractal\TransformerAbstract;
/**
 * Description of ProjectTransformer
 * Classe responsável por realizar a formatação de dados,
 * assim, deixando eles do jeito que quisermos que mostre
 * em JSON.
 * 
 * @author Maurilio
 */
class ProjectTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['members'];
    public function transform(Project $project)
    {
        return [
            'project_id' => $project->id,
            'client_id' => $project->client_id,
            'owner_id' => $project->owner_id,
            'members' => $project->members,
            'project' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date,
        ];
    }
    
    /**
     * 
     * @param Project $project
     * @return includeMembers
     * Metodo responsavel por incluir uma coleção de dados (lista)
     * dentro da nossa propria coleção, criando uma instancia
     * dos Membros.
     */
    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }
    
}
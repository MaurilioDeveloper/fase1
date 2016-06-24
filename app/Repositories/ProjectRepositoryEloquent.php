<?php

namespace App\Repositories;

use App\Models\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\ProjectRepository as ProjectRepository;
use App\Presenters\ProjectPresenter;

/**
 * @class ProjectRepositoryEloquent
 * Todas e quaisquer consulta de dados
 * deve permancer nas classes de Repository (Desing Patterns).
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * 
     * @return ClientRepositoryEloquent
     * Responsavel por realizar a chamada
     * da nossa Model, para que nosso controller
     * não necessite chamar diretamente a model.
     */
    public function model() 
    {
        return Project::class;
    }
    
    public function boot()
    {
        $this->pushCriteria(app(\Prettus\Repository\Criteria\RequestCriteria::class));
    }
    
    /**
     * 
     * @param int $projectId
     * @param int $userId
     * @return isOwner
     * Verfica se o usuario é dono de um
     * determinado Projeto.
     */
    public function isOwner($projectId, $userId)
    {
        if(count($this->findWhere(['id' => $projectId, 'owner_id' => $userId]))){
            return true;
        }
        
        return false;
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * @param int $projectId
     * @param int $memberId
     * @return hasMember
     * Verifica se o projeto possui um determinado membro
     * 
     */
    public function hasMember($projectId, $memberId)
    {
        // Localiza nosso projeto
        $project = $this->find($projectId);
        
        // Retorna o projeto se o usuario for realmente membro do projeto
        foreach($project->members as $member){
            if($member->id == $memberId){
                return true;
            }
        }
        return false;
        
    }
    
    public function presenter() {
        return ProjectPresenter::class;
    }
}
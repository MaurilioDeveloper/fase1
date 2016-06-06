<?php

namespace App\Repositories;

use App\Models\Project;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\ProjectRepository as ProjectRepository;

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

}
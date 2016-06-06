<?php

namespace App\Repositories;

use App\Models\ProjectNote;
use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\ProjectNoteRepository as ProjectNoteRepository;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
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
        return ProjectNote::class;
    }
    
    public function boot()
    {
        $this->pushCriteria(app(\Prettus\Repository\Criteria\RequestCriteria::class));
    }

}
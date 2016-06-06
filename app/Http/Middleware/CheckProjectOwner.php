<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\ProjectRepository;
use LucaDegasperi\OAuth2Server\Authorizer;

class CheckProjectOwner
{
    private $repository;
    
    public function __construct(ProjectRepository $repository) 
    {
        $this->repository = $repository;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Verifica se o usuario é dono do respectivo projeto.
         * Se ele possuir mais de um (consulta vinda do 'RepositoryEloquent')
         * ele irá retornar o projeto, mostrando que ele tem permissão para
         * acessar esse projeto.
         */
        
        $userId = Authorizer::getResourceOwnerId();
        $projectId = $request->project;
        
        if($this->repository->isOwner($projectId, $userId) == false){
            return ['error' => 'Access forbidden'];
        }
        
        return $next($request);
    }
}

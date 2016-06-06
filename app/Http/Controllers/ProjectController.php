<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectRepository as ProjectRepository;
use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use LucaDegasperi\OAuth2Server\Authorizer;

class ProjectController extends Controller
{
    /**
     *
     * @var ClientRepository
     */
    private $repository;
    
    /**
     *
     * @var Request
     */
    private $request;
    
    /**
     *
     * @var ClientService 
     */
    private $service;
    
    public function __construct(ProjectRepository $repository, Request $request, ProjectService $service) {
        $this->repository = $repository;
        $this->request = $request;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Dependencia ClientRepository (Interface).
     * Responsavel por diminuir o acoplamento de codigo
     * (Desing Patterns). Podendo assim, trabalhar com
     * quaisquer ORM (Doctrine, Eloquent...), assumindo a
     * responsabilidade pelo Provider 'RepositoryProvider'.
     */
    public function index()
    {
        /**
         * ---------------------------------------------------------------------
         * @return Projects
         * Retorna apenas projetos referentes ao 
         * usuario (dono do projeto).
         * ---------------------------------------------------------------------
         */
        return $this->repository->findWhere(
            ['owner_id' => Authorizer::getResourceOwnerId()]
        );
        // return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Metodo Responsavel por inserir as informações
     * no banco de dados.
     */
    public function store()
    {
        return $this->service->create($this->request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Che
     */
    public function show($id)
    {
        if($this->checkProjectPermissions($id) == false){
            return ['error' => 'Access Forbidden'];
        }
        
        /**
         * ---------------------------------------------------------------------
         * Verifica se o usuario é dono do respectivo projeto.
         * Se ele possuir mais de um (consulta vinda do 'RepositoryEloquent')
         * ele irá retornar o projeto, mostrando que ele tem permissão para
         * acessar esse projeto. 
         * (Regra agora criada no 'CheckProjectOwner' => Middleware).
         * Deixando assim, 
         * global para todos os metodos que formos utilizar a mesma.
         * ---------------------------------------------------------------------
         */
        
        /*
         * ---------------------------------------------------------------------
         * $userId = 
         * Authorizer::getResourceOwnerId();
         * 
         * if($this->repository->isOwner($id, $userId) == false){
         *    return ['success' => false];
         * }
         * ---------------------------------------------------------------------
         */
        
         return $this->repository->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        
        return $this->service->update($this->request->all(), $id);
        //$this->repository->find($id)->update($this->request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->checkProjectOwner($id)==false){
            return ['error' => 'Access Forbidden'];
        }
        
        return $this->repository->delete($id);
    }
    
    private function checkProjectOwner($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        
        return $this->repository->isOwner($projectId, $userId);
       
    }
    private function checkProjectMember($projectId)
    {
        $userId = Authorizer::getResourceOwnerId();
        
        return $this->repository->hasMember($projectId, $userId);
       
    }
    
    private function checkProjectPermissions($projectId)
    {
        if($this->checkProjectOwner($projectId) || $this->checkProjectMember($projectId)){
            return true;
        }
        return false;
    }
    
}

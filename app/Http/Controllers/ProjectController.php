<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectRepository as ProjectRepository;
use App\Http\Controllers\Controller;
use App\Services\ProjectService;

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
        return $this->repository->all();
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
     */
    public function show($id)
    {
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
        return $this->repository->delete($id);
    }
}

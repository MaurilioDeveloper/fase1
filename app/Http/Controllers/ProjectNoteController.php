<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProjectNoteRepository as ProjectNoteRepository;
use App\Http\Controllers\Controller;
use App\Services\ProjectNoteService;

class ProjectNoteController extends Controller
{
    /**
     *
     * @var ClientNoteRepository
     */
    private $repository;
    
    /**
     *
     * @var Request
     */
    private $request;
    
    /**
     *
     * @var ProjectNoteService 
     */
    private $service;
    
    public function __construct(ProjectNoteRepository $repository, Request $request, ProjectNoteService $service) {
        $this->repository = $repository;
        $this->request = $request;
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Dependencia ProjectNoteRepository (Interface).
     * Responsavel por diminuir o acoplamento de codigo
     * (Desing Patterns). Podendo assim, trabalhar com
     * quaisquer ORM (Doctrine, Eloquent...), assumindo a
     * responsabilidade pelo Provider 'RepositoryProvider'.
     */
    
    /**
     * 
     * @param type $id
     * @return Retorna todas as anotações de
     * um determinado Projeto.
     */
    public function index($id)
    {
        return $this->repository->findWhere(['project_id' => $id]);
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
    public function show($id, $noteId)
    {
        return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $noteId)
    {
        return $this->service->update($this->request->all(), $noteId);
        //$this->repository->find($id)->update($this->request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $noteId
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $noteId)
    {
        return $this->repository->delete($noteId);
    }
}

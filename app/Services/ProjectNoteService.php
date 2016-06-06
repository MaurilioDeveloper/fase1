<?php

namespace App\Services;

use App\Repositories\ProjectNoteRepository;
use App\Validators\ProjectNoteValidator;
/**
 * Description of ClientService
 *
 * @author Maurilio
 */
class ProjectNoteService {

    /**
     *
     * @var ClientRepository
     * 
     */
    protected $repository;
    /**
     *
     * @var ClientValidator
     * Responsavel por validar todos os nossos campos
     * (Regras de Validação)
     */
    protected $validator;
    
    public function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator) 
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
    
    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            // Enviar um email
            // Disparar notificação
            // Toda Regra de negocio de nossa aplicação
            return $this->repository->create($data);
        } catch (\Prettus\Validator\Exceptions\ValidatorException $e) {
            /**
             * @return Array de Erros
             * Mostrando todos os erros de validação
             */
            return [
                'error' => true, 
                'message' => $e->getMessageBag()
            ];
        }
    }
    
    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            // Enviar um email
            // Disparar notificação
            // Toda Regra de negocio de nossa aplicação
            return $this->repository->update($data, $id);
        } catch (\Prettus\Validator\Exceptions\ValidatorException $e) {
            /**
             * @return Array de Erros
             * Mostrando todos os erros de validação
             */
            return [
                'error' => true, 
                'message' => $e->getMessageBag()
            ];
        }
    }
}

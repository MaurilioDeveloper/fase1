<?php

namespace App\Services;

use App\Repositories\ProjectRepository;
use App\Validators\ProjectValidator;
use Illuminate\Support\Facades\Storage;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Contracts\Filesystem\Factory as Storage;

/**
 * Description of ClientService
 *
 * @author Maurilio
 * @version 1.0.0
 * @since 2016
 */
class ProjectService {

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
    
    /**
     *
     * @var Filesystem
     * Responsavel por ter acesso direto aos
     * arquivos (file). Ao invés de utilizar
     * a Facade de File. Deixando o codigo menos
     * acoplado.
     */
    protected $filesystem;
    
    /**
     *
     * @var Storage
     * Responsavel por ter acesso direto a
     * camada de Storage, ao inves de utilizar
     * a Face Storage. Assim melhorando o acoplamento
     * de codigo.
     * ------------------------------------------------
     * Obs: Em regras de negocio (Service), nunca é bom
     * utilizar Facades.
     */
    protected $storage;


    public function __construct
    (
        ProjectRepository $repository, 
        ProjectValidator $validator, 
        Filesystem $filesystem,
        Storage $storage
    ) 
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->filesystem = $filesystem;
        $this->storage = $storage;
    }
    
    /**
     * 
     * @param array $data
     * @return type
     * Metodo responsavel por verificar a validação
     * dos dados que foram inseridos, se estão corretos,
     * e inserir o objeto ao banco.
     */
    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            // Enviar um email
            // Disparar notificação
            // Toda Regra de negocio de nossa aplicação
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
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
    
    /**
     * 
     * @param array $data
     * @param type $id
     * @return type
     * Metodo responsavel por atualizar (Update)
     * os dados do banco, averiguando se estão
     * corretos, pegando-os pelo respectivo $id
     * do Projeto. 
     */
    public function update(array $data, $id)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            // Enviar um email
            // Disparar notificação
            // Toda Regra de negocio de nossa aplicação
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
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
    /**
     * 
     * @method createFile 
     * @params array $data
     * Metodo responsavel por retornar o upload de um 
     * arquivo atraves de seu nome, sua extensão e o 
     * arquivo em si. Pegando-os atraves de um array
     * de dados. Com isso, a responsabilidade fica 
     * totalmente com a camada de serviço.
     */
    public function createFile(array $data)
    {
        // name
        // description
        // extension
        // file
        
        /**
         * @param $project
         * Responsavel por buscar o Projeto, atraves de seu 
         * $id, utilizando a camada de Repository, aonde trabalhamos
         * com o banco de dados. (Camada de Model da Aplicação).
         * É utilizado a function skipePrsenter(), pois apenas assim é
         * encontrado o files(), podendo criar o objeto no banco de dados.
         * Pois, 
         */
        $project = $this->repository->skipPresenter()->find($data['project_id']);
        //dd($project);
        
        /**
         * Responsavel por salvar o arquivo com seus dados
         * ao banco.
         */
        $projectFile = $project->files()->create($data);
        $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));
        
    }
}

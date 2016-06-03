<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** Lista Branca (Dados que poderam ser inseridos manualmente e colocados 
     *  Banco de Dados.
     *  protected $fillable = [
     *      'name', 'responsible', 'email', 'phone', 'address', 'obs'
     *  ];
     */
    
    /**
     *
     * @var string 
     * Lista Negra da Nossa aplicação. 
     */
    protected $guarded = ['id'];
}

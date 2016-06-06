<?php

namespace App\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ClientValidator
 *
 * @author Maurilio
 */
class ProjectValidator extends LaravelValidator
{
    
    protected $rules = [
        'owner_id' => 'required|integer',
        'client_id' => 'required|integer',
        'name' => 'required',
        'progress' => 'required',
        'status' => 'required',
        'due_date' => 'required'
    ];
    
}

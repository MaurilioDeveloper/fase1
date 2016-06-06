<?php

namespace App\Validators;

use Prettus\Validator\LaravelValidator;

/**
 * Description of ProjectValidator
 *
 * @author Maurilio
 */
class ProjectNoteValidator extends LaravelValidator
{
    
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required',
    ];
    
}

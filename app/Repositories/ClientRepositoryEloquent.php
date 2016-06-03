<?php

namespace App\Repositories;

use App\Models\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository
{
    public function model() 
    {
        return Client::class;
    }

}
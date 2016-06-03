<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        /*
         * Para rodar as seeds, basta rodar o comando:
         * 'php artisan db:seed'
         */
        
        /*
         * @method truncate()
         * Responsavel por deletar todos os registros
         * que ja constituem o banco.
         */
        App\Models\Client::truncate();
        factory('App\Models\Client', 10)->create();
    }

}

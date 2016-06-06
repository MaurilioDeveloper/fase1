<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder {

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
        App\Models\Project::truncate();
        factory('App\Models\Project', 10)->create();
    }

}

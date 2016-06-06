<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder 
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        /*
         * Para rodar as seeds, basta rodar o comando:
         * 'php artisan db:seed'
         */

        /*
         * @method truncate()
         * Responsavel por deletar todos os registros
         * que ja constituem o banco.
         */
        App\Models\User::truncate();
        factory(\App\Models\User::class)->create([
            'name' => "Maurilio Silva",
            'user' => "maurilio.silva",
            'email' => "mauriliodeveloper@gmail.com",
            'password' => bcrypt(12345),
            'remember_token' => str_random(10),
        ]);
        
        factory(\App\Models\User::class, 10)->create();
    }

}

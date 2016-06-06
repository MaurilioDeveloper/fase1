<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        /*
         * Cria dados falsos para nossa Aplicação.
         * 'php artisan make:seeder nome_da_seeder'
         * Responsavel por criar nossas seeders com
         * dados fakes.
         */
        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);

        Model::reguard();
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * @method register
         * Responsavel por fazer que quando injetarmos a dependencia
         * do ClientRepository, ele irá trazer uma instancia do 
         * ClientRepositoryEloquent. Pois não conseguimos injetar
         * a dependencia de uma interface em algum lugar, então
         * esse nosso 'Provider', prove esse serviço.
         */
        $this->app->bind(
                \App\Repositories\ClientRepository::class, 
                \App\Repositories\ClientRepositoryEloquent::class
        );
        
        $this->app->bind(
                \App\Repositories\ProjectRepository::class, 
                \App\Repositories\ProjectRepositoryEloquent::class
        );
        
        $this->app->bind(
                \App\Repositories\ProjectNoteRepository::class, 
                \App\Repositories\ProjectNoteRepositoryEloquent::class
        );
    }
}

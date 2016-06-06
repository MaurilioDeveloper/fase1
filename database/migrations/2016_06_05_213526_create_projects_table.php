<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            /**
             * @var integer owner_id
             * Responsavel por fazer referencia
             * ao dono do projeto.
             * unsigned: Responsavel por solicitar um
             * numero positivo
             */
            $table->integer('owner_id')->unsigned();
            $table->foreign('owner_id')->references('id')->on('users');
            /**
             * @var integer client_id
             * Reponsavel por fazer referencia
             * a um Cliente. Por exemplo, projeto X
             * possui um determinado Cliente.
             */
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('name');
            $table->text('description');
            $table->smallInteger('progress')->unsigned();
            $table->smallInteger('status')->unsigned();
            $table->date('due_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('projects');
    }
}

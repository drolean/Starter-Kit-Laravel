<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->enum('tipo', ['bug', 'tarefa', 'outro'])->default('bug');
            $table->enum('prioridade', ['alta', 'media', 'baixa'])->default('baixa');
            $table->enum('status', ['aberto', 'fechado'])->default('aberto');
            $table->integer('dev_loe')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::create('tickets_comment', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comentario');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('ticket_id')->unsigned();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets_comment');
        Schema::drop('tickets');
    }
}

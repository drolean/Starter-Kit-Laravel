<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('empresa');
            $table->string('cnpj')->unique();
            $table->string('telefone')->nullable();
            $table->string('endereco')->nullable();
            $table->boolean('active');
            $table->integer('max_users')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('logo')->default('default.jpg');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companies');
    }
}

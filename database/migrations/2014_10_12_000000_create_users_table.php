<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('activation_code')->nullable();
            $table->boolean('activation')->default(false);

            $table->boolean('is_admin')->nullable();
            $table->boolean('is_super')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->timestamp('blocked_on')->nullable();
            $table->timestamp('password_change_at')->nullable();
            $table->string('avatar')->default('default.jpg');

            $table->rememberToken();
            $table->timestamps();

            $table->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('companies', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('companie_user', function (Blueprint $table) {
            $table->integer('companie_id')->unsigned();
            $table->foreign('companie_id')->references('id')->on('companies')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['companie_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('companie_user');
        Schema::table('companies', function ($table) {
            $table->dropForeign('companies_user_id_foreign');
        });
        Schema::dropIfExists('users');
    }
}

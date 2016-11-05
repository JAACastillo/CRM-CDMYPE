<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('tipo',array('Administrador','Asesor','Compras','Director'));
            $table->string('avatar')->default('default.png');
            $table->rememberToken();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}

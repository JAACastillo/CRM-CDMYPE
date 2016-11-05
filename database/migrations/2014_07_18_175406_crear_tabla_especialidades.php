<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEspecialidades extends Migration {

	public function up()
	{
		 Schema::create('especialidades',function($table){
            $table->increments('id');

            $table->string('especialidad');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	
	public function down()
	{
        Schema::drop('especialidades');
	}

}

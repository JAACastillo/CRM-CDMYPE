<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConsultoresEspecialidades extends Migration {


	public function up()
	{
		 Schema::create('consultoresEspecialidades',function($table){
            $table->increments('id');

            $table->integer('consultor_id');
            $table->integer('subespecialidad_id');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	
	public function down()
	{
        Schema::drop('consultoresEspecialidades');
	}

}

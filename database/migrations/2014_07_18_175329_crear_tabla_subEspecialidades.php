<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSubEspecialidades extends Migration {

	public function up()
	{
		 Schema::create('subEspecialidades',function($table){
            $table->increments('id');

            $table->integer('especialidad_id');
            $table->string('sub_especialidad');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	
	public function down()
	{
        Schema::drop('SubEspecialidades');
	}

}

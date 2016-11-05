<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAsistencias extends Migration {

public function up()
	{
		Schema::create('asistencias',function($table){
            $table->increments('id') ;

            $table->integer('empresario_id');
            $table->integer('captermino_id');
            $table->enum('asistira', array("No","Si"));
            $table->enum('asistio', array("No","Si"));

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('asistencias');
	}


}

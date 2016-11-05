<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConsultores extends Migration {

	public function up()
	{
		 Schema::create('consultores',function($table){
            $table->increments('id');

            $table->string('nit',30)->unique();
            $table->string('dui',20)->unique();
            $table->string('correo',75)->unique();
            $table->string('nombre', 100);
            $table->integer('municipio_id');
            $table->string('direccion', 250);
            $table->enum('sexo',array('Mujer','Hombre'));
            $table->string('telefono',20);
            $table->string('celular',20);
            $table->softDeletes();
            $table->timestamps();
        });
	}

	
	public function down()
	{
        Schema::drop('consultores');
	}

}

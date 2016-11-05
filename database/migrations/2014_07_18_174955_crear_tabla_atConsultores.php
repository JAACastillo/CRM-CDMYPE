<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAtConsultores extends Migration {

	public function up()
	{
		 Schema::create('atConsultores',function($table){
            $table->increments('id');

            $table->enum('estado', array('Enviado','Seleccionado'));
            $table->string('doc_oferta');
            $table->date('fecha_oferta');
            $table->date('fecha_seleccion');
            $table->integer('attermino_id');
            $table->integer('consultor_id');

            $table->softDeletes();
            $table->timestamps();
        });
	}


	public function down()
	{
		Schema::drop('atConsultores');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAtTerminos extends Migration {

	public function up()
	{
		Schema::create('atTerminos',function($table) {
            $table->increments('id');

            $table->string('tema', 500);
            $table->string('obj_general', 2000);
            $table->string('obj_especifico', 2000);
            $table->string('productos',3000);
            $table->integer('tiempo_ejecucion');
            $table->integer('trabajo_local');
            $table->date('fecha');
            $table->double('financiamiento', 7, 2);
            $table->double('aporte', 6, 2);
            $table->enum('estado', array('Creado','Enviado','Ofertas Recibidas','Consultor Seleccionado','Contratada','Finalizada'));
            $table->integer('especialidad_id');
            $table->integer('usuario_id');
            $table->integer('empresa_id');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
        Schema::drop('atterminos');
	}

}

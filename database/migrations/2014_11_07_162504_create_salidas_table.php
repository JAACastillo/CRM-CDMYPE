<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salidas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('fecha_inicio');
			$table->time('hora_salida');
			$table->time('hora_regreso');
			$table->integer('lugar_destino');
			$table->integer('participantes');
			$table->text('justificacion');
			$table->text('objetivo');
			$table->integer('encargado');
			$table->enum('estado', array('Aprobado','Rechazado','Cancelado'));
			$table->text('observacion');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('salidas');
	}

}

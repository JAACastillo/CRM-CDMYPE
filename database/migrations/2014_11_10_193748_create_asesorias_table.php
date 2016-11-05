<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsesoriasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asesoria', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo');
			$table->integer('municipio_id');
			$table->date('fecha_inicio');
			$table->date('fecha_fin');
			$table->time('hora_inicio');
			$table->time('hora_fin');
			$table->enum('tipo', array('Seguimiento','Inicial'));
			$table->integer('especialidad')->default(0);
			$table->integer('proyecto_id')->default(0);
			$table->integer('actividad');
			$table->text('detalle');
			$table->enum('estado', array('Programada','Completada', 'Cancelada'));
			$table->integer('user_id');
			$table->integer('empresa_id');
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
		Schema::drop('asesoria');
	}

}

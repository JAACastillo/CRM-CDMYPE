<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReunionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reuniones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('titulo');
			$table->integer('user_id');
			$table->integer('municipio_id');
			$table->enum('organizacion', array('CDMYPE','CONAMYPE','Capacitación', 'Otra Institución'));
			$table->date('fecha_inicio');
			$table->date('fecha_fin');
			$table->time('hora_inicio');
			$table->time('hora_fin');
			$table->text('detalle_reunion');
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
		Schema::drop('reuniones');
	}

}

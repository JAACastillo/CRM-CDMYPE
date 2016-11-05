<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaConfiguraciones extends Migration {


	public function up()
	{
		Schema::create('configuraciones',function($table){
			$table->increments('id');
			
			$table->string('num_bancario',50);
			$table->string('institucion',100);
			$table->string('correo',50);

            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('configuraciones');
	}

}

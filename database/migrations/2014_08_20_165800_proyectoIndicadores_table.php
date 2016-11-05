<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProyectoIndicadoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('proyectoIndicadores',function($table){
            $table->increments('id');
            $table->string('nombre' );
            $table->string('tipo');
            $table->integer('prioridad');
            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('proyectoIndicadores');
	}

}

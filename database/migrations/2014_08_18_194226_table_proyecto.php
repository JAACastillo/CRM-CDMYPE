<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableProyecto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyectos',function($table){
            $table->increments('id');
            
            $table->string('nombre');
            $table->string('meta');
            $table->text('descripcion');
            $table->integer('empresa_id');
            $table->integer('asesor');
            $table->integer('creador');
            
            $table->date('fechaInicio');
            $table->date('fechaFin');

            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('proyectos');
	}


}

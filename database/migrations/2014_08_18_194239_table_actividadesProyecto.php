<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableActividadesProyecto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('actividadesProyecto',function($table){
            $table->increments('id');
            
            $table->string('nombre');
            $table->integer('proyecto_id');
            $table->date('fecha');
            $table->boolean('completo');
            $table->text('descripcion');
            $table->enum( 'Encargado', array('Asesor', 'Cliente', 'Consultor', 'Docente', 'Alumnos'));
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAtenciones extends Migration {

	public function up()
	{
        Schema::create('atenciones',function($table){
            $table->increments('id');
            
            $table->integer('usuario_id');
            $table->integer('empresa_id');
            $table->date('fecha');

            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('atenciones');
	}

}

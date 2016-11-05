<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaAtContratos extends Migration {

	public function up()
	{
		Schema::create('atContratos',function($table){
            $table->increments('id') ;

            $table->integer('duracion');
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->double('pago', 7, 2);
            $table->double('aporte',7,2);
            $table->string('lugar_firma', 75);
            $table->integer('attermino_id');
            
            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('atContratos');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEmpresasEmpresarios extends Migration {

	public function up()
	{
        Schema::create('empresasEmpresarios',function($table){
            $table->increments('id');
            
            $table->enum('tipo',array('Empresario','Empresaria','Propietario','Propietaria','Representante'));
            $table->integer('empresario_id');
            $table->integer('empresa_id');
            
            $table->softDeletes();
            $table->timestamps();
        });
	}


	public function down()
	{
        Schema::drop('empresasEmpresarios');
	}

}

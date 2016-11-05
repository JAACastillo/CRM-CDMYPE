<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCapTerminos extends Migration {

	public function up()
	{
		Schema::create('capTerminos',function($table) {
		$table->increments('id');
            
            $table->string('encabezado', 500);
            $table->string('tema', 500);
            $table->enum('categoria', array('Emprendedoras y empresarias de los Departamentos de Cabañas, Cuscatlán y San Vicente.',
                                              'Empresarios de los departamentos de Cabañas, Cuscatlán y San Vicente.'));
            $table->string('descripcion', 3000);
            $table->string('obj_general', 2000);
            $table->string('obj_especifico', 2000);
            $table->string('productos',3000);
            $table->string('lugar',1000);
            $table->date('fecha');
            $table->date('fecha_lim');
            $table->time('hora_ini');
            $table->time('hora_fin');
            $table->string('nota',3000);
            $table->enum('estado', array('Creado','Enviado','Ofertas Recibidas','Consultor Seleccionado','Contratada','Finalizada'));
            $table->integer('especialidad_id');
            $table->integer('usuario_id');
            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('capTerminos');
	}

}

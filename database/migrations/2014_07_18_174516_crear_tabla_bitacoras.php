<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaBitacoras extends Migration {

	public function up()
	{
        Schema::create('bitacoras', function($table) {
            $table->increments('id');
            
            $table->integer('usuario_id');
            $table->enum('tabla',array(
                'usuarios',
                'bitacoras',
                'movimientos',
                'atenciones',
                'empresas',
                'empresasEmpresarios',
                'empresarios',
                'departamentos',
                'municipios',
                'atTerminos',
                'atConsultores',
                'atContratos',
                'actas',
                'ampliacionesContratos',
                'consultores',
                'consultoresEspecialidades',
                'subEspecialidades',
                'especialidades',
                'capConsultores',
                'capTerminos',
                'capContratos',
                'participantes',
                'historias',
                'configuraciones'));
            $table->integer('tabla_id');
            $table->enum('accion',array('Crear','Modificar','Eliminar'));
            
            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('bitacoras');
	}

}

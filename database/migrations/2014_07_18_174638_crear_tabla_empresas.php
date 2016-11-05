<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaEmpresas extends Migration {

	public function up()
	{
        Schema::create('empresas', function($table) {
            $table->increments('id');
            
            $table->enum('categoria',array('Empresa','Grupo'));
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->integer('municipio_id');
            $table->string('direccion', 250);
            $table->string('nit', 20);
            $table->string('registro_iva', 25);
            $table->enum('constitucion',array('Informal Natural','Formal Natural','Formal Jurídica'));
            $table->enum('clasificacion',array('Emprendedor','Micro-empresa','Micro-empresa de Subsistencia','Grupo Asociativo Empresas','No definido'));
            $table->enum('sector_economico',array('Artesanias','Agroindustrias Alimentaria','Calzado','Comercio','Construcción','Química Farmaceutica','Tecnología de Información y Comunicación','Textiles y Confección','Turismo','Otros'));
            $table->string('actividad', 3000);

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
        Schema::drop('empresas');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCapContratos extends Migration {

	public function up()
	{
		Schema::create('capContratos',function($table){
            $table->increments('id') ;

            $table->double('pago', 7, 2);
            $table->string('lugar_firma', 100);
            $table->enum('firma', array('Director','Directora'));
            $table->integer('captermino_id');

            $table->softDeletes();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('capContratos');
	}

}

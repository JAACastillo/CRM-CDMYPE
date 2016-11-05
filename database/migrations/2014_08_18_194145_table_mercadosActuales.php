<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMercadosActuales extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('mercadosActuales',function($table){
            $table->increments('id');
            
            $table->integer('indicador_id'); //id usuario
            $table->enum('mercados', array('Local', 'Regional', 'Nacional', 'Internacional'));
            
            
            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('mercadosActuales');
	}

}

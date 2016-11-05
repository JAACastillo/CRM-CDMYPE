<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAsesoriaMaterial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asesoriaMateriales',function($table){
            $table->increments('id');
            
            $table->integer('asesoria_id'); //id usuario
            $table->string('material');
            
            
            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('asesoriaMateriales');
	}
}

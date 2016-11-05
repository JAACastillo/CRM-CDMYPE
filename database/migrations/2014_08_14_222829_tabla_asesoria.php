 <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAsesoria extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('asesorias',function($table){
            $table->increments('id');
            
            $table->integer('modificado'); //id usuario
            $table->integer('creador'); //id usuario
            $table->string('nombre');
            $table->string('descripcion');
            
            
            $table->softDeletes();
            $table->timestamps();
        });
	}
	
	public function down()
	{
        Schema::drop('asesorias');
	}

}

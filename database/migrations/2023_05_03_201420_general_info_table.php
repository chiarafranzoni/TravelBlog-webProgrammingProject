<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalinfo', function(Blueprint $table){
    
                
            $table->increments('id');

            $table-> integer('myuser_id')->unsigned();  //chiave esterna che punterà alla tabella myuser

            $table->enum('price', ['ECONOMIC', 'AVERAGE', 'EXPENSIVE']);

            $table->enum('category', ['HOUSING', 'ATTRACTION', 'RESTAURANT']);
            $table->String('description',2000);
            $table->String('link')->nullable();
            $table->String('place_image')->nullable();
            $table->integer('stars');

            $table->boolean('public');
            $table-> integer('ref_id')->unsigned(); 

        });

        Schema::table('generalinfo', function(Blueprint $table){

            //chiave esterna che punterà all'id della tabella address

            $table->foreign('myuser_id')->references('id')-> on('myuser'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('generalinfo');
    }
};

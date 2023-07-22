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
        Schema::create('travel', function(Blueprint $table){
    
                
            $table->increments('id');

            $table-> integer('myuser_id')->unsigned();  //chiave esterna che punterà alla tabella myuser

            
            $table->String('title');
            $table->boolean('public');
            $table->json('transportation');
            $table->integer('duration');
            $table->String('thumbnail');

            $table->json('stages');

        });

        Schema::table('travel', function(Blueprint $table){

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
        
        Schema::dropIfExists('travel');
    }
};

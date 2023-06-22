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
        Schema::create('restaurant', function(Blueprint $table){
    
                
            $table->increments('id');
            $table->String('name');

            $table->enum('type', ['RESTAURANT', 'CAFE', 'TAVERN', 'BREWERY','PIZZERIA','PUB', 'ICE-CREAM SHOP']);

            $table-> integer('address_id')->unsigned();  //chiave esterna che punterà alla tabella address


        });

        Schema::table('restaurant', function(Blueprint $table){

            //chiave esterna che punterà all'id della tabella address

            $table->foreign('address_id')->references('id')-> on('address'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant');
    }
};


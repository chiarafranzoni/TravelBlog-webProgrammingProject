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
        Schema::create('housing', function(Blueprint $table){
    
                
            $table->increments('id');
            $table->String('name');

            $table->enum('type', ['CHALET', 'B&B', 'HOTEL']);

            $table-> integer('address_id')->unsigned();  //chiave esterna che punterà alla tabella address


        });

        Schema::table('housing', function(Blueprint $table){

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
        Schema::dropIfExists('housing');
    }
};

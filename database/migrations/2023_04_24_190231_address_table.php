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
        Schema::create('address', function(Blueprint $table){

            $table-> increments('id');  // = chiave esterna per tabelle: MyUser, Attraction, Restaurant, Housing
            $table-> string('street_and_number');
            $table-> string('city');
            $table-> string('province');
            $table-> string('country')->nullable();
            $table-> string('postcode')->nullable();

            
         });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};


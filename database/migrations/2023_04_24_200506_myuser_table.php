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

    /* Creo lo Schema per la tabella degli utenti (myuser per distinguerla da quella già impostata), con:

            - id
            - nome
            - cognome
            - password
            - indirizzo
            - numero telefono
            - mail
            - viaggi    (ANCORA DA FARE!!)
    
    */
    {
        Schema::create('myuser', function(Blueprint $table){

            
            $table->increments('id');
         
            $table->string('firstname'); 
            $table->string('lastname');

            $table-> integer('address_id')->unsigned();  //chiave esterna che punterà alla tabella address

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telephone')->unique();
            $table->string('password'); 
            $table->rememberToken(); // protezione contro haker per cookies

            /* Più inserisci viaggio */

        });

         
        // Per MODIFICARE la struttura della tabella: AGGIUNGO IL VINCOLO DI CHIAVE ESTERNA

         /*
            NB: gli Schema::table si usano per modificare tabelle già esistenti!

            Se li faccio contemporaneamente NON funziona!!

            Prima scrivo solo gli Schema::create e faccio "php artisan migrate"
            Poi aggiungo gli Schema::table e ri-migro

         */
        
        Schema::table('myuser', function(Blueprint $table){

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
         Schema::dropIfExists('myuser');
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table ='address';   // Ci sarà una tabella address nel database

    public $timestamps= false; // non voglio che nel database ci siano le colonne CREATED AT e UPDATED AT


    protected $fillable=['street_and_number','city','province','country','postcode'];

    // Ha relazione 1-1 con myuser -> hasOn e BelognsTo
    public function myuser(){    // Utente a cui è legato l'address

        return $this->hasOne(myUser::class,'address_id');

    }

    // Sarà da fare anche per Restaurant, Attraction e Housing



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    
    protected $table ='restaurant';   // Ci sarà una tabella address nel database

    public $timestamps= false; // non voglio che nel database ci siano le colonne CREATED AT e UPDATED AT

      
    protected $fillable=['name','price_from','price_to','category','description','link','place_image'];

    public function address(){    // Metodo che mi ritorna l'address dell'utente

        return $this->belongsTo(Address::class,'address_id');
    }
}

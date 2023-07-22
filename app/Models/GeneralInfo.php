<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralInfo extends Model
{

    use HasFactory;

    
    protected $table ='generalinfo';   // Ci sarà una tabella address nel database

    public $timestamps= false; // non voglio che nel database ci siano le colonne CREATED AT e UPDATED AT

      
    protected $fillable=['price','category','description','link','place_image','stars','public','ref_id'];

    public function myuser(){    // Metodo che mi ritorna l'utente associato

        return $this->belongsTo(myUser::class,'myuser_id','id');    /* È associato ad 1 utente che inserisce qualcosa */
    }

}

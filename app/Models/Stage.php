<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    
    
    protected $table ='stage';   // Ci sarà una tabella address nel database

    public $timestamps= false; // non voglio che nel database ci siano le colonne CREATED AT e UPDATED AT


    protected $fillable=['location','nation','housings','restaurants','attractions'];


}

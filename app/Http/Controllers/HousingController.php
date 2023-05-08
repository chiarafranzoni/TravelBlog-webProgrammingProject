<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Housing; //Specifico che voglio usare quel modello
use App\Models\DataLayer;

class HousingController extends Controller
{
    // Mi faccio torare la pagina 
    public function index(){

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $housings=array(); // Creo un array, in cui salverò gli alloggi


        $housings=$dl->publicHousingFromInfo();

        //Mi faccio tornare la pagina restaurant.index, che userà come restaurants_list, l'array creato 
        return view('housing.index')->with('housings_list', $housings);
    }
}
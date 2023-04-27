<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant; //Specifico che voglio usare quel modello
use App\Models\DataLayer;

class RestaurantController extends Controller

{
    // Mi faccio torare la pagina 
    public function index(){

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $restaurants=array(); // Creo un array di ristoranti, in cui inserirò ciascun ristorante in ordine alfabetico

        $restaurants=$dl->listRestaurants();    // Invovo sull'array il metodo listRestaurants() del DataLayer

        //Mi faccio tornare la pagina restaurant.index, che userà come restaurants_list, l'array creato 
        return view('restaurant.index')->with('restaurants_list', $restaurants);
    }



}

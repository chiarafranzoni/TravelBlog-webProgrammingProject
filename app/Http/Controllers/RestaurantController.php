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

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $restaurants=array(); // Creo un array di ristoranti, in cui inserirò ciascun ristorante in ordine alfabetico

        $restaurants=$dl->listRestaurants();    // Invoco il metodo listRestaurants() del DataLayer, per costruire l'aray dei ristoranti

        //Mi faccio tornare la pagina restaurant.index, che userà come restaurants_list, l'array creato 
        //return view('restaurant.index')->with('restaurants_list', $restaurants)->with('logged',true)->with('loggedName',$_SESSION['loggedName']);

        
        
        /* Verifico se esiste lo username e se la password corrisponde */

       if(!isset($_SESSION['logged'])){

        return view('restaurant.index')->with('restaurants_list', $restaurants)->with('logged',false);

       }
       else{

        return view('restaurant.index')->with('restaurants_list', $restaurants)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/

       }

}
}
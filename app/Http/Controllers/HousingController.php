<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Housing; //Specifico che voglio usare quel modello
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class HousingController extends Controller
{
    // Mi faccio torare la pagina 
    public function index(){

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $housings=array(); // Creo un array, in cui salverò gli alloggi


        $housings=$dl->publicHousingFromInfo();

        //Mi faccio tornare la pagina restaurant.index, che userà come restaurants_list, l'array creato 
        //return view('housing.index')->with('housings_list', $housings);
    
        if(!isset($_SESSION['logged'])){

            return view('housing.index')->with('housings_list', $housings)->with('logged',false);
    
           }
           else{
    
            return view('housing.index')->with('housings_list', $housings)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
    
           }
    }

    public function add(){
        return view('housing.add')->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
    }

     // Per memorizzare la housing che inserisco del form

     public function store(Request $req)
     { //Request serve per mandare la richiesta http

        session_start();

        console_log($req->file('image'));
 
         $dl = new DataLayer(); // DataLayer gestisce tutte le query del database
 
        
        $user=$dl->getUser($_SESSION['email']);

        $image= $req->file('image');
        $image_name= $req->file('image')->getClientOriginalName();

         // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
         // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
        $image_name= ($user->id).$image_name;  

        //Salvo l'immagine
        $req->file('image')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata

         $dl->addHousing($req->input('name'), $req->input('category'), $req->input('price'), $req->input('description')
                     , $req->input('link'), $req->input('stars'), $req->input('public'),$image_name, $user
                     , $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
         
         return Redirect::to(route('housing.index')); // Importa la classe Redirect!!
     }


}

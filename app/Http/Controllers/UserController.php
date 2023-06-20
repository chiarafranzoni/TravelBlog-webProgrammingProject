<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\myUser;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller

/*

            LOGIN
    
*/


{
    public function login(){
        return view('user.login');
    }

    // PASSO User e password x autenticarmi
    public function authentication(Request $req){    /* HTTP Request => per mandare dati da form su database */

        session_start();
        
        /* Verifico se esiste lo username e se la password corrisponde */

        $dl= new DataLayer();
        if($dl->validUser($req->input('email'),$req->input('password'))){ // PAsso al metodo del datalayer lo user e la password nella form

            $_SESSION['logged']=true;
            $_SESSION['loggedName']=$dl->getUserName($req->input('email')); // Chiedo il nome dell'utente usando come input della richiesta la mail
            $_SESSION['email']=$req->input('email');

        
            return Redirect::to(route('home'));   // Se è valido passo la rotta che dà l'elenco dei libri
        }

        return view('user.errorLogin');   // Altrimenti passo la vista di errore
        
    }

    public function logout(){

        session_destroy();

        return Redirect::to(route('home')); 
    }


    /*

            SUBSCRIPTION
    
    */

    public function create()    // funzione per Creare un utente -> iscrizione
    {
        return view('user.subscription');
    }

    // Per memorizzare l'utente dalla subscription

    public function store(Request $req)
    { //Request serve per mandare la richiesta http

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $dl->addUser($req->input('firstname'), $req->input('lastname'), $req->input('email'), $req->input('telephone')
                    , $req->input('password'), $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
        
        return Redirect::to(route('home')); // Importa la classe Redirect!!
    }



    /*

            PROFILE & PERSONAL-INFO
    */

    // Qui sotto TUTTO ha per forza LOGGED=true e loggedName= $_SESSION['loggedName'], perchè quando sono qui sono già loggato!
    
    public function profile(){
        
        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $user=$dl->getUser($_SESSION['email']);


        return view('user.profile')->with('logged',true)->with('loggedName', $_SESSION['loggedName'])->with('user', $user) ;
    }

    public function adventures(){
        
        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $user=$dl->getUser($_SESSION['email']);

        $housings=array(); // Creo un array, in cui salverò gli alloggi
        $housings=$dl->getUserHousing($_SESSION['email']);

        $attractions=array(); 
        $attractions=$dl->getUserAttraction($_SESSION['email']);


        return view('user.adventures')->with('housings_list', $housings)->with('attractions_list', $attractions)->with('logged',true)->with('loggedName', $_SESSION['loggedName'])->with('user', $user) ;
    }

}

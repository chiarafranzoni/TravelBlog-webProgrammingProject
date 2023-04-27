<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\myUser; //Specifico che voglio usare quel modello
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect; // Importo la classe


class UserController extends Controller
{

    public function create()    // funzione per Creare un utente -> iscrizione
    {
        return view('user.subscription');
    }

    public function login()
    {
        return view('user.login');
    }

    public function store(Request $req)
    { //Request serve per mandare la richiesta http

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $dl->addUser($req->input('firstname'), $req->input('lastname'), $req->input('email'), $req->input('telephone')
                    , $req->input('password'), $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
        
        return Redirect::to(route('home')); // Importa la classe Redirect!!
    }
}
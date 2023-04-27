<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function getHome()
    {
        // Definisco la funzione che mi pernette di tornare la view "index"
        return view('index'); 
    }
}

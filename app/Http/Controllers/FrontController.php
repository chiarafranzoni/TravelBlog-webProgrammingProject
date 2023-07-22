<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
   
    /* SE uno ha già fatto il login:

    => NON ho ancora settato logged in UserController-> $logged=false
    
    => altrimenti: sono già loggato e ho le giuste info per avere più accesso nella navbar
    */
    

    public function getHome()
    {

        session_start();
        
        /* Verifico se esiste lo username e se la password corrisponde */

       if(!isset($_SESSION['logged'])){

        return view('index')->with('logged',false);

       }
       else{

        return view('index')->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/

       }
        
        
    }
}

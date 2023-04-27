<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;


/*
        Nelle route specifico:
            - un metodo http (es. get)
            - l'url della pagina dove saranno visualizzate le info (es. / indica 'localhots:8000')
            - il nome del Controlller da usare
            - il metodo del Controller che invoco

 */

Route::get('/',[FrontController::class, 'getHome'])-> name('home');



/**
 * 
 *          USER 
 * 
 */

// PER USER uso Rotta Restfull !

Route::resource('user', UserController::class);

/* Specifico risorsa user e il controller ad esso associata 

    --> si inseriscono 7 metodi definiti:

    - index
    - create
    - store
    - show
    - edit
    - update
    - destroy

NB: DEVO COMUNQUE RIDEFINIRE SOTTO TUTTE LE FUNZIONI CHE NON SONO QUESTE 7

*/



Route::get('/user',[UserController::class,'login'])-> name('user.login');



/**
 * 
 *          RESTAURANT
 * 
 */

Route::resource('restaurant', RestaurantController::class);
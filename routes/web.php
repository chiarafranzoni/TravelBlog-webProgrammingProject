<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\AttractionController;


 /**
 * 
 *          MIDDLEWARE
 * 
 */


 Route::middleware(['user'])->group(function(){        /* Così ho limitato alcune azioni agli utenti loggati */
    
    /* HOUSING */
    Route::get('/housing/add', [HousingController::class, 'add'])->name('housing.add');
    Route::post('/housing/store', [HousingController::class, 'store'])->name('housing.store');

    /* ATTRACTION */
    Route::get('/attraction/add', [ AttractionController::class, 'add'])->name('attraction.add');
    Route::post('/attraction/store', [  AttractionController::class, 'store'])->name('attraction.store');
    

    /* USER */
    Route::get('/user/logout',[UserController::class, 'logout'])->name('user.logout');
    Route::get('/user/profile',[UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/adventures',[UserController::class, 'adventures'])->name('user.adventures');


 });



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

//Route::resource('user', UserController::class);

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

Route::get('/user/login',[UserController::class,'login'])-> name('user.login');
Route::post('/user/login',[UserController::class, 'authentication'])->name('user.authentication');


Route::get('/user/create',[UserController::class,'create'])-> name('user.create');
Route::post('/user/store',[UserController::class, 'store'])->name('user.store');




/**
 * 
 *          RESTAURANT
 * 
 */

Route::resource('restaurant', RestaurantController::class);




/**
 * 
 *          HOUSING
 * 
 */

 Route::resource('housing', HousingController::class);


 /**
 * 
 *          ATTRACTION
 * 
 */

 Route::resource('attraction', AttractionController::class);

 



    
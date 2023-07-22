<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\TravelController;


 /**
 * 
 *          MIDDLEWARE
 * 
 */



 Route::middleware(['user'])->group(function(){        /* Così ho limitato alcune azioni agli utenti loggati */
    
    /* HOUSING */
    Route::get('/housing/add', [HousingController::class, 'add'])->name('housing.add');
    Route::post('/housing/store', [HousingController::class, 'store'])->name('housing.store');
    Route::get('/housing/{id}/edit', [HousingController::class, 'edit'])->name('housing.edit'); 
    Route::get('/housing/{id}/update', [HousingController::class, 'update'])->name('housing.update');
    Route::get('/housing/{id}/destroy', [HousingController::class, 'destroy'])->name('housing.cancella');
    Route::get('/housing/{id}/destroy/confirm', [HousingController::class, 'confirmDestroy'])->name('housing.destroy.confirm');
    Route::get('/ajaxFormCheckHousing',[HousingController::class, 'ajaxCheck']);  // Per verificare se è già presente
   
    /* ATTRACTION */
    Route::get('/attraction/add', [ AttractionController::class, 'add'])->name('attraction.add');
    Route::post('/attraction/store', [  AttractionController::class, 'store'])->name('attraction.store');
    Route::get('/attraction/{id}/edit', [AttractionController::class, 'edit'])->name('attraction.edit'); 
    Route::get('/attraction/{id}/update', [AttractionController::class, 'update'])->name('attraction.update');
    Route::get('/attraction/{id}/destroy', [AttractionController::class, 'destroy'])->name('attraction.cancella');
    Route::get('/attraction/{id}/destroy/confirm', [AttractionController::class, 'confirmDestroy'])->name('attraction.destroy.confirm');
    Route::get('/ajaxFormCheckAttraction',[AttractionController::class, 'ajaxCheck']);  // Per verificare se è già presente
    
    /* RESTAURANT */
    Route::get('/restaurant/add', [ RestaurantController::class, 'add'])->name('restaurant.add');
    Route::post('/restaurant/store', [  RestaurantController::class, 'store'])->name('restaurant.store');
    Route::get('/restaurant/{id}/edit', [RestaurantController::class, 'edit'])->name('restaurant.edit'); 
    Route::get('/restaurant/{id}/update', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::get('/restaurant/{id}/destroy', [RestaurantController::class, 'destroy'])->name('restaurant.cancella');
    Route::get('/restaurant/{id}/destroy/confirm', [RestaurantController::class, 'confirmDestroy'])->name('restaurant.destroy.confirm');
    Route::get('/ajaxFormCheckRestaurant',[RestaurantController::class, 'ajaxCheck']);  // Per verificare se è già presente
    

    /* USER */
    Route::get('/user/logout',[UserController::class, 'logout'])->name('user.logout');
    Route::get('/user/profile',[UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/adventures',[UserController::class, 'adventures'])->name('user.adventures');
    Route::post('/user/addressUpdate',[UserController::class, 'addressUpdate'])->name('user.addressUpdate');

    /* TRAVEL */
    Route::get('/travel/add', [ TravelController::class, 'add'])->name('travel.add');
    Route::get('/travel/{id}/edit', [TravelController::class, 'edit'])->name('travel.edit'); 
   // Route::get('/travel/{id}/update', [TravelController::class, 'update'])->name('travel.update');
    Route::get('/travel/{id}/destroy', [TravelController::class, 'destroy'])->name('travel.cancella');
    Route::get('/travel/{id}/destroy/confirm', [TravelController::class, 'confirmDestroy'])->name('travel.destroy.confirm');
    
    Route::get('/ajaxDeleteStage', [ TravelController::class, 'ajaxDeleteStage']);


 });


 Route::get('/ajaxVerifySub',[UserController::class, 'ajaxVerifySub']); 

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
 *          TRAVEL
 * 
 */


 Route::get('/travel/{id}/more', [TravelController::class, 'more'])->name('travel.more');


/**
 * 
 *          HOUSING
 * 
 */


 Route::get('/housing/{id}/more', [HousingController::class, 'more'])->name('housing.more');


 /**
 * 
 *          ATTRACTION
 * 
 */


 Route::get('/attraction/{id}/more', [AttractionController::class, 'more'])->name('attraction.more');

 
 /**
 * 
 *          RESTAURANT
 * 
 */


 Route::get('/restaurant/{id}/more', [RestaurantController::class, 'more'])->name('restaurant.more');


/**
 * 
 *          TRAVEL
 * 
 */

 Route::resource('travel', TravelController::class);

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

 



    
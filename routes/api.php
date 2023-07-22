<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HousingController;
use App\Http\Controllers\AttractionController;
use App\Http\Controllers\TravelController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['user'])->group(function(){        /* Così ho limitato alcune azioni agli utenti loggati */
    
    /* HOUSING */
    Route::post('/ajaxHousingAddDescription',[HousingController::class, 'ajaxHousingAddDescription']);
    Route::post('/ajaxEditHousingNOImage',[HousingController::class, 'ajaxEditHousingNOImage']);

    /* ATTRACTION */
    Route::post('/ajaxAttractionAddDescription',[AttractionController::class, 'ajaxAttractionAddDescription']);
    Route::post('/ajaxEditAttractionNOImage',[AttractionController::class, 'ajaxEditAttractionNOImage']);

     /* RESTAURANT */
     Route::post('/ajaxRestaurantAddDescription',[RestaurantController::class, 'ajaxRestaurantAddDescription']);
     Route::post('/ajaxEditRestaurantNOImage',[RestaurantController::class, 'ajaxEditRestaurantNOImage']);

    /* TRAVEL */
    Route::post('/ajaxAddStage',[TravelController::class, 'ajaxAddStage']);
    Route::post('/ajaxAddTravel',[TravelController::class, 'ajaxAddTravel']);
    Route::post('/ajaxEditTravelNOImage',[TravelController::class, 'ajaxEditTravelNOImage']);
    Route::post('/ajaxEditTravelWITHImage',[TravelController::class, 'ajaxEditTravelWITHImage']);
    Route::post('/ajaxEditStage',[TravelController::class, 'ajaxEditStage']);
  

    /* USER */
    Route::post('/ajaxEditProfileNOEmail',[UserController::class, 'ajaxEditProfileNOEmail']); 
    Route::post('/ajaxEditProfileWITHEmail',[UserController::class, 'ajaxEditProfileWITHEmail']); 
    
   
   

 });

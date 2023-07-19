<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travel; //Specifico che voglio usare quel modello
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class TravelController extends Controller
{
    // Mi faccio torare la pagina 
    public function index(){

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $travels=array(); // Creo un array, in cui salverò gli alloggi


        $travels=$dl->publicTravel();

    
        if(!isset($_SESSION['logged'])){

            return view('travel.index')->with('travels_list', $travels)->with('logged',false);
    
        }
        else{
    
            return view('travel.index')->with('travels_list', $travels)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
    
        }
    }

    public function add(){

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $user=$dl->getUser($_SESSION['email']);

        $housings=array(); // Creo un array, in cui salverò gli alloggi
        $housings=$dl->getUserHousing($_SESSION['email']);

        $attractions=array(); 
        $attractions=$dl->getUserAttraction($_SESSION['email']);

        $restaurants=array(); 
        $restaurants=$dl->getUserRestaurant($_SESSION['email']);

        return view('travel.add')->with('logged',true)->with('housings',$housings)->with('attractions',$attractions)->with('restaurants',$restaurants)->with('loggedName', $_SESSION['loggedName']);
    }


    public function more($id){ // Chiamo la rotta passando l'id della attraction che voglio visualizzare

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $travel=$dl->getTravelFromId($id);  // Mi faccio tornare la attraction assoiciata all'id


        if(!isset($_SESSION['logged'])){

           return view('travel.more')->with('travel', $travel[0])->with('logged',false);
  
           }
           else{
  
           return view('travel.more')->with('travel', $travel[0])->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
  
           }

        
    }

    public function edit($id){ // Chiamo la rotta passando l'id della restaurant che voglio visualizzare


        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $user=$dl->getUser($_SESSION['email']);

        $housings=array(); // Creo un array, in cui salverò gli alloggi
        $housings=$dl->getUserHousing($_SESSION['email']);

        $attractions=array(); 
        $attractions=$dl->getUserAttraction($_SESSION['email']);

        $restaurants=array(); 
        $restaurants=$dl->getUserRestaurant($_SESSION['email']);

        
        $travel=$dl->getTravelFromId($id);

        console_log($travel[0]);
  
  
        return view('travel.edit')->with('travel', $travel[0])->with('housings',$housings)->with('attractions',$attractions)->with('restaurants',$restaurants)->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
     
  
    }
  

    // Presenta una pagina per chiedere la conferma della cancellazione
   public function confirmDestroy($id){ 

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $travel=$dl->getTravelFromId($id);

        return view('travel.delete')->with('travel', $travel[0])->with('logged',true)->with('loggedName', $_SESSION['loggedName']);

   }

 // Elimino il travel e gli stage
    public function destroy($id){
    
        $dl=new DataLayer(); 

        $dl-> destroyTravel($id);
        return Redirect::to(route('user.adventures'));


    }


    public function ajaxAddStage(Request $req){

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $id= $dl->addStage($req->input('location'), $req->input('nation'),$req->input('housing_array'),
                     $req->input('restaurant_array'),$req->input('attraction_array'));

        $stageAdded= $dl->getStageFromId($id);

        $response=array("id"=>$id,"stageAdded"=>$stageAdded);

        return response()->json($response);

    }

    public function ajaxAddTravel(Request $req){

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

         
        $user=$dl->getUser($_SESSION['email']);
  
        $image= $req->file('thumbnail');
        $image_name=null;
  
        if($image){
           $image_name= $req->file('thumbnail')->getClientOriginalName();
  
           // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
           // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
        $image_name= ($user->id).$image_name;  
  
        //Salvo l'immagine
        $req->file('thumbnail')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata
  
        }

        $dl->addTravel($req->input('title'),$req->input('duration'),$req->input('transportation_array'),
                    $req->input('stage_array'),$req->input('public'),$image_name, $user);

        
        return;
    }

    public function ajaxEditTravelNOImage(Request $req){    // AGGIUNGI STAGE_ARRAY E IMMAGINE

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database
  
        $dl->editTravelNOImage($req->input('travelID'),$req->input('title'),$req->input('duration'),$req->input('transportation_array'),
                                $req->input('stage_array'), $req->input('public'));   // AGGIUNGI: $image_name, $req->input('stage_array'),

        
        return;
    }

    public function ajaxEditTravelWITHImage(Request $req){    // AGGIUNGI STAGE_ARRAY E IMMAGINE

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

         
        $user=$dl->getUser($_SESSION['email']);
  
        $image= $req->file('thumbnail');
        $image_name=null;
  
        if($image){
           $image_name= $req->file('thumbnail')->getClientOriginalName();
  
           // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
           // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
        $image_name= ($user->id).$image_name;  
  
        //Salvo l'immagine
        $req->file('thumbnail')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata
  
        }
  
        $dl->editTravelWITHImage($req->input('travelID'),$req->input('title'),$req->input('duration'),$req->input('transportation_array'),
                                $req->input('stage_array'), $req->input('public'),$image_name);   // AGGIUNGI: $image_name, $req->input('stage_array'),

        
        return;
    }

    public function ajaxDeleteStage(Request $req){

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $dl-> deleteStageFromId($req->input('stageID'));

        $dl-> modifyStagesOfTravel($req->input('travelID'),$req->input('stage_array'));


    }

    public function ajaxEditStage(Request $req){

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        $dl-> editStageFromId($req->input('stageID'),$req->input('location'),$req->input('nation'),
                            $req->input('housing_array'),$req->input('restaurant_array'),$req->input('attraction_array') );

    }

}

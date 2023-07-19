<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant; //Specifico che voglio usare quel modello
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class RestaurantController extends Controller

{
    // Mi faccio torare la pagina 
    public function index(){

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $restaurants=array(); // Creo un array, in cui salverò gli alloggi


        $restaurants=$dl->publicRestaurantFromInfo();

    
        if(!isset($_SESSION['logged'])){

            return view('restaurant.index')->with('restaurants_list', $restaurants)->with('logged',false);
    
        }
        else{
    
            return view('restaurant.index')->with('restaurants_list', $restaurants)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
    
        }
    }

    public function add(){
        return view('restaurant.add')->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
    }

    // Per memorizzare il restaurant che inserisco del form

    public function store(Request $req)
    { //Request serve per mandare la richiesta http

        session_start();

        console_log($req->file('image'));

        $dl = new DataLayer(); // DataLayer gestisce tutte le query del database

        
        $user=$dl->getUser($_SESSION['email']);

        $image= $req->file('image');
        $image_name=null;

        if($image){
            $image_name= $req->file('image')->getClientOriginalName();
  
            // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
            // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
           $image_name= ($user->id).$image_name;  
   
           //Salvo l'immagine
           $req->file('image')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata
   
          }

        $dl->addRestaurant($req->input('name'), $req->input('category'), $req->input('price'), $req->input('description')
                    , $req->input('link'), $req->input('stars'), $req->input('public'),$image_name, $user
                    , $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
        
        return Redirect::to(route('restaurant.index')); // Importa la classe Redirect!!
    }

    public function more($id){ // Chiamo la rotta passando l'id della attraction che voglio visualizzare

        session_start();

        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi

        $restaurant=$dl->getRestaurantFromId($id);  // Mi faccio tornare la attraction assoiciata all'id

        $infos=$dl->getInfoFromRestaurantId($restaurant[0]->id);

        $images=[];

         for ($i=0; $i <count($infos) ; $i++) { 
            
               if ($infos[$i]->place_image!='' && $infos[$i]->place_image != 'http://localhost:8000/storage/images'){
                  
                  array_push($images,$infos[$i]->place_image); 
               }
               
         }

        $address=$dl->getAddressFromId($restaurant[0]->address_id);

        if(!isset($_SESSION['logged'])){

           return view('restaurant.more')->with('restaurant', $restaurant[0])->with('infos', $infos)->with('images', $images)->with('address', $address)->with('logged',false);
  
           }
           else{
  
           return view('restaurant.more')->with('restaurant', $restaurant[0])->with('infos', $infos)->with('images', $images)->with('address', $address)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
  
           }

        
  }


   public function edit($id){ // Chiamo la rotta passando l'id della restaurant che voglio visualizzare


        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi
  
        
        $restaurants=array(); 
        $restaurants=$dl->getUserRestaurantByID($_SESSION['email'], $id);
  
    
  
        $address=$dl->getAddressFromId($restaurants[0]->address_id);
  
  
        return view('restaurant.edit')->with('restaurant', $restaurants[0])->with('address', $address)->with('logged',true)->with('loggedName', $_SESSION['loggedName']); /* il metodo permette di eseguire index in view*/
    
     
  
   }
  
  
   public function update(Request $req,$id){ // Per inviare le modifiche
  
  
        session_start();
        
        $dl=new DataLayer(); 
  
        
        $user=$dl->getUser($_SESSION['email']);
  
        $image= $req->file('image');
        $image_name=null;
  
        if($image){
           $image_name= $req->file('image')->getClientOriginalName();
  
           // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
           // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
        $image_name= ($user->id).$image_name;  
  
        //Salvo l'immagine
        $req->file('image')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata
  
        }
  
        console_log($req->input('category'));
  
  
        $dl->editRestaurant($id, $req->input('name'), $req->input('category'), $req->input('price'), $req->input('description')
        , $req->input('link'), $req->input('stars'), $req->input('public'),$image_name, $user
        , $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
    
        return Redirect::to(route('user.adventures'));
  
   }
  
     // Presenta una pagina per chiedere la conferma della cancellazione
   public function confirmDestroy($id){ 
  
  
        $dl=new DataLayer(); // Creo un oggetto di tipo datalayer per poterne usare i metodi
  
        console_log($id);
  
        
        $restaurants=array(); 
        $restaurants=$dl->getUserRestaurantByID($_SESSION['email'], $id);
  
        return view('restaurant.delete')->with('restaurant', $restaurants[0])->with('logged',true)->with('loggedName', $_SESSION['loggedName']);
  
   }
  
     // Elimino li einfo dell'attarction relative a quell'utente
     public function destroy($id){
  
        $dl=new DataLayer(); 
  
        $user=$dl->getUser($_SESSION['email']);  // Capisco che utente stia facendo le cose
        /**
         * 
         * 
         *    IMPLEMENTA IL DELETE NEL DATALAYER !
         * 
         *    deleteRestaurant(), sulla base dell'id dell'ttraction e dell'id dell'utente
         * 
         */
  
         $dl-> destroyRestaurant($id, $user->id);
         return Redirect::to(route('user.adventures'));
  
  
     }
  


     public function ajaxCheck(Request $req){
      
        $dl= new DataLayer();
  
        $restaurantId= $dl->findExistingRestaurant(
           $req->input('name'),
           $req->input('type'),
           $req->input('street_and_number'),
           $req->input('city'),
           $req->input('province')
        );
  
        if ($restaurantId) { // Se trovo l'id, lo ritorno, perchè esiste già l'restaurant
  
           $response=array("found"=>$restaurantId);
           
        }else{   // Altrimenti torno false
  
           $response=array("found"=>false);
        }
      
        
        return response()->json($response);
     }


    
    public function ajaxRestaurantAddDescription(Request $req){

        $dl= new DataLayer();

        $image= $req->file('image');

        $user=$dl->getUser($_SESSION['email']);

        $image= $req->file('image');
        $image_name=null;

        if($image){
        $image_name= $req->file('image')->getClientOriginalName();

        // Concateno all'inizio del nome dell'immagine nche l'id dell'utente
        // => anche se due utenti mettono un immagine con lo stesso nome, non ci sono problemi
        $image_name= ($user->id).$image_name;  

        //Salvo l'immagine
        $req->file('image')->storeAs('public/images/', $image_name);  // Salvo l'immagine in storage->app->public->images con il nome con cui l'ho salvata

        }

        $restaurantId= $dl->findExistingRestaurant(     // Torna l'id dell'attrazione che esiste già
        $req->input('name'),
        $req->input('type'),
        $req->input('street_and_number'),
        $req->input('city'),
        $req->input('province')
        );

        $dl->addRestaurantGeneralInfo( 
        $req->input('price'),
        $req->input('description'),
        $req->input('link'), 
        $image_name,
        $req->input('stars'),
        $req->input('public'),
        $user,
        $restaurantId,
        )  ;


        return Redirect::to(route('restaurant.index'));
    }

    public function ajaxEditRestaurantNOImage(Request $req){

      
        $dl=new DataLayer(); 
  
        
        $user=$dl->getUser($_SESSION['email']);
  
  
        $dl->editRestaurantNOImage($req->input('id'), $req->input('entity_name'), $req->input('category'), $req->input('price'), $req->input('description')
        , $req->input('link'), $req->input('stars'), $req->input('public'), $user
        , $req->input('street_and_number'),$req->input('city'),$req->input('province'),$req->input('country'),$req->input('postcode'));
    
        return Redirect::to(route('user.adventures'));
     }
}
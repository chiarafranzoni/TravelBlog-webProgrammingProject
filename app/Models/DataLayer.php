<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLayer 
{

     /**
     *      METODI PER USER
     * 
     */

    // Metodo per aggiungere un user alla table
    public function addUser($firstname,$lastname,$email, $telephone,$password,
                            $street_and_number, $city,$province,$country,$postcode
    ) {

    

        // Aggiungo prima l'indirizzo relativo all'utente
        $address = new Address;

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();

        // Poi posso creare l'user, a cui associare l'id di address come chiave esterna
        $user = new myUser;

        $user->firstname=  $firstname;
        $user->lastname = $lastname;
        $user->address_id=$address->id; // Mi faccio tornare l'id dell'address appena creato
        $user->email = $email;
        $user->telephone = $telephone;
        $user->password = md5($password);


        $user->save();

    }

    public function validUser($email, $password){

        // Recupero l'array di password degli utenti che hanno mail corrispondente

        $users= myUser::where('email',$email)->get(['password']);

        if(count($users)==0){
            return false;
        }

        return (md5($password)==($users[0]->password)); // Confronto le password criptate con md5, se sono uguali tutto è andato bene

    }

    public function getUserName($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        return $users[0]->firstname;  //recupero il nome corrispondente all'autente nella prima cella dell'array
    }

    public function getUser($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        return $users[0];  //recupero il nome corrispondente all'autente nella prima cella dell'array
    }

    public function userExist($email){

        $users= myUser::where('email',$email)->get();
       
        if(count($users)==0){

            return false;
        }else{
            return true;
        }
    }

    public function editProfileWithNOEmail($firstname, $lastname, $password,$user){

        $user =myUser::find($user->id);

        $user->firstname=  $firstname;
        $user->lastname = $lastname;
        $user->password = md5($password);

        $user->save();
    }

    public function editProfileWithEmail($firstname, $lastname, $password,$email,$user){

        $user =myUser::find($user->id);

        $user->firstname=  $firstname;
        $user->lastname = $lastname;
        $user->password = md5($password);
        $user->email = $email;

        $user->save();
    }

    public function editAddress($street_and_number, $city, $province,$country,$postcode, $user){

        $address = Address::find($user->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();

    }



    /* USER and HOUSING */
    public function getUserHousing($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();

        $housingInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->get();


        $housings=[];

        foreach ($housingInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $housing = Housing::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($housing && count($housing)){    // se housing esiste lo pusho 
                
                
                $housing[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($housings,$housing[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $housings;
    
    }
   
    public function getUserHousingByID($email, $id){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $housingInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();


        $housings=[];

        foreach ($housingInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $housing = Housing::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($housing && count($housing)){    // se housing esiste lo pusho 
                
                
                $housing[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($housings,$housing[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $housings;
    
    }

    /* USER and ATTRACTION */

    public function getUserAttraction($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $attractionInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->get();


        $attractions=[];

        foreach ($attractionInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $attraction = Attraction::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($attraction && count($attraction)){    // se housing esiste lo pusho 
                
                
                $attraction[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($attractions,$attraction[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $attractions;
    
    }

    public function getUserAttractionByID($email, $id){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $attractionInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();


        $attractions=[];

        foreach ($attractionInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $attraction = Attraction::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($attraction && count($attraction)){    // se housing esiste lo pusho 
                
                
                $attraction[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($attractions,$attraction[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $attractions;
    
    }

    /* USER and RESTAURANT */

    public function getUserRestaurant($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $restaurantInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->get();


        $restaurants=[];

        foreach ($restaurantInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $restaurant = Restaurant::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($restaurant && count($restaurant)){    // se housing esiste lo pusho 
                
                
                $restaurant[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($restaurants,$restaurant[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $restaurants;
    
    }

      
    public function getUserRestaurantByID($email, $id){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $restaurantInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["myuser_id", "=", $users[0]->id]
                    ])
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();


        $restaurants=[];

        foreach ($restaurantInfo_array as $info)  {            /* Per ciascun indice, verifico a quale restaurant corrisponde l'id*/

            
            $restaurant = Restaurant::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($restaurant && count($restaurant)){    // se restaurant esiste lo pusho 
                
                
                $restaurant[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($restaurants,$restaurant[0]);  // Pusho nell'array sia l'restaurant che le sue info relative
            
            }

        }   

        return $restaurants;
    
    }


    /* USER and TRAVEL */

    public function getUserTravel($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        
        $travels= Travel::select("*")       /* Ritorno tutte le info riguardanti le ATTRACTION e che sono pubbliche*/
        ->where([
            ["myuser_id", "=", $users[0]->id]
        ])
        ->get();
        

        foreach ($travels as $travel)  { /* Per ciascun indice, verifico a quale ATTRACTION corrisponde al ref_id delle info*/

            $stages= json_decode($travel->stages);


            $stage_array=[];

            foreach ($stages as $stage_id){

                $stage= Stage::select("*")       /* Ritorno tutte le tappe del viaggio*/
                    ->where([
                        ["id", "=", $stage_id]
                    ])
                    ->get();


                if ($stage && count($stage)) {
                    
                    array_push($stage_array,$stage[0]);
                }
            }
            
            $travel->stage_array= $stage_array; 

        }   


        return $travels;
    
    }

    /*
    *           UTILI IN GENERALE
    */

    public function getAddressFromId($id){

        $address = Address::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
        
        ->where([
            ["id", "=", $id]
        ])
        ->get();


        return $address[0];
    }

     /**
     *      METODI PER TRAVEL
     * 
     */

    public function publicTravel(){
        $travels= Travel::select("*")       /* Ritorno tutte le info riguardanti le ATTRACTION e che sono pubbliche*/
        ->where([
            ["public", "=", 1]
        ])
        ->get();
        

        foreach ($travels as $travel)  { /* Per ciascun indice, verifico a quale ATTRACTION corrisponde al ref_id delle info*/

            $stages= json_decode($travel->stages);


            $stage_array=[];

            foreach ($stages as $stage_id){

                $stage= Stage::select("*")       /* Ritorno tutte le tappe del viaggio*/
                    ->where([
                        ["id", "=", $stage_id]
                    ])
                    ->get();


                if ($stage && count($stage)) {
                    
                    array_push($stage_array,$stage[0]);
                }
            }

            $user = myUser::select("*")
                    ->where([
                        ["id", "=", $travel->myuser_id]
                    ])
                    ->get();
            
            $travel->stage_array= $stage_array; 
            $travel->user= $user[0]; 

        }   


        return $travels;
    }

    public function getStageFromId($id){
        $stage = Stage::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();
        return $stage[0];
    }

    public function deleteStageFromId($id){

        $stage= Stage::select("*")       /* Ritorno la tappa corrispondente */
                    ->where([
                        ["id", "=", $id]
                    ])
                    ->get();

                $stage[0]->delete();
    }

    public function modifyStagesOfTravel($id, $stage_array){

        
        $travel= Travel::find($id);

        $travel->stages =$stage_array;
        
        $travel->save();
        
    }


    public function editStageFromId($stageID,$location,$nation,$housing_array,$restaurant_array, $attraction_array){

        $stage= Stage::find($stageID);

        $stage->location = $location;
        $stage->nation = $nation;
        $stage->housings = $housing_array;
        $stage->restaurants = $restaurant_array;
        $stage->attractions = $attraction_array;

        $stage->save();
    }

    public function getTravelFromId($id){


        $travels = Travel::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();

    
        foreach ($travels as $travel)  { 

            $user = myUser::select("*")
            ->where([
                ["id", "=", $travel->myuser_id]
            ])
            ->get();
    

            $stages= json_decode($travel->stages);


            $stage_array=[];

            foreach ($stages as $stage_id){ // cerco lo stage

                $housing_array=[];
                $attraction_array=[];
                $restaurant_array=[];

                $stage= Stage::select("*")       /* Ritorno tutte le tappe del viaggio*/
                    ->where([
                        ["id", "=", $stage_id]
                    ])
                    ->get();


                $housings=json_decode($stage[0]->housings);
                if($housings){
                    foreach($housings as $housing_id){ 

                        $housingInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["myuser_id", "=", $user[0]->id]
                        ])
                        ->where([
                            ["category", "=", "HOUSING"]
                        ])
                        ->where([
                            ["ref_id", "=", $housing_id]
                        ])
                        ->get();


                        foreach ($housingInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

                            
                            $housing = Housing::select("*")
                                    ->where([
                                        ["id", "=", $info->ref_id]
                                    ])
                                    ->get();

                            if($housing && count($housing)){    // se housing esiste lo pusho 
                                
                                
                                $housing[0]-> info= $info;      // Assegno la chiave info il valore $info
                            
                                array_push($housing_array,$housing[0]);  // Pusho nell'array sia l'housing che le sue info relative
                            
                            }

                        }



                    }
                }

                $restaurants=json_decode($stage[0]->restaurants);
                if($restaurants){
                    foreach($restaurants as $restaurant_id){ 

                        $restaurantInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["myuser_id", "=", $user[0]->id]
                        ])
                        ->where([
                            ["category", "=", "RESTAURANT"]
                        ])
                        ->where([
                            ["ref_id", "=", $restaurant_id]
                        ])
                        ->get();


                        foreach ($restaurantInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

                            
                            $restaurant = Restaurant::select("*")
                                    ->where([
                                        ["id", "=", $info->ref_id]
                                    ])
                                    ->get();

                            if($restaurant && count($restaurant)){    // se housing esiste lo pusho 
                                
                                
                                $restaurant[0]-> info= $info;      // Assegno la chiave info il valore $info
                            
                                array_push($restaurant_array,$restaurant[0]);  // Pusho nell'array sia l'housing che le sue info relative
                            
                            }

                        }



                    }
                }
                
                $attractions=json_decode($stage[0]->attractions);
                if($attractions){
                    foreach($attractions as $attraction_id){ 

                        $attractionInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["myuser_id", "=", $user[0]->id]
                        ])
                        ->where([
                            ["category", "=", "ATTRACTION"]
                        ])
                        ->where([
                            ["ref_id", "=", $attraction_id]
                        ])
                        ->get();


                        foreach ($attractionInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

                            
                            $attraction = Attraction::select("*")
                                    ->where([
                                        ["id", "=", $info->ref_id]
                                    ])
                                    ->get();

                            if($attraction && count($attraction)){    // se housing esiste lo pusho 
                                
                                
                                $attraction[0]-> info= $info;      // Assegno la chiave info il valore $info
                            
                                array_push($attraction_array,$attraction[0]);  // Pusho nell'array sia l'housing che le sue info relative
                            
                            }

                        }



                    }
                }
                


                $stage[0]->housing_array = $housing_array;
                $stage[0]->restaurant_array = $restaurant_array;
                $stage[0]->attraction_array = $attraction_array;

            

                if ($stage && count($stage)) {
                    
                    array_push($stage_array,$stage[0]);
                }
            }

            
            $travel->stage_array= $stage_array; 
            $travel->user= $user[0]; 

        }   


        return $travels;
    }

    public function addStage($location, $nation, $housing_array, $restaurant_array, $attraction_array){

        $stage= new Stage;

        $stage->location =$location;
        $stage->nation =$nation;
        $stage->housings =$housing_array;
        $stage->restaurants =$restaurant_array;
        $stage->attractions =$attraction_array;

        $stage->save();

        return $stage->id;
    }

    public function addTravel($title,$duration,$transportation_array,$stage_array,$public,$image_name, $user){

        $travel= new Travel;

        $travel->title =$title;
        $travel->duration =$duration;
        $travel->transportation =$transportation_array;
        $travel->stages =$stage_array;

        if ($public=== 'true') {
            $travel->public = 1;
        }else{
            $travel->public = 0;
        }

        $travel->myuser_id = $user->id ;
        
        $travel->thumbnail= asset("storage/images/$image_name");


        $travel->save();
    }
    

    public function destroyTravel($id){

        $travels = Travel::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();

    
        foreach ($travels as $travel)  { 

            $stages= json_decode($travel->stages);

            foreach ($stages as $stage_id){ // cerco lo stage

                $stage= Stage::select("*")       /* Ritorno tutte le tappe del viaggio*/
                    ->where([
                        ["id", "=", $stage_id]
                    ])
                    ->get();

                $stage[0]->delete();
            }

            $travel->delete();

         }

    }

    //$travel->stages =$stage_array;
        //$travel->thumbnail= asset("storage/images/$image_name");
    public function editTravelNOImage($travelID, $title,$duration,$transportation_array,$stage_array,$public){  // NON modifico l'immagine

        $travel= Travel::find($travelID);

        $travel->title =$title;
        $travel->duration =$duration;
        $travel->transportation =$transportation_array;
        $travel->stages =$stage_array;
        
        
        $travel->public = 0;

        if ($public=== 'true') {
            $travel->public = 1;
        }
        


        $travel->save();
    }


    public function editTravelWITHImage($travelID, $title,$duration,$transportation_array,$stage_array,$public,$image_name){  //MODIFICO con la nuova immagine

        $travel= Travel::find($travelID);

        $travel->title =$title;
        $travel->duration =$duration;
        $travel->transportation =$transportation_array;
        $travel->stages =$stage_array;
        $travel->thumbnail= asset("storage/images/$image_name");
        
        
        $travel->public = 0;

        if ($public=== 'true') {
            $travel->public = 1;
        }
        


        $travel->save();
    }




    /**
     *      METODI PER RESTAURANT
     * 
     */


    public function publicRestaurantFromInfo(){            /* Mi faccio tornare le attrazioni dalle info */

        $restaurantInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti le ATTRACTION e che sono pubbliche*/
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();


        $restaurants=[];

        foreach ($restaurantInfo_array as $info)  { /* Per ciascun indice, verifico a quale ATTRACTION corrisponde al ref_id delle info*/

            
            $restaurant = Restaurant::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

                    if($restaurant && count($restaurant)){    // se attraction esiste lo pusho 
                
                        $counter=0;
                        for ($i=0; $i < count($restaurants); $i++) { 
                            
                            if($restaurants[$i]->id == $restaurant[0]->id){
                                $counter=$counter+1;    // ho + attrazioni uguali

                                if ( $restaurants[$i]->info && ($restaurants[$i]->info->place_image == '' || $restaurants[$i]->info->place_image == 'http://localhost:8000/storage/images' )){

                            
                                    $restaurants[$i]->info= $info;
                                }
                            }
                        }
        
        
                        $restaurant[0]-> info= $info;      // Assegno la chiave info il valore $info
                       
                        if(!$counter){  // Non lo pusho se ho 2 attrazioni uguali
                        array_push($restaurants,$restaurant[0]);  // Pusho nell'array sia l'attraction che le sue info relative
                        }
                    }
        

        }   

        
        $addresses=[];


        for ($i=0; $i < count($restaurants); $i++) { 

            $addresses = Address::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                
                ->where([
                    ["id", "=", $restaurants[$i]->address_id]
                ])
                ->get();

            if($addresses && count($addresses)){    // se housing esiste lo pusho 
                
                
                $restaurants[$i]->address= $addresses[0];     // Assegno la chiave info il valore $info

            }
        }

        return $restaurants;
    }


     // Metodo per aggiungere una RESTAURANT alla table
    public function addRestaurant($name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
    $street_and_number, $city,$province,$country,$postcode
        ) {



        // Aggiungo prima l'indirizzo relativo alla housing
        $address = new Address;

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();

        // Poi posso creare la HOUSING, a cui associare l'id di address come chiave esterna
        $restaurant = new Restaurant;

        $restaurant->name=  $name;
        $restaurant->type = $category;
        $restaurant->address_id=$address->id;

        $restaurant->save();

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="RESTAURANT";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$restaurant->id;

        $generalInfo->save();

    }

    public function getRestaurantFromId($id){


        $restaurant = Restaurant::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();

    

        return $restaurant;
    }

    public function getInfoFromRestaurantId($id){

        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();

        $users=[];


        for ($i=0; $i < count($Info_array); $i++) { 

            $users = myUser::select("*")
                    ->where([
                        ["id", "=", $Info_array[$i]->myuser_id]
                    ])
                    ->get();

            if($users && count($users)){    // se restaurant esiste lo pusho 
                
                
                $Info_array[$i]->user= $users[0];     // Assegno la chiave info il valore $info
            

            }
        }


        return $Info_array;
    }

    // dato il nome del restaurant, cerco se c'è un indirizzo che corrisponde a quello inserito,
    // altrimenti torno null -> NON c'è nessuna attraction che corrisponde
    public function findExistingRestaurant($name, $type, $street_and_number,$city, $province){

        $restaurants= Restaurant::select("*")
                    ->where([
                        ["name", "=", $name]
                    ])
                    ->get();

        for( $i=0; $i<count($restaurants); $i++){

            $address_id=$restaurants[$i]->address_id;

            $addresses= Address::select("*")
                    ->where([
                        ["id", "=", $address_id]
                    ])
                    ->get();

            if( $addresses[0] &&
                $addresses[0]->street_and_number == $street_and_number &&
                $addresses[0]->city == $city &&
                $addresses[0]->province == $province ){

                    return $restaurants[$i]->id;

            }
        
        }

     return null;

    }

    public function destroyRestaurant($id, $user_id){

        // Trovo le info relative a quell'attrazione e all'id
        $info = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti restaurant e che sono pubbliche*/
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["myuser_id", "=", $user_id]
                    ])
                    ->get();

        $info[0]->delete();    // cancello le info relative all'utente e l'attraction

        // Controllo poi quante info sono rimaste a quell'attraction
        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti restaurant e che sono pubbliche*/
                    ->where([
                        ["category", "=", "RESTAURANT"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();

        if(count($Info_array)==0){
            $restaurant = Restaurant::find($id);
            $restaurant->delete();
        }


    }


    public function addRestaurantGeneralInfo($price, $description,$link,$image_name,$stars,$public,$user,$restaurantId){  

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="RESTAURANT";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public=== 'true') {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$restaurantId;

        $generalInfo->save();
    }

    public function editRestaurant($id, $name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){



        // Trvo l'attrcation con l'id e la modifico
        $restaurant = Restaurant::find($id);

        $restaurant->name=  $name;
        $restaurant->type = $category;

        $restaurant->save();

        

        // Modifico l'indirizzo
        $address = Address::find($restaurant->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti restaurant e che sono pubbliche*/
                        ->where([
                            ["category", "=", "RESTAURANT"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="RESTAURANT";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$restaurant->id;

        $generalInfo->save();

    

    }

    public function editRestaurantNOImage($id, $name,$category,$price, $description,$link,$stars,$public,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){




        // Trvo l'attrcation con l'id e la modifico
        $restaurant = Restaurant::find($id);

        $restaurant->name=  $name;
        $restaurant->type = $category;

        $restaurant->save();

        

        // Modifico l'indirizzo
        $address = Address::find($restaurant->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti restaurant e che sono pubbliche*/
                        ->where([
                            ["category", "=", "RESTAURANT"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="RESTAURANT";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->stars=  $stars;

        if ($public=== 'true') {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$restaurant->id;

        $generalInfo->save();
    

    }



    /**
     *      METODI PER HOUSING
     * 
     */

    public function publicHousingFromInfo(){            /* Mi faccio tornare le case dalle info */

        $housingInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();


        $housings=[];

        foreach ($housingInfo_array as $info)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            
            $housing = Housing::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

                    if($housing && count($housing)){    // se attraction esiste lo pusho 
                
                        $counter=0;
                        for ($i=0; $i < count($housings); $i++) { 
                            
                            if($housings[$i]->id == $housing[0]->id){
                                $counter=$counter+1;    // ho + attrazioni uguali

                                if ( $housings[$i]->info && ($housings[$i]->info->place_image == '' || $housings[$i]->info->place_image == 'http://localhost:8000/storage/images' )){

                            
                                    $housings[$i]->info= $info;
                                }
                            }
                        }
        
        
                        $housing[0]-> info= $info;      // Assegno la chiave info il valore $info
                       
                        if(!$counter){  // Non lo pusho se ho 2 attrazioni uguali
                        array_push($housings,$housing[0]);  // Pusho nell'array sia l'attraction che le sue info relative
                        }
                    }
        

        }  
        
        $addresses=[];


        for ($i=0; $i < count($housings); $i++) { 

            $addresses = Address::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                
                ->where([
                    ["id", "=", $housings[$i]->address_id]
                ])
                ->get();

            if($addresses && count($addresses)){    // se housing esiste lo pusho 
                
                
                $housings[$i]->address= $addresses[0];     // Assegno la chiave info il valore $info

            }
        }
        

        return $housings;
    }


    // Metodo per aggiungere una HOUSING alla table
    public function addHousing($name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
                            $street_and_number, $city,$province,$country,$postcode
    ) {

    

        // Aggiungo prima l'indirizzo relativo alla housing
        $address = new Address;

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();

        // Poi posso creare la HOUSING, a cui associare l'id di address come chiave esterna
        $housing = new Housing;

        $housing->name=  $name;
        $housing->type = $category;
        $housing->address_id=$address->id;
        
        $housing->save();

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="HOUSING";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
            $generalInfo->public = 1;
        }else{
            $generalInfo->public = 0;
        }
        
        $generalInfo->ref_id=$housing->id;

        $generalInfo->save();

    }

    public function getHousingFromId($id){


        $housing = Housing::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();

    

        return $housing;
    }

    public function getInfoFromHousingId($id){

        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();

        $users=[];


        for ($i=0; $i < count($Info_array); $i++) { 

            $users = myUser::select("*")
                    ->where([
                        ["id", "=", $Info_array[$i]->myuser_id]
                    ])
                    ->get();

            if($users && count($users)){    // se housing esiste lo pusho 
                
                
                $Info_array[$i]->user= $users[0];     // Assegno la chiave info il valore $info
                
                console_log($Info_array[$i]->user);

            }
        }


        return $Info_array;
    }

     // dato il nome dell'attraction, cerco se c'è un indirizzo che corrisponde a quello inserito,
    // altrimenti torno null -> NON c'è nessuna attraction che corrisponde
    public function findExistingHousing($name, $type, $street_and_number,$city, $province){

        $housings= Housing::select("*")
                    ->where([
                        ["name", "=", $name]
                    ])
                    ->get();

        for( $i=0; $i<count($housings); $i++){

            $address_id=$housings[$i]->address_id;

            $addresses= Address::select("*")
                    ->where([
                        ["id", "=", $address_id]
                    ])
                    ->get();

            if( $addresses[0] &&
                $addresses[0]->street_and_number == $street_and_number &&
                $addresses[0]->city == $city &&
                $addresses[0]->province == $province ){

                    return $housings[$i]->id;

            }
        
        }

     return null;

    }

    public function destroyHousing($id, $user_id){

        // Trovo le info relative a quell'attrazione e all'id
        $info = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["myuser_id", "=", $user_id]
                    ])
                    ->get();

        $info[0]->delete();    // cancello le info relative all'utente e l'attraction

        // Controllo poi quante info sono rimaste a quell'attraction
        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();

        if(count($Info_array)==0){
            $housing = Housing::find($id);
            $housing->delete();
        }


    }


    public function addHousingGeneralInfo($price, $description,$link,$image_name,$stars,$public,$user,$housingId){  

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="HOUSING";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public=== 'true'){
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$housingId;

        $generalInfo->save();
    }

    public function editHousing($id, $name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){



        // Trvo l'attrcation con l'id e la modifico
        $housing = Housing::find($id);

        $housing->name=  $name;
        $housing->type = $category;

        $housing->save();

        

        // Modifico l'indirizzo
        $address = Address::find($housing->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["category", "=", "HOUSING"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="HOUSING";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$housing->id;

        $generalInfo->save();

    

    }

    public function editHousingNOImage($id, $name,$category,$price, $description,$link,$stars,$public,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){


            
        // Trvo l'attrcation con l'id e la modifico
        $housing = Housing::find($id);

        $housing->name=  $name;
        $housing->type = $category;

        $housing->save();

        

        // Modifico l'indirizzo
        $address = Address::find($housing->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["category", "=", "HOUSING"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="HOUSING";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
         $generalInfo->stars=  $stars;

         if ($public=== 'true') {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$housing->id;

        $generalInfo->save();
    

    }


    /**
     *      METODI PER ATTRACTION
     * 
     */


     /*NB: CAMBIA ANCHE  publicRestaurantFromInfo e publicHousingFromInfo*/

     public function publicAttractionFromInfo(){            /* Mi faccio tornare le attrazioni dalle info */

        $attractionInfo_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti le ATTRACTION e che sono pubbliche*/
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();


        $attractions=[];

        foreach ($attractionInfo_array as $info)  { /* Per ciascun indice, verifico a quale ATTRACTION corrisponde al ref_id delle info*/

            
            $attraction = Attraction::select("*")
                    ->where([
                        ["id", "=", $info->ref_id]
                    ])
                    ->get();

            if($attraction && count($attraction)){    // se attraction esiste lo pusho 
                
                $counter=0;
                for ($i=0; $i < count($attractions); $i++) { 
                    

                    // Controllo se ho più attrazioni uguali e cerco quella che ha immagine non nulla
                    if($attractions[$i]->id == $attraction[0]->id){
                        $counter=$counter+1;    // ho + attrazioni uguali

                        if ( $attractions[$i]->info && ($attractions[$i]->info->place_image == '' || $attractions[$i]->info->place_image == 'http://localhost:8000/storage/images' )){

                            
                            $attractions[$i]->info= $info;
                        }

                    }
                }


                $attraction[0]-> info= $info;      // Assegno alla chiave info il valore $info
               
                if(!$counter){  // Non lo pusho se ho 2 attrazioni uguali
                array_push($attractions,$attraction[0]);  // Pusho nell'array sia l'attraction che le sue info relative
                }
            }

        
        }   

        $addresses=[];


        for ($i=0; $i < count($attractions); $i++) { 

            $addresses = Address::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                
                ->where([
                    ["id", "=", $attractions[$i]->address_id]
                ])
                ->get();

            if($addresses && count($addresses)){    // se housing esiste lo pusho 
                
                
                $attractions[$i]->address= $addresses[0];     // Assegno la chiave info il valore $info

            }
        }

        return $attractions;
     }

     // Metodo per aggiungere una ATTRACTION alla table
    public function addAttraction($name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
    $street_and_number, $city,$province,$country,$postcode
        ) {



        // Aggiungo prima l'indirizzo relativo alla housing
        $address = new Address;

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();

        // Poi posso creare la HOUSING, a cui associare l'id di address come chiave esterna
        $attraction = new Attraction;

        $attraction->name=  $name;
        $attraction->type = $category;
        $attraction->address_id=$address->id;

        $attraction->save();

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="ATTRACTION";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$attraction->id;

        $generalInfo->save();

    }

    public function getAttractionFromId($id){


        $attraction = Attraction::select("*")
                ->where([
                    ["id", "=", $id]
                ])
                ->get();

    

        return $attraction;
    }

    public function getInfoFromAttractionId($id){

        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["public", "=", 1]
                    ])
                    ->get();

        $users=[];


        for ($i=0; $i < count($Info_array); $i++) { 

            $users = myUser::select("*")
                    ->where([
                        ["id", "=", $Info_array[$i]->myuser_id]
                    ])
                    ->get();

            if($users && count($users)){    // se housing esiste lo pusho 
                
                
                $Info_array[$i]->user= $users[0];     // Assegno la chiave info il valore $info
            

            }
        }


        return $Info_array;
    }


    // dato il nome dell'attraction, cerco se c'è un indirizzo che corrisponde a quello inserito,
    // altrimenti torno null -> NON c'è nessuna attraction che corrisponde
    public function findExistingAttraction($name, $type, $street_and_number,$city, $province){

        $attractions= Attraction::select("*")
                    ->where([
                        ["name", "=", $name]
                    ])
                    ->get();

        for( $i=0; $i<count($attractions); $i++){

            $address_id=$attractions[$i]->address_id;

            $addresses= Address::select("*")
                    ->where([
                        ["id", "=", $address_id]
                    ])
                    ->get();

            if( $addresses[0] &&
                $addresses[0]->street_and_number == $street_and_number &&
                $addresses[0]->city == $city &&
                $addresses[0]->province == $province ){

                    return $attractions[$i]->id;

            }
        
        }

    return null;

    }

    public function destroyAttraction($id, $user_id){

        // Trovo le info relative a quell'attrazione e all'id
        $info = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->where([
                        ["myuser_id", "=", $user_id]
                    ])
                    ->get();

        $info[0]->delete();    // cancello le info relative all'utente e l'attraction

        // Controllo poi quante info sono rimaste a quell'attraction
        $Info_array = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                    ->where([
                        ["category", "=", "ATTRACTION"]
                    ])
                    ->where([
                        ["ref_id", "=", $id]
                    ])
                    ->get();

        if(count($Info_array)==0){
            $attraction = Attraction::find($id);
            $attraction->delete();
        }


    }


    public function addAttractionGeneralInfo($price, $description,$link,$image_name,$stars,$public,$user,$attractionId){  

        $generalInfo = new GeneralInfo;

        $generalInfo->myuser_id = $user->id ;
        $generalInfo->price=  $price;
        $generalInfo->category="ATTRACTION";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public=== 'true'){
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$attractionId;

        $generalInfo->save();
    }

    // Per salavare le modifiche fatte
    public function editAttraction($id, $name,$category,$price, $description,$link,$stars,$public,$image_name,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){



        // Trvo l'attrcation con l'id e la modifico
        $attraction = Attraction::find($id);

        $attraction->name=  $name;
        $attraction->type = $category;

        $attraction->save();

        

        // Modifico l'indirizzo
        $address = Address::find($attraction->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["category", "=", "ATTRACTION"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="ATTRACTION";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->place_image= asset("storage/images/$image_name");
        $generalInfo->stars=  $stars;

        if ($public) {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$attraction->id;

        $generalInfo->save();

    

    }

    public function editAttractionNOImage($id, $name,$category,$price, $description,$link,$stars,$public,$user,
    $street_and_number, $city,$province,$country,$postcode
        ){



        // Trvo l'attrcation con l'id e la modifico
        $attraction = Attraction::find($id);

        $attraction->name=  $name;
        $attraction->type = $category;

        $attraction->save();

        

        // Modifico l'indirizzo
        $address = Address::find($attraction->address_id);

        $address->street_and_number =$street_and_number;
        $address->city  =$city ;
        $address->province =$province ;
        $address->country =$country ;
        $address ->postcode =$postcode ;

        $address->save();


        $generalInfo = Generalinfo::select("*")       /* Ritorno tutte le info riguardanti housing e che sono pubbliche*/
                        ->where([
                            ["category", "=", "ATTRACTION"]
                        ])
                        ->where([
                            ["ref_id", "=", $id]
                        ])
                        ->where([
                            ["myuser_id", "=", $user->id]
                        ])
                        ->get();

        $generalInfo= $generalInfo[0];

        $generalInfo->price=  $price;
        $generalInfo->category="ATTRACTION";
        $generalInfo->description=  $description;
        $generalInfo->link = $link;
        $generalInfo->stars=  $stars;

        if ($public=== 'true') {
        $generalInfo->public = 1;
        }else{
        $generalInfo->public = 0;
        }

        $generalInfo->ref_id=$attraction->id;

        $generalInfo->save();

    

    }















    /**
     * Vecchie funzioni
     */


     // Metodo per avere la lista in ordine alfabetico dei ristoranti
     // => usata in RestaurantController

     public function listRestaurants(){

        return Restaurant::orderBy('name','asc')->get();
    }




    public function isAnHousing(){  /* Torna un array di GeneralInfo con category housing */

        $housings_info = Generalinfo::select("*")
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->get();

                    console_log($housings_info);
        
        return $housings_info;
    }



    public function idHousingInfo(){            /* Mi faccio tornare i ref_id delle generalinfo che hanno housing */

        $id_array = Generalinfo::select("*")
                    ->where([
                        ["category", "=", "HOUSING"]
                    ])
                    ->pluck('ref_id')->toArray();

        console_log($id_array);
        
        return $id_array ;
    }



    public function getHousingFromInfo($id_array){

        $housings=[];

        foreach ($id_array as $ref_id)  {            /* Per ciascun indice, verifico a quale housing corrisponde l'id*/

            console_log($ref_id);

           
            $housing = Housing::select("*")
                    ->where([
                        ["id", "=", $ref_id]
                    ])
                    ->get();

            if($housing && count($housing)){    // se housing esiste lo pusho 
                
                array_push($housings, $housing[0]); // Pusho l'unico elemento di housing nell'array
            }
        }   

        return $housings;
    }


     // Metodo per avere la lista in ordine alfabetico dei ristoranti
     // => usata in RestaurantController

    public function listHousing(){


        return Housing::orderBy('name','asc')->get();
    }
}



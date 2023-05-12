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
        $user->password = $password;


        $user->save();

    }

    public function validUser($email, $password){

        // Recupero l'array di password degli utenti che hanno mail corrispondente

        $users= myUser::where('email',$email)->get(['password']);

        if(count($users)==0){
            return false;
        }

        return ($password==($users[0]->password)); // Confronto le password criptate con md5, se sono uguali tutto è andato bene

    }

    public function getUserName($email){

        // Ritorna l'array di utenti con mail corrispondente a mail

        $users= myUser::where('email',$email)->get();
        return $users[0]->firstname;  //recupero il nome corrispondente all'autente nella prima cella dell'array
    }




    /**
     *      METODI PER RESTAURANT
     * 
     */

    

     // Metodo per avere la lista in ordine alfabetico dei ristoranti
     // => usata in RestaurantController

    public function listRestaurants(){

        return Restaurant::orderBy('name','asc')->get();
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

            if($housing && count($housing)){    // se housing esiste lo pusho 
                
                
                $housing[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($housings,$housing[0]);  // Pusho nell'array sia l'housing che le sue info relative
            
            }

        }   

        return $housings;
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



    /**
     *      METODI PER ATTRACTION
     * 
     */

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
                
                
                $attraction[0]-> info= $info;      // Assegno la chiave info il valore $info
               
                array_push($attractions,$attraction[0]);  // Pusho nell'array sia l'attraction che le sue info relative
            
            }

        }   

        return $attractions;
     }
}



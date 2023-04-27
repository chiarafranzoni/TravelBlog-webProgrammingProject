<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataLayer extends Model
{
    use HasFactory;


    // Metodo per aggiungere un user alla table
    public function addUser($firstname,$lastname,$email, $telephone,$password,
                            $street_and_number, $city,$province,$country,$postcode
    ) {

     /**
     *      METODI PER USER
     * 
     */

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


    /**
     *      METODI PER RESTAURANT
     * 
     */

     // Metodo per avere la lista in ordine alfabetico dei ristoranti
     // => usata in RestaurantController

    public function listRestaurants(){

        return Restaurant::orderBy('name','asc')->get();
    }
}
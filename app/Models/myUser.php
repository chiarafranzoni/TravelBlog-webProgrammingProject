<?php

namespace App\Models;


//Copio struttura da User

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class myUser extends Authenticatable
{

    protected $table = 'myuser'; 
    public $timestamps = false;

    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address(){    // Metodo che mi ritorna l'address dell'utente

        return $this->belongsTo(Address::class,'address_id');

        //Il myuser ha un address, che è una class

        // Attributo chiave esterna sarà in myuser
        // --> la chiave esterna in myuser sarà address_id
    
    
        // PER BECCARE L'utente associato all'indirizzio: $address-> myuser
    }

    public function generalinfo(){    // Utente a cui è legato l'address

        return $this->hasMany(GeneralInfo::class,'myuser_id'); /*L'utente può inserire più esperienze, ovvero più general info*/

    }
}

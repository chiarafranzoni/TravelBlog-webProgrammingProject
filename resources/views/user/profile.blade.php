@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Profile
@endsection

@section('stile')
profile.css
@endsection

@section('left-navbar')
<li class="nav-item">
    <a class="nav-link active current" aria-current="page" href="{{route('home')}}">Homepage</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Our favourites <!--Menù dropdown-->
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{route('restaurant.index')}}">Restaurants</a></li>
      <li><a class="dropdown-item" href="{{route('housing.index')}}">Housings</a></li>
      <li><a class="dropdown-item" href="{{route('attraction.index')}}">Attractions</a></li>
      <li><a class="dropdown-item" href="{{route('travel.index')}}">Travels</a></li>
    </ul>
</li>
@endsection


@section('corpo')

<div class="external">

    <div class="container">

        <div class="row" style="margin-top: 2em">
            <div>

                <div class="header">
                    <ul class="nav nav-pills header" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-personal-tab" data-bs-toggle="pill" data-bs-target="#pills-personal" role="tab" aria-controls="pills-personal" aria-selected="true">Personal Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-address-tab" data-bs-toggle="pill" data-bs-target="#pills-address" role="tab" aria-controls="pills-address" aria-selected="false">Address info</button>
                        </li>
                    </ul>
                </div>

                <!-- FORM PER LE INFO PERSONALI-->

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-personal" role="tabpanel" aria-labelledby="pills-personal-tab" tabindex="0">
                        <form id="login-form" action="" method="post" style="margin-top: 2em">
                            @csrf

                            <label for="firstname"> First Name</label>
                            <div class="input-box">
                                <!-- Con for associo la label al campo id dell'input-->
                              <i class="bi bi-person"></i>
                            <input class='form-control' type="text" id="firstname" name="firstname" value="{{ $user->firstname}}" oninput="handleChange(event)"> <!--Con placeholder, inserisco un terto provvisorio-->
                
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                             <span class='invalid-input' id="invalid-firstname" style="color:red;"></span>

                
                            <br>
                
                            <label for="lastname"> Last Name</label> 
                            <div class="input-box">
                              <i class="bi bi-person"></i>
                            <input class='form-control' type="text" id="lastname" name="lastname" value=" {{ $user->lastname}}" oninput="handleChange(event)"> 
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-lastname" style="color:red;"></span>

                            <br>
                            
                            <label for="email"> Email</label> 
                            <div class="input-box">  
                              <i class="bi bi-envelope"></i>
                            <input class='form-control' type="email" id="email" name="email" value="{{ $user->email}}" oninput="handleChange(event)"> 
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-email" style="color:red;"></span>

                            
                            <br>
                
                            <label for="telephone"> Telephone</label>
                            <div class="input-box">   
                              <i class="bi bi-telephone"></i>             
                              <input class='form-control' type="text" id="telephone" name="telephone" value="{{ $user->telephone}}"> 
                            </div>
                
                            <br>
                            
                            <label for="password"> Password</label>
                            <div class="input-box ">    
                                <i class="bi bi-lock"></i>            
                              <input class='form-control' type="password" id="password" name="password" placeholder="Password" oninput="handleChange(event)"> 
                                <div class="eye">
                                    <i  class="bi bi-eye" onclick="passwordToggle()" id="eye"></i>
                                </div>
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-password" style="color:red;"></span>

            

                            <div style="margin-bottom: 1em; margin-top:1em;">
                              <a onclick="checkPersonalInfo( '{{$user->email}}')" class="btn btn-success">Edit</a>  
                            </div>          
                        </form>


                    </div>
                    <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab" tabindex="0">
                        <form id="register-form" name='addressForm' action="{{ route('user.addressUpdate') }}" method="post" style="margin-top: 2em">
                            @csrf
                            <label for="street_and_number"> Street and Number</label> 
                            <div class="address-box">  
                              <input class='form-control' type="text" id="street_and_number" name="street_and_number" value="{{ $user->address->street_and_number}}"> 
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-street_and_number" style="color:red;"></span>
                
                            <br>
                
                            <label for="city"> City</label>
                            <div class="address-box">                
                              <input class='form-control' type="text" id="city" name="city" value="{{ $user->address->city}}"> 
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-city" style="color:red;"></span>
                
                            <br>
                
                            <label for="province"> Province</label>
                            <div class="address-box">                
                              <input class='form-control' type="text" id="province" name="province"  value="{{ $user->address->province}}"> 
                            </div>
                            <!-- INserisco dei messaggi in caso di info errate-->
                            <span class='invalid-input' id="invalid-province" style="color:red;"></span>
                
                            <br>
                
                            <label for="country"> Country</label>  
                            <div class="address-box">              
                              <input class='form-control' type="text" id="country" name="country"  value="{{ $user->address->country}}"> 
                            </div>
                
                            <br>
                
                            <label for="postcode"> Postcode</label> 
                            <div class="address-box">               
                              <input class='form-control' type="text" id="postcode" name="postcode" value="{{ $user->address->postcode}}"> 
                            </div>
                

                            <div style="margin-bottom: 1em; margin-top:1em;">
                              
                              <input class="btn btn-success" type="submit" value="Edit" onclick="checkAddress(event)" >
                               
                            </div> 

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
                
   
@endsection
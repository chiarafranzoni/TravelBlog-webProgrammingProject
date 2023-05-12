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
                        <form id="login-form" action="{{ route('user.login') }}" method="post" style="margin-top: 2em">
                            @csrf

                            <label for="firstname"> First Name</label>
                            <div class="input-box">
                                <!-- Con for associo la label al campo id dell'input-->
                              <i class="bi bi-person"></i>
                              <input class='form-control' type="text" id="firstname" name="firstname" placeholder="First Name"> <!--Con placeholder, inserisco un terto provvisorio-->
                
                            </div>
                
                            <br>
                
                            <label for="lastname"> Last Name</label> 
                            <div class="input-box">
                              <i class="bi bi-person"></i>
                              <input class='form-control' type="text" id="lastname" name="lastname" placeholder=" Last Name"> 
                            </div>
                
                            <br>
                            
                            <label for="email"> Email</label> 
                            <div class="input-box">  
                              <i class="bi bi-envelope"></i>
                              <input class='form-control' type="email" id="email" name="email" placeholder="Email"> 
                            </div>
                            
                            <br>
                
                            <label for="telephone"> Telephone</label>
                            <div class="input-box">   
                              <i class="bi bi-telephone"></i>             
                              <input class='form-control' type="text" id="telephone" name="telephone" placeholder="Telephone Number"> 
                            </div>
                
                            <br>
                            
                            <label for="password"> Password</label>
                            <div class="input-box ">    
                                <i class="bi bi-lock"></i>            
                                <input class='form-control' type="password" id="password" name="password" placeholder="Password"> 
                                <div class="eye">
                                    <i  class="bi bi-eye" onclick="passwordToggle()" id="eye"></i>
                                </div>
                            </div>
            

                            <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                            <label for="login" class="btn btn-primary"><i class="bi-check-lg"></i> Login</label>

                    
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-address" role="tabpanel" aria-labelledby="pills-address-tab" tabindex="0">
                        <form id="register-form" action= method="post" style="margin-top: 2em">
                            @csrf
                            <label for="street_and_number"> Street and Number</label> 
                            <div class="address-box">  
                              <input class='form-control' type="text" id="street_and_number" name="street_and_number" placeholder="Street and Number"> 
                            </div>
                
                            <br>
                
                            <label for="city"> City</label>
                            <div class="address-box">                
                              <input class='form-control' type="text" id="city" name="city" placeholder="City"> 
                            </div>
                
                            <br>
                
                            <label for="province"> Province</label>
                            <div class="address-box">                
                              <input class='form-control' type="text" id="province" name="province" placeholder="Province"> 
                            </div>
                
                            <br>
                
                            <label for="country"> Country</label>  
                            <div class="address-box">              
                              <input class='form-control' type="text" id="country" name="country" placeholder="Country"> 
                            </div>
                
                            <br>
                
                            <label for="postcode"> Postcode</label> 
                            <div class="address-box">               
                              <input class='form-control' type="text" id="postcode" name="postcode" placeholder="Postcode"> 
                            </div>
                

                            <a href="{{ route('home') }}" class="btn btn-secondary"><i class="bi-box-arrow-left"></i> Back</a>
                            <label for="Register" class="btn btn-primary"><i class="bi-check-lg"></i> Register</label>
                            <input id="Register" type="submit" value="Register" class="hidden"/>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
                
   
@endsection
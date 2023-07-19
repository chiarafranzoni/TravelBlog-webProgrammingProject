@extends('layouts.form') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Subscription
@endsection

@section('stile')
formSubscription.css
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
    
    <br>

    <div class="container">


      <div class="row">

        <div class="title-text">
          <h3 > Subscribe </h3>

        </div>

        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
        <form method="post" name='subscriptionForm' action="{{route('user.store')}}">
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            <label for="firstname"> First Name</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              <input class='form-control' type="text" id="firstname" name="firstname" placeholder="First Name" oninput="handleChange(event)"> <!--Con placeholder, inserisco un terto provvisorio-->

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-firstname" style="color:red;"></span>


            <br>

            <label for="lastname"> Last Name</label> 
            <div class="input-box">
              <i class="bi bi-person"></i>
              <input class='form-control' type="text" id="lastname" name="lastname" placeholder=" Last Name" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-lastname" style="color:red;"></span>


            <br>
            
            <label for="email"> Email</label> 
            <div class="input-box">  
              <i class="bi bi-envelope"></i>
              <input class='form-control' type="email" id="email" name="email" placeholder="Email" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-email" style="color:red;"></span>

            
            <br>

            <label for="telephone"> Telephone</label>
            <div class="input-box">   
              <i class="bi bi-telephone"></i>             
              <input class='form-control' type="text" id="telephone" name="telephone" placeholder="Telephone Number" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-telephone" style="color:red;"></span>


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


            <br>

            <label for="street_and_number"> Street and Number</label> 
            <div class="address-box">  
              <input class='form-control' type="text" id="street_and_number" name="street_and_number" placeholder="Street and Number" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-street_and_number" style="color:red;"></span>


            <br>

            <label for="city"> City</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="city" name="city" placeholder="City" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-city" style="color:red;"></span>


            <br>

            <label for="province"> Province</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="province" name="province" placeholder="Province" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-province" style="color:red;"></span>


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

            <br>

            <a class="btn btn-secondary" href="{{route('home')}}"> Cancel</a>
            <input class="btn subscribeForm-btn" type="submit" value="Subscribe" onclick="checkSubscriptionForm(event)">
          

        </form>
      </div>

   
    </div>

  </div>
   
@endsection



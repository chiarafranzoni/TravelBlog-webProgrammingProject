@extends('layouts.master') 
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
      <li><a class="dropdown-item" href="hotels.html">Hotels</a></li>
      <li><a class="dropdown-item" href="hotels.html">Attractions</a></li>
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
        <form method="post" action="{{route('user.store')}}">
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            

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
            <div class="input-box">    
              <i class="bi bi-lock"></i>            
              <input class='form-control' type="password" id="password" name="password" placeholder="Password"> 
            </div>

            <br>

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

            <br>

            <a class="btn btn-secondary" href="{{route('home')}}"> Cancel</a>
            <input class="btn subscribeForm-btn" type="submit" value="Subscribe">
          

        </form>
      </div>

   
    </div>

  </div>
   
@endsection


@section('footer')


    <footer class="page-footer">

        <div class="container">
            <small>
                Always ready to inspire you  <span><i class="bi bi-airplane-fill"> </i></span> 
            </small>
        </div>
    
    </footer>

@endsection
@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Add Attraction
@endsection

@section('stile')
attractionAdd.css
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
          <h3 > Add Attraction </h3>

        </div>

        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
        <form name='attraction' method="post" action="{{route('attraction.store')}}" enctype="multipart/form-data">
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            

            <label for="name"> Name</label>
            <div class="input-box" id="name-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              <input class='form-control' type="text" id="name" name="name" placeholder="Name"> <!--Con placeholder, inserisco un terto provvisorio-->

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id= "invalid-name" style="color:red;"></span>

            <br>

            <label for="category"> Category</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              
              <select class="form-select " type="text" id="category" name="category" placeholder="Category">
                
                <option selected>Category</option>

                @foreach (['MUSEUM', 'PARK', 'GARDEN', 'SQUARE', 'LAKE','SEA','MOUNTAIN','CITY'] as $item)

                <option value="{{$item}}">{{strtolower($item)}}</option>
                    
                @endforeach

                
              </select>

            </div>

            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-category" style="color:red;"></span>


            <br>

            <label for="price">Price</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>

              <select class="form-select " id="price" name="price">
                <option selected>Price</option>

                @foreach (['ECONOMIC', 'AVERAGE', 'EXPENSIVE'] as $item)

                <option value="{{$item}}">{{strtolower($item)}}</option>
                    
                @endforeach

              </select>
             
            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-price" style="color:red;"></span>

            <br>

            <label for="description"> Description</label>
            <div class="input-box">

              <textarea class='form-control' type="text" id="description" name="description" placeholder="Description" rows="5"></textarea>

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-description" style="color:red;"></span>


            <br>

            <label for="link"> Link</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              <input class='form-control' type="text" id="link" name="link" placeholder="Insert a useful link for other users"> 

            </div>
            

            <br>

            <label for="image"> Image</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              <input class='form-control' type="file" id="image" name="image" placeholder="Image"> 

            </div>

            <br>

            <label for="stars"> Stars</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-person"></i>
              <input class='form-control' type="text" id="stars" name="stars" placeholder="Stars"> 

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-stars" style="color:red;"></span>


            <br>

            <label for="public"> Public</label>

              <div class='form-control1'>
                <input  type="checkbox" id="public" name="public" placeholder="Public"> 
                <span> Do you want to make this visible to others?</span>
              </div>            
          

            <br>


            <label for="street_and_number"> Street and Number</label> 
            <div class="address-box">  
              <input class='form-control' type="text" id="street_and_number" name="street_and_number" placeholder="Street and Number"> 
            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-street" style="color:red;"></span>


            <br>

            <label for="city"> City</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="city" name="city" placeholder="City"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-city" style="color:red;"></span>


            <br>

            <label for="province"> Province</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="province" name="province" placeholder="Province"> 
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

            <a class="btn btn-secondary" href="{{route('attraction.index')}}"> Cancel</a>
            <input class="btn subscribeForm-btn" type="submit" value="Submit" onclick="checkForm(event,'ATTRACTION');">
          
            <!-- CONTROLLO SULLA FORM: creo un script checkForm nel file js, passando il parametro event, usato per prevenire l'azione di default-->
           

        </form>
      </div>

   
    </div>

  </div>
   
@endsection



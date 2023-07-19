@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Edit Housing
@endsection

@section('stile')
housingAdd.css
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

  <div class="external"  id='elementForm' >
    
    <br>

    <div class="container" >


      <div class="row">

        <div class="title-text">
          <h3 > Edit Housing </h3>
          <span id="IDSpan" style="display: none" value='{{$housing->id}}'>{{$housing->id}}</span>


        </div>

        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
        <form name='housing' method="post" action="{{route('housing.update', ['housing' => $housing->id])}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            

            <label for="name"> Name</label>
            <div class="input-box" id="name-box">
                <!-- Con for associo la label al campo id dell'input-->
                <i class="bi bi-shop"></i>
              <input class='form-control' type="text" id="name" name="name" placeholder="Name" value="{{$housing->name}}" oninput="handleChange(event)"> <!--Con placeholder, inserisco un terto provvisorio-->

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id= "invalid-name" style="color:red;"></span>

            <br>

            <label for="category"> Category</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-tag"></i>
              <select class="form-select " type="text" id="category" name="category" placeholder="Category" oninput="handleChange(event)">
                
                <option selected>{{$housing->type}}</option>

                @foreach (['CHALET', 'B&B', 'HOTEL','CAMPING','HOLIDAY VILLAGE','CABIN','TREEHOUSE','CASTLE','HOUSEBOAT','TRULLO'] as $item)

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
              <i class="bi bi-currency-dollar"></i>

              <select class="form-select " id="price" name="price" oninput="handleChange(event)">
                <option selected>{{$housing->info->price}}</option>

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

              <textarea class='form-control' type="text" id="description" name="description" placeholder="Description" rows="5" 
              oninput="handleChange(event)">{{$housing->info->description}}</textarea>
            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-description" style="color:red;"></span>


            <br>

            <label for="link"> Link</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-link"></i>
              <input class='form-control' type="text" id="link" name="link" placeholder="Insert a useful link for other users" value="{{$housing->info->link}}"> 

            </div>
            

            <br>

            <label for="image"> Image</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->

              <i class="bi bi-card-image"></i>
              <input class='form-control' accept="image/png, image/jpeg" type="file" id="image" name="image" placeholder="Image"  > 
            </div>

            <br>

            <label for="image"> Old Image </label>
            <div class="input-box" style="display: flex; justify-content:center;">
                <!-- Con for associo la label al campo id dell'input-->

                @if ($housing->info->place_image == '' || $housing->info->place_image == 'http://localhost:8000/storage/images')

                    <p> NO OLD IMAGE PRESENT</p>
                    
                @else

                     <img src=" {{$housing->info->place_image}}" class="d-block w-100">
                    
                @endif        
               
            </div>
            

            <br>

            <label for="stars"> Stars</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
                <i class="bi bi-star-fill"></i>
              <input class='form-control' type="text" id="stars" name="stars" placeholder="Stars" value="{{$housing->info->stars}}" oninput="handleChange(event)" > 

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-stars" style="color:red;"></span>


            <br>

            <label for="public"> Public</label>

              <div class='form-control1'>

                @if(value($housing->info->public))

                <input  type="checkbox" id="public" name="public" placeholder="Public" checked="true" > 

              @else
                <input  type="checkbox" id="public" name="public" placeholder="Public" > 

              
              @endif
                <span> Do you want to make this visible to others?</span>
              </div>            
          

            <br>


            <label for="street_and_number"> Street and Number</label> 
            <div class="address-box">  
              <input class='form-control' type="text" id="street_and_number" name="street_and_number" placeholder="Street and Number" value="{{$address->street_and_number}}"  oninput="handleChange(event)"> 
            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-street_and_number" style="color:red;"></span>


            <br>

            <label for="city"> City</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="city" name="city" placeholder="City" value="{{$address->city}}"  oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-city" style="color:red;"></span>


            <br>

            <label for="province"> Province</label>
            <div class="address-box">                
              <input class='form-control' type="text" id="province" name="province" placeholder="Province" value="{{$address->province}}" oninput="handleChange(event)"> 
            </div>
             <!-- INserisco dei messaggi in caso di info errate-->
             <span class='invalid-input' id="invalid-province" style="color:red;"></span>


            <br>

            <label for="country"> Country</label>  
            <div class="address-box">              
              <input class='form-control' type="text" id="country" name="country" placeholder="Country" value="{{$address->country}}"> 
            </div>

            <br>

            <label for="postcode"> Postcode</label> 
            <div class="address-box">               
              <input class='form-control' type="text" id="postcode" name="postcode" placeholder="Postcode" value="{{$address->postcode}}"> 
            </div>

            <br>

            <a class="btn btn-secondary" href="{{route('user.adventures')}}"> Cancel</a>
            <input class="btn subscribeForm-btn" type="submit" value="Save" onclick="checkForm(event,'HOUSING', 'Save');">
          
            <!-- CONTROLLO SULLA FORM: creo un script checkForm nel file js, passando il parametro event, usato per prevenire l'azione di default-->
           

        </form>

      </div>

      

   
    </div>

  </div>

  <!-- div -->

  <div class="externalAlreadyPresent" id="alreadyPresent"  style="display: none">
    
    <br>

    <div class="container" >


        <div class="row">

            <div class="title-text">
              <h3 > Add Housing </h3>

            </div>

            <div  style="display: block; text-align:center; margin-bottom:2em;  height: 200px">
                <h5>Hey, this housing has already been insert!</h5>
                <h6> If you press PROCEED, your info will be added to the ones already present</h6>

                <div style="display: flex; justify-content:center; margin-top:3em;">
                
                    <button class="btn btn-light" style="margin-right: 1.5em"> Go back</button>
                    
                    <button class="btn btn-success" onclick="addProceed('ATTRACTION')"> Proceed </button>
                </div>
            </div>
        </div>
    </div>
  </div>
   
@endsection



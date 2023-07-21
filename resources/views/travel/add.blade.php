@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Add Travel
@endsection

@section('stile')
travelAdd.css
@endsection

@section('left-navbar')
<li class="nav-item">
    <a class="nav-link active " aria-current="page" href="{{route('home')}}">Homepage</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle current" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Our favourites <!--Menù dropdown-->
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{route('restaurant.index')}}">Restaurants</a></li>
      <li><a class="dropdown-item" href="{{route('housing.index')}}">Housings</a></li>
      <li><a class="dropdown-item" href="{{route('attraction.index')}}">Attractions</a></li>
      <li><a class="dropdown-item current" href="{{route('travel.index')}}">Travels</a></li>
    </ul>
</li>
@endsection

@section('corpo')

  <div class="external"  id='elementForm' >
    
    <br>

    <div class="container" >


      <div class="row">

        <div class="title-text">
          <h3 > Add Travel </h3>

        </div>
    
        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
        <form name='attraction' method="post" action="" enctype="multipart/form-data">
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            

            <label for="name"> Title</label>
            <div class="input-box" id="title-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-shop"></i>
              <input class='form-control' type="text" id="title" name="title" placeholder="Title" oninput="handleChange(event)"> <!--Con placeholder, inserisco un terto provvisorio-->

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id= "invalid-title" style="color:red;"></span>

            <br>

            <label for="duration"> Duration</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
                <i class="bi bi-hourglass-split"></i>
              <input class='form-control' type="text" id="duration" name="duration" placeholder="Duration"  oninput="handleChange(event)"> 

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-duration" style="color:red;"></span>

            <br>

            <label for="transportation"> Transportation</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->

                <div class="dropdown " >
                  <i class="bi bi-airplane"></i>
                  <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown transportation" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelectTransportation(event)">
                    
                    Select Transportation Mean
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="transportation" name="transportation" placeholder="Transportation">
                

                    @foreach (['CAR', 'BUS', 'AIRPLANE', 'CRUISE', 'FERRY', 'BIKE', 'WALK'] as $item)
                      <li ><input  class="form-check-input1" type="checkbox" id="{{$item}}" value="{{$item}}">{{strtoupper($item)}}</li>
                        
                    @endforeach
                  </ul>
                </div>

            </div>

            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-transportation" style="color:red;"></span>


            <br>


            <label for="thumbnail"> Thumbnail</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-card-image"></i>
              <input class='form-control' accept="image/png, image/jpeg" type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail"> 

            </div>

      
            <br>

            <label for="public"> Public</label>

              <div class='form-control1'>
                <input  type="checkbox" id="public" name="public" placeholder="Public"> 
                <span> Do you want to make this visible to others?</span>
              </div>            
          

              <br>

              <div id="stageExternalContainer" style=" display:none; justify-content:center">
                <label> STAGES</label>
                
                <div id="stageContainer" style=" display:none; border: 1px solid green">

                  

                </div>
              </div>

              <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id="invalid-stages" style="color:red;"></span>

            

            <br>

              <!-- AGGIUNGO UN PEZZO PER AGGIUNGERE UNA TAPPA-->
            <div id="addStage" style="display: none">

                <label for="location"> Location</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->
                    <i class="bi bi-geo-alt-fill"></i>
                <input class='form-control' type="text" id="location" name="location" placeholder="Location"  oninput="handleChange(event)"> 

                </div>
                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-location" style="color:red;"></span>

                <br>


                <label for="nation"> Nation</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->
                    <i class="bi bi-geo-fill"></i>
                <input class='form-control' type="text" id="nation" name="nation" placeholder="Nation"  oninput="handleChange(event)"> 

                </div>
                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-nation" style="color:red;"></span>

                <br>

                <!-- HOUSING -->
                <label for="housing"> Housing</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->

                    @if ( !$housings || count($housings)== 0)

                        <p> Hey, you haven't insert any housing yet!</p>
                        
                    @else

                    
                        <!-- Con for associo la label al campo id dell'input-->
        
                        <div class="dropdown " id='element-select' >
                          <i class="bi bi-house-heart"></i>
                          <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown housing" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                            
                            Select Your Housing
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="housing" name="housing" placeholder="Housing">
                      
                            @foreach ($housings as $housing)
                              <li ><input  class="form-check-input" type="checkbox" id="{{$housing->id}}" value="{{$housing->id}}">{{strtoupper($housing->name)}}</li>
                                
                            @endforeach
                          </ul>
                        </div>
        
                   

                    @endif

                </div>

                <br>

                <!-- RESTAURANT -->
                <label for="restaurant"> Restaurant</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->

                    @if ( !$restaurants || count($restaurants)== 0)

                        <p> Hey, you haven't insert any restaurant yet!</p>
                        
                    @else

                        <!-- Con for associo la label al campo id dell'input-->
        
                        <div class="dropdown " >
                          <i class="fas fa-utensils"></i>
                          <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown restaurant" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                            
                            Select Your Restaurant
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="restaurant" name="restaurant" placeholder="Restaurant" >
                      
                            @foreach ($restaurants as $restaurant)
                              <li ><input  class="form-check-input" type="checkbox" id="{{$restaurant->id}}" value="{{$restaurant->id}}">{{strtoupper($restaurant->name)}}</li>
                                
                            @endforeach
                          </ul>
                        </div>

                    @endif

                </div>

                <br>

                <!-- ATTARCTION -->
                <label for="attraction"> Attraction</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->

                    @if ( !$attractions ||count($attractions)== 0)

                        <p> Hey, you haven't insert any attraction yet!</p>
                        
                    @else

                      <div class="dropdown " >
                        <i class="bi bi-balloon"></i>
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown attraction" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                          
                          Select Your Attraction
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="attraction" name="attraction" placeholder="Attraction" >
                    
                          @foreach ($attractions as $attraction)
                            <li ><input  class="form-check-input" type="checkbox" id="{{$attraction->id}}" value="{{$attraction->id}}">{{strtoupper($attraction->name)}}</li>
                              
                          @endforeach
                        </ul>
                      </div>
                        
                    @endif

                    

                </div>


                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-elements" style="color:red;"></span>

                <br>
                
                <button class="btn add btn-success " type="button" onclick="stageAddinAdd(event);">Add this stage</button>

            </div>

            <br>

            
            <a class="btn  btn-light" type='button' style="margin-bottom: 1em; display:block;" id="toggle_stage" onclick="toggleAddStage(event)"> Add a stage of the travel</a>

            <br>


            <a class="btn btn-secondary" type='button' href="{{route('travel.index')}}"> Cancel</a>
            <input class="btn subscribeForm-btn"  type="submit"  value="Submit" onclick="checkAddTravel(event)">
          
            <!-- CONTROLLO SULLA FORM: creo un script checkForm nel file js, passando il parametro event, usato per prevenire l'azione di default-->
           

        </form>



      </div>

      

   
    </div>

  </div>


   
@endsection



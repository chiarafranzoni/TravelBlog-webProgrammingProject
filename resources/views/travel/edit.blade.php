@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Edit {{$travel->title}}
@endsection

@section('stile')
travelAdd.css
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
          <h3 > Edit Travel </h3>
          <span id="travelIDSpan" style="display: none" value='{{$travel->id}}'>{{$travel->id}}</span>

        </div>
    
        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
        <form name='attraction' method="post" action="" enctype="multipart/form-data">
            @csrf  <!-- OBBLIGATORIO PER SICUREZZA dopo ogni form: cross site request forgery-->


            <!-- Ogni cosa avrà label e un campo-->

            

            <label for="name"> Title</label>
            <div class="input-box" id="title-box">
                <!-- Con for associo la label al campo id dell'input-->
              <i class="bi bi-shop"></i>
              <input class='form-control' type="text" id="title" name="title" placeholder="Title" value='{{$travel->title}}' oninput="handleChange(event)"> <!--Con placeholder, inserisco un terto provvisorio-->

            </div>
            <!-- INserisco dei messaggi in caso di info errate-->
            <span class='invalid-input' id= "invalid-title" style="color:red;"></span>

            <br>

            <label for="duration"> Duration</label>
            <div class="input-box">
                <!-- Con for associo la label al campo id dell'input-->
                <i class="bi bi-hourglass-split"></i>
              <input class='form-control' type="text" id="duration" name="duration" placeholder="Duration" value='{{$travel->duration}}' oninput="handleChange(event)"> 

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


                    @if (str_contains($travel->transportation, $item))

                        
                      <li ><input  class="form-check-input1" type="checkbox" id="{{$item}}" value="{{$item}}" checked="true">{{strtoupper($item)}}</li>

                    @else
                        <li ><input  class="form-check-input1" type="checkbox" id="{{$item}}" value="{{$item}}" >{{strtoupper($item)}}</li>
                        
                    @endif
                        
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
              <input class='form-control'accept="image/png, image/jpeg" type="file" id="thumbnail" name="thumbnail" placeholder="Thumbnail"> 

            </div>

      
            <br>


            <label for="image"> Old Thumbnail </label>
            <div class="input-box" style="display: flex; justify-content:center;">
                <!-- Con for associo la label al campo id dell'input-->

                @if ($travel->thumbnail == '' || $travel->thumbnail == 'http://localhost:8000/storage/images')

                    <p> NO OLD IMAGE PRESENT</p>
                    
                @else

                     <img id="oldImage" src=" {{$travel->thumbnail}}" value='{{$travel->thumbnail}}' class="d-block w-100">
                    
                @endif        
               
            </div>
            

            <br>

            <label for="public"> Public</label>

              <div class='form-control1'>
                @if(value($travel->public))

                <input  type="checkbox" id="public" name="public" placeholder="Public" checked="true" > 

              @else
                <input  type="checkbox" id="public" name="public" placeholder="Public" > 

              
              @endif
                <span> Do you want to make this visible to others?</span>
              </div>            
          

              <br>

              <div id="stageExternalContainer" style="  justify-content:center">
                <label> STAGES</label>
                
                <div id="stageContainer" style=" border: 1px solid green; padding:1em;">

                  @foreach ($travel->stage_array as $item)
                    
                    <p id='{{$item->id}}' ><i class='bi bi-dot'></i> {{$item->location}}</p>

                    <div id="innerButton" style="font-size:15px; margin-top:-15px; margin-bottom:20px;">
                        <button id='{{$item->id}}' type="button" style="padding: 2px" class="btn btn-success" onclick="modifyStage({{$item}})"> Edit Stage</button>
                        <button id='{{$item->id}}' type="button" style="padding: 2px" class="btn btn-danger" onclick="deleteStage({{$item}})"> Delete Stage</button>
                    </div>
                  
                      
                  @endforeach

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
                
                <button class="btn add btn-success " type="button" onclick="stageAddStage(event);">Add this stage</button>

            </div>

            <br>

             <!-- AGGIUNGO UN PEZZO PER EDITARE UNA TAPPA-->
            <div id="editStage" style="display: none">

                <label for="location"> Location</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->
                    <i class="bi bi-geo-alt-fill"></i>
                <input class='form-control' type="text" id="locationEdit" name="location" placeholder="Location"  oninput="handleChange(event)"> 

                </div>
                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-locationEdit" style="color:red;"></span>

                <br>


                <label for="nation"> Nation</label>
                <div class="input-box">
                    <!-- Con for associo la label al campo id dell'input-->
                    <i class="bi bi-geo-fill"></i>
                <input class='form-control' type="text" id="nationEdit" name="nation" placeholder="Nation"  oninput="handleChange(event)"> 

                </div>
                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-nationEdit" style="color:red;"></span>

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
                          <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown housingEdit" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                            
                            Select Your Housing
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="housingEdit" name="housing" placeholder="Housing">
                      
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
                          <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown restaurantEdit" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                            
                            Select Your Restaurant
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="restaurantEdit" name="restaurant" placeholder="Restaurant" >
                      
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
                        <button class="btn btn-secondary dropdown-toggle form-control" type="button" id="multiSelectDropdown attractionEdit" data-bs-toggle="dropdown" aria-expanded="false" onclick="handleSelect(event)">
                          
                          Select Your Attraction
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="multiSelectDropdown" id="attractionEdit" name="attraction" placeholder="Attraction" >
                    
                          @foreach ($attractions as $attraction)
                            <li ><input  class="form-check-input" type="checkbox" id="{{$attraction->id}}" value="{{$attraction->id}}">{{strtoupper($attraction->name)}}</li>
                              
                          @endforeach
                        </ul>
                      </div>
                        
                    @endif

                    

                </div>


                <!-- INserisco dei messaggi in caso di info errate-->
                <span class='invalid-input' id="invalid-elementsEdit" style="color:red;"></span>

                <br>

                <span style="display: none" id="stageID"> </span>
                <button class="btn add btn-secondary " type="button" onclick="closeModify(event);">Close</button>
                <button class="btn add btn-success " type="button" onclick="stageModifyStage(event);">Modify this stage</button>

            </div>

            <br>

            
            <a class="btn  btn-light" type='button' style="margin-bottom: 1em; display:block;" id="toggle_stage" onclick="toggleAddStage(event)"> Add a stage of the travel</a>

            <br>


            <a class="btn btn-secondary" type='button' href="{{route('user.adventures')}}"> Cancel</a>
            <input class="btn subscribeForm-btn"  type="submit"  value="Submit" onclick="checkEditTravel(event, {{$travel->id}})">
          
            <!-- CONTROLLO SULLA FORM: creo un script checkForm nel file js, passando il parametro event, usato per prevenire l'azione di default-->
           

        </form>



      </div>

      

   
    </div>

  </div>


   
@endsection



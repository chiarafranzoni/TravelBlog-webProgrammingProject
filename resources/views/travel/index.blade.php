@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Travels
@endsection

@section('stile')
elementsList.css
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


<div class="holder" style="
color: darkorange;
text-shadow: 2px 2px orangered;">
    <h3> Travels</h3>
</div>

<div class="top-external" style="border: 1px solid orangered  ;">

    <div class="info-container ">
       <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
        A beautiful adventure is like a diamod...it lasts forever!
       </p>
       <p>
        Here you can find a little treasure! <br> Let yourself be inspired by the
        experiences of other users to live your next dream vacation  <br>
        Try searching for something or ... add something yourself!
        
        </p>
    </div>

    <div class="search-container">
        <h6> How many days do you wanna stay away ?</h6>
        <input class="form-control" id="searchDuration" type="text" placeholder="Type a number of days">
    </div>

    <div class="search-container">
        <h6> Where do you wanna go ?</h6>
        <input class="form-control" id="searchLocality" type="text" placeholder="Type a locality">
    </div>

    <div class="search-container">
        <h6> What do you wanna travel by ?</h6>
        <select class="form-select " id="searchTransportation" name="price" >
            <option selected>SELECT A TRANSPORT MEAN</option>

            @foreach (['CAR', 'BUS', 'AIRPLANE', 'CRUISE', 'FERRY', 'BIKE', 'WALK'] as $item)

            <option value="{{$item}}">{{strtoupper($item)}}</option>
                
            @endforeach

        </select>
    </div>

    
    <div class="search-container">

        <button class="btn btn-add" style="
        margin-top:2em;
        background-color: rgba(241, 235, 255, 0.6);
        box-shadow: 1px 1px  orangered;" > <a class="dropdown-item" href="{{route('travel.add')}}"> Add a Travel </a></button>
        
        
    </div>
    
</div>

   

        <!-- Da RestaurantController, mi arriva una travels_list -->

        @foreach ($travels_list as $travel) <!--Per ciascun ristornate della lista-->

                        
            <div class="external" style="
            background-color: rgba(241, 235, 255, 0.6);
            box-shadow: 1px 1px orangered;">

                <div class="continer ">
                    
                    <div class="card">

                            <div class="row no-gutters"> <!-- Setta margini a 0-->
                                <div class="col-xs-7 col-md-6 col-lg-6">
                                    @if (value($travel->thumbnail) != '' && value($travel->thumbnail) != 'http://localhost:8000/storage/images') <!-- Se l'immagine c'è la stampo-->

                                    <img src="{{$travel->thumbnail}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                    
                                    @else  <!-- Se l'immagine non c'è, metto un placeholder-->
                                        <img src="/img/no-image.png"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                    @endif
                                </div>

                                <div class="card-wrapper col-xs-5  col-md-6 col-lg-6">
                                    <div class="card-body" style="height: 100%; display: grid;">
                                        <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                            {{$travel->title}} 

                                        </h5>

                                        <p class="card-text" > <button class="btn " 
                                            style="
                                            padding-left: 2px;
                                            padding-right: 2px;
                                            padding-top: 0;
                                            padding-bottom: 0;
                                            background-color: teal;
                                            color: white;
                                            pointer-events: none;">{{$travel->user->firstname}}</button></p>

                                        <p class="card-text card-address" style="display: flex; gap:5px;">
                                           
                                                <i class="bi bi-geo-alt-fill"></i>

                                                @for ($i = 0; $i < count($travel->stage_array); $i++)

                                                    @if ($i != count($travel->stage_array)-1)
                                                        <span> {{$travel->stage_array[$i]->location}},</span>
                                                    @else
                                                    <span> {{$travel->stage_array[$i]->location}}</span>
                                                    @endif
                                                    
                                                @endfor
                                            
                                
                                        </p>

                                        <p class="card-text card-duration" style="margin-bottom: 2em;">
                                            <i class="bi bi-hourglass-split"></i>
                                            @if (value($travel->duration) ==1)
                                                {{$travel->duration}} day
                                            @else
                                                {{$travel->duration}} days
                                             @endif
                                        </p>


                                        <!-- TRASPORTI: CAR, BUS, AIRPLANE, CRUISE, FERRY, BIKE, WALK-->
                                        <p>Transportation:</p>
                                        <p class="card-text card-transportation" >
                                            
                                            @foreach (json_decode($travel->transportation) as $item)
                                                <span> 

                                                    @if (strtoupper($item) == 'CAR' )
                                                        <i class="bi bi-car-front-fill"></i>
                                                        
                                                    @elseif(strtoupper($item) == 'AIRPLANE')
                                                        <i class="bi bi-airplane"></i>
                                                        
                                                    @elseif(strtoupper($item) == 'BUS')
                                                        <i class="bi bi-bus-front-fill"></i>

                                                    @elseif(strtoupper($item) == 'BIKE')
                                                        <i class="bi bi-bicycle"></i>

                                                    @elseif(strtoupper($item) == 'WALK')
                                                        <i class="fas fa-walking"></i>
                                                    @else
                                                         <i class="fas fa-anchor"></i>

                                                    @endif


                                                

                                                    {{strtoupper($item)}} 
                                                </span>

                                                <br>
                                            @endforeach
                                            
                                            
                                
                                        </p>
                                        
                        
                                        <p class="card-text float-right" style=" display:flex; align-content:baseline; ">

                                            <small class="text-muted" >Wanna see mora about this travel ?</small>
                                        </p>
                                        <div class='w-100' >
                                        
                                            <a href="{{route('travel.more', ['id' => $travel->id])}}" class="btn btn-secondary more">
                                                See More!
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
                        
                        

        @endforeach

        <!-- Metto un div che apparirà solo nel caso in cui la ricerca non dia risultati-->
        <div  style="text-align: center; margin-bottom:2em; padding:1em">
            <span class="hidden" style="display: none"> OPS... <br>It seems that what you are looking for doesn't exist .</span>
            <span class="hidden" style="display: none; font-size: 25px; text-shadow: none;"><br> Try searching again, maybe it will be the right time !</span>
        </div>

<script>
    $(document).ready(function () {


            $("#searchDuration").on("keyup", function () {

                $("#searchTransportation").val("SELECT A TRANSPORT MEAN");

                var value = $(this).val().toLowerCase();
                $(".external").filter(function () {

                        $(this).toggle($(this).find($(".card-duration")).text().toLowerCase().indexOf(value) > -1)
                        

                });

                
                var dim = $('.external').is(":visible");

                if (dim == false) {
                    $(".hidden").show();
                } else {
                    $(".hidden").hide();   
                }

                


            });


            $("#searchLocality").on("keyup", function () {
                
                $("#searchTransportation").val("SELECT A TRANSPORT MEAN");

                var locationValue = $(this).val().toLowerCase();
                $(".external").filter(function () {

                        $(this).toggle($(this).find($(".card-address")).text().toLowerCase().indexOf(locationValue) > -1)
                        

                });

                
                var dim = $('.external').is(":visible");

                if (dim == false) {
                    $(".hidden").show();
                } else {
                    $(".hidden").hide();   
                }

                


            });


            
           $("#searchTransportation").on("change", function () {
               var value = $(this).val().toLowerCase();

               $("#searchLocality").val('');
               $("#searchDuration").val('');

               $(".external").filter(function () {

                
                transportation_selection= $("#searchTransportation").find(":selected").text();


                    if ( transportation_selection != "SELECT A TRANSPORT MEAN") {

                       $(this).toggle($(this).find($(".card-transportation")).text().toLowerCase().indexOf(value) > -1)

                    }else{
                        $(this).show();
                        
                    }
                       

               });

               
               var dim = $('.external').is(":visible");

                if (dim == false) {
                    $(".hidden").show();
                } else {
                    $(".hidden").hide();   
                }

            });
    });

</script>

    
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
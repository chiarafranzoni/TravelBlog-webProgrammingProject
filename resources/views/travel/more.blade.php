@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
   {{$travel->title}}
@endsection

@section('stile')
more.css
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

<div class="back" >

    <a onclick="history.go(-1);">
        <button class="btn btn-light btn-back" style="margin-top:1em;"><i class="bi bi-arrow-left"></i> Go back</button>
    </a>
</div>

<div class="holder">
    <h3 style="
    color: darkorange;
    text-shadow: 2px 2px orangered;"> {{$travel->title}} </h3>
</div>

<!-- IMPORTANT INFOS -->
<div class="gallery" >

    <div class="comments comment-slide">
    
        <h3 ><i class="bi bi-info-square"></i> Important Infos</h3>

        <div class="info d-block">

            <h6 style="margin-top: 1em">   
                
                DESTINATION:
                <i class="bi bi-geo-alt-fill"></i>

                @for ($i = 0; $i < count($travel->stage_array); $i++)

                    @if ($i != count($travel->stage_array)-1)
                        <span> {{$travel->stage_array[$i]->location}} ({{$travel->stage_array[$i]->nation}}),</span>   <!--Metto la virgola-->
                    @else
                    <span> {{$travel->stage_array[$i]->location}} ({{$travel->stage_array[$i]->nation}})</span>   <!--Se è lultimo NON metto la virgola-->
                    @endif
                    
                @endfor
            </h6>
            
            <h6 style="margin-top: 1em">
                
                DURATION:
                <i class="bi bi-hourglass-split"></i>
                @if (value($travel->duration) ==1)
                    {{$travel->duration}} day
                @else
                    {{$travel->duration}} days
                 @endif
            </h6>
            

            <h6 style="margin-top:1em">  
                
                TRANSPORTATION:

                <div style="margin-top: 0.5em">
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
                </div>
            </h6>

             

                @if (value($travel->thumbnail) != '' && value($travel->thumbnail) != 'http://localhost:8000/storage/images') <!-- Se l'immagine c'è la stampo-->

                <h6 style="margin-top: 1em">THUMBNAIL:</h6>

                <div class="image" >

                    <img src="{{$travel->thumbnail}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
              
                </div>
                
                @endif
                
                
            


        </div>
    </div>
</div>


<!-- STAGES  -->

@for ($i = 0; $i < count($travel->stage_array); $i++)
    <div class="gallery">

        <div class="comment stage">

                
            <h3 ><i class="bi bi-geo-fill"></i>Stage {{$i+1}}: {{$travel->stage_array[$i]->location}}</h3>

            <!-- HOUSINGS -->

            <div class="container">

                <h2 class="housing_title">Housings</h2>
                
                @if (count($travel->stage_array[$i]->housing_array)==0)

                    <p class="noElement"> No housing for this stage </p>
                    
                @else
                    
                    <div class="scrolling-wrapper-flexbox">

            
                        @foreach ($travel->stage_array[$i]->housing_array as $housing)
                            
                    
                            <div class="card" style="margin-right: 0.5em">
                            
                                <div class="row no-gutters"> <!-- Setta margini a 0-->
                                    <div class="col-xs-5 col-md-5 col-lg-6">

                                    @if (value($housing->info->place_image) != '' && value($housing->info->place_image) != 'http://localhost:8000/storage/images') <!-- Se l'immagine c'è la stampo-->

                                        <img src="{{$housing->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                        
                                    @else  <!-- Se l'immagine non c'è, metto un placeholder-->
                                        <img src="/img/no-image.png"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                    @endif
                                </div>

                                    <div class="col-xs-7 col-md-7 col-lg-6">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                                {{$housing->name}} 

                                                    <!-- STampo stelline : vedi restaurant --> 

                                            </h5>
                                            <p class="card-text">
                                                <span class="badge badge-pill bg-primary"> 
                                                    <i class="bi bi-house-heart"></i> 
                                                    {{$housing->type}}
                                                </span>
                                                <span class="badge badge-pill" style="background-color: olivedrab"> 
                                                        <i class="bi bi-currency-dollar" style="color: white"></i> {{$housing->info->price}}</button> 
                                            
                                                </span>
                                                <small class="card-subtitle mb-3">
                                                    
                                                    @for ($j = 0; $j < 5 ; $j++)
                            
                                                        @if ($j < value($housing->info->stars))
                                
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                            
                                                        @endif
                                                    @endfor
                                                </small> 
                                    
                                            </p>
                                            <p class="card-text">{{$housing->info->description}}</p>

                                            <a  href="{{$housing->info->link}}" style="text-decoration: none; color: black;">
                                                
                                                <p class="card-text float-right link"><i class="bi bi-link"></i> {{$housing->info->link}} </p>
                                            </a>
                            
                                            <p class="card-text float-right">
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt-fill"></i> 
                                                    {{$housing->address->street_and_number}},
                                                    {{$housing->address->postcode}},
                                                    {{$housing->address->city}}
                                                    ({{$housing->address->province}}),
                                                    {{$housing->address->country}} </small>
                                            </p>
                                            <div class='w-100'>
                                                <a href="{{route('housing.more', ['id' => $housing->id])}}" class="btn btn-secondary more">
                                                    See More!
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            

                        @endforeach

                    </div>
                @endif
                
                
            
            </div>


            <!-- ATTRACTIONS -->


            <div class="container">

                <h2 class="attraction_title">Attractions</h2>

                
                    @if (count($travel->stage_array[$i]->attraction_array)==0)

                    <p class="noElement"> No attraction for this stage </p>
                
                @else
                
                    <div class="scrolling-wrapper-flexbox">

                
                        @foreach ($travel->stage_array[$i]->attraction_array as $attraction)
                            
                            <div class="card" style="margin-right: 0.5em">
                            
                                <div class="row no-gutters"> <!-- Setta margini a 0-->
                                    <div class="col-xs-5 col-md-5 col-lg-6">

                                        @if (value($attraction->info->place_image) != '' && value($attraction->info->place_image) != 'http://localhost:8000/storage/images') <!-- Se l'immagine c'è la stampo-->

                                            <img src="{{$attraction->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                            
                                        @else  <!-- Se l'immagine non c'è, metto un placeholder-->
                                            <img src="/img/no-image.png"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                        @endif
                                    </div>

                                    <div class="col-xs-7 col-md-7 col-lg-6">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                                {{$attraction->name}} 

                                                <!-- STampo stelline : vedi restaurant --> 

                                            </h5>
                                            <p class="card-text">
                                                <span class="badge badge-pill bg-primary"> 

                                                    @if ( value($attraction->type) == 'PARK')
                                                        <i class="bi bi-balloon"></i>
                                            
                                                    @elseif( value($attraction->type) == 'GARDEN')
                                                        <i class="bi bi-flower1"></i>

                                                    @elseif( value($attraction->type) == 'CITY' || value($attraction->type) == 'MUSEUM' || value($attraction->type) == 'SQUARE' )
                                                        <i class="bi bi-bank"></i>

                                                    @elseif( value($attraction->type) == 'MOUNTAIN' )
                                                        <i class="fa-solid fa-mountain"></i>
   
                                                    @elseif( value($attraction->type) == 'CHURCH' )
                                                        <i class="fas fa-church"></i>
                                                        
                                                    @elseif( value($attraction->type) == 'SEA' || value($attraction->type) == 'LAKE'  )
                                                        <i class="bi bi-water"></i>
                                                    @endif

                                                    {{$attraction->type}}

                                                </span>
                                                <span class="badge badge-pill" style="background-color: olivedrab"> 
                                                    <i class="bi bi-currency-dollar" style="color: white"></i> {{$attraction->info->price}}</button> 
                                            
                                                </span>
                                                <small class="card-subtitle mb-3">
                                                    
                                                    @for ($j = 0; $j < 5 ; $j++)
                            
                                                        @if ($j < value($attraction->info->stars))
                                
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                            
                                                        @endif
                                                    @endfor
                                                </small> 
                                    
                                            </p>
                                            <p class="card-text">{{$attraction->info->description}}</p>

                                                <a  href="{{$attraction->info->link}}"  style="text-decoration: none; color: black;">
                                                    
                                                    <p class="card-text float-right  link"><i class="bi bi-link"></i> {{$attraction->info->link}} </p>
                                                </a>
                            
                                            <p class="card-text float-right">
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt-fill"></i> 
                                                    {{$attraction->address->street_and_number}},
                                                    {{$attraction->address->postcode}},
                                                    {{$attraction->address->city}}
                                                    ({{$attraction->address->province}}),
                                                    {{$attraction->address->country}} </small>
                                            </p>
                                            <div class='w-100'>
                                                <a href="{{route('attraction.more', ['id' => $attraction->id])}}" class="btn btn-secondary more">
                                                    See More!
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            

                        @endforeach

                    </div>
                @endif
                    
                
            </div>

            <!-- RESTAURANTS -->


            <div class="container">

                <h2 class="restaurant_title">Restaurants</h2>
            
                
                    @if (count($travel->stage_array[$i]->restaurant_array)==0)

                    <p class="noElement">No restaurant for this stage  </p>
                
                @else
                
                    <div class="scrolling-wrapper-flexbox">

                
                        @foreach ($travel->stage_array[$i]->restaurant_array as $restaurant)
                            
                    
                            <div class="card" style="margin-right: 0.5em">
                            
                                <div class="row no-gutters"> <!-- Setta margini a 0-->
                                    <div class="col-xs-5 col-md-5 col-lg-6">

                                        @if (value($restaurant->info->place_image) != '' && value($restaurant->info->place_image) != 'http://localhost:8000/storage/images') <!-- Se l'immagine c'è la stampo-->

                                            <img src="{{$restaurant->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                            
                                        @else  <!-- Se l'immagine non c'è, metto un placeholder-->
                                            <img src="/img/no-image.png"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                        @endif
                                    </div>

                                    <div class="col-xs-7 col-md-7 col-lg-6">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                                {{$restaurant->name}} 

                                                <!-- STampo stelline : vedi restaurant --> 

                                            </h5>
                                            <p class="card-text">
                                                <span class="badge badge-pill bg-primary"> 

                                                    @if ( value($restaurant->type) == 'RESTAURANT')
                                                        <i class="fas fa-utensils"></i>
                                            
                                                    @elseif( value($restaurant->type) == 'ICE-CREAM SHOP')
                                                        <i class="fas fa-ice-cream"></i>

                                                    @elseif( value($restaurant->type) == 'BREWERY' ||  value($restaurant->type) == 'TAVERN' ||  value($restaurant->type) == 'PUB')
                                                        <i class="fas fa-beer"></i>

                                                    @elseif( value($restaurant->type) == 'PIZZERIA' )
                                                        <i class="fas fa-pizza-slice"></i>

                                                    @elseif( value($restaurant->type) == 'CAFE'  )
                                                        <i class="fas fa-coffee"></i>

                                                    @elseif( value($restaurant->type) == 'BAKERY'  )
                                                        <i class="fas fa-birthday-cake"></i>
                                                    @endif
                                                    
                                                    {{$restaurant->type}} 
                                                    
                                                </span>
                                                <span class="badge badge-pill" style="background-color: olivedrab"> 
                                                    <i class="bi bi-currency-dollar" style="color: white"></i> {{$restaurant->info->price}}</button> 
                                            
                                                </span>
                                                <small class="card-subtitle mb-3">
                                                    
                                                    @for ($j = 0; $j < 5 ; $j++)
                            
                                                        @if ($j < value($restaurant->info->stars))
                                
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                            
                                                        @endif
                                                    @endfor
                                                </small> 
                                    
                                            </p>
                                            <p class="card-text">{{$restaurant->info->description}}</p>

                                                <a  href="{{$restaurant->info->link}}"  style="text-decoration: none; color: black;">
                                                    
                                                    <p class="card-text float-right  link"><i class="bi bi-link" ></i> {{$restaurant->info->link}} </p>
                                                </a>
                            
                                            <p class="card-text float-right">
                                                <small class="text-muted">
                                                    <i class="bi bi-geo-alt-fill"></i> 
                                                    {{$restaurant->address->street_and_number}},
                                                    {{$restaurant->address->postcode}},
                                                    {{$restaurant->address->city}}
                                                    ({{$restaurant->address->province}}),
                                                    {{$restaurant->address->country}} </small>
                                            </p>
                                            <div class='w-100'>
                                                <a href="{{route('restaurant.more', ['id' => $restaurant->id])}}" class="btn btn-secondary more">
                                                    See More!
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            

                        @endforeach

                    </div>
                @endif
                    
                
            </div>

        </div>



    </div>

@endfor
    
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
@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Adventures
@endsection

@section('stile')
adventures.css
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


<div class="holder">
    <h3> Your adventures </h3>
</div>


<div class="top-external">

    Here you can see all your previous experience, to remember happy moments or inspire your friends!

</div>

<div class="external">

    <!-- HOUSINGS -->

    <div class="container">

         <h2 class="housing_title">Housings</h2>
            
            @if (count($housings_list)==0)

                <p class="noElement"> Hey, you haven't insert any housing yet! If you want to add one <a href="{{route('housing.add')}}" style="color:black">click here</a> </p>
             
            @else
               
                <div class="scrolling-wrapper-flexbox">

       
                    @foreach ($housings_list as $housing)
                        
                
                        <div class="card" style="margin-right: 0.5em">
                        
                            <div class="row no-gutters"> <!-- Setta margini a 0-->
                                <div class="col-xs-5 col-md-5 col-lg-6">
                                    <img src="{{$housing->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
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
                                                
                                                @for ($i = 0; $i < 5 ; $i++)
                        
                                                    @if ($i < value($housing->info->stars))
                            
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
                                            <a href="" class="btn btn-success more">
                                                Edit
                                            </a>

                                            <a href="" class="btn btn-danger more">
                                                Delete
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
       
          
            @if (count($attractions_list)==0)

            <p class="noElement"> Hey, you haven't insert any attraction yet! If you want to add one <a href="{{route('attraction.add')}}" style="color:black">click here</a> </p>
         
        @else
           
            <div class="scrolling-wrapper-flexbox">

        
                @foreach ($attractions_list as $attraction)
                    
            
                    <div class="card" style="margin-right: 0.5em">
                    
                        <div class="row no-gutters"> <!-- Setta margini a 0-->
                            <div class="col-xs-5 col-md-5 col-lg-6">
                                <img src="{{$attraction->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
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

                                            @elseif( value($attraction->type) == 'SEA' || value($attraction->type) == 'LAKE'  )
                                                <i class="bi bi-water"></i>
                                            @endif

                                            {{$attraction->type}}

                                        </span>
                                        <span class="badge badge-pill" style="background-color: olivedrab"> 
                                            <i class="bi bi-currency-dollar" style="color: white"></i> {{$attraction->info->price}}</button> 
                                    
                                        </span>
                                        <small class="card-subtitle mb-3">
                                            
                                            @for ($i = 0; $i < 5 ; $i++)
                    
                                                @if ($i < value($attraction->info->stars))
                        
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
                                        <a href="" class="btn btn-success more">
                                            Edit
                                        </a>

                                        <a href="" class="btn btn-danger more">
                                            Delete
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


    
    <!-- RESTAURANTSS -->


    <div class="container">

        <h2 class="restaurant_title">Restaurant</h2>
       
          
            @if (count($restaurants_list)==0)

            <p class="noElement"> Hey, you haven't insert any restaurant yet! If you want to add one <a href="{{route('restaurant.add')}}" style="color:black">click here</a> </p>
         
        @else
           
            <div class="scrolling-wrapper-flexbox">

        
                @foreach ($restaurants_list as $restaurant)
                    
            
                    <div class="card" style="margin-right: 0.5em">
                    
                        <div class="row no-gutters"> <!-- Setta margini a 0-->
                            <div class="col-xs-5 col-md-5 col-lg-6">
                                <img src="{{$restaurant->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
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
                                            
                                            @for ($i = 0; $i < 5 ; $i++)
                    
                                                @if ($i < value($restaurant->info->stars))
                        
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
                                        <a href="" class="btn btn-success more">
                                            Edit
                                        </a>

                                        <a href="" class="btn btn-danger more">
                                            Delete
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

                
   
@endsection


@section('footer')


    <footer class="page-footer" style="margin-top: 5em ">

        <div >
            <small>
                Always ready to inspire you  <span><i class="bi bi-airplane-fill"> </i></span> 
            </small>
        </div>
    
    </footer>

@endsection
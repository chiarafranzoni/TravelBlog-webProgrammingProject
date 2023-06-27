@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Restaurants
@endsection

@section('stile')
elementsList.css
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
 


    <div class="holder" style="
    color: crimson;
    text-shadow: 2px 2px maroon;">
        <h3> Restaurants</h3>
    </div>

    <div class="top-external" style="border: 1px solid maroon  ;">

        <div class="info-container ">
           <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
            Pizza, ice-cream, hamburger... I bet that now you are hungry!
           </p>
           <p>
            Guess what?  Good for you!  <br> Take a look at what amazing places
            other people have suggested to you, to discover your new favourite restaurant  <br>
            Try searching for something or ... add something yourself!
            
            </p>
        </div>

        <div class="search-container">
            <h6> What are you looking for ?</h6>
            <input class="form-control" id="searchName" type="text" placeholder="Type a name">
        </div>

        <div class="search-container">
            <h6> Where do you wanna go ?</h6>
            <input class="form-control" id="searchLocality" type="text" placeholder="Type a locality">
        </div>

        
        <div class="search-container">

            <button class="btn btn-add" style="
            margin-top:2em;
            background-color: lightgoldenrodyellow;;
            box-shadow: 1px 1px  rgb(220,20,60);" > <a class="dropdown-item" href="{{route('restaurant.add')}}"> Add a Restaurant </a></button>
            
            
        </div>
        
    </div>

       

            <!-- Da RestaurantController, mi arriva una restaurants_list -->

            @foreach ($restaurants_list as $restaurant) <!--Per ciascun ristornate della lista-->

                            
                <div class="external" style="
                background-color: lightgoldenrodyellow;
                box-shadow: 1px 1px rgb(220,20,60);">

                    <div class="continer ">
                        
                        <div class="card">

                                <div class="row no-gutters"> <!-- Setta margini a 0-->
                                    <div class="col-xs-7 col-md-6 col-lg-5">
                                        <img src="{{$restaurant->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                    </div>

                                    <div class="card-wrapper col-xs-5  col-md-6 col-lg-7">
                                        <div class="card-body" style="height: 100%; display: grid;">
                                            <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                                {{$restaurant->name}} 

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
                                                
                                    
                                            </p>
                                            <p class="card-text card-address" style="margin-bottom: 2em;">
                                                <i class="bi bi-geo-alt-fill"></i> 
                                                {{$restaurant->address->street_and_number}},
                                                {{$restaurant->address->postcode}},
                                                {{$restaurant->address->city}}
                                                ({{$restaurant->address->province}}),
                                                {{$restaurant->address->country}} </p>
                            
                                            <p class="card-text float-right" style=" display:flex; align-content:baseline; ">

                                                <small class="text-muted" >Wanna see what other people think about this?</small>
                                            </p>
                                            <div class='w-100' >
                                            
                                                <a href="{{route('restaurant.more', ['id' => $restaurant->id])}}" class="btn btn-secondary more">
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
    
    
                $("#searchName").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $(".external").filter(function () {
    
                            $(this).toggle($(this).find($(".card-title")).text().toLowerCase().indexOf(value) > -1)
                            
    
                    });
    
                    
                    var dim = $('.external').is(":visible");
    
                    if (dim == false) {
                        $(".hidden").show();
                    } else {
                        $(".hidden").hide();   
                    }
    
                    
    
    
                });
    
    
                $("#searchLocality").on("keyup", function () {
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
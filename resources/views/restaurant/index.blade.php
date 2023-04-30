@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Restaurants
@endsection

@section('stile')
restaurantsList.css
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
 


    <div class="holder">
        <h3> Restaurants</h3>
    </div>



        

            <!-- Da RestaurantController, mi arriva una restaurants_list -->

            @foreach ($restaurants_list as $restaurant) <!--Per ciascun ristornate della lista-->

                            
                <div class="external">

                    <div class="continer ">
                        
                        <div class="card">

                                <div class="row no-gutters"> <!-- Setta margini a 0-->
                                    <div class="col-xs-7 col-md-6 col-lg-5">
                                        <img src="{{$restaurant->place_image}}" alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                    </div>

                                    <div class="col-xs-5  col-md-6 col-lg-7">
                                        <div class="card-body">
                                            <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                                {{$restaurant->name}} 
                                                @if (value($restaurant->stars)==5)
                                                    
                                                    <span class="badge badge-pill top-rating">Top Rating</span>
                                                @endif
                                            </h5>
                                            <p class="card-text">
                                                <span class="badge badge-pill bg-primary"> <i class="fas fa-pizza-slice"></i>
                                                    {{$restaurant->category}}
                                                </span>
                                                <span class="badge badge-pill bg-primary bs-color"> Rating</span>
                                                <small class="card-subtitle mb-3"> Price</small> 
                                    
                                            </p>
                                            <p class="card-text">{{$restaurant->description}}</p>
                            
                                            <p class="card-text float-right">
                                                <small class="text-muted">See More !</small>
                                            </p>
                                            <div class='w-100'>
                                                <a href="" class="btn btn-secondary more">
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
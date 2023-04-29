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

<div class="external">

<div class="continer ">
    
    <div class="card">

            <div class="row no-gutters"> <!-- Setta margini a 0-->
                <div class="col-xs-7 col-md-6 col-lg-5">
                    <img src="img/viaggio.jpg" alt="Photo" class="card-img h-100">
                </div>

                <div class="col-xs-5  col-md-6 col-lg-7">
                    <div class="card-body">
                        <h5 class="card-title"> Title <span class="badge badge-pill bg-primary">Top Rating</span></h5>
                        <p class="card-text">
                            <span class="badge badge-pill bg-primary"> <i class="bi bi-1-circle-fill"></i>
                                Categoria</span>
                            <span class="badge badge-pill bg-primary bs-color"> Rating</span>
                            <small class="card-subtitle mb-3"> Price</small> 
                
                        </p>
                        <p class="card-text">Learn how to buil responsive item belbelbeiyugyhdyughjdiuhjiujidhujdih</p>
          
                        <p class="card-text float-right">
                            <small class="text-muted">See More !</small>
                        </p>
                        <div class='clear-fix w-100'></div>
                        <a href="" class="btn btn-secondary ">
                            See More!
                        </a>
                    </div>
                </div>
            </div>

    </div>
</div>
</div>



 <div class="container">

    <div class="holder">
        <h3> Restaurants</h3>
    </div>

    <div class="row">

        

            <!-- Da RestaurantController, mi arriva una restaurants_list -->

            @foreach ($restaurants_list as $restaurant) <!--Per ciascun ristornate della lista-->
            
            <!-- Costruisco il container per il ristorante-->
            
            <div class="external">

                <div class="image col-sm-2 col-md-4">
                    <img src="{{$restaurant->place_image}}" alt="Photo">
                </div>
                
                <div class=" container about col-sm-10 col-md-8">
                    <div class="name">
                        <h1>{{$restaurant->name}}</h1>
                    </div>
                    <div class="info">
                        <div class="category_text"> Category:</div><div class="category">{{$restaurant->category}}</div>
                        <div class="price_text"> Price:</div><div class="price"> {{$restaurant->price_from}}- {{$restaurant->price_to}} €</div>
                        <div class="rating_text"> Rating: </div>
                        <div class="rating"> 
                            
                            @for ($i = 0; $i < 5; $i++)
                            
                                @if ($i < value($restaurant->stars))            <!-- CAMBIAAAA con {{$restaurant->stars}}-->
                                <i class="bi bi-star-fill"></i>
                            
                                @else
                                <i class="bi bi-star"></i>

                                    
                                @endif


                            @endfor
                        </div>
                    </div>
                    <div class="more">
                        <a href="CAMBIA!">
                            <h3>Wanna see more?</h3>
                        </a>
                    </div>
                    
                </div>

            </div>    

            @endforeach

        

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
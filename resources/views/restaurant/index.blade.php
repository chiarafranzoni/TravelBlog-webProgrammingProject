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
 <div class="container">

    <div class="holder">
        <h3> Restaurants</h3>
    </div>

    <div class="row">

        

            <!-- Da RestaurantController, mi arriva una restaurants_list -->

            @foreach ($restaurants_list as $restaurant) <!--Per ciascun ristornate della lista-->
            
            <!-- Costruisco il container per il ristorante-->
            
            <div class="external">

                <div class="image col-sm-2 col-md-3">
                    <img src="{{$restaurant->place_image}}" alt="Photo">
                </div>
                
                <div class=" container about col-sm-10 col-md-9">
                    <div class="name">
                        <h1>{{$restaurant->name}}</h1>
                    </div>
                    <div class="info">
                        <div class="category_text"> Category:</div><div class="category">{{$restaurant->category}}</div>
                        <div class="price_text"> Price:</div><div class="price"> {{$restaurant->price_from}}- {{$restaurant->price_to}}</div>
                        <div class="rating_text"> Rating: </div><div class="rating"> Rating: </div>
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
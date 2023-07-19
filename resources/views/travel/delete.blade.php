@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Delete Travel
@endsection

@section('stile')
error.css
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

<div class="external ">
    
    <br>

    <div class=" container containerError">


      <div class="row ">

        <div class="subtitle-text">
            <h3>Are you sure?</h3>
        </div>

        <br>

        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
            <div class="holder">

                <p>You really want to delete <strong>{{$travel->title}}</strong> ?</p>

            </div>

            <div class="holderB">
                <p>
                    <a class="btn btn-secondary" style="margin-right: 2em"  href="{{route('user.adventures')}} ">Go back</a>
                </p>

                <p>
                    <a class="btn btn-danger"  href="{{ route('travel.cancella',['id' => $travel->id])}}">Delete</a>
                </p>
            </div>

    
        </div>
          
        
    
    </div>
          
</div>
             
   
@endsection



@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Homepage
@endsection

@section('stile')
style.css
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
      <li><a class="dropdown-item" href="{{route('housing.index')}}">Hotels</a></li>
      <li><a class="dropdown-item" href="{{route('attraction.index')}}">Attractions</a></li>  
      <li><a class="dropdown-item" href="{{route('travel.index')}}">Travels</a></li>
    </ul>
</li>

@endsection


@section('corpo')


    <!--  INIZIO CAROSELLO -->

    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
        

            <!--NB: solo il primo elemento del carosello deve essere active! -->

            <div class="carousel-item active">
                
                <!--  IMMAGE SFONDO CAROSELLO-->
                <img src="img/viaggio.jpg" class="d-block w-100" alt="Viaggio">
                
                <!--  TITOLO SLIDE CAROSELLO-->
                <div class="centered">
                    <div class="carousel-text">
                    <h5 >Travels</h5>
                    </div>
                </div>

                <!--  RIQUADRO CON LINK PER PAGINA-->
                <a class="carousel-link-text-a" href="{{route('travel.index')}}">
                    <div class="carousel-link">
                    
                        <p>SEE MORE</p> 
        
                    </div>
                </a>

            </div>
            

            <!--  Itero sulle slide successive del carosello-->
            @for($i=0 ; $i<3; $i++)

                <div class="carousel-item ">

                    <!--  IMMAGE SFONDO CAROSELLO : in modo condizionale scelgo l'immagine-->

                    <img src= " @if($i==0) img/attrazioni.JPG
                                @elseif($i==1) img/ristoro.jpg
                                @else  img/alloggio.jpg
                                @endif" 
                    class="d-block w-100" 
                    alt= "  @if($i==0) Attrazioni
                            @elseif($i==1) Ristori
                            @else  Alloggi
                            @endif">

                   
                    
                    <!--  TITOLO SLIDE CAROSELLO : in modo condizionale scelgo il titolo-->
                    <div class="centered">
                        <div class="carousel-text">

                            <h5 >
                                @if( $i==0) Attractions

                                @elseif( $i==1) Restaurants
                                
                                @else Housings
                                
                                @endif

                            </h5> 

                        </div>
                    </div>

                    <!--  RIQUADRO CON LINK PER PAGINA : in modo condizionale scelgo il link-->

                    <a class="carousel-link-text-a" 
                        href="  @if($i==0) {{route('attraction.index')}}
                                @elseif($i==1) {{route('restaurant.index')}}
                                @else  {{route('housing.index')}}
                                @endif" >


                        <div class="carousel-link">
                            
                                <p>SEE MORE</p> 

                        </div>
                    </a>

                    
                </div>

            @endfor

        </div>
        

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
        </button>

    </div>

    <!--  FINE CAROSELLO -->

    <!--  Info e subscription box -->
    <div style="overflow:hidden; padding: 1.5em ; margin-bottom: 6em">

        <div class="row" style="padding-top: 3em; overflow:hidden;">

            <!-- NB: la somma eve sempre essere 12 -->

            <div class="col-sm-5 col-md-4" >
                <!--  Inserisco immagine in parte a info -->

                <img class="info-img" src="img/round-info-border-text.jpg">

            </div>

            <div class="col-sm-7 col-md-8" style="display: block; text-align:center">

                <h2 class="info_text-title" style="margin-bottom: 0.5em"> Discover something special!</h2>

                <p class="info_text" >
                    Do you want to escape from reality for a little bit? Well, Welcome! <br>
                    Here you can find stories and photos from various travel destinations around the world,
                     with insider tips and advice on the best places to visit, eat, and stay. 
                    Take a look at the experiences that other users have insert or ... 
                    subscribe now to share your adventures with others and keep your own travel diary to remember all your happy moments!

                </p>

                <a class="btn subscribe" onclick="alreadySubscribed({{$logged}})"> Subscribe now ! </a>
                
            </div>

        </div>
    </div>


    <div class="holder" style="
    color:yellowgreen;
    text-shadow: 2px 2px darkgreen;">

        <h3> Attractions</h3>
    </div>

        
    <div class="top-external" style=" border: 1px solid darkgreen  ;">

        <div class="info-container ">
           <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
            Hey, wanna have some fun? Or maybe learn something super cool? 
           </p>
           <p>
             Go on and take a look at all the attractions that other people have reviewed or add your own favourite!
            
            </p>

            <button class="btn add" style="
            margin-top:1em;
            background-color: whitesmoke;
            box-shadow: 1px 1px darkgreen;"> <a class="dropdown-item" href="{{route('attraction.index')}}"> Take a look at the attractions</a></button>

        </div>

        
    </div>

    <div class="holder" style="
    color:rgb(45, 177, 177) ;
    text-shadow: 2px 2px darkblue;">

        <h3> Housings</h3>
    </div>

        
    <div class="top-external" style=" border: 1px solid darkblue  ;">

        <div class="info-container ">
           <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
            Cozy bedroom, awesome views end amazing breakfast. A dream?
           </p>
           <p>
             Go on and take a look at all the housings that other people have reviewed or add your own favourite!
            
            </p>

            <button class="btn add" style="
            margin-top:1em;
            background-color: rgb(255, 235, 205);
            box-shadow: 1px 1px darkblue;"><a class="dropdown-item" href="{{route('housing.index')}}"> Take a look at the housings</a></button>

        </div>

        
    </div>

    <div class="holder" style="
    color: crimson;
    text-shadow: 2px 2px maroon;">

        <h3> Restaurants</h3>
    </div>

        
    <div class="top-external" style=" border: 1px solid maroon  ;">

        <div class="info-container ">
           <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
            Pizza, ice-cream, hamburger... I bet that now you are hungry!
           </p>
           <p>
             Go on and take a look at all the restaurants that other people have reviewed or add your own favourite!
            
            </p>

            <button class="btn add" style="
            margin-top:1em;
            background-color: lightgoldenrodyellow;;
            box-shadow: 1px 1px  rgb(220,20,60);"><a class="dropdown-item" href="{{route('restaurant.index')}}"> Take a look at the restaurants</a></button>

        </div>

        
    </div>

    
    <div class="holder" style="
    color: darkorange;
    text-shadow: 2px 2px orangered;">

        <h3> Travels</h3>
    </div>

        
    <div class="top-external" style=" border: 1px solid orangered  ;">

        <div class="info-container ">
           <p style="  font-family: 'Lucida Handwriting'; font-size:1.3rem;">
            A beautiful adventure is like a diamod...it lasts forever!
           </p>
           <p>
             Go on and take a look at all the trevel that other people have insert or add your own !
            
            </p>

            <button class="btn add" style="
            margin-top:1em;
            background-color: rgba(241, 235, 255, 0.6);
            box-shadow: 1px 1px  orangered;" ><a class="dropdown-item" href="{{route('travel.index')}}"> Take a look at the travels</a></button>

        </div>

        
    </div>


    
@endsection


@section('footer')


    <footer class="page-footer">

        <div class="container ">
            <small>
                Always ready to inspire you  <span><i class="bi bi-airplane-fill"> </i></span> 
            </small>
        </div>
    
    </footer>

@endsection
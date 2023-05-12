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
                    <h5 >Itinerari</h5>
                    </div>
                </div>

                <!--  RIQUADRO CON LINK PER PAGINA-->
                <a class="carousel-link-text-a" href="Itinerari.html">
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
                                @if( $i==0) Attrazioni

                                @elseif( $i==1) Ristorazione
                                
                                @else Alloggi
                                
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

    <div style="overflow:hidden;">

        <div class="row" style="padding-top: 7em; overflow:hidden;">

            <!-- NB: la somma eve sempre essere 12 -->

            <div class="col-sm-5 col-md-4" >
                <!--  Inserisco immagine in parte a info -->

                <img class="info-img" src="img/round-info-border-text.jpg">

            </div>

            <div class="col-sm-7 col-md-8">

                <h2 class="info_text-title"> Lorem Ipsum</h2>

                <p class="info_text">
                    Vestibulum non urna tincidunt, convallis purus a, vulputate sapien. Sed cursus eros massa, eget auctor purus vehicula sit amet.
                    Nam euismod dui molestie mauris bibendum venenatis. Aenean ipsum nibh, ornare et malesuada vitae, hendrerit sit amet ante.
                    Quisque id mattis purus. Nunc elementum consectetur euismod. Sed odio nibh, posuere in semper in, egestas ac dui.
                    Sed id ultricies risus, eget facilisis mauris. Nulla facilisi.
                    Vivamus venenatis ac nisi eu venenatis. Curabitur eget convallis ligula. 
                    Phasellus tortor sem, pretium at dolor eu, porta fermentum est. Aliquam consectetur massa fermentum, 
                    varius nulla in, porta mauris. Integer placerat nisl et lacus euismod, eu bibendum libero fringilla. 
                    Praesent commodo convallis molestie. Proin sit amet tincidunt tellus, vitae semper quam. 
                    Quisque bibendum diam diam, at consectetur velit ornare eget. Curabitur vel purus ut lectus pulvinar rhoncus. 
                    Sed non gravida nisi, at consequat quam. Integer ultricies vitae lorem condimentum fermentum.

                </p>

                <a class="btn subscribe" href="{{route('user.create')}}"> Subscribe </a>
                

            </div>

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
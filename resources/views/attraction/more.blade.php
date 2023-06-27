@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
   {{$attraction->name}}
@endsection

@section('stile')
more.css
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
    <h3 style="
    color:yellowgreen ;
    text-shadow: 2px 2px darkgreen;"> {{$attraction->name}} </h3>
</div>

<div class="gallery" >

    <div class="comments">
    
        <h3 ><i class="bi bi-info-square"></i> Important Infos</h3>

        <div class="info d-block">

            <h6 > 
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
            </h6>
            
            <h6 ><i class="bi bi-geo-alt-fill"></i> {{$address->street_and_number}},{{$address->postcode}},{{$address->city}} ({{$address->province}}),{{$address->country}} </h6>
            

            @for ($i = 0; $i < count($infos); $i++)

                <a  href="{{$infos[$i]->link}}"><h6 class="link"><i class="bi bi-link"></i> {{$infos[$i]->link}} </h6></a>
                
            @endfor
        </div>
    </div>
</div>


<!-- GALLERIA COMMENTI-->


<div class="gallery">

    <div class="comments">

        <h3><i class="bi bi-chat-dots"></i> What people say </h3>
        

        <!-- SE HO 1 SOLA RECENSIONE -->

        @if (count($infos)== 1)

            <div class="carousel-inner carousel-comment"> 

                <h5>From {{$infos[0]->user->firstname}} : </h5>
                <div class="stars">
                    @for ($i = 0; $i < 5 ; $i++)
                    
                        @if ($i < value($infos[0]->stars))

                            <i class="bi bi-star-fill"></i>
                        @else
                            <i class="bi bi-star"></i>
                            
                        @endif
                    @endfor

                    @if ( value($infos[0]->stars)==5)

                        
                            <button type="button" class="btn top-rating"> TOP RATING</button> 

                    @endif
                </div>

                
                <button type="button" class="btn price-btn"> <i class="bi bi-currency-dollar" style="color: white"></i> {{$infos[0]->price}}</button> 


                <p style="margin-top: 0.5em;"> {{$infos[0]->description}} </p>
            </div>   
         
            
            
        <!-- SE HO PIù  RECENSIONI E CREO UN CAROSELLO-->

        @else

            
            <!-- 1° COMMENTO -->
      
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner carousel-comment">
                    <div class="carousel-item active">
                        <h5>From {{$infos[0]->user->firstname}} : </h5>

                        <div class="stars">
                            @for ($i = 0; $i < 5 ; $i++)
                                @if ($i < value($infos[0]->stars))

                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                    
                                @endif

                            @endfor

                            
                            @if ( value($infos[0]->stars)==5)

                                <button type="button" class="btn top-rating"> TOP RATING</button> 

                            @endif
    
                        </div>

                        
                        <button type="button" class="btn price-btn">  <i class="bi bi-currency-dollar" style="color: white"></i>  {{$infos[0]->price}}</button> 

                        <p style="margin-top: 0.5em;"> {{$infos[0]->description}} </p>

                            <h5> 1 / {{count($infos)}} </h5>
                        
                    </div>

                <!-- ITERO DAL SECONDO COMMENTO IN POI -->  

                @for ($i = 1; $i <count($infos); $i++)
                
                <div class="carousel-item">
                    <h5>From {{$infos[$i]->user->firstname}} : </h5>

                    <div class="stars">

                        @for ($j = 0; $j < 5 ; $j++)
                            @if ($j < value($infos[$i]->stars))
            
                                <i class="bi bi-star-fill"></i>
                            @else
                                <i class="bi bi-star"></i>
                                
                            @endif
                        @endfor

                        @if ( value($infos[$i]->stars)==5)

                                <button type="button" class="btn top-rating"> TOP RATING</button> 

                            @endif

                    </div>

                    
                    <button type="button" class="btn price-btn">  <i class="bi bi-currency-dollar" style="color: white"></i>  {{$infos[$i]->price}}</button> 

                    <p style="margin-top: 0.5em;"> {{$infos[$i]->description}} </p>

                        <h5>{{$i+1}} / {{count($infos)}} </h5>
                    
                </div>
                @endfor
             
              
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            </div>

        @endif

    </div>

</div>



<!-- GALLERIA IMMAGINI-->


<div class="image-gallery">

    <div class="image">

        <h3 style="font-family: 'Poppins';"><i class="bi bi-camera"></i> Gallery </h3>
        

        <!-- SE HO 1 SOLA IMMAGINE-->

        @if (count($infos)==1)

            <img  src=" {{$infos[0]->place_image}}" class="d-block" >
              
          
        <!-- SE HO PIù IMMAGINI-->
        @else

    
      
        <div id="carouselImage" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src=" {{$infos[0]->place_image}}" class="d-block " >
                <div class="carousel-caption  d-md-block">
                    <h5> 1 / {{count($infos)}} </h5>
                </div>
              </div>

              @for ($i = 1; $i < count($infos); $i++)
              <div class="carousel-item">
                <img src=" {{$infos[$i]->place_image}}" class="d-block " >
                <div class="carousel-caption d-md-block" >
                    <h5>{{$i+1}} / {{count($infos)}} </h5>
                </div>
              </div>
              @endfor
             
              
            </div>
            <button class="carousel-control-prev " type="button" data-bs-target="#carouselImage" data-bs-slide="prev">
              <span class="carousel-control-prev-icon " aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next " type="button" data-bs-target="#carouselImage" data-bs-slide="next">
              <span class="carousel-control-next-icon " aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>

        @endif

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
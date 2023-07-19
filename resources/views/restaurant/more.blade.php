@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
   {{$restaurant->name}}
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
      <li><a class="dropdown-item" href="{{route('travel.index')}}">Travels</a></li>
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
    color: crimson;
    text-shadow: 2px 2px maroon;"> {{$restaurant->name}} </h3>
</div>

<div class="gallery" >

    <div class="comments comment-slide">
    
        <h3 ><i class="bi bi-info-square"></i> Important Infos</h3>

        <div class="info d-block">

            <h6 >   
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
            </h6>
            
            <h6 ><i class="bi bi-geo-alt-fill"></i> {{$address->street_and_number}},{{$address->postcode}},{{$address->city}} ({{$address->province}}),{{$address->country}} </h6>
            

            @for ($i = 0; $i < count($infos); $i++)

                <a  href="{{$infos[$i]->link}}"><h6 class="link"><i class="bi bi-link"></i> {{$infos[$i]->link}} </h6></a>
                
            @endfor
        </div>
    </div>
</div>


<!-- SEARCH BOX -->
<div class="gallery">

    <div class="top-external" style=" border: 1px solid maroon  ;">

        <div class="search-container">
            <h6> Select comments by price range : </h6>

            <select class="form-select " id="searchPrice" name="price" >
                <option selected>SELECT A PRICE</option>

                @foreach (['ECONOMIC', 'AVERAGE', 'EXPENSIVE'] as $item)

                <option value="{{$item}}">{{strtoupper($item)}}</option>
                    
                @endforeach

            </select>
        </div>

        <div class="search-container">
            <h6>  Select comments by stars : </h6>

            <select class="form-select " id="searchStars" name="price">
                <option selected>SELECT A STARS' NUMBER</option>

                @foreach (['0', '1', '2','3','4','5',] as $item)

                <option value="{{$item}}">{{strtoupper($item)}}</option>
                    
                @endforeach

            </select>
        </div>

        
        
    </div>

</div>


<!-- SCROLLING VERTICALE COMMENTI -->

<div class="gallery">

    <div class="comment">

        
        <h3 ><i class="bi bi-chat-dots"></i> What people say </h3>

        <div style=" max-height: 500px; overflow-y: scroll;" class="comment-container">

            @for ($i = 0; $i <count($infos); $i++)

                <div class="comment  carousel-comment">

                    <h5>From {{$infos[$i]->user->firstname}} : </h5>

                    <div class="stars">

                        <span class="starNumber" style="display: none">{{$infos[$i]->stars}}</span>

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

    </div>

</div>

<!-- Metto un div che apparirà solo nel caso in cui la ricerca non dia risultati-->
<div style="text-align: center; margin-bottom: 5em; margin-top: -5em; padding:1em">

    <span class="hidden" style="display: none; font-size: 25px;"> OPS... <br>It seems that what you are looking for doesn't exist .</span>
    <span class="hidden" style="display: none; font-size: 20px; text-shadow: none;"><br> Try searching again, maybe it will be the right time !</span>
</div>



<!-- GALLERIA IMMAGINI-->


<div class="image-gallery">

    <div class="image">

        <h3 style="font-family: 'Poppins';"><i class="bi bi-camera"></i> Gallery </h3>
        
    
        <!-- SE NON IMMAGINI-->
        @if (count($images)==0)

        <div style="text-align: center; padding:1em">

            <span class="hidden" style=" font-size: 25px;"> No images avaiable </span>
        </div>

  
          
        <!-- SE HO 1 SOLA IMMAGINE-->

        @elseif(count($images)==1)

            <img  src=" {{$images[0]}}" class="d-block" >

        <!-- SE HO PIù IMMAGINI-->
        @else

      
        <div id="carouselImage" class="carousel slide">
            <div class="carousel-inner">

              <div class="carousel-item active">
                <img src=" {{$images[0]}}" class="d-block " >
                <div class="carousel-caption  d-md-block">
                    <h5> 1 / {{count($infos)}} </h5>
                </div>
              </div>

              @for ($i = 1; $i < count($images); $i++)
              <div class="carousel-item">
                <img src=" {{$images[$i]}}" class="d-block " >

                <div class="carousel-caption d-md-block" >
                    <h5>{{$i+1}} / {{count($images)}} </h5>
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
 

<!-- SCRIPT PER CERCARE NEI COMMENTI-->


<script>
    $(document).ready(function () {

        console.log($(".carousel-comment").length)


           $("#searchPrice").on("change", function () {
               var value = $(this).val().toLowerCase();

               $(".carousel-comment").filter(function () {

                
                price_selection= $("#searchPrice").find(":selected").text();

                $("#searchStars").val("SELECT A STARS' NUMBER");

                //$("#searchStars").find(":selected").text("SELECT A STARS' NUMBER"); // Faccio in modo che se ho selezionato già price, si deselezioni stars
            

                    if ( price_selection != "SELECT A PRICE") {

                       $(this).toggle($(this).find($(".price-btn")).text().toLowerCase().indexOf(value) > -1)

                    }else{
                        $(this).show();
                        
                    }
                       

               });

               
               var dim = $('.carousel-comment').is(":visible");

               console.log(dim);

               if (dim == false) {
                   $(".hidden").show();
               } else {
                   $(".hidden").hide();   
                   
               }

               


            });


            $("#searchStars").on("change", function () {
               var value = $(this).val().toLowerCase();

               $(".carousel-comment").filter(function () {


                star_selection= $("#searchStars").find(":selected").text();

                $("#searchPrice").val("SELECT A PRICE");

                //$("#searchPrice").find(":selected").text("SELECT A PRICE"); // Faccio in modo che se ho selezionato già stelle, si deselezioni price
            
  
                     if ( star_selection != "SELECT A STARS' NUMBER") {

                        $(this).toggle($(this).find($(".starNumber")).text().toLowerCase().indexOf(value) > -1)

                     } else{
                        $(this).show();
                     }

               });

               
               var dim = $('.carousel-comment').is(":visible");

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
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



    <div class="container">

         <h2 class="housing_title">Housings</h2>
            
            @if (count($housings_list)==0)

                <p class="noElement"> Hey, you haven't insert any housing yet! If you want to add one <a href="{{route('housing.add')}}" style="color:black">click here</a> </p>
             
            @else
               
            <div class="scrolling-wrapper-flexbox">

       
                    @foreach ($housings_list as $housing)
                        
                
                        <div class="card">
                        
                            <div class="row no-gutters"> <!-- Setta margini a 0-->
                                <div class="col-xs-5 col-md-5 col-lg-5">
                                    <img src="{{$housing->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                                </div>

                                <div class="col-xs-7 col-md-7 col-lg-7">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                            {{$housing->name}} 

                                             <!-- STampo stelline : vedi restaurant --> 

                                        </h5>
                                        <p class="card-text">
                                            <span class="badge badge-pill bg-primary"> <i class="fas fa-pizza-slice"></i>
                                                {{$housing->type}}
                                            </span>
                                            <span class="badge badge-pill bg-primary bs-color"> Rating</span>
                                            <small class="card-subtitle mb-3"> Price</small> 
                                
                                        </p>
                                        <p class="card-text">{{$housing->info->description}}</p>
                        
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
                        

                    @endforeach

                </div>
            @endif
            
           
        
    </div>

    <div class="container">

        <h2 class="attraction_title">Attractions</h2>
       
          
            @if (count($attractions_list)==0)

            <p class="noElement"> Hey, you haven't insert any attraction yet! If you want to add one <a href="{{route('attraction.add')}}" style="color:black">click here</a> </p>
         
        @else
           
        <div class="scrolling-wrapper-flexbox">

                @foreach ($attractions_list as $attraction)
                    
            
                    <div class="card card-body">
                        
                        <div class="row no-gutters"> <!-- Setta margini a 0-->
                            <div class="col-xs-7 col-md-6 col-lg-5">
                                <img src="{{$attraction->info->place_image}}"  alt="Photo" class="card-img h-100"  style="border-radius: 3px;">
                            </div>

                            <div class="col-xs-5  col-md-6 col-lg-7">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-family: 'Poor Richard'; font-size: 40px;"> 
                                        {{$attraction->name}} 

                                         <!-- STampo stelline : vedi restaurant --> 

                                    </h5>
                                    <p class="card-text">
                                        <span class="badge badge-pill bg-primary"> <i class="fas fa-pizza-slice"></i>
                                            {{$attraction->type}}
                                        </span>
                                        <span class="badge badge-pill bg-primary bs-color"> Rating</span>
                                        <small class="card-subtitle mb-3"> Price</small> 
                            
                                    </p>
                                    <p class="card-text">{{$attraction->info->description}}</p>
                    
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
                    

                @endforeach

            </div>
        @endif
            
           
        </div>

    </div>
    
</div>

                
   
@endsection
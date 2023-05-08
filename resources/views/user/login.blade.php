@extends('layouts.master') 
<!-- Prendo il template realizzato in layout.master e sostituisco tutti i place holder @-->

 <!--Definisco ciò che voglio mettere al posto del placeholder title-->
@section('title') 
    Login
@endsection

@section('stile')
formLogin.css
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

<div class="external ">
    
    <br>

    <div class="container ">


      <div class="row ">

        <div class="title-text">
            <h3>Sign In</h3>
       </div>

        <!-- Con metodo post: aggiungo queste info a database, invocando il metodo store nello UserController-->
            <form >

                <label for="email"> Email</label> 
                <div class="input-box">  
                    <i class="bi bi-envelope"></i>
                    <input class='form-control' type="email" id="email" name="email" placeholder="Email"> 
                </div>

                <label for="password"> Password</label>
                <div class="input-box ">    
                    <i class="bi bi-lock"></i>            
                    <input class='form-control' type="password" id="password" name="password" placeholder="Password"> 
                    <div class="eye">
                        <i  class="bi bi-eye" onclick="passwordToggle()" id="eye"></i>
                    </div>
                </div>

                <div class="buttonHolder">
                    <input class="btn loginSubmit" type="submit" value="Login">
                </div>

            </form>

            <div class="holder">
                <p>Don't have an account yet?</p>
                <a href="{{route('user.create')}}"> 
                    <p> Subscribe now !</p>
                </a>
              

            </div>
        </div>
          
        
    
    </div>
          
</div>
             
   
@endsection



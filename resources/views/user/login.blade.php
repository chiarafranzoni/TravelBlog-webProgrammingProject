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
      <li><a class="dropdown-item" href="restaurants.html">Restaurants</a></li>
      <li><a class="dropdown-item" href="hotels.html">Hotels</a></li>
      <li><a class="dropdown-item" href="hotels.html">Attractions</a></li>
    </ul>
</li>
@endsection

@section('corpo')

<div class="external ">
    
    <br>

    <div class="container ">

      <div class="empty-space" style="height: 4em"> 
        <!--  Inserisco dello spazio vuoto in testa al form -->
      </div>

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
                <div class="input-box">    
                <i class="bi bi-lock"></i>            
                <input class='form-control' type="password" id="password" name="password" placeholder="Password"> 
                </div>


                <div class="row align-items-center remember">
                    <input type="checkbox">Remember Me
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="btn float-right login_btn">
                </div>
            </form>
        </div>
          
        <div class="empty-space" style="height: 4em"> 
            <!--  Inserisco dello spazio vuoto in coda al form -->
        </div>
    
    </div>
          
</div>
             
   
@endsection



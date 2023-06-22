<!-- DEFINISCO UNO SCHEMA GENERALE PER LE PAGINE

  Quando utilizzo @ yield(''), metto un place holder per definire poi le cose

-->


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8/"> <!-- Per specificare il char set -->
        <!-- DA SOSTITUIRE ! -->
        <title>
             @yield('title')        
        </title>

        <meta name="viewport" content="width=device-width , initial-scale=1.0, user-scalable=no"> <!-- Per rendere responsive la pagina -->

        <!-- STYLESHEET -->
        <!-- bootstrap.min.css : non ha gli spazi per risparmare memoria != bootstrap.css -->

        <link rel="stylesheet" href="{{ url('/')}}/css/bootstrap.min.css">  <!-- dice dove trovare il file bootstap.min.css, per trovare sempre gli URL-->
        <link rel="stylesheet" href="{{ url('/')}}/css/general.css">  <!-- dice dove trovare il file bootstap.min.css, per trovare sempre gli URL-->

        <link rel="stylesheet" href="{{ url('/')}}/css/@yield('stile')">  <!-- Per applicare una formattazione css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> <!-- Pe usare le icone bootrstrap-->
        
 


        <!-- Javascript -->
        <script src="{{ url('/')}}/js/bootstrap.bundle.min.js"></script>  <!-- Per riuscire ad includere javascript-->
        <script src="{{ url('/')}}/js/toggle.js"></script>                <!-- Per riuscire a fare il toggle della password e dell'icona-->
        <script src="http://code.jquery.com/jquery.js"></script>

    </head>

    <body>

        <!-- PER CREARE UNA NAVBAR-->

      
        <nav class="navbar navbar-expand-lg bg-body-tertiary" >
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav col-lg-6">
                  @yield ('left-navbar')
                </ul>
              </div>

              <!-- NEl FRONT CONTROLLER: faccio un controllo sul login, per poi settare correttamente il booleano $logged-->

              
            
              @if($logged)
                <li class="nav-item dropdown dropdown-menu-right" style="list-style-type: none">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Welcome {{$loggedName}}<!--Menù dropdown-->
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="bi bi-gear" style="padding-right: 10px"></i> Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('user.adventures')}}"><i class="bi bi-globe-europe-africa" style="padding-right: 15px"></i>Your adventure</a></li>
                    <li><a class="dropdown-item" href="{{route('user.logout')}}"><i class="bi bi-power " style="padding-right: 15px"></i>Logout</a></li>
                  </ul>
                </li>
              @else
                <a class="btn login" href="{{route('user.login')}}"> Login </a>
          
              @endif

            </div>
          </nav>

          <div class="container">
              @yield('breadcrumb')
          </div>
            
            @yield('corpo')    

    </body>


    @yield('footer') 
  
  
   
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8/"> <!-- Per specificare il char set -->
        <title>Homepage</title>
        <meta name="viewport" content="width=device-width , initial-scale=1.0, user-scalable=no"> <!-- Per rendere responsive la pagina -->

        <!-- STYLESHEET -->
        <!-- bootstrap.min.css : non ha gli spazi per risparmare memoria != bootstrap.css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">  
        <link rel="stylesheet" href="css/style.css">  <!-- Per applicare una formattazione css -->

        <!-- Javascript -->
        <script src="js/bootstrap.bundle.min.js"></script>  <!-- Per riuscire ad includere javascript-->
        <script src="http://code.jquery.com/jquery.js"></script>
    </head>



    <body>

        <!-- PER CREARE UNA NAVBAR-->
        <nav class="navbar navbar-expand-lg bg-body-tertiary", style="background-color: #b1d6f1;">
            <div class="container-fluid" >
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active current" aria-current="page" href="#">Homepage</a>
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
            </ul>
            </div>
        </div>
        </nav>



      <!-- PER CREARE IL CAROSELLO DI IMMAGINI -->

        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
                <div class="carousel-item active">

                <!--presence of the .d-block and .w-100 on carousel images to prevent browser default image alignment.-->
                
                <!--  IMMAGE SFONDO CAROSELLO-->
                <img src="img/P1060039.JPG" class="d-block w-100" alt="Miramare">
                
                <!--  TITOLO SLIDE CAROSELLO-->
                <div class="centered">
                    <div class="carousel-text">
                    <h5 >Miramare</h5>
                    </div>
                </div>

                <!--  RIQUADRO CON LINK PER PAGINA-->
                <a class="carousel-link-text-a" href="Miramare.html">
                    <div class="carousel-link">
                    
                        <p>SEE MORE</p> 
        
                    </div>
                </a>

              </div>

                <!-- 3° elemento-->
                <div class="carousel-item">
                    <img src="img/photo_5825451189846784664_y.jpg" class="d-block w-100" alt="Desenzano">
                    <div class="centered">
                        <div class="carousel-text">
                        <h5 >Desenzano</h5>
                        </div>
                    </div>

                    <a class="carousel-link-text-a" href="Desenzano.html">
                        <div class="carousel-link ">
                        
                            <p>SEE MORE</p> 
            
                        </div>
                    </a>

                </div>

                <!-- 3° elemento-->
                <div class="carousel-item">
                    <img src="img/photo_5825451189846784605_y.jpg" class="d-block w-100" alt="Riga">

                    <div class="centered">
                        <div class="carousel-text">
                        <h5 >Riga</h5>
                        </div>
                    </div>

                
                    <a class="carousel-link-text-a" href="Riga.html">
                        <div class="carousel-link">
                        
                            <p>SEE MORE</p> 
            
                        </div>
                    </a>

                </div>
                <!-- 3° elemento-->
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

        <!-- FINE CAROSELLO -->


        <div class="container"> <!-- posizino un elemento nel container-->
          <header class="header-sezione">
              <h1>Our adventure collection</h1>
          </header>
       </div>

    

        <!-- BODY CON IL TESTO DELLA PAGINA-->

        <div class="container_page">
          <div class="row">
              <div class="col-12">  <!-- Quando uno un dispositivo piccolo, uso 9 colonne, quando è grande le uso tutte e 12-->
                <p>
                    Vestibulum non urna tincidunt, convallis purus a, vulputate sapien. Sed cursus eros massa, eget auctor purus vehicula sit amet.
                    Nam euismod dui molestie mauris bibendum venenatis. Aenean ipsum nibh, ornare et malesuada vitae, hendrerit sit amet ante.
                      Quisque id mattis purus. Nunc elementum consectetur euismod. Sed odio nibh, posuere in semper in, egestas ac dui.
                      Sed id ultricies risus, eget facilisis mauris. Nulla facilisi.
                    Vivamus venenatis ac nisi eu venenatis. Curabitur eget convallis ligula. 
                    Phasellus tortor sem, pretium at dolor eu, porta fermentum est. Aliquam consectetur massa fermentum, 
                    varius nulla in, porta mauris. Integer placerat nisl et lacus euismod, eu bibendum libero fringilla. 
                    Praesent commodo convallis molestie. Proin sit amet tincidunt tellus, vitae semper quam. 
                    Quisque bibendum diam diam, at consectetur velit ornare eget. Curabitur vel purus ut lectus pulvinar rhoncus. 
                    Sed non gravida nisi, at consequat quam. Integer ultricies vitae lorem condimentum fermentum

                </p>
              </div>
              <!--
              <div class="col-sm-3 col-md-6">  Uso le restanti 3 colonne per l'immagine 
                  <img class="img-thumbnail img-responsive" src="img/pretty-4-th.jpg">
              </div>
            -->
          </div>
      </div>


    </body>
   
</html>
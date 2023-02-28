<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" >
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/icofont.css">
    
<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script>
	$(document).ready(function() { 
	   $("#owl-wrapper").owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			// Navigation
			navigationText : ["Anterior","Siguiente"],
			rewindNav : true,
			scrollPerPage : true,
			//Pagination
			pagination : true,
			paginationNumbers: false
		});
	});
	</script>
-->
    <title>Valiticket</title>
  </head>
  <body>
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top " style="background-image:url(imgs/bk-menu.png);">
    <a class="navbar-brand" href="index.php">Valiticket</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Portada <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="evento.php">Eventos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="quienes.php">Quienes somos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Registro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="servicios.php">Servicios</a>
        </li>

      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Buscar" aria-label="Buscar">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
      </form>
    </div>
  </nav>
</header>


<main role="main">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class=""></li>
      <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner" >
      <div class="carousel-item active" style="height:650px;">
        <img src="imgs/slider1.webp" />

        <div class="container">
          <div class="carousel-caption text-left">
            <h1>Conferencia de Ingenieros</h1>
            <p>Nostrum molestie vel an. Te mel alia eros. Ut mel doming legimus</p>
            <p><a class="btn btn-lg btn-primary" href="https://getbootstrap.com/docs/4.6/examples/carousel/#">Inscribirse</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item " style="height:650px;">
         <img src="imgs/slider2.jpg" />

        <div class="container">
          <div class="carousel-caption">
            <h1>Súper Mega Evento</h1>
            <p>Lorem ipsum dolor sit amet, cu propriae expetendis definitionem nec</p>
            <p><a class="btn btn-lg btn-primary" href="https://getbootstrap.com/docs/4.6/examples/carousel/#">Inscribirse</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item" style="height:650px;">
        <img src="imgs/slider3.jpg" />

        <div class="container">
          <div class="carousel-caption text-right">
            <h1>Eu case semper accusam qui</h1>
            <p>Ei feugiat insolens contentiones qui, cu hinc nusquam noluisse mel. Ei eius porro mentitum his, solet dicant iuvaret et usu</p>
            <p><a class="btn btn-lg btn-primary" href="https://getbootstrap.com/docs/4.6/examples/carousel/#">Ver m&aacute;s</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#myCarousel" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#myCarousel" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Siguiente</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->

<div class="about-area ptb100 fix" id="about-event">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-left">
                            <div class="about-top">
                                <h1 class="section-title">Más datos del Evento</h1>
                                <div class="total-step">
                                    <div class="descp">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout. The point of using
                                            Lorem Ipsum is that it has a morless normal distribution of letters, as
                                            opposed</p>
                                    </div>
                                </div>
                            </div>
                            <h1 class="section-title">Detalles</h1>
                            <div class="total-step">
                                <div class="about-step">
                                    <h2 class="sub-title">1st Stape to gather</h2>
                                    <div class="descp">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page.</p>
                                    </div>
                                </div>
                                <div class="about-step">
                                    <h2 class="sub-title">2nd Stape to Create won way</h2>
                                    <div class="descp">
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-right">
                            <ul>
                                <li><i class="zmdi zmdi-calendar-note" style="color:#ff004d;"></i><span style="color:#ff004d;"><b>13 Septiembre 2022</b></span></li>
                                <li><i class="zmdi zmdi-accounts"></i>1500 Asientos</li>
                                <li><i class="zmdi zmdi-palette"></i>5 Plateas a elegir</li>
                                <li><i class="zmdi zmdi-mic-setting"></i>3 Oradores</li>
                                <li><i class="zmdi zmdi-pin"></i>Avda. Siempre Viva 1255</li>
                                <li><i class="zmdi zmdi-google-maps"></i>Buenos Aires</li>
                            </ul>
                            <div class="about-btn"> <a href="#" class="btn-def bnt-2">Comprar entradas</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div id="happen" class="what-happen-area ptb100 off-white fix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title">Pr&oacute;ximos Eventos</h1>
                        <div class="clearfix"></div>
                        <div class="tab-menu-list pt20 mb70 text-center">
                            <ul class="nav d-block happen-tab" role="tablist">
                                <li role="presentation"><a class="active" href="#day-one" aria-controls="day-one" role="tab" data-bs-toggle="tab">13, Feb 2021</a></li>
                                <li role="presentation"><a href="#day-two" aria-controls="day-two" role="tab" data-bs-toggle="tab">14, Feb 2021</a></li>
                                <li role="presentation"><a href="#day-three" aria-controls="day-three" role="tab" data-bs-toggle="tab">15, Feb 2021</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="day-one">
                                <div class="row">
                                    <div class="total-happen owl-carousel owl-theme" style="opacity: 1; display: block;">
                                        <!--single happen start-->
                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 3120px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);"><div class="owl-item" style="width: 390px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-badge"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>21.00hs</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Evento 1 </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 390px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-bullhorn"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>22:00hs</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Gran Evento 2 </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h2.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 390px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-check-circled"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>22.10hs</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Evento 3 </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h3.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 390px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-full-night"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>4.10 am to 8.00 pm</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div></div></div>
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="day-two">
                                <div class="row">
                                    <div class="total-happen owl-carousel owl-theme" style="opacity: 0; display: block;">
                                        <!--single happen start-->
                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 0px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);"><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-set"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>12.10 am to 04.00 pm</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h3.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-rise"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>7.10 am to 9.00 am</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-alt"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>9.10 am to 11.50 am</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h2.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-full-night"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>4.10 am to 8.00 pm</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div></div></div>
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="day-three">
                                <div class="row">
                                    <div class="total-happen owl-carousel owl-theme" style="opacity: 0; display: block;">
                                        <!--single happen start-->
                                        <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 0px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);"><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-alt"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>9.10 am to 11.50 am</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h2.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-set"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>12.10 am to 04.00 pm</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h3.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-sun-rise"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>7.10 am to 9.00 am</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div><div class="owl-item" style="width: 0px;"><div class="col-lg-12">
                                            <div class="single-happen">
                                                <div class="happen-top mb30">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-full-night"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3>4.10 am to 8.00 pm</h3>
                                                        <p>14 Feb 2021</p>
                                                    </div>
                                                </div>
                                                <div class="happen-bottom">
                                                    <h3 class="happen-heading uppercase">Get Together All designer </h3>
                                                    <div class="happen-details">
                                                        <div class="happen-img">
                                                            <img src="imgs/h1.webp" alt="">
                                                        </div>
                                                        <div class="happen-text">
                                                            <p class="uppercase"><strong>Lenao Lorem</strong></p>
                                                            <p>UX Designer</p>
                                                            <p class="uppercase">Vanue : Roof 1</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div></div></div></div>
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                        <!--single happen start-->
                                        
                                        <!--single happen end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<div id="speaker" class="speaker-area pt100 pb50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title pb30">Oradores</h1>
                    </div>
                    <div class="col-12">
                        <div class="total-speaker-2 row">
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="imgs/team01.webp" alt="">
                                    <h4 class="speaker-name uppercase"><strong>Patricia Morales</strong></h4>
                                    <p class="speaker-deg">Designer</p>
                                    <div class="social-icon">
                                        <ul>
                                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-behance"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single-speaker-->
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="imgs/team01.webp" alt="">
                                    <h4 class="speaker-name uppercase"><strong>Patricia Morales</strong></h4>
                                    <p class="speaker-deg">Designer</p>
                                    <div class="social-icon">
                                        <ul>
                                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-behance"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single-speaker-->
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="imgs/team02.webp" alt="">
                                    <h4 class="speaker-name uppercase"><strong>Patricia Morales</strong></h4>
                                    <p class="speaker-deg">UX Designer</p>
                                    <div class="social-icon">
                                        <ul>
                                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-behance"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single-speaker-->
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="imgs/team03.webp" alt="">
                                    <h4 class="speaker-name uppercase"><strong>Patricia Morales</strong></h4>
                                    <p class="speaker-deg">Devloper</p>
                                    <div class="social-icon">
                                        <ul>
                                            <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-behance"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                            <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single-speaker-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="upcomming-events-area off-white ptb100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title">Pr&oacute;ximos Eventos</h1>
                        <div class="total-upcomming-event">
                            <div class="single-upcomming shadow-box">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-01.webp" alt="">
                                        </div>
                                        <div class="sue-date-time text-center">
                                            <span>26 Mar <br> 2021</span>
                                            <span>09.10 pm</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                            <a href="#" class="btn-def bnt-2 small">Comprar Tickets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-upcomming shadow-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-02.webp" alt="">
                                        </div>
                                        <div class="sue-date-time text-center">
                                            <span>25 Mar <br> 2021</span>
                                            <span>09.10 pm</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                            <a href="#" class="btn-def bnt-2 small">Comprar Tickets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-upcomming shadow-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-03.webp" alt="">
                                        </div>
                                        <div class="sue-date-time text-center">
                                            <span>27 Mar <br> 2021</span>
                                            <span>08.10 pm</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                            <a href="#" class="btn-def bnt-2 small">Comprar Tickets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single-upcomming shadow-box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-04.webp" alt="">
                                        </div>
                                        <div class="sue-date-time text-center">
                                            <span>29 Mar <br> 2021</span>
                                            <span>06.10 pm</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                            <a href="#" class="btn-def bnt-2 small">Comprar Tickets</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a class="all-events uppercase text-center" href="#">M&aacute;s Eventos<i class="zmdi zmdi-spinner"></i></a>
                    </div>
                </div>
            </div>
        </div>


<!--<div class="call-to-action bg-overlay white-overlay pb100 pt85">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cal-to-wrap">
                            <h1 class="section-title">Enter Your Email Address For Events &amp; News</h1>
                            <form action="#">
                                <div class="input-box">
                                    <input type="email" placeholder="Enter your E-mail Address" class="info" name="email">
                                    <button class="send-btn"><i class="zmdi zmdi-mail-send"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
-->


<div id="contact" class="map-area mt100">
            <iframe class="contact-map-size" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1613802584124!5m2!1sen!2sbd" allowfullscreen="" loading="lazy">
            </iframe>
            <div class="map-content">
                <div class="content-body">
                    <form id="contact-form" action="mail.php">
                        <div class="input-box">
                            <input type="text" placeholder="Nombre" class="info" name="con_name">
                            <input type="email" placeholder="E-mail*" class="info" name="con_email">
                            <input type="text" placeholder="Profesi&oacute;n" class="info" name="con_subject">
                            <textarea class="area-text" placeholder="Mensaje" name="con_message"></textarea>
                        </div>
                        <p class="form-message"></p>
                        <div class="input-box upload-box">
                            <button type="submit" class="submit">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        
<div class="information-area off-white ptb100">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="single-information text-center">
                            <div class="info-icon">
                                <i class="zmdi zmdi-phone"></i>
                            </div>
                            <h4>Tel&eacute;fono</h4>
                            <p>+ (0192) 5184203</p>
                            <p>+ (0185) 0950555</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-information text-center">
                            <div class="info-icon">
                                <i class="zmdi zmdi-email-open"></i>
                            </div>
                            <h4>E-Mail</h4>
                            <p><a href="mailto:company@email.com">company@email.com</a></p>
                            <p><a href="mailto:we@company.info">we@company.info</a></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-information text-center">
                            <div class="info-icon">
                                <i class="zmdi zmdi-city-alt"></i>
                            </div>
                            <h4>1st Venue</h4>
                            <p>555 / 2A Sevent Streth</p>
                            <p>Rampura, Bansree.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        



<div id="timeline" class="timeline-area ptb100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="clearfix"></div>
                        <div class="tab-menu-list tml-02 mb50 text-center">
                            <ul class="nav d-block timeline-tab" role="tablist">
                                <li role="presentation"><a class="active" href="#day-02-one" aria-controls="day-02-one" role="tab" data-bs-toggle="tab" aria-selected="true">Day 01</a></li>
                                <li role="presentation"><a href="#day-02-two" aria-controls="day-02-two" role="tab" data-bs-toggle="tab">Day 02</a></li>
                                <li role="presentation"><a href="#day-02-three" aria-controls="day-02-three" role="tab" data-bs-toggle="tab" class="" aria-selected="false">Day 03</a></li>
                                <li role="presentation"><a href="#day-02-four" aria-controls="day-02-four" role="tab" data-bs-toggle="tab">Day 04</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="day-02-one">
                                <div class="total-timeline">
                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="imgs/timeline-01.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-rise"></i></li>
                                                        <li>9.00 am</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 02</p>
                                            <h4>Auditoriam 02</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="imgs/timeline-02.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-alt"></i></li>
                                                        <li>12.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="imgs/timeline-03.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-set"></i></li>
                                                        <li>3.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Momen Buhyan</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="day-02-two">
                                <div class="total-timeline">
                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-01.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-rise"></i></li>
                                                        <li>9.00 am</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-03.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-set"></i></li>
                                                        <li>3.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Momen Buhyan</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 02</p>
                                            <h4>Auditoriam 02</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-02.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-alt"></i></li>
                                                        <li>12.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="day-02-three">
                                <div class="total-timeline">

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 02</p>
                                            <h4>Auditoriam 02</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-02.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-alt"></i></li>
                                                        <li>12.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-01.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-rise"></i></li>
                                                        <li>9.00 am</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-03.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-set"></i></li>
                                                        <li>3.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Momen Buhyan</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="day-02-four">
                                <div class="total-timeline">
                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-01.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-rise"></i></li>
                                                        <li>9.00 am</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 02</p>
                                            <h4>Auditoriam 02</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-02.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-alt"></i></li>
                                                        <li>12.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of

                                                    letters</p>
                                                <h5>Speaker: Nusrat Fariya</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->

                                    <!--single timeline start-->
                                    <div class="single-timeline shadow-box">
                                        <div class="timeline-left">
                                            <p>Vanue 01</p>
                                            <h4>Auditoriam 01</h4>
                                        </div>
                                        <div class="timeline-right">
                                            <div class="timeline-img">
                                                <img src="img/event/timeline-03.webp" alt="">
                                            </div>
                                            <div class="timeline-content">
                                                <div class="timeline-top">
                                                    <ul>
                                                        <li><i class="icofont icofont-sun-set"></i></li>
                                                        <li>3.00 pm</li>
                                                        <li>13.feb.2021</li>
                                                    </ul>
                                                </div>
                                                <h4>Seat Booking &amp; Confirm Registration</h4>
                                                <p>It is a long established fact that reader distracted by the readable
                                                    content of a page when looking at its layout. The point of using
                                                    Lorem Ipsum is that it has a more-or-less normal distribution of
                                                    letters</p>
                                                <h5>Speaker: Momen Buhyan</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





<div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-area">
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-area">
                            <ul>
                                <li><a href=""><img src="imgs/pay-01.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-02.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-03.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-04.webp" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</main>
	
    <script src="js/main.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    

  </body>
</html>
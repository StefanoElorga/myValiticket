<? require 'init.php';
$sql="select * from eventos where aprobada=1 and portada=2 and fecha>='".date("Y-m-d")."' order by fecha";
//echo $sql;
$eventos=gtabla($sql);
?><!doctype html>
<html lang="en">
  <? require "head.php";
  $portada=1;
  ?>
	<link rel="stylesheet" href="dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="dist/assets/owl.carousel-2.min.css">
	<link rel="stylesheet" href="dist/assets/owl.theme.default.min.css">
	<script src="dist/owl.carousel.min.js"></script>

  <body>
<? require "cabecera.php";?>

<main role="main">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
	  <?
	  $gg=0;
	  foreach ($eventos as $evento) {
	  	$gg++;
		if ($gg==1) $activo="active"; else $activo="";
	  ?>
      <li data-target="#myCarousel" data-slide-to="0" class="<?=$activo;?>"></li>
	  <? } ?>
    </ol>
    <div class="carousel-inner" >
      
	  <?
	  $gg=0;
	  foreach ($eventos as $evento) {
	  	$gg++;
		if ($gg==1) $activo="active"; else $activo="";
	  ?>
	  <div class="carousel-item <?=$activo?>" style="height:auto;">
        <img src="multimedia/eventos/<?=$evento['imgmain']?>-recorte.jpg" style="width:100%;" />

        <div class="container">
          <div class="carousel-caption text-left">
            <h1><?=utf8($evento['titulo'])?></h1>
            <p><?=utf8($evento['descripcion'])?></p>
            <a class="my-button bt-wdx200 letter-color-change" href="evento.php?id=<?=$evento['id']?>">Comprar entradas</a>
          </div>
        </div>
      </div>
      <? } ?>
	  
      
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
<?
$sql="select * from eventos where aprobada=1 and portada=1 and fecha>='".date("Y-m-d")."' order by fecha";
//echo $sql;
$eventos=gtabla($sql);
?>
<div id="happen" class="what-happen-area ptb100 off-white fix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title" style=" font-family: 'Oswald', sans-serif;">Pr&oacute;ximos Eventos</h1>
                        <div class="clearfix"></div>
                        <!--<div class="tab-menu-list pt20 mb70 text-center">
                            <ul class="nav d-block happen-tab" role="tablist">
                                <li role="presentation"><a class="active" href="#day-one" aria-controls="day-one" role="tab" data-bs-toggle="tab">13, Feb 2021</a></li>
                                <li role="presentation"><a href="#day-two" aria-controls="day-two" role="tab" data-bs-toggle="tab">14, Feb 2021</a></li>
                                <li role="presentation"><a href="#day-three" aria-controls="day-three" role="tab" data-bs-toggle="tab">15, Feb 2021</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>-->
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="day-one">
                                <div class="row">
                                    <div class="total-happen owl-carousel owl-theme " style="opacity: 1; display: block; height:700px;">
                                        <!--single happen start-->
										<? foreach ($eventos as $evento) {?>
									
                                       <!-- cambio de estructura en las CARDS -->
                    
                                <div class="card-events">
                                    <div class="card-events-div-image">
                                        <img src="multimedia/eventos/<?=$evento['imgmain']?>-cuadrado.jpg" alt="" class="card-events-image">
                                    </div>

                                    <div class="card-events-overlay">
                                            <div class="happen-top" style="border-bottom:solid black 2px;">
                                                    <div class="happen-icon">
                                                        <i class="icofont icofont-bullhorn"></i>
                                                    </div>
                                                    <div class="happen-time-date">
                                                        <h3><?=$evento['hora']?>hs</h3>
                                                        <p><? $explota=explode("-",$evento['fecha']); echo $explota[2]." de ". mes($explota[1])." de ".$explota[0];?></p>
                                                    </div>
                                                </div>
                                     <a href="evento.php?id=<?=$evento['id']?>" class="btn-11"><?=utf8($evento['titulo'])?></a>
                                     <p class="card-event-description"><?=utf8($evento['descripcion'])?></p>
                                    </div>
                                 </div>
                                   
										<? } ?>
										

                                        
                                        <!--single happen end-->
										
										
                                    </div>
                                </div>
                            </div>
                            
                            
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
                        <h1 class="section-title">Pr&oacute;ximamente</h1>
                        <!--<div class="tab-menu-list tml-02 mb50 text-center">
                            <ul class="nav d-block timeline-tab" role="tablist">
                                <li role="presentation"><a class="active" href="#day-02-one" aria-controls="day-02-one" role="tab" data-bs-toggle="tab" aria-selected="true">Day 01</a></li>
                                <li role="presentation"><a href="#day-02-two" aria-controls="day-02-two" role="tab" data-bs-toggle="tab">Day 02</a></li>
                                <li role="presentation"><a href="#day-02-three" aria-controls="day-02-three" role="tab" data-bs-toggle="tab" class="" aria-selected="false">Day 03</a></li>
                                <li role="presentation"><a href="#day-02-four" aria-controls="day-02-four" role="tab" data-bs-toggle="tab">Day 04</a></li>
                            </ul>
                        </div>-->
                        <div class="clearfix"></div>
                        <!-- Tab panes -->
						<?
						$sql="select * from eventos where aprobada=1 and fecha>='".date("Y-m-d")."' order by fecha";
						$eventoss=gtabla($sql);
						?>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active show" id="day-02-one">
                                <div style="display:flex;flex-direction:column">
								<? if ($eventoss) {
									foreach ($eventoss as $evento) {
									?>
									<!--single timeline start-->
                                    <div class="prox-events">
                                        <div class="prox-events-direction-container">
                                            <p class="direction"><?=utf8($evento['direccion'])?></p>
                                            <h4 class="place" style=" width:100%; text-align:center "><?=utf8($evento['lugar'])?></h4>
                                        </div>

                                        <div class="timeline-right description-container">
                                            <div class="timeline-img" >
                                                <img src="multimedia/eventos/<?=$evento['imgmain']?>-cuadrado.jpg" alt="" class="prox-card-img">
                                            </div>

                                            <div class="timeline-content">
                                                <div class="C">
                                                    <ul class="desc-list">
                                                        <li><i class="icofont icofont-sun-rise"></i></li>
                                                        <li><?=$evento['hora']?></li>
                                                        <li><? $explota=explode("-",$evento['fecha']); echo $explota[2]." de ". mes($explota[1])." de ".$explota[0];?></li>
                                                    </ul>
                                                </div>

                                                <h4><a href="evento.php?id=<?=$evento['id']?>" class="prox-event-title"><?=utf8($evento['titulo'])?></a></h4>
                                                <p class="prox-event-description"><?=utf8($evento['descripcion'])?> </p>
                                            
                                                <h5><? //=utf8($evento['detalles'])?></h5>

                                            </div>
                                        </div>
                                    </div>
                                    <!--single timeline end-->
									<? } } ?>
                                </div>
                            </div>
                            
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>





<!-- <div class="footer-area" style="<?php echo $_SESSION['skin']=="dark" ? "background-color:#050c40" :  "background-color:#3b0082"?>">
            <div class="container"  >
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-area">
                            <ul>
                                <li><a href="#" class="icon-container"><i class="zmdi zmdi-"></i></a></li>
                                <li><a href="#" class="icon-container"><i class="zmdi zmdi-google"></i></a></li>
                                <li><a href="#" class="icon-container"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#" class="icon-container"><i class="zmdi zmdi-vimeo"></i></a></li>
                                <li><a href="#" class="icon-container"><i class="zmdi zmdi-pinterest"></i></a></li>
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
        </div> -->


        <footer class="footer">
        <ul class="my-webs">
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-instagram ig"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-google gl"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-twitter tw"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-vimeo vm"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-pinterest ps"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Portada</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Nosotros</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Servicios</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Equipo</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contacto</a></li>
        </ul>
        <p>&copy;2023 Gonzalo Martos | All Rights Reserved</p>
  </footer>



</main>
	
<!--    <script src="js/main.js"></script>-->
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<!--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
   <script>
   $(document).ready(function(){

$('.owl-carousel').owlCarousel({

    loop:true,

    margin:10,

    responsiveClass:true,

    responsive:{

        0:{

            items:1,

            nav:true

        },

        600:{

            items:2,

            nav:true

        },

        1000:{

            items:3,

            nav:true,

            loop:true

        }

    }

})



});


   </script> 

    <!-- SCRIPTS Y ESTILOS -->
    
    

     <script>
    $(window).on("scroll", function() {
      $(".card-events").each(function() {
        if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.8) {
          $(this).addClass("visible");
        }
      });
    });
  </script>

<script>
    $(window).on("scroll", function() {
      $(".prox-events").each(function() {
        if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.8) {
          $(this).addClass("visible");
        }
      });
    });
  </script> 






    
    <style>
@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');






/* ESTILOS PARA EL TITULO DE EVENTOS comienzo */
.btn-11 {
  position: relative;
  width: 270px;
  color:<?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?>;
  display:inline-block;
  background:none;
  margin:30px;
  text-align:center;
  font-size:20px;
  border: solid <?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?> 3px;
  font-family: 'Oswald', sans-serif;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
  text-transform:uppercase
}

.btn-11:hover{
  box-shadow: none;
  transition:1s;
  color:<?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?>;
}
/* ESTILOS PARA EL TITULO DE EVENTOS fin */


/* CARTAS PRINCIPALES */

/* el container de la carta completa */
.card-events {
  width: 90%;
  height:500px;
  margin: 0px 0 20px 0px;
  border-radius:20px;
  opacity: 0;
  transition: 1s;
  transform: translateY(50%);
  position: relative;
  overflow: hidden;
  background-color: <?php echo $_SESSION['skin']=="dark" ? "#17161a" :  "#eae6f0" ?>;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
}

/* la imagen de background */
.card-events-div-image {
  height: 100%;
  width: 100%;
  transition: filter 0.3s ease;
  background-position: center;
  background-size: cover;
}

/* este es el componente <img/> ocupamos el 100% */
.card-events-image{
  height: 100%;
  width:100%;
}


.card-events:hover{
  transition:1s;
  box-shadow:none;
}

.card-events:hover .card-events-div-image {
  filter: grayscale(0);
}

/* estilos para el top de la carta */
.card-events-overlay {
  width: 100%;
  height: 100%;
  bottom: -100%;
  transition: bottom 1s ease;
  position: absolute;
  background-color:  <?php echo $_SESSION['skin']=="dark" ? "rgba(0, 0, 0, 0.7)" :  "rgba(255, 255, 255, 0.9)" ?>;
}

.card-events:hover .card-events-overlay {
  bottom: 0;
}


.card-event-description{
  font-size: 19px;
  font-family: 'Oswald', sans-serif;
  padding: 0px 20px 0px 20px;
}

/* estilo especial para dar efecto de aparición */
.card-events.visible {
  opacity: 1;
  transform: translateY(0);
}


/* CARTAS DE "PROXIMOS EVENTOS" comienzo */
.prox-events{
  height:200px;
  margin-bottom:40px;
  border-radius:20px;
  opacity: 0;
  transform: translateX(50%);
  transition: 1s;
  display:flex;
  flex-direction:row;
  background-color: <?php echo $_SESSION['skin']=="dark" ? "#17161a" :  "#eae6f0" ?>;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
}

.prox-event-title{
font-family: 'Oswald', sans-serif;

}
.prox-event-title:hover{
color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>;
}

.prox-event-description{
  font-family: 'Oswald', sans-serif;
  font-size:17px;
  max-height: 50px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: pre-wrap;
}

/* estilo especial para efecto de aparición */
.prox-events.visible {
  opacity: 1;
  transform: translateY(0);
}

.prox-events:hover{
  transition:1s;    
    box-shadow:none;
}


.prox-events-direction-container{
  width:25%;
  height:100%;
  border-radius: 20px 0px 0px 20px;
  display:flex; 
  flex-direction:column; 
  align-items:center; 
  justify-content:center;
  background-color:<?php echo $_SESSION['skin']=="dark" ? "#17161a;" :  "#eae6f0 ;"?>; 
}

.direction{
  width:100%; 
  text-align:center;
  font-family: 'Oswald', sans-serif;
}

.place{
  width:100%; 
  text-align:center;
  font-family: 'Oswald', sans-serif;
}


.timeline-img{
  width:30%;
  height: 100%;
}

.prox-card-img{
  width:100%;
  height:100%;
}



.description-container{
  width:80%; 
}
/* CARTAS DE "PROXIMOS EVENTOS" fin */

/* width para el botón que aparece en el carrusel automatico. */
.bt-wdx200{
  width:200px
}



/* EMPIEZA LOS ESTILOS DEL FOOTER */
.footer {
            position: relative;
            width: 100%;
            background-color:<?php echo $_SESSION['skin']=="dark" ? "#050c40" :  "#3b0082"?>;
            min-height: 100px;
            padding: 20px 50px;
             display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .my-webs{
            display:flex;
            flex-direction:row;
        }


        .icon-container{
            display: inline-block;
            position: relative;
            padding:0;
            margin:10px
        }

        .icon-container i {
            transition: transform 0.5s ease-in-out;
            font-size:25px;
            color:#fff;

        }




        .ig:hover {
            color:#d75457;
            animation-duration: 1s;
            animation-name: jumpAndSpin;
 
        }

        @keyframes jumpAndSpin {
            0% {
                transform: translateY(0) rotate(0deg) ;
            }
  

            50% {
                transform: translateY(-3px) rotate(360deg) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100% {
                transform: translateY(0) rotate(360deg) ;
            }
        }



        .gl:hover {
            color:#fbbb00;
            animation-duration: 1s;
            animation-name: jump;
        }

        @keyframes jump {
            0% {
                transform: translateY(0) ;
            }
  
            25% {
                transform: translateY(-10px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            75% {
                transform: translateY(-5px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100%{
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
        }


        .tw:hover  {
            color:#1d9bf0;
            animation-duration: 1s;
            animation-name: leftAndRight;
        }

        @keyframes leftAndRight {
            0% {
                transform: translateX(0);
            }
  
            25%{
                transform: translateX(-5px);
            }
            50% {
                transform: translateX(5px);
            }

            100% {
                transform: translateX(0) ;

            }
        }


        .vm:hover  {
            transform:  rotate(360deg);
            color:#41b1db
        }

        .ps:hover  {
            color:#e60023;
            animation-duration: 0.8s;
            animation-name: circleMove;
        }

        @keyframes circleMove {
            0% {
                transform: translateX(0);
            }
  
            20%{
                transform: translateX(5px);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateX(-5px);
            }

            80%{
                transform: translateY(5px);
            }

            100%{
                transform: translate(0,0);
             }
        }

        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .menu__item {
            list-style: none;
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }

        .menu__link:hover {
            color:#daff06;
            transform:translateY(-5px)
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }
        /*  ESTILOS DEL FOOTER fin*/


/* RESPONSIVE */
@media (max-width:767px){
.card-events{
  opacity: 1;
  transform: none;
}

.card-events.visible {
  opacity: 1;
  transform: none;
}

.prox-events{
  height:500px;
  margin-bottom:60px;
  opacity: 1;
  flex-direction:column;
  transform: none;
}

.prox-events-direction-container{
  width:100%;
  height:30%;
  border-radius: 20px 20px 0px 0px;
  flex-direction:row; 
  justify-content:center;
}
.description-container{
  width:100%;
  border-radius:0px 0px 20px 20px;
    
}

.prox-card-img{
  width:100%;
  height:100%;
  border-radius:0px;
  box-shadow: none;
}

.timeline-img{
  width:100%;
  height:60%;
  display:flex
}

.timeline-content{
  width:100%;
  margin-left:0px
}

.card-events {
  margin: 0px 0px 20px 20px;
}
}
    </style>

  </body>
</html>

<!-- TEMA CLARO: #5700e0 #fff  y sus variedades (rgba)-->
<!-- TEMA OSUCRO: #050c40 #000 #daff06 y sus variedades (rgba)-->
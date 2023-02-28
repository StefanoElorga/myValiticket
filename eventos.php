<? require 'init.php';
$sql="select * from eventos where aprobada=1 and fecha>='".date("Y-m-d")."' order by fecha";
$eventoss=gtabla($sql);
?><!doctype html>
<html lang="en">
  <? require "head.php";
  	$eventos=1;
	?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Cronograma de Eventos</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->





<div id="timeline" class="timeline-area ptb100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="clearfix"></div>
                        <!--<div class="tab-menu-list tml-02 mb50 text-center">
                            <ul class="nav d-block timeline-tab" role="tablist">
                                <li role="presentation"><a class="active" href="#day-02-one" aria-controls="day-02-one" role="tab" data-bs-toggle="tab" aria-selected="true">Day 01</a></li>
                                <li role="presentation"><a href="#day-02-two" aria-controls="day-02-two" role="tab" data-bs-toggle="tab">Day 02</a></li>
                                <li role="presentation"><a href="#day-02-three" aria-controls="day-02-three" role="tab" data-bs-toggle="tab" class="" aria-selected="false">Day 03</a></li>
                                <li role="presentation"><a href="#day-02-four" aria-controls="day-02-four" role="tab" data-bs-toggle="tab">Day 04</a></li>
                            </ul>
                        </div>-->
                        <h1 class="section-title">Pr&oacute;ximos Eventos</h1>
                       
                        <!-- Tab panes -->
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

<div class="upcomming-events-area off-white ptb100">
            <div class="container" >
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title">M&aacute;s Eventos</h1>
                        <div class="total-upcomming-event">


                            <div class="more-events-card" >
                                

                                    <div class="date-img-container" >
                                        <div class="sue-pic">
                                            <img src="imgs/sue-01.webp" alt="">
                                        </div>
                                        <div class="more-events-date" >
                                            <span>26 Mar <br> 2021</span>
                                            <span>09.10 pm</span>
                                        </div>
                                    </div>


                                    <div class="more-event-name">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#"  class="more-event-type">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                            <a href="#" class="my-button letter-color-change">Comprar Tickets</a>
                                        </div>
                                    </div>
                               
                            </div>

                            <div class="more-events-card" >
                              
                                    <div class="date-img-container">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-02.webp" alt="">
                                        </div>
                                        <div class="more-events-date" >
                                            <span>25 Mar <br> 2021</span>
                                            <span>09.10 pm</span>
                                        </div>
                                    </div>

                                    
                                    <div class="more-event-name">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#" class="more-event-type">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                        <a href="#" class="my-button letter-color-change">Comprar Tickets</a>
                                        </div>
                                    </div>
                              
                            </div>


                            <div class="more-events-card" >
                                
                                    <div class="date-img-container">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-03.webp" alt="">
                                        </div>
                                        <div class="more-events-date" >
                                            <span>27 Mar <br> 2021</span>
                                            <span>08.10 pm</span>
                                        </div>
                                    </div>


                                     <div class="more-event-name">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#" class="more-event-type">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                        <a href="#" class="my-button letter-color-change">Comprar Tickets</a>
                                        </div>
                                    </div>
                                
                            </div>


                            <div class="more-events-card" >
                                
                                <div class="date-img-container">
                                        <div class="sue-pic">
                                            <img src="imgs/sue-04.webp" alt="">
                                        </div>
                                        <div class="more-events-date" >
                                            <span>29 Mar <br> 2021</span>
                                            <span>06.10 pm</span>
                                        </div>
                                    </div>

                                    <div class="more-event-name">
                                        <div class="uc-event-title">
                                            <div class="uc-icon"><i class="zmdi zmdi-globe-alt"></i></div>
                                            <a href="#" class="more-event-type">Update Design &amp; Ux Support</a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-3">
                                        <div class="venu-no">
                                            <p>Vanue : Hall No 2</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-4">
                                        <div class="upcomming-ticket text-center">
                                        <a href="#" class="my-button letter-color-change">Comprar Tickets</a>
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

<script>
    $(window).on("scroll", function() {
      $(".prox-events").each(function() {
        if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.8) {
          $(this).addClass("visible");
        }
      });
    });
  </script>

<script>
    $(window).on("scroll", function() {
      $(".more-events-card").each(function() {
        if ($(this).offset().top <= $(window).scrollTop() + $(window).height() * 0.8) {
          $(this).addClass("visible");
        }
      });
    });
  </script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');

/* CARTAS DE "MÁS EVENTOS" */

.more-events-card{
  height:200px;
  margin-bottom:40px;
  border-radius:20px;
  transition: 1s;
  display:flex;
  flex-direction:row;
  background-color:<?php echo $_SESSION['skin']=="dark" ? "#17161a;" :  "#eae6f0 ;"?>;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
  opacity: 0;
  transform: translateX(50%);
}


.more-events-card.visible {
  opacity: 1;
  transform: translateY(0);
}

.more-events-card:hover{
  transition:1s;    
    box-shadow:none;
}

.date-img-container{
    width:25%;
  height:100%;
  border-radius: 20px 0px 0px 20px;
  display:flex; 
  flex-direction:row; 
  align-items:center; 
  justify-content:center;
  background-color:<?php echo $_SESSION['skin']=="dark" ? "#17161a;" :  "#eae6f0 ;"?>; 
}


.more-events-date{
    margin-right: 20px;
    padding: 0;
    width: 150px;
    border-radius: 100%;
    height: 120px;
    background-color:<?php echo $_SESSION['skin']=="dark" ? "#302f36;" :  "#cbc8cf;"?>;
    display: flex;
    text-align: center;
    align-items: center;
    flex-direction: column;
    justify-content: center;

}

.more-event-type:hover{
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?> !important;
}


.more-event-name{
    display:flex;
    flex-direction:row;
    justify-content:center; 
    margin-left:10px
}


/* CARTAS DE "PROXIMOS EVENTOS" */
.prox-events{
  height:200px;
  margin-bottom:40px;
  border-radius:20px;
  opacity: 0;
  transform: translateX(50%);
  transition: 1s;
  display:flex;
  flex-direction:row;
  background-color:<?php echo $_SESSION['skin']=="dark" ? "#17161a;" :  "#eae6f0 ;"?>;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
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

.prox-events.visible {
  opacity: 1;
  transform: translateY(0);
}

.prox-events:hover{
  transition:1s;    
    box-shadow:none;
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



/* EMPIEZA EL FOOTER */

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
</style>
	
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
<? require 'init.php';
$id=substr($_GET['id'],0,10);

$sql="select * from eventos where id=".$id;
$evento=gfila($sql);

//print_r($evento);



?><!doctype html>
<html lang="en">
  <?
  $eventos=1;
  require "head.php";
  ?>
  <body>
<? require "cabecera.php";?>


<main role="main">
<!-- 
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner" >
      <div class="carousel-item active" style="height:auto;">
        <img src="multimedia/eventos/<?=$evento['imgmain'];?>" style="width:100%;" />

        <div class="container">
          <div class="carousel-caption text-left">
            <h1><?=utf8($evento['titulo']);?></h1> -->
            <!--<p>Nostrum molestie vel an. Te mel alia eros. Ut mel doming legimus</p>-->
<!--            <p><a class="btn btn-lg btn-primary" href="#detalles">Comprar Tickets</a></p>-->
          <!-- </div>
        </div>
      </div>
     
    </div>
  </div> -->


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->



<div class="about-area ptb100 fix container-principal" id="about-event">
            
                    <div class="col-md-6 container-event">
                        <div class="about-left">
                            <div class="about-top" >
                                <h1 class="section-title text-title">Más datos del Evento</h1>
                               
                                    <div class="descp">
                                        <p class="text-description"><?=utf8($evento['descripcion']);?></p>
                                    </div>
                                
                            </div>
							<a name="detalles"></a>
                            <h1 class="section-title text-title">Detalles</h1>
                            
								<div class="about-step">
                                    <img src="multimedia/eventos/<?=$evento['imgsec'];?>" style="width:100%; padding:5%;" />
								</div>
                                <?
								$sql="select * from evento_plateas where idevento=".$evento['id']." and aprobada=1";
                                $plateas=gtabla($sql);
								if ($plateass) {
									echo "<h3>Plateas disponibles</h3>";
									$cp=0;
								foreach ($plateas as $platea) {
									$cp+=$platea['cantidad'];
								?>
                                <div class="about-step">
                                    <h2 class="sub-title"><?=utf8($platea['nombre'])?></h2>
                                    <div class="descp">
                                        <p class="text-description"><?=$platea['cantidad']?> Asientos / $ <?=number_format($platea['precio'],0,".","")?> c/u</p>
                                    </div>
                                </div>
                                <? } } ?>
                                <div class="about-step">
                                    <div class="descp">
                                        <p class="text-description"><?=utf8($evento['detalles'])?></p>
                                    </div>
                                </div>
                      
                    </div>

                    <div class="col-md-6">
                        <div class="about-right sub-container">
                            <ul>
                                <li class="icon-title"><i class="zmdi zmdi-calendar-note icon-style date-color"></i><span class="date-color"><b><? $explota=explode("-",$evento['fecha']); echo $explota[2]." de ". mes($explota[1])." de ".$explota[0];?></b></span></li>
                                <li class="icon-title"><i class="zmdi zmdi-accounts icon-style"></i><?=$cp;?> Asientos</li>
                                <li class="icon-title"><i class="zmdi zmdi-palette icon-style"></i><?=count($plateas)?> Plateas a elegir</li>
                                <li class="icon-title"><i class="zmdi zmdi-mic-setting icon-style"></i>3 Oradores</li>
                                <li class="icon-title"><i class="zmdi zmdi-pin icon-style"></i><?=utf8($evento['direccion'])?></li>
                                <li class="icon-title"><i class="zmdi zmdi-google-maps icon-style"></i><?=utf8($evento['lugar'])?></li>
								
                            </ul>
<!--						<div class="about-btn"> <a href="#" class="btn-def bnt-2">Comprar entradas</a> </div>-->
                        </div><br>
                            <div class="about-right sub-container">
								<ul>
                                	<?
									if ($plateas) {
										echo "<h3 class='text-title'>Plateas disponibles</h3>";
									foreach ($plateas as $platea) {
										if (isset($_SESSION['carrito'][$platea['id']]) and is_numeric($_SESSION['carrito'][$platea['id']])) {
											$canty=$_SESSION['carrito'][$platea['id']];
											} else {
											$canty=0;
											}

									?>
									<li class="icon-title"><i class="zmdi zmdi-label icon-style"></i><?=utf8($platea['nombre'])?> $ <?=number_format($platea['precio'],0,".","")?></li> 
									<div>
									<? if ($evento['fechafinventa']>=date("Y-m-d")) {
											if ($evento['horafinventa']>=date("H:i:s")) {
									?>
									<div class="wrapper"><!--<a href="#" class="btn-def bnt-2" onClick="return false;">Comprar entradas</a>--> 
                                    <input type="button" value="-" onClick="agregar('<?=$platea['id']?>', '-1')" class="buttons-minus-plus minus" style="padding:0px 10px !important;" /> 
                                    <input type="text" value="<?=$canty;?>" name="eplatea<?=$platea['id']?>" id="eplatea<?=$platea['id']?>" readonly class="input-tickets" maxlength="2" /> 
                                    <input type="button" value="+" onClick="agregar('<?=$platea['id']?>', '1')" class="buttons-minus-plus plus" style="padding:0px 10px !important;"/><br><br><? //  entrada.php?id=<?=$platea['id'];?>
									</div>
                                        
                                   
									<? } } ?>
									</div>
									<? } 
									?>
									<div style="padding-left:0px;" id="ir<?=$platea['id']?>">
                                    <? if ($evento['fechafinventa']>=date("Y-m-d")) {
											if ($evento['horafinventa']>=date("H:i:s")) {
									?><a href="cart.php" class="my-button">Ir al carrito</a><? } } ?>
									</div>
									<? } ?>
								</ul>
							</div>
                </div>
            </div>
        </div>

        <!-- HASTA ACÁ -->


<script>
function agregar(idplatea, cantidad) {
	var nc="eplatea"+idplatea;
	var tv=document.getElementById(nc).value;
	//alert (tv);
	if (cantidad==1) {
		tv++;
		} else {
		if (tv>0) {
			tv--;
			}
		}
	$("#"+nc).val(tv);
	//alert(tv);
	$.ajax({
	type: "POST",
	url: "agregar.php",
	data: 'hidplatea='+idplatea+"&quanty="+tv,
	success: function(datos){
		//$('#stotal').html(datos);
		}
	});

	}
</script>

<?
$sql="select * from evento_oradores where idevento=".$evento['id'];
$oradores=gtabla($sql);
//print_r($oradores);
if ($oradores) {
?>
<div id="speaker" class="speaker-area pt50 pb50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title pb30 text-title">Oradores</h1>
                    </div>
                    <div class="col-12">
                        <div class="total-speaker-2 row">
                        	<? foreach ($oradores as $orador) {?>
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="multimedia/eventos/<?=$orador['imagen']?>" alt="">
                                    <h4 class="speaker-name uppercase"><strong><?=utf8($orador['nombre'])?></strong></h4>
                                    <p class="speaker-deg text-description"><?=utf8($orador['profesion'])?></p>
                                    <div class="social-icon">
                                        <ul>
                                            <? if ($orador['facebook']!='') {?><li><a href="<?=$orador['facebook'];?>"><i class="zmdi zmdi-facebook"></i></a></li><? } ?>
                                            <? if ($orador['instagram']!='') {?><li><a href="<?=$orador['instagram'];?>"><i class="zmdi zmdi-instagram"></i></a></li><? } ?>
                                            <? if ($orador['pinterest']!='') {?><li><a href="<?=$orador['pinterest'];?>"><i class="zmdi zmdi-pinterest"></i></a></li><? } ?>
                                            <? if ($orador['google']!='') {?><li><a href="<?=$orador['google'];?>"><i class="zmdi zmdi-google"></i></a></li><? } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--single-speaker-->
                            <? } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<? } ?>

<!-- <div class="upcomming-events-area off-white ptb100" style="display:none;">
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
    




    <style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');

    /* toda la pagina */
    .container-principal{
        display:flex; 
        justify-content:center
    }

    /* el container del evento entero */
    .container-event{
        background-color:<?php echo $_SESSION['skin']=="dark" ? "#17161a;" :  "#eae6f0 ;"?>;
        display:flex;
        flex-direction:row; 
        border:solid 3px black;
        padding:25px;
        box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
    }
    

    /* los sub containers que tiene el evento (le he colocado border:none porque boostrap vino con un border.)*/
    .sub-container{
        box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
        border:none;
    }

/* estilo para los titulos "más datos del evento" y "detalles" y "plateas disponibles" */
.text-title{
    font-family: 'Oswald', sans-serif;
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>;
    
}

/* estilo para la descripción de "más datos del evento" y "detalles" */
.text-description{
    font-family: 'Oswald', sans-serif;
    font-size:17px;
}

/* estilo para el titulo de cada ICONO */
.icon-title{
    font-family: 'Oswald', sans-serif;
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>
}

/* estilo para los iconos */
.icon-style{
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>
}

/* estilo para el texto que marca la fecha del EVENTO */
.date-color{
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>
}

/* estilos suma y resta de entradas comienzo */
.wrapper{
    height:50px;
    width:170px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:none;
    border-radius:12px;
    box-shadow:0 5px 10px rgba(0,0,0,0.2);
    margin-bottom:10px;
    border:solid 3px <?php echo $_SESSION['skin']=="dark" ? "#fff" :  "#000" ?>

}

.buttons-minus-plus{
    width:50px;
    text-align:center;
    font-size:55px;
    font-weight:600;
    height: 50px;
    border:none;
    background:transparent;
    display:flex;
    color: <?php echo $_SESSION['skin']=="dark" ? "#fff" :  "#000" ?>
}

.minus:hover{
  transform:translateY(-5px);
    color:red  
}

.plus:hover{
    transform:translateY(-5px);
    color:#daff06
}

.input-tickets{
 font-size:25px;
 border-right:2px solid rgba(0,0,0,0.2);
 border-left:2px solid rgba(0,0,0,0.2);
 border-top:none;
 border-bottom:none;
 width:50px;
 text-align:center;
 font-weight:600;
 background:transparent;
 color:<?php echo $_SESSION['skin']=="dark" ? "#fff" :  "#000" ?>
}




@keyframes plusAndMinusEffect {
    0% {
    opacity: 0;
    transform: translate(-50%, -100%);
  }
  50% {
    opacity: 1;
    transform: translate(-50%, 0);
  }

  100%{
    opacity: 0;
  }

}

/* estilos suma y resta de entradas final */


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

  </body>
</html>
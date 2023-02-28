<? require 'init.php';
$idplatea=substr($_GET['id'],0,10);

$sql="select * from evento_plateas where id=".$idplatea." and aprobada=1";
$xplatea=gfila($sql);

$sql="select * from eventos where id=".$xplatea['idevento'];
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

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
    </ol>
    <div class="carousel-inner" >
      <div class="carousel-item active" style="height:auto;">
        <img src="multimedia/eventos/<?=$evento['imgmain'];?>-recorte.jpg" style="width:100%; " />

        <div class="container" style="">
          <div class="carousel-caption text-left">
            <h1><?=utf8($evento['titulo']);?></h1>
            <!--<p>Nostrum molestie vel an. Te mel alia eros. Ut mel doming legimus</p>-->
            <!--<p><a class="btn btn-lg btn-primary" href="#detalles">Comprar Tickets</a></p>-->
          </div>
        </div>
      </div>
     
    </div>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->

<div class="about-area ptb100 fix" id="about-event">
            <div class="container">
                <div class="row">
                    <?
                    $tlimit=$evento['fecha'].$evento['hora'];
					$ahora=date("Y-m-dH:i");
					//echo $ahora;
					if ($ahora<=$tlimit) {?>
                    <div class="col-md-12 mb90">
                    <center>
                    <h3>Comprar: <?=$xplatea['nombre']?></h3><br>
					<form action="addcart.php" method="post">
                    <div style="width:350px;">
                    	<div style="">
                        <?
						if (isset($_SESSION['carrito'][$xplatea['id']]) and is_numeric($_SESSION['carrito'][$xplatea['id']])) {
	                        $canty=$_SESSION['carrito'][$xplatea['id']];
							} else {
							$canty=1;
							}
						?>
                        <input type="number" value="<?=$canty;?>" name="quanty" id="quanty" min="1" max="15" style="font-size:20px;" />&nbsp;<input type="submit" value="Agregar al carrito" onClick="agregar();" id="agregar" name="agregar" class="btn-submit"/>
                        <input type="hidden" name="hidplatea" value="<?=$xplatea['id']?>" />
                        </div>
                    </div>
                    </form>
                    </center>
                    </div>
                    <? } ?>
                    <div class="col-md-6">
                        <div class="about-left">
                            <div class="about-top">
                                <h1 class="section-title">Más datos del Evento</h1>
                                <div class="total-step">
                                    <div class="descp">
                                        <p><?=utf8($evento['descripcion']);?></p>
                                    </div>
                                </div>
                            </div>
							<a name="detalles"></a>
                            <h1 class="section-title">Detalles</h1>
                            <div class="total-step">
								<div class="about-step">
                                    <img src="multimedia/eventos/<?=$evento['imgsec'];?>" style="width:100%; padding:10%;" />
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
                                        <p><?=$platea['cantidad']?> Asientos / $ <?=number_format($platea['precio'],0,".","")?> c/u</p>
                                    </div>
                                </div>
                                <? } } ?>
                                <div class="about-step">
                                    <div class="descp">
                                        <p><?=utf8($evento['detalles'])?></p>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="about-right">
                            <ul>
                                <li><i class="zmdi zmdi-calendar-note" style="color:#ff004d;"></i><span style="color:#ff004d;"><b><? $explota=explode("-",$evento['fecha']); echo $explota[2]." de ". mes($explota[1])." de ".$explota[0];?></b></span></li>
                                <li><i class="zmdi zmdi-accounts"></i><?=$cp;?> Asientos</li>
                                <li><i class="zmdi zmdi-palette"></i><?=count($plateas)?> Plateas a elegir</li>
                                <li><i class="zmdi zmdi-mic-setting"></i>3 Oradores</li>
                                <li><i class="zmdi zmdi-pin"></i><?=utf8($evento['direccion'])?></li>
                                <li><i class="zmdi zmdi-google-maps"></i><?=utf8($evento['lugar'])?></li>
								
                            </ul>
<!--						<div class="about-btn"> <a href="#" class="btn-def bnt-2">Comprar entradas</a> </div>-->
                        </div><br>
                            <div class="about-right">
								<ul>
                                	<?
									if ($plateas and count($plateas)>1) {
										echo "<h3>Otras Plateas disponibles</h3>";
									foreach ($plateas as $row) {
										if ($xplatea['id']!=$row['id']) {
									?>
									<li><i class="zmdi zmdi-label"></i><?=utf8($row['nombre'])?> $ <?=number_format($row['precio'],0,".","")?></li> <a href="entrada.php?id=<?=$row['id'];?>" class="btn-def bnt-2">Comprar entradas</a><br><br>
                                    <? } } }?>
								</ul>
							</div>
                    </div>
                </div>
            </div>
        </div>


<?
$sql="select * from evento_oradores where idevento=".$evento['id'];
//$oradores=gtabla($sql);
//print_r($oradores);
if ($oradores) {
?>
<div id="speaker" class="speaker-area pt50 pb50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="section-title pb30">Oradores</h1>
                    </div>
                    <div class="col-12">
                        <div class="total-speaker-2 row">
                        	<? foreach ($oradores as $orador) {?>
                            <!--single-speaker-->
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="single-speaker shadow-box text-center">
                                    <img src="multimedia/eventos/<?=$orador['imagen']?>" alt="">
                                    <h4 class="speaker-name uppercase"><strong><?=utf8($orador['nombre'])?></strong></h4>
                                    <p class="speaker-deg"><?=utf8($orador['profesion'])?></p>
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

<div class="upcomming-events-area off-white ptb100" style="display:none;">
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
	
    <!--<script src="js/main.js"></script>-->
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
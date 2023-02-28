<? require 'init.php';?><!doctype html>
<html lang="en">
  <? require "head.php";
  $miperfil=1;
  ?>
  <body>
<? require "cabecera.php";?>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style-jui.css">
<!--  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script>

  </script>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
					<?
					$idevento=$_GET['id'];
					$sql="select * from eventos where id=".$idevento;
					$evento=gfila($sql);
					?>
                    <li class="active">Tickets Vendidos</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->


<div class="off-white ptb100">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            <h1 class="section-title">Tickets Vendidos según Plateas de <b><?=utf8($evento['titulo']);?></b></h1>
            <?
			$sql="select * from evento_plateas where idevento=".$idevento;
			$plateas=gtabla($sql);
			?>
			<div>
			<? foreach ($plateas as $platea) {
			echo "<br><h2 style='color:#ff004d;'>".utf8($platea['nombre'])."</h2>";
			$sql="select * from entradas where idp=".$platea['id']." and vendida=1";
			$vendidas=gtabla($sql);
			if ($vendidas) {
			?>
			<table class="table table-striped">
				<tr>
					<td>Nombre
					</td>
					<td>D&iacute;a venta
					</td>
					<td>Hora venta
					</td>
				</tr>
				<?
				$sep=";";
				$nfile="multimedia/listado-".$platea['id'].".csv";
				$handle = fopen($nfile, "w");
				$valor="Nombre".$sep."Fecha Venta".$sep."Hora venta\r\n";
				//salvar
				fwrite($handle, $valor);
				foreach ($vendidas as $vendida) {
				?>
				<tr>
					<td><?
					$sql="select * from personas where id=".$vendida['idpersona'];
					$perss=gfila($sql);
					echo utf8($perss['nombre']);
					?>
					</td>
					<td><? $arrhora=explode(" ", $vendida['fechaven']); echo tfecha($arrhora[0]);?>
					</td>
					<td><?=$arrhora[1];?>
					</td>
				</tr>
				<?
				$valor=($perss['nombre']).$sep.tfecha($arrhora[0]).$sep.$arrhora[1]."\r\n";
				//salvar
				fwrite($handle, $valor);
				}
				//close file
				fclose($handle);
				?>
			</table>
			<center><a href="<? echo $nfile;//descargar-listado.php?id?>" class="btn btn-primary">Descargar listado</a></center><br><br>
			<? } else {
				echo "Sin vendas a&uacute;n.<br><br><br>";
				}
			} ?>
			</div>
            </div>

		</div>
        <center><a href="mi-perfil.php" class="btn btn-warning">Volver</a></center>
    </div>
</div>




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
	
    <script src="js/main.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    

  </body>
</html>
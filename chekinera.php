<? require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	}
//echo $_SESSION['usuario'];
$sql="select * from validadores where email='".$_SESSION['usuario']."'";
$validador=gfila($sql);
//print_r($validador);
if ($_SESSION['usuario']!=$validador['email']) {
	header("location: mi-perfil.php");
	}

$hoy=date("Y-m-d");
$destripar="https://".$_SERVER['HTTP_HOST']."/check/";

?><!doctype html>
<html lang="en">
  <? require "head.php";
  $registro=1;
  ?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Chekinera</li>
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
			<?
			if ($msj) {
            ?>
            <center><div class="alert <?=$alert?>" role="alert"><?=$msj;?></div></center>
            <? } ?>
            <h1 class="section-title">Verificar QR</h1>

              <div class="form-group">
                <label for="exampleInputEmail1">Lectura del QR</label>
                <input type="text" name="QR" class="form-control" id="QR" aria-describedby="QR" required value="" autocomplete="off" />
              </div>
              <div id="result">
			  ...
			  </div>
                <div class="upcomming-ticket text-center">
                    <input type="button" class="btn-submit" value="Verificar" name="enviar" onClick="verificar_QR();" />
                </div>

            </div>
        </div>
    </div>
</div>
<script>
function verificar_QR() {
	var text=document.getElementById("QR");
	//alert(text.value);
	var valor=text.value;
	$.ajax({
	type: "GET",
	url: "verificar_QR.php",
	data: 'valor='+valor,
	success: function(datos){
		$('#result').html(datos);
		}
	});

	}

function ejecutar_QR() {
	var text=document.getElementById("QR");
	//alert(text.value);
	var valor=text.value;
	$.ajax({
	type: "GET",
	url: "ejecutar-QR.php",
	data: 'id='+valor,
	success: function(datos){
		$('#result').html(datos);
		}
	});
	
	}
</script>



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
    
    

  </body>
</html>
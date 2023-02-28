<? require 'init.php';

$hash=$_GET['hash'];
if (1==1) {//strlen($hash)==32
	$link=conectar();
	$hash=mysqli_real_escape_string($link, $hash);
	//$txtpass=mysql_real_escape_string($_POST['txtp']);
	$sql="select * from personas where hash='".$hash."' and rp=1";
	//echo $sql; exit();
	$user=gfila($sql);
	//print_r($user);
	$continuar=true;
	if (!$user) {
		//exit();
		//usuario no encontrado
		$msj="Petici&oacute;n no existe";
		$tipo="alert alert-danger";
		$continuar=false;
		}	
	}
	if ($_POST and $user) {//
		//include("../phpmailer-gmail/class.phpmailer.php");
		//include("../phpmailer-gmail/class.smtp.php");
		$error=false;
		if ($_POST['txtp1']!=$_POST['txtp2']) {
			$error=true;
			$tipo="alert alert-danger";
			$msj="La contrase&ntilde;a debe ser la misma en ambas cajas de texto.";
			} else {
			if ($_POST['txtp1']=="" or strlen($_POST['txtp1'])<6 ) {
				$error=true;
				$tipo="alert alert-danger";
				$msj="La contrase&ntilde;a no puede ser vac&iacute;a o tener menos de 6 letras.";
				}

			}
		if (!$error) {
			$sql="update personas set pass='".md5($_POST['txtp1'])."', rp=0 where id=".$user['id'];
			$exito=gexecute($sql);
			$tipo="alert alert-success";
			$msj="Su Contrase&ntilde;a ha sido cambiada. Ingrese con su nueva contrase&ntilde;a.";
			$continuar=false;
			}
		}
?><!doctype html>
<html lang="en">
  <? require "head.php";
  $login=1;
  ?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Recuperar mi contrase&ntilde;a</li>
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
                <center><div class="alert <?=$tipo?>" role="alert"><?=$msj;?></div></center>
                <? } ?>
			<? 
			//$continuar=1;
			if ($continuar) {
			?>
            <h1 class="section-title">Ingrese los siguientes campos</h1>
            <form action="<?=$PHP_SELF;?>?hash=<?=$_GET['hash'];?>" method="post">
              <div class="form-group">
                <label for="exampleInputEmail1">Ingrese su nueva contrase&ntilde;a</label>
                <input type="password" name="txtp1" class="form-control" id="exampleInputEmail1"  />
              </div>
              <div class="form-group">
                <label for="exampleInputp2">Repita su nueva contrase&ntilde;a</label>
                <input type="password" name="txtp2" class="form-control" id="exampleInputp2"  />
              </div>
			<a href="login.php">Iniciar sesi&oacute;n</a>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Recuperar" name="enviar" />
                </div>
            </form>
			<? } ?>
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
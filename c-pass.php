<? require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	}

if ($_POST['enviar']) {

	$pass=substr($_POST['tpass'],0,10);
	$pass2=substr($_POST['tpass2'],0,10);
	
	//validar
	$valido=true;
	$sql="select * from personas where id='".$_SESSION['idu']."'";
	//echo $sql; exit();
	$user=gfila($sql);
	if (md5($_POST['apass'])!=$user['pass']) $valido=false;
	if ($pass=='') $valido=false;
	if ($pass!=$pass2) $valido=false; 
	if (strlen($pass)<4) $valido=false;
	if ($valido) {
			$sql="update personas set pass='".md5($pass)."' where id='".$_SESSION['idu']."'";
			//echo $sql; exit();
			$cc=gexecute($sql);
			}
	if ($cc>=1) {
		$ok=1;
		//irphp("usuarios.php?ok=2");
		$msj="La contrase&ntilde;a se cambi&oacute; correctamente!";
		$error=false; $alert="alert-success";
		}
		else {
		$msj="Hubo un error al cambiar la contrase&ntilde;a!<br />Verifique los campos! O las contrase&ntilde;as no coinciden o la contrase&ntilde;a es menor a 6 letras";
		$error=true; $alert="alert-warning";
		}
	}
	else {
	$_POST['tnombre']=substr($_GET['id'],0,15);
	$error=true;
	}

?><!doctype html>
<html lang="en">
  <? require "head.php";
  $miperfil=1;
  ?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Cambiar mi contrase&ntilde;a</li>
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
            <? if ($error) {?>
			<h1 class="section-title">Rellene los siguientes campos</h1>
            <form action="<?=$PHP_SELF;?>" method="post" name="form">
              <div class="form-group">
                <label for="exampleInputEmail1">Ingrese su actual Contrase&ntilde;a</label>
                <input type="password" name="apass" class="form-control" id="apass" aria-describedby="apass" required value="">
              </div>
              <div class="form-group">
                <label for="tpass">Su nueva Contrase&ntilde;a:</label>
                <input type="password" name="tpass" class="form-control" id="tpass" aria-describedby="tpass" required value="">
              </div>
              <div class="form-group">
                <label for="tpass2">Repetir nueva contrase&ntilde;a:</label>
                <input type="password" name="tpass2" class="form-control" id="tpass2" aria-describedby="tpass2" required value="" />
              </div>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Guardar" name="enviar" />&nbsp;<a class="btn btn-light" href="mi-perfil.php">Cancelar</a>
                </div>

            </form>
			<? } else {
			?>
			<center><a class="btn btn-success" href="mi-perfil.php">Volver</a></center>
			<?
			}
			?>
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
<? require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	}



$hoy=date("Y-m-d");
if ($_POST['enviar']) {
	$error=false;
	$enviarc=true;

	//validar usuario, existe?
	$sql="select * from personas where email='".$_POST['email']."' and id<>".$_SESSION['idu'];
	$haymail=gfila($sql);
	if ($haymail) {
		//echo "hay mail"; exit();
		$error=true;
		$tipoerror="email";
		}
/*	if ($_POST['pass']!=$_POST['pass2']) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="pass";
		}*/

	if ($_POST['email']!=$_POST['email2']) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="email2";
		}

	/*if ($_POST['organizador']) {
		$chkorg=1;
		} else {
		$chkorg=0;
		}*/
/*	$sql="select * from personas where telefono='".$_POST['movil']."'";
	$haymovil=gfila($sql);
	if ($haymovil) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="movil";
		}*/
						
						
						
						
						
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	
	//Create an instance; passing `true` enables exceptions
	if (!$error) {
		$hash=md5(date("Y-m-d H:i:s").rand(0,99999));
		$rand=rand(1000,9999);
		$sql="update personas set nombre='".utf8d($_POST['tname'])."', telefono='".$_POST['movil']."', email='".$_POST['email']."' where id=".$_SESSION['idu']."";
		//echo $sql; //exit();
		$modi=gexecute($sql);
		$msj= 'Se ha actualizado correctamente';
		$alert="alert-success";

		} else {
		//echo "error";
		if ($tipoerror=="email") {
			$msj= 'El email especificado ya existe en nuestra base de datos!';
			$alert="alert-danger";
			}
		if ($tipoerror=="email2") {
			$msj= 'El email especificado deben coincidir en ambas cajas de texto';
			$alert="alert-danger";
			}
		/*if ($tipoerror=="pass") {
			$msj= 'La contrase&ntilde;a debe ser la misma en ambas cajas de texto!';
			$alert="alert-danger";
			}*/
		/*if ($error) {
			$msj= 'Error';
			$alert="alert-danger";
			}*/
		//$msj= 'Hubo un error';
		//$alert="alert-success";

		}
	} else {
	//echo "no post";
	$sql="select * from personas where id=".$_SESSION['idu'];
	$user=gfila($sql);
	$_POST['tname']=utf8($user['nombre']);
	$_POST['movil']=$user['telefono'];
	$_POST['email']=$user['email'];
	$_POST['email2']=$user['email'];
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
                    <li class="active">Editar mis datos</li>
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
            <h1 class="section-title">Rellene los siguientes campos</h1>
            <form action="<?=$PHP_SELF;?>" method="post" name="form">
              <div class="form-group">
                <label for="exampleInputEmail1">Apellido y Nombre</label>
                <input type="text" name="tname" class="form-control" id="nya" aria-describedby="nya" required value="<?=$_POST['tname']?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?=$_POST['email']?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Repita Email</label>
                <input type="email" name="email2" class="form-control" id="exampleInputEmail12" aria-describedby="emailHelp" required value="<?=$_POST['email2']?>" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Celular</label>
                <input type="number" name="movil" class="form-control" id="celular" aria-describedby="celular" required value="<?=$_POST['movil']?>">
              </div>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Guardar" name="enviar" />&nbsp;<a class="btn btn-light" href="mi-perfil.php">Cancelar</a>
                </div>

            </form>
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
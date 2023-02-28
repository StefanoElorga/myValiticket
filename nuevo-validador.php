<? require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	}



$hoy=date("Y-m-d");
if ($_POST['enviar']) {
	$error=false;
	$enviarc=true;

	//validar usuario, existe?
	$sql="select * from personas where email='".$_POST['email']."'";
	$haymail=gfila($sql);
	if (!$haymail) {
		//echo "hay mail"; exit();
		$error=true;
		$tipoerror="email";
		}

	if (!$error) {
		$sql="insert into validadores (email, idp, idvali) values ('".$_POST['email']."', ".$_SESSION['idu'].", ".$haymail['id'].")";
		//echo $sql; exit();
		$modi=gexecute($sql);
		$msj= 'Se ha insertado correctamente';
		$alert="alert-success";

		} else {
		//echo "error";
		if ($tipoerror=="email") {
			$msj= 'El email especificado no existe en nuestra base de datos!';
			$alert="alert-danger";
			}
		}
	} else {
	//echo "no post";
	$sql="select * from personas where id=".$_SESSION['idu'];
	//$user=gfila($sql);
	/*$_POST['tname']=utf8($user['nombre']);
	$_POST['movil']=$user['telefono'];
	$_POST['email']=$user['email'];
	$_POST['email2']=$user['email'];*/
	}
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
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?=$_POST['email']?>">
              </div>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Guardar" name="enviar" />&nbsp;<a class="btn btn-light" href="mi-perfil.php">Cancelar</a>
                </div>

            </form>
            <br><br><br>
            <a name="validadores"></a>
            Usuarios asociados a las validaciones de Entradas
            <?
			$sql="select validadores.id, validadores.email, personas.nombre from validadores join personas where validadores.idp=".$_SESSION['idu']." and personas.email=validadores.email"; //"select * from validadores where idp=".$_SESSION['idu'];
			//echo $sql;
            $valideitors=gtabla($sql);
			if ($valideitors) {
			?>
            <table class="table table-striped">
            	<tr>
                	<td>Nombre</td>
                	<td>Email</td>
                    <td>Eliminar</td>
                </tr>
            	<?
                foreach ($valideitors as $row) {
				?>
                <tr>
                	<td><?=utf8($row['nombre'])?></td>
                	<td><?=$row['email']?></td>
                    <td><a href="borrar-validador.php?id=<?=$row['id']?>">Borrar</a></td>
                </tr>
                <? } ?>
            </table>
            <? } else {?>
            Usuarios no se encuentran
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
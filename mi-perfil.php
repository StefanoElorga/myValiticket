<? require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	} else {
	$sql="select * from personas where id=".$_SESSION['idu'];
	$user=gfila($sql);
	//print_r($user);
	
	}


$hoy=date("Y-m-d");
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
                    <li class="active">Mi perfil</li>
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
        	<div class="col-md-6 col-sm-12">
			<?
			if ($msj) {
            ?>
            <center><div class="alert <?=$alert?>" role="alert"><?=$msj;?></div></center>
            <? } ?>
            <h1 class="section-title">Rellene los siguientes campos</h1>
            <form action="registro.php" method="post" name="form">
              <div class="form-group">
                <label for="exampleInputEmail1">Apellido y Nombre</label>
                <input type="text" name="tname" class="form-control" id="nya" aria-describedby="nya" value="<?=utf8($user['nombre'])?>" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="<?=$user['email']?>" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Celular</label>
                <input type="number" name="movil" class="form-control" id="celular" aria-describedby="celular"  value="<?=$user['telefono']?>" readonly>
              </div>

            </form>
            </div>
            
        <div class="col-md-6 col-sm-12" style="text-align:right;">
				<!--links-->
                <h1 class="section-title">Opciones</h1>
                <div class="espacio"><a href="editar-mis-datos.php" class="btn btn-primary">Cambiar mis datos</a></div>
                <div class="espacio"><a href="c-pass.php" class="btn btn-primary">Cambiar contrase&ntilde;a</a></div>
                <div class="espacio"><a href="mis-tickets.php" class="btn btn-primary">Mis Tickets</a></div>
                <? if ($user['organizador']==1) {?>
                <div class="espacio"><a href="nuevo-evento.php" class="btn btn-primary">Nuevo Evento</a></div>
                <div class="espacio"><a href="nuevo-validador.php" class="btn btn-primary">Validadores</a></div>
                <div class="espacio"><a class="btn btn-primary" onClick="desplegar();">Modificar Evento o agregar Plateas</a></div>
                <div id="desplegar" style="display:none;">
                	<?
                    $sql="select * from eventos where 1 and aprobada=1 and fecha>='".date("Y-m-d")."'";
					//echo $sql;
					$eventos=gtabla($sql);
					if ($eventos) {
						?>
                        <!--Mis Eventos en curso<br>-->
                        <?
						foreach($eventos as $event) { 
						?><h5><a href="editar-evento.php?ide=<?=$event['id'];?>"><?=utf8($event['titulo']);?></a>&nbsp;<a href="tickets-evento.php?id=<?=$event['id']?>" title="Tickets"><i class="zmdi zmdi-bookmark"></i></a></h5><? } } ?>
                </div>
				<?
				
				if (1==1) {?>
				<div class="espacio"><a class="btn btn-warning" href="chekinera.php">Chekinera</a></div><? } ?>
                <? } ?>
                <div class="espacio" style="display:none;">
                	Ud. es Controlador en los siguientes Eventos:<br>
					<div><b><a href="">jsdfjslkd</a></b></div>
					<div><b><a href="">jsdfjslkd</a></b></div>
					<div><b><a href="">jsdfjslkd</a></b></div>
                </div>
				<br><br><div class="espacio"><a href="logout.php" class="btn btn-danger">Cerrar Sesi&oacute;n</a></div>
                
            </div>
        </div>
    </div>
</div>
<style>
.espacio {
	margin:10px 0px;
	/*display:block;*/
	clear:left;
	}
</style>
<script>
function desplegar() {
	$("#desplegar").toggle();
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
<? require 'init.php';
if (!isset($_SESSION['idu']) or !is_numeric($_GET['ide'])) {
	header("location: login.php");
	}

$hoy=date("Y-m-d");
if ($_POST['enviar']) {
	//controlar campos
	conectar(); $error=false;
	$titulo=mysql_real_escape_string(utf8d($_POST['tname']));
	$descripcion=mysql_real_escape_string(utf8d($_POST['description']));
	$fecha=str_replace("/", "-",$_POST['fecha']);
	$fecha=tfecha($fecha);
	$afecha=explode("-",$fecha);
	
	$day=$afecha[2]; $mes=$afecha[1]; $ano=$afecha[0];
	if (checkdate($mes, $day, $ano)) {
		//ok
		} else {
		$error=true; $errorfecha=1;
		//echo "mala fecha"; echo $dia; exit();
		}
	$hora=$_POST['hora'];
	$ahora=explode(":", $hora);
	if ($ahora[0]<24 and $ahora[0]>=0 and $ahora[1]>=0 and $ahora[1]<60) {
		//ok
		//echo "ok";
		} else {
		$error=true; $errorhora=1;
		}
	$lugar=mysql_real_escape_string(utf8d($_POST['lugar']));
	$direccion=mysql_real_escape_string(utf8d($_POST['direccion']));
	//subir imagen main
	$img_temp=$_FILES['file1']['name'];
	if ($img_temp!='') {
		$exten=extension($img_temp); //echo $exten; exit();
		if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
			$directorio = "multimedia/eventos/";
			$aleatorio = rand(100000,999999);
			$imgmain = date("Y-m-d")."-". $aleatorio . "." . $exten;
			$_POST['imgmain']=$imgmain;
			$arch = $directorio . $imgmain;
			move_uploaded_file($_FILES['file1']['tmp_name'], $arch);
			}
			else {
			$error=true; $errorfile=1;
			}
		} else {
		//mismo archivo
		$imgmain=$_POST['himgmain'];
		$_POST['imgmain']=$imgmain;
		}

	//subir imagen secondary
	$img_temp=$_FILES['file2']['name'];
	if ($img_temp!='') {
		$exten=extension($img_temp);
		if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
			$directorio = "multimedia/eventos/";
			$aleatorio = rand(100000,999999);
			$imgsec = date("Y-m-d")."-". $aleatorio . "." . $exten;
			$_POST['imgsec']=$imgsec;
			$arch = $directorio . $imgsec;
			move_uploaded_file($_FILES['file2']['tmp_name'], $arch);
			}
			else {
			$error=true; $errorfile=1;
			}
		} else {
		//mismo archivo
		$imgsec=$_POST['himgsec'];
		$_POST['imgsec']=$imgsec;
		}

	


	//insertar bbdd
	$sql="update eventos  set titulo='".$titulo."', descripcion='".$descripcion."', fecha='".$fecha."', hora='".$hora."', lugar='".$lugar."', direccion='".$direccion."', imgmain='".$imgmain."', imgsec='".$imgsec."' where id=".$_POST['hide'];
	//echo $sql;
	$k=gexecute($sql);
	//echo $k; exit();
	if ($k>=0) {
		//borrar plateas existentes y luego guardar las nuevas o actualizadas
		$sql="delete from evento_plateas where idevento=".$_POST['hide'];
		gexecute($sql);
		for ($x=1; $x<=$_POST['cplateas']; $x++) {
			$nplatea=mysql_real_escape_string(utf8d($_POST['platea'.$x]));
			$cantip=mysql_real_escape_string($_POST['seats'.$x]);
			$precio=mysql_real_escape_string($_POST['precio'.$x]);
			$sql="insert into evento_plateas (nombre, cantidad, precio, idevento) values ('".$nplatea."', ".$cantip.", ".$precio.", ".$_POST['hide'].")";
			//echo $sql."<br>";
			ginsert($sql);
			}
		} else {
		//algo pasó q no se pudo insertar el evento
		}
	
	
	} else {
	//traer datos del evento
	$ide=substr($_GET['ide'],0,9);
	$sql="select * from eventos where id=".$ide." and idprop=".$_SESSION['idu'];
	//echo $sql;
	$evento=gfila($sql);
	//print_r($evento);
	$_POST['tname']=utf8_encode($evento['titulo']);
	$_POST['description']=utf8_encode($evento['descripcion']);
	$_POST['fecha']=tfecha($evento['fecha']);
	$_POST['hora']=$evento['hora'];
	$_POST['lugar']=utf8_encode($evento['lugar']);
	$_POST['direccion']=utf8_encode($evento['direccion']);
	$_POST['hide']=$ide;
	$_POST['imgmain']=$evento['imgmain']; $_POST['himgmain']=$evento['imgmain'];
	$_POST['imgsec']=$evento['imgsec']; $_POST['himgsec']=$evento['imgsec'];
	$sql="select * from evento_plateas where idevento=".$ide;
	$plateas=gtabla($sql);
	$_POST['cplateas']=count($plateas);
	$x=0;
	foreach ($plateas as $platea) {
		$x++;
		$_POST['seats'.$x]=$platea['cantidad'];
		$_POST['platea'.$x]=utf8_encode($platea['nombre']);
		$_POST['precio'.$x]=$platea['precio'];
		}	
	
	
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
                    <li class="active">Nuevo Evento</li>
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
            <form action="<?=$PHP_SELF;?>" method="post" name="form" enctype="multipart/form-data">
              <div class="form-group">
                <label for="exampleInputEmail1">T&iacute;tulo</label>
                <input type="text" name="tname" class="form-control" id="nya" aria-describedby="nya" required value="<?=$_POST['tname']?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Descripci&oacute;n</label>
                <textarea name="description" class="form-control" id="descripcion" aria-describedby="descripcion" required="required"><?=$_POST['description']?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Fecha del Evento</label>
                <input type="text" name="fecha" class="form-control" id="fechaevento" aria-describedby="fechaevento" required value="<?=$_POST['fecha']?>" placeholder="__/__/_____" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Hora del Evento</label>
                <input type="text" name="hora" class="form-control" id="horaevento" aria-describedby="horaevento" required value="<?=$_POST['hora']?>" placeholder="__:__" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Lugar</label>
                <input type="text" name="lugar" class="form-control" id="lugar" aria-describedby="lugar" required value="<?=$_POST['lugar']?>" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Direcci&oacute;n</label>
                <input type="text" name="direccion" class="form-control" id="direccion" required value="<?=$_POST['direccion']?>" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Imagen principal</label><br>
					<img src="multimedia/eventos/<?=$_POST['imgmain']?>" width="150" /><br><input type="hidden" name="himgmain" value="<?=$_POST['himgmain']?>" />
					Cambiar:
                <input type="file" name="file1" class="form-control-file" id="file1" style="border:0 none; font-size:12px; height:60px;" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Imagen de plateas</label><br>
					<img src="multimedia/eventos/<?=$_POST['imgsec']?>" width="150" /><br><input type="hidden" name="himgsec" value="<?=$_POST['himgsec']?>" />
					Cambiar:
                <input type="file" name="file2" class="form-control-file" id="file2" style="border:0 none; font-size:12px; height:60px" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"><b>Plateas</b></label>
				<table id="tablaplateas">
				<?
				for ($x=1; $x<=$_POST['cplateas']; $x++) {
				?>
					<tr id="tr1">
						<td width="25%">Nombre: <input type="text" name="platea<?=$x;?>" class="form-control" id="platea<?=$x;?>" required placeholder="Nombre de Platea" value="<?=$_POST['platea'.$x]?>" /></td>
						<td width="30%">Cant. Asientos: <input type="number" name="seats<?=$x;?>" class="form-control" id="seats<?=$x;?>" required placeholder="Cantidad de Asientos o Locaciones" value="<?=$_POST['seats'.$x]?>" /></td>
						<td width="25%">Precio $: <input type="number" name="precio<?=$x;?>" class="form-control" id="precio<?=$x;?>" required placeholder="Costo" value="<?=$_POST['precio'.$x]?>" /></td>
					</tr>
					<? } ?>
				</table>
                <input type="button" value="Agregar platea" onClick="agregar_platea();"/>&nbsp;<input type="button" value="Quitar platea" onClick="quitar_platea();"/>
              </div>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Guardar" name="enviar" /> (Podr&aacute; editar despu&eacute;s)<br>
					<input type="hidden" value="<?=$_POST['cplateas']?>" name="cplateas" id="cplateas" />
					<input type="hidden" name="hide" value="<?=$_POST['hide'];?>" />
					
                </div>

            </form>
            </div>
        </div>
    </div>
</div>
<script>
var platea=<?=$_POST['cplateas']?>;
function agregar_platea() {
	platea++;
	//alert(platea);
	var elemento=$("<tr id=\"tr"+platea+"\"><td width=\"25%\">Nombre: <input type=\"text\" name=\"platea"+platea+"\" class=\"form-control\" id=\"platea"+platea+"\" required placeholder=\"Nombre de Platea\" /></td><td width=\"30%\">Cant. Asientos: <input type=\"number\" name=\"seats"+platea+"\" class=\"form-control\" id=\"seats"+platea+"\" required placeholder=\"Cantidad de Asientos o Locaciones\" /></td><td width=\"25%\">Precio $: <input type=\"number\" name=\"precio"+platea+"\" class=\"form-control\" id=\"precio"+platea+"\" required placeholder=\"Costo\" /></td></tr>");
	//var elemento=$("<input type=\"text\" class=\"form-control\" name=\"sel"+platea+"\" placeholder=\"Ingrese una opci&oacute;n selectable\" value=\"\" /><br>");
	$("#tablaplateas").append(elemento);
	var cplateas=document.getElementById('cplateas');
	//alert (cplateas);
	cplateas.value=platea;
	}
function quitar_platea() {
	document.getElementById("tablaplateas").deleteRow(platea-1);
	platea--;
	var cplateas=document.getElementById('cplateas');
	//alert (cplateas);
	cplateas.value=platea;
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
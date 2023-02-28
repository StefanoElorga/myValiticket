<? require 'init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	} else {
	$sql="select * from personas where id=".$_SESSION['idu']." and organizador=1";
	$user=gfila($sql);
	if ($user) {
		} else {
		header("location: index.php");
		}
	}

$hoy=date("Y-m-d");
if ($_POST['enviar']) {
	//controlar campos
	$link=conectar(); $error=false;
	$titulo=mysqli_real_escape_string($link, utf8d($_POST['tname']));
	$descripcion=mysqli_real_escape_string($link, utf8d($_POST['description']));
	$detalles=mysqli_real_escape_string($link, utf8d($_POST['detalles']));
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
	$lugar=mysqli_real_escape_string($link, utf8d($_POST['lugar']));
	$direccion=mysqli_real_escape_string($link, utf8d($_POST['direccion']));
	//subir imagen main
	$img_temp=$_FILES['file1']['name'];
	$exten=extension($img_temp); //echo $exten; exit();
	if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
		$directorio = "multimedia/eventos/";
		$aleatorio = rand(100000,999999);
		$imgmain = date("Y-m-d")."-". $aleatorio . "." . $exten;
		$arch = $directorio . $imgmain;
		move_uploaded_file($_FILES['file1']['tmp_name'], $arch);
		}
		else {
		$error=true; $errorfile=1;
		}

	//subir imagen secondary
	$img_temp=$_FILES['file2']['name'];
	$exten=extension($img_temp);
	if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
		$directorio = "multimedia/eventos/";
		$aleatorio = rand(100000,999999);
		$imgsec = date("Y-m-d")."-". $aleatorio . "." . $exten;
		$arch = $directorio . $imgsec;
		move_uploaded_file($_FILES['file2']['tmp_name'], $arch);
		}
		else {
		$error=true; $errorfile=1;
		}

	


	//insertar bbdd
	$sql="insert into eventos (titulo, descripcion, detalles, fecha, hora, lugar, direccion, imgmain, imgsec, aprobada, idprop, fechafinventa, horafinventa) values (
	'".$titulo."',
	'".$descripcion."',
	'".$detalles."',
	'".$fecha."',
	'".$hora."',
	'".$lugar."',
	'".$direccion."',
	'".$imgmain."',
	'".$imgsec."',
	0,
	".$_SESSION['idu'].",
	'".$fecha."',
	'".$hora."')";//$_SESSION['idu']
	//echo $sql;
	$k=ginsert($sql);
	//echo $k; exit();
	if ($k>0) {
		for ($x=1; $x<=$_POST['cplateas']; $x++) {
			$nplatea=mysqli_real_escape_string($link, utf8d($_POST['platea'.$x]));
			$cantip=mysqli_real_escape_string($link, $_POST['seats'.$x]);
			$precio=mysqli_real_escape_string($link, $_POST['precio'.$x]);
			$sql="insert into evento_plateas (nombre, cantidad, precio, idevento) values ('".$nplatea."', ".$cantip.", ".$precio.", ".$k.")";
			//echo $sql."<br>";
			ginsert($sql);
			}
		$msj="Evento creado exitosamente";
		$alert="alert-success";
		//aqui mandar mail de nuevo evento
		
		try {
		
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'www.ideasbinarias.net';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'envios@ideasbinarias.net';                     //SMTP username
			$mail->Password   = 'Azul2001%%';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;//465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('envios@ideasbinarias.net', 'Nuevo evento en Valiticket!');
			$para="lic.diego.arce@gmail.com";
			$mail->addAddress($para);     //Add a recipient
			//$mail->addAddress("lic.diego.arce@gmail.com");     //Add a recipient
			//$mail->addAddress('ellen@example.com');               //Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');
		
			//Content
			//armar link de aprobacion
			$linkaprobacion="https://ideasbinarias.net/valiticket/aprobar-evento.php?id=".$k."&hash=".md5($k);
			
			$cuerpo ="<p>Nombre evento: ".$titulo.": "."</p>";
			$cuerpo.="<p>Fecha del evento: ".$fecha."</p>";
			$cuerpo.="<p>Hora del evento: ".$hora."</p>";
			$cuerpo.="<p>Lugar: ".$lugar."</p>";
			$cuerpo.="<p>Aprobar evento: <a href='".$linkaprobacion."'>Clic para aprobar</a></p>";
		
			$asunto="Nuevo evento por aprobar en Valiticket";
			$mail->isHTML(true);//Set email format to HTML
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
			$enviado=$mail->send();
			} catch (Exception $e) {
			$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$alert="alert-danger";
			}
			
		unset ($_POST);
		} else {
		//algo pasó q no se pudo insertar el evento
		$msj="Hubo un problema y no se pudo crear el evento!";
		$alert="alert-danger";
		}
	
	
	} else {
	$_POST['cplateas']=1;
	
	}
?><!doctype html>
<html lang="en">
  <? require "head.php";
  $registro=1;
  ?>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#fechaevento" ).datepicker();
  } );
  </script>
  
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
                <label for="exampleInputEmail1">Detalles</label>
                <textarea name="detalles" class="form-control" id="detalles" aria-describedby="detalles" required="required"><?=$_POST['detalles']?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Fecha del Evento</label>
                <input type="text" name="fecha" class="form-control" id="fechaevento" aria-describedby="fechaevento" required value="<?=$_POST['fecha']?>" placeholder="__/__/_____" autocomplete="off" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Hora del Evento</label>
                <input type="text" name="hora" class="form-control" id="horaevento" aria-describedby="horaevento" required value="<?=$_POST['hora']?>" placeholder="__:__" autocomplete="off" />
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
                <label for="exampleInputPassword1">Imagen principal</label>
                <input type="file" name="file1" class="form-control-file" id="file1" required style="border:0 none; font-size:12px; height:60px;" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Imagen de plateas</label>
                <input type="file" name="file2" class="form-control-file" id="file2" required style="border:0 none; font-size:12px; height:60px" />
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
	
    <!--<script src="js/main.js"></script>-->
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
<script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','S\u00e1b'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S\u00e1'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
	$("#fechaevento").datepicker();
	});

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
$('#horaevento').timepicker({
    timeFormat: 'HH:mm',
    interval: 30,
    minTime: '00',
    maxTime: '23:30pm',
    defaultTime: '12',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>

  </body>
</html>
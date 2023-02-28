<? require 'init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (!isset($_SESSION['idu']) or !is_numeric($_GET['ide'])) {
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

	$fechafve=str_replace("/", "-",$_POST['fechafve']);
	$fechafve=tfecha($fechafve);
	$afechafve=explode("-",$fechafve);
	
	$day=$afecha[2]; $mes=$afecha[1]; $ano=$afecha[0];
	if (checkdate($mes, $day, $ano)) {
		//ok
		} else {
		$error=true; $errorfecha=1;
		//echo "mala fecha"; echo $dia; exit();
		}

	$day2=$afechafve[2]; $mes2=$afechafve[1]; $ano2=$afechafve[0];
	if (checkdate($mes2, $day2, $ano2)) {
		//ok
		} else {
		$error=true; $errorfecha2=1;
		//echo "mala fecha"; echo $dia; exit();
		}
	
	
	$hora=$_POST['hora'];
	$horafve=$_POST['horafve'];
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
	if ($img_temp!='') {
		$exten=extension($img_temp); //echo $exten; exit();
		if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
			$directorio = "multimedia/eventos/";
			$aleatorio = rand(100000,999999);
			$imgmain = date("Y-m-d")."-". $aleatorio . "." . $exten;
			$_POST['imgmain']=$imgmain;
			$arch = $directorio . $imgmain;
			move_uploaded_file($_FILES['file1']['tmp_name'], $arch);

			$nomfoto=$imgmain."-recorte.jpg";
			redimensionar_central($exten, $directorio.$imgmain, $directorio.$nomfoto, 1280, 85,'');
			$nomfoto=$imgmain."-cuadrado.jpg";
			recortar_cuadrado($ext, $directorio.$imgmain."-recorte.jpg", $directorio.$nomfoto, 350, 85,'');

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

	
	//update oradores
	//cuantos son?
	$co=$_POST['oradores'];
	//echo $co; exit();
	for ($oo=1; $oo<=$co; $oo++) {
		if ($_POST['hiddorador'.$oo]) {
			//echo "modificar";
			//se modificó la foto?
			$img_temp=$_FILES['fileorador'.$oo]['name'];
			if ($img_temp!='') {
				$exten=extension($img_temp); //echo $exten; exit();
				//echo $img_temp; exit();
				if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
					$directorio = "multimedia/eventos/";
					$aleatorio = rand(100000,999999);
					$imgora = date("Y-m-d")."-". $aleatorio . "." . $exten;
					$_POST['filename'.$oo]=$imgora;
					$arch = $directorio . $imgora;
					move_uploaded_file($_FILES['fileorador'.$oo]['tmp_name'], $arch);
					}
					else {
					$error=true; $errorfile=1;
					}
				} else {
				//mismo archivo
				//$imgmain=$_POST['himgmain'];
				//$_POST['imgmain']=$imgmain;
				}

			//modificar lo demás
			$sql="update evento_oradores set imagen='".$_POST['filename'.$oo]."', nombre='".utf8d($_POST['norador'.$oo])."', profesion='".utf8d($_POST['oprofesion'.$oo])."', facebook='".$_POST['facebook'.$oo]."', instagram='".$_POST['instagram'.$oo]."', pinterest='".$_POST['pinterest'.$oo]."', google='".$_POST['mail'.$oo]."' where id=".$_POST['hiddorador'.$oo];
			gexecute($sql);
			//echo $sql; exit();
			} else {
			//echo "nuevo";
			//subir foto
			$img_temp=$_FILES['fileorador'.$oo]['name'];
			if ($img_temp!='') {
				$exten=extension($img_temp); //echo $exten; exit();
				//echo $img_temp; exit();
				if ($exten=="jpg" || $exten=="jpeg" || $exten=="gif" || $exten=="png") {
					$directorio = "multimedia/eventos/";
					$aleatorio = rand(100000,999999);
					$imgora = date("Y-m-d")."-". $aleatorio . "." . $exten;
					$_POST['filename'.$oo]=$imgora;
					$arch = $directorio . $imgora;
					move_uploaded_file($_FILES['fileorador'.$oo]['tmp_name'], $arch);
					}
					else {
					$error=true; $errorfile=1;
					}
				} else {
				//mismo archivo
				//$imgmain=$_POST['himgmain'];
				//$_POST['imgmain']=$imgmain;
				}
			$sql="insert into evento_oradores (imagen, nombre, profesion, facebook, instagram, pinterest, google, idevento) values ('".$_POST['filename'.$oo]."', '".utf8d($_POST['norador'.$oo])."', '".utf8d($_POST['oprofesion'.$oo])."', '".$_POST['facebook'.$oo]."', '".$_POST['instagram'.$oo]."', '".$_POST['pinterest'.$oo]."', '".$_POST['mail'.$oo]."', ".$_POST['hide'].")";
			//echo $sql; exit();
			$idnuevoorador=ginsert($sql);
			$_POST['hiddorador'.$oo]=$idnuevoorador;

			}
		}
	
	

	//insertar bbdd
	$sql="update eventos  set titulo='".$titulo."', descripcion='".$descripcion."', detalles='".$detalles."', fecha='".$fecha."', hora='".$hora."', fechafinventa='".$fechafve."', horafinventa='".$horafve."', lugar='".$lugar."', direccion='".$direccion."', imgmain='".$imgmain."', imgsec='".$imgsec."' where id=".$_POST['hide'];
	//echo $sql;
	$k=gexecute($sql);
	//echo $k; exit();
	if ($k>=0) {
		//borrar plateas existentes y luego guardar las nuevas o actualizadas
		$sql="delete from evento_plateas where idevento=".$_POST['hide'];
		//gexecute($sql);
		$link=conectar();
		
		for ($x=1; $x<=$_POST['cplateas']; $x++) {
			//echo "hhhhhhhhhhhhhh".$_POST["hidd".$x]."----------------------------------------<br>";
			$nplatea=mysqli_real_escape_string($link, utf8d($_POST['platea'.$x]));
			$cantip=mysqli_real_escape_string($link, $_POST['seats'.$x]);
			$precio=mysqli_real_escape_string($link, $_POST['precio'.$x]);
			if ($_POST["hidd".$x]) {
				$sqlu="update evento_plateas set nombre='".$nplatea."', cantidad=".$cantip.", precio=".$precio." where id=".$_POST['hidd'.$x];
				gexecute($sqlu);
				} else {
				$sql="insert into evento_plateas (nombre, cantidad, precio, idevento) values ('".$nplatea."', ".$cantip.", ".$precio.", ".$_POST['hide'].")";
				//echo $sql."<br>";
				$idpl=ginsert($sql);
				
				//enviar mail de plateas nuevas
				$plateasnuevas=true;
				$newnplateas[]=$nplatea;
				$newcplateas[]=$cantip;
				$newpplateas[]=$precio;
				
				$_POST['hidd'.$x]=$idpl;
				$_POST['hiddnew'.$x]=1;
				}
			//enviar mail por si hay plateas nuevas
			if ($plateasnuevas) {
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
					$mail->setFrom('envios@ideasbinarias.net', 'Nueva/s platea/s en Valiticket!');
					$para="lic.diego.arce@gmail.com";
					$mail->addAddress($para);     //Add a recipient
					//$mail->addAddress("lic.diego.arce@gmail.com");     //Add a recipient
					//$mail->addAddress('ellen@example.com');               //Name is optional
					//$mail->addReplyTo('info@example.com', 'Information');
					//$mail->addCC('cc@example.com');
					//$mail->addBCC('bcc@example.com');
				
					//Content
					//armar link de aprobacion
					$k=$_POST['hide'];
					$linkaprobacion="https://ideasbinarias.net/valiticket/aprobar-plateas.php?id=".$k."&hash=".md5($k);
					
					$cuerpo ="<p>Nombre evento: ".$titulo.": "."</p>";
					for ($h=0; $h<count($newnplateas); $h++) {
						$cuerpo.="<p>Nueva platea: ".$newnplateas[$h]."</p>";
						$cuerpo.="<p>Cantidad: ".$newcplateas[$h]."</p>";
						$cuerpo.="<p>Precio $: ".$newpplateas[$h]."</p>";
						}
					
					
					$cuerpo.="<p>Aprobar plateas: <a href='".$linkaprobacion."'>Clic para aprobar</a></p>";
				
					$asunto="Nueva/s Platea/s por aprobar en Valiticket";
					$mail->isHTML(true);//Set email format to HTML
					$mail->Subject = $asunto;
					$mail->Body    = $cuerpo;
					//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
					$enviado=$mail->send();
					} catch (Exception $e) {
					$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					$alert="alert-danger";
					}
				}
			}
		$msj="Evento modificado exitosamente!";
		$alert="alert-success";
		} else {
		//algo pasó q no se pudo insertar el evento
		$msj="Hubo un problema y no se pudo modificar el evento!";
		$alert="alert-danger";
		}
	
	
	} else {//no post
	//traer datos del evento
	$ide=substr($_GET['ide'],0,9);
	$sql="select * from eventos where id=".$ide." and idprop=".$_SESSION['idu'];
	//echo $sql;
	$evento=gfila($sql);
	if ($evento) {
		//print_r($evento);
		$_POST['tname']=utf8_encode($evento['titulo']);
		$_POST['description']=utf8_encode($evento['descripcion']);
		$_POST['detalles']=utf8_encode($evento['detalles']);
		$_POST['fecha']=str_replace("-", "/", tfecha($evento['fecha']));
		$_POST['hora']=$evento['hora'];
		$_POST['fechafve']=str_replace("-", "/", tfecha($evento['fechafinventa']));
		$_POST['horafve']=$evento['horafinventa'];
		$_POST['lugar']=utf8_encode($evento['lugar']);
		$_POST['direccion']=utf8_encode($evento['direccion']);
		$_POST['hide']=$ide;
		$_POST['imgmain']=$evento['imgmain']; $_POST['himgmain']=$evento['imgmain'];
		$_POST['imgsec']=$evento['imgsec']; $_POST['himgsec']=$evento['imgsec'];
		$sql="select * from evento_plateas where idevento=".$ide;
		//echo $sql;
		$plateas=gtabla($sql);
		$_POST['cplateas']=count($plateas);
		$x=0;
		if ($plateas) {
			foreach ($plateas as $platea) {
				$x++;
				$_POST['seats'.$x]=$platea['cantidad'];
				$_POST['platea'.$x]=utf8_encode($platea['nombre']);
				$_POST['precio'.$x]=$platea['precio'];
				$_POST["hidd".$x]=$platea['id'];
				if ($platea['aprobada']==1) {
					$_POST["hiddnew".$x]=0;
					} else {
					$_POST["hiddnew".$x]=1;
					}
				}	
			}
		//print_r($_POST); exit();
		$sql="select * from evento_oradores where idevento=".$ide;
		//echo $sql;
		$oradores=gtabla($sql);
		$_POST['oradores']=count($oradores);
		$x=0;
		if ($oradores) {
			foreach ($oradores as $orador) {
				$x++;
				$_POST['norador'.$x]=utf8_encode($orador['nombre']);
				$_POST['oprofesion'.$x]=utf8_encode($orador['profesion']);
				$_POST['imagen'.$x]=$orador['imagen'];
				$_POST['filename'.$x]=$orador['imagen'];
				$_POST['facebook'.$x]=$orador['facebook'];
				$_POST['instagram'.$x]=$orador['instagram'];
				$_POST['pinterest'.$x]=$orador['pinterest'];
				$_POST['mail'.$x]=$orador['google'];
				$_POST["hiddorador".$x]=$orador['id'];
				}	
			}

		} else {
		header("location: index.php");
		}
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
                    <li class="active">Edici&oacute;n de  Evento</li>
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
                <textarea name="detalles" class="form-control" id="descripcion" aria-describedby="detalles" required="required"><?=$_POST['detalles']?></textarea>
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
                <label for="exampleInputEmail1">Fecha de Fin de Venta Entradas</label>
                <input type="text" name="fechafve" class="form-control" id="fechafve" aria-describedby="fechafve" required value="<?=$_POST['fechafve']?>" placeholder="__/__/_____" />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Hora de Fin de Venta Entradas</label>
                <input type="text" name="horafve" class="form-control" id="horafve" aria-describedby="horafve" required value="<?=$_POST['horafve']?>" placeholder="__:__" />
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
					<tr id="tr<?=$x;?>">
						<td width="25%">Nombre: <input type="text" name="platea<?=$x;?>" class="form-control" id="platea<?=$x;?>" required placeholder="Nombre de Platea" value="<?=$_POST['platea'.$x]?>" <? if ($_POST['hiddnew'.$x]==0) {?> readonly<? } ?> /></td>
						<td width="30%">Cant. Asientos: <input type="number" name="seats<?=$x;?>" class="form-control" id="seats<?=$x;?>" required placeholder="Cantidad de Asientos o Locaciones" value="<?=$_POST['seats'.$x]?>" <? if ($_POST['hiddnew'.$x]==0) {?> readonly<? } ?>/></td>
						<td width="25%">Precio $: <input type="number" name="precio<?=$x;?>" class="form-control" id="precio<?=$x;?>" required placeholder="Costo" value="<?=$_POST['precio'.$x]?>" <? if ($_POST['hiddnew'.$x]==0) {?> readonly<? } ?>/></td>
						<input type="hidden" name="hidd<?=$x?>" value="<?=$_POST['hidd'.$x]?>" />
                        <input type="hidden" name="hiddnew<?=$x?>" value="<?=$_POST['hiddnew'.$x]?>" />
					</tr>
					<? } ?>
				</table>
                <input type="button" value="Agregar platea" onClick="agregar_platea();"/>&nbsp;<? //<input type="button" value="Quitar platea" onClick="quitar_platea();"/> ?>
              </div>

			<div class="form-group">
                <label for="exampleInputPassword1"><b>Oradores</b></label>
				<table id="tablaoradoress">
				<?
				//$_POST['oradores']=1;
				for ($x=1; $x<=$_POST['oradores']; $x++) {
				?>
					<tr id="tor<?=$x;?>">
						<td><br>
						<table><tr>
						<td width="100%" colspan="4"><img src="multimedia/eventos/<?=$_POST['filename'.$x]?>"><input type="hidden" name="filename<?=$x;?>" value="<?=$_POST['filename'.$x]?>" />
                        <br>
                        Imagen (160x160 pixeles): <input type="file" name="fileorador<?=$x;?>" class="form-control-file" style="border:0 none; font-size:12px; height:60px;" /></td>
						</tr>
						<tr>
						<td width="50%" colspan="2">Nombre: <input type="text" name="norador<?=$x;?>" class="form-control" id="norador<?=$x;?>" required placeholder="Nombre de Orador" value="<?=$_POST['norador'.$x]?>" /></td>
						<td width="50%" colspan="2">Profesi&oacute;n: <input type="text" name="oprofesion<?=$x;?>" class="form-control" id="oprofesion<?=$x;?>" required placeholder="Profesion" value="<?=$_POST['oprofesion'.$x]?>" /></td>
						</tr>
						<tr>
						<td width="25%">Facebook: <input type="text" name="facebook<?=$x;?>" class="form-control" id="facebook<?=$x;?>" value="<?=$_POST['facebook'.$x]?>" /></td>
						<td width="25%">Instagram: <input type="text" name="instagram<?=$x;?>" class="form-control" id="instagram<?=$x;?>" value="<?=$_POST['instagram'.$x]?>" /></td>
						<td width="25%">Pinterest: <input type="text" name="pinterest<?=$x;?>" class="form-control" id="pinterest<?=$x;?>" value="<?=$_POST['pinterest'.$x]?>" /></td>
						<td width="25%">Mail: <input type="text" name="mail<?=$x;?>" class="form-control" id="mail<?=$x;?>" value="<?=$_POST['mail'.$x]?>" /></td>
						</tr>
						</table>
						</td><input type="hidden" name="hiddorador<?=$x;?>" value="<?=$_POST['hiddorador'.$x]?>" />
					</tr>
					<? } ?>
				</table>
                <input type="button" value="Agregar orador" onClick="agregar_orador();"/>&nbsp;<? //<input type="button" value="Quitar platea" onClick="quitar_platea();"/> ?>
              </div>
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="btn-submit" value="Guardar" name="enviar" /> <!--(Podr&aacute; editar despu&eacute;s)<br>-->
					<input type="hidden" value="<?=$_POST['cplateas']?>" name="cplateas" id="cplateas" />
					<input type="hidden" value="<?=$_POST['oradores']?>" name="oradores" id="coradores" />
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

var oradores=<?=$_POST['oradores']?>;
function agregar_orador() {
	oradores++;
	//alert(platea);
	var elemento=$("<tr id=\"tor"+oradores+"\"><td><br><table><tr><td width=\"100%\" colspan=\"4\">Imagen  (160x160 pixeles): <input type=\"file\" name=\"fileorador"+oradores+"\" class=\"form-control-file\" style=\"border:0 none; font-size:12px; height:60px;\"/></td></tr><tr><td width=\"50%\" colspan=\"2\">Nombre: <input type=\"text\" name=\"norador"+oradores+"\" class=\"form-control\" id=\"norador"+oradores+"\" required placeholder=\"Nombre de Orador\" /></td><td width=\"50%\" colspan=\"2\">Profesi&oacute;n: <input type=\"text\" name=\"oprofesion"+oradores+"\" class=\"form-control\" id=\"oprofesion"+oradores+"\" required placeholder=\"Profesion\" /></td></tr><tr><td width=\"25%\">Facebook: <input type=\"text\" name=\"facebook"+oradores+"\" class=\"form-control\" id=\"facebook"+oradores+"\" /></td><td width=\"25%\">Instagram: <input type=\"text\" name=\"instagram"+oradores+"\" class=\"form-control\" id=\"instagram"+oradores+"\" /></td><td width=\"25%\">Pinterest: <input type=\"text\" name=\"pinterest"+oradores+"\" class=\"form-control\" id=\"pinterest"+oradores+"\" /></td><td width=\"25%\">Mail: <input type=\"text\" name=\"mail"+oradores+"\" class=\"form-control\" id=\"mail"+oradores+"\" /></td></tr></table></td></tr>");
	//var elemento=$("<input type=\"text\" class=\"form-control\" name=\"sel"+platea+"\" placeholder=\"Ingrese una opci&oacute;n selectable\" value=\"\" /><br>");
	$("#tablaoradoress").append(elemento);
	var coradores=document.getElementById('coradores');
	//alert (cplateas);
	coradores.value=oradores;
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
	$("#fechafve").datepicker();
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
    defaultTime: '',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
$('#horafve').timepicker({
    timeFormat: 'HH:mm',
    interval: 30,
    minTime: '00',
    maxTime: '23:30pm',
    defaultTime: '',
    startTime: '00:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
</script>
    

  </body>
</html>
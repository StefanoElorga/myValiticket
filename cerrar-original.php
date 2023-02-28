<?
require 'init.php';
if (!isset($_SESSION['idu'])) {
	header("location: login.php");
	} else {
	$sql="select * from personas where id=".$_SESSION['idu'];
	$user=gfila($sql);
	//print_r($user);
	
	}
include "phpqrcode/qrlib.php";
$q=0; $sum=0; $cuerpo=''; $_SESSION['xentradas']=array();
foreach ($_SESSION['carrito'] as $indx => $item) {
	$q++;
	$sql="select * from evento_plateas where id=".$indx;
	$platea=gfila($sql);
	
	$sql="select * from eventos where id=".$platea['idevento'];
	$evento=gfila($sql);
	
	//hay cupon descuento?
	if ($_SESSION['cupon'.$evento['id']]) {
		//buscar el cupon y sumar +1 a aplicados
		$sql="select * from cupones where idevento=".$evento['id'];
		$elcupon=gfila($sql);
		//tema a resolver en la reunión próxima (dscuento por evento o por entrada)
		$sql="update cupones set aplicados=aplicados+1 where idevento=".$evento['id'];
		gexecute($sql);
		}
	//selecciono las entradas
	$sql="select * from entradas where idp=".$indx." limit ".$item;
	//echo $sql."<br />";
	$entradas=gtabla($sql);
	foreach ($entradas as $row) {
		$sql="update entradas set vendida=1, fechaven='".date("Y-m-d H:i:s")."', idpersona=".$user['id']." where id=".$row['id']." and uniqueid='".$row['uniqueid']."'";
		//echo $sql."<br />";
		gexecute($sql);//**********************************************************************
		if ($_SESSION['cupon'.$evento['id']]) {
			$sql="insert into cupones_aplicados (idpersona, idcupon, idevento) values (".$_SESSION['idu'].", ".$elcupon['id'].", ".$evento['id'].")";
			ginsert($sql);
			}
		
		//genero QR
		//set it to writable location, a place for temp generated PNG files
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'multimedia'.DIRECTORY_SEPARATOR."entradas".DIRECTORY_SEPARATOR;
		//html PNG location prefix
		$PNG_WEB_DIR = 'multimedia/entradas/';
		//ofcourse we need rights to create temp dir
		if (!file_exists($PNG_TEMP_DIR))
			mkdir($PNG_TEMP_DIR);
		$filename = $PNG_TEMP_DIR.'test.png';
		//processing form input
		//remember to sanitize user input in real-life solution !!!
		$errorCorrectionLevel = 'H';
		if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
			$errorCorrectionLevel = $_REQUEST['level'];    
		$matrixPointSize = 8;
		if (isset($_REQUEST['size']))
			$matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
		$_REQUEST['data']="https://".$_SERVER['HTTP_HOST']."/check/".$row['uniqueid'];
		//echo $_REQUEST['data'];
		if (isset($_REQUEST['data'])) { 
			//it's very important!
			if (trim($_REQUEST['data']) == '')
				die('data cannot be empty! <a href="?">back</a>');
			// user data
			$filename = $PNG_TEMP_DIR.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
			//$filenameQR = $PNG_TEMP_DIR.'blocla'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
			QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
			$originalQR=@imagecreatefrompng($filename);
			//$logoblocla=@imagecreatefrompng("imgs/logo-en-qr.png");
			$dataQR=getimagesize($filename);
			//$dataLOGO=getimagesize("imgs/logo-en-qr.png");
			list($width, $heigth)=getimagesize($filename);
			//list($lgwidth, $lgheigth)=getimagesize("imgs/logo-en-qr.png");
			$newQR=imagecreatetruecolor($width, $heigth);
			imagecopy(	$newQR,
						$originalQR,
						0,
						0,
						0,
						0,
						$width,
						$heigth
						);
/*						
			imagecopy(	$newQR,
						$logoblocla,
						($width/2)-($lgwidth/2),
						($heigth/2)-($lgheigth/2),
						0,
						0,
						$lgwidth,
						$lgheigth
						);
*/			
			//imagepng($newQR, $filenameQR, 0);
			imagepng($newQR, $filename, 0);
			} else {    
			//default data
			echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
			QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
		}    
		//display generated file
		//echo '<center><img src="'.$PNG_WEB_DIR.basename($filenameQR).'" onClick="closeqr();" /></center>';  
		//armo el mail



		$cuerpo.="<h3>Evento: ".($evento['titulo']).", Platea: ".utf8($platea['nombre'])."</h3>";
		$cuerpo.="<p><img src='https://ideasbinarias.net/valiticket/multimedia/eventos/".$evento['imgmain']."-recorte.jpg' width='600' /></p>";
		//$cuerpo.="<p><img src='multimedia/entradas/testf53d6cc99a6660d978dec129f272bc79.png' /></p>";
		$cuerpo.="<p>Su entrada para el día ".tfecha($evento['fecha']).", hora ".$evento['hora'].", <br />";
		$cuerpo.="<img src='https://ideasbinarias.net/valiticket/".$PNG_WEB_DIR.basename($filename)."' /></p>";
		$cuerpo.="<br /><br />";
		
		$_SESSION['xentradas'][]="<h3>Evento: ".($evento['titulo']).", Platea: ".utf8($platea['nombre'])."</h3>
		<p><img src='https://ideasbinarias.net/valiticket/multimedia/eventos/".$evento['imgmain']."-recorte.jpg' width='600' /></p>
		<p>Su entrada para el día ".tfecha($evento['fecha']).", hora ".$evento['hora'].", <br />
		<img src='https://ideasbinarias.net/valiticket/".$PNG_WEB_DIR.basename($filename)."' /></p>";

		$_SESSION['xtexto'][]="<h5>Evento: ".utf8($evento['titulo']).", Platea: ".utf8($platea['nombre'])."</h5>";
		


		}


	//print_r($evento);
	//$evento['id']//utf8($evento['titulo'])
	//$indx//utf8($platea['nombre'])
	//$item*$platea['precio'];
	$sum+=$item*$platea['precio'];
	//$platea['id'];
	}
//echo utf8($cuerpo);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

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
	$mail->setFrom('envios@ideasbinarias.net', 'Ud. se ha registrado en Valiticket');
	$para=strtolower($user['email']);
	$mail->addAddress($para);     //Add a recipient
	//$mail->addAddress("lic.diego.arce@gmail.com");     //Add a recipient
	//$mail->addAddress('ellen@example.com');               //Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');

	//Content
	/*$cuerpo ="<p>Bienvenido a  ".$_SERVER['HTTP_HOST'].": "."</p>";
	$cuerpo.="<p>Su nombre: ".$_POST['tname']."</p>";
	$cuerpo.="<p>Su email: ".$_POST['email']."</p>";
	$cuerpo.="<p>Su password: ".$_POST['pass']."</p>";*/

	$asunto="Valiticket le envia sus entradas desde el sitio web ".$_SERVER['HTTP_HOST'];
	$mail->isHTML(true);//Set email format to HTML
	$mail->Subject = $asunto;
	$mail->Body    = $cuerpo;
	//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	$enviado=$mail->send();
	} catch (Exception $e) {
	$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	$alert="alert-danger";
	}
//unset($_SESSION['carrito']);

header("location: congrats.php");
?>
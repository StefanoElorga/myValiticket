<?
require 'init.php';
include "phpqrcode/qrlib.php";
$token="APP_USR-5928348539970896-100723-72de34ccf0adfb5d4ce719ee3c18cf0e-833921102";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);


if ($_GET) {
	//$sql="insert into debug (text, text2) values ('".$_GET['topic']."', '".$_GET['id']."') ";
	$sql="insert into ventas_notificacion_ipn (topic, valor, fecha) values ('".$_GET['topic']."', '".$_GET['id']."', '".date("Y-m-d H:i:s")."') ";
	ginsert($sql);
	//insertar el pedido
	if ($_GET['topic']=='payment') {
		//buscar el external_reference asociado
		$params = $_GET['id'];
		$result=(json_decode(get_venta($params, $token),true));
		$producto=$result;
		//print_r($producto); exit();
		if ($producto['status']=='approved') {
			$er=$producto['external_reference'];
			//recuperar la preferencia
			$sql="select * from carrito_pedidos where external_reference='".$er."' and estado_pago=0"; //exit();//acá se controló que ya no se haya ejecutado
			$data=gfila($sql);
			if ($data) {//hay un pedido
				//$idventa=uniqid("", true);
				$modipre = "UPDATE carrito_pedidos SET estado_pago = '1', collection_id = '".$_GET['id']."' WHERE preference_id = '".$data['preference_id']."'";
				gexecute($modipre);
				$preferencia=$data['preference_id'];
				$q=0; $sum=0; $cuerpo='';
				//obtener el carro de la bbdd
				$sql="select * from temp_carro where preferencia='".$preferencia."'";
				$carro=gtabla($sql);
				//foreach ($_SESSION['carrito'] as $indx => $item) {
				if ($carro) {
				//usuario que compró?
				$sql="select * from personas where id=".$carro[0]['idcliente'];
				$user=gfila($sql);
				foreach ($carro as $rowy) {
					$q++;
					$indx=$rowy['idplatea'];
					$item=$rowy['cantidad'];
					$sql="select * from evento_plateas where id=".$indx;
					$platea=gfila($sql);
					
					$sql="select * from eventos where id=".$platea['idevento'];
					$evento=gfila($sql);
					
					//selecciono las entradas
					$sql="select * from entradas where idp=".$indx." limit ".$item;
					//echo $sql."<br />";
					$entradas=gtabla($sql);
					foreach ($entradas as $row) {
						$sql="update entradas set vendida=1, fechaven='".date("Y-m-d H:i:s")."', idpersona=".$user['id']." where id=".$row['id']." and uniqueid='".$row['uniqueid']."'";
						//echo $sql."<br />";
						gexecute($sql);//**********************************************************************
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
						$_REQUEST['data']="https://".$_SERVER['HTTP_HOST']."/check/".$row['uniqueid'];//link
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
						//$cuerpo.="<p><img src='https://ideasbinarias.net/valiticket/multimedia/eventos/".$evento['imgmain']."-recorte.jpg' width='200' /></p>";
						//$cuerpo.="<p><img src='multimedia/entradas/testf53d6cc99a6660d978dec129f272bc79.png' /></p>";
						$cuerpo.="<p>Su entrada para el día ".tfecha($evento['fecha']).", hora ".$evento['hora'].", <br />";
						//$cuerpo.="<img src='https://ideasbinarias.net/valiticket/".$PNG_WEB_DIR.basename($filename)."' /></p>";
						$cuerpo.="<a href='https://ideasbinarias.net/valiticket/".$PNG_WEB_DIR.basename($filename)."' >Descargar</a></p>";
						$cuerpo.="<br /><br />";
						
						$_SESSION['xentradas'][]="<h3>Evento: ".($evento['titulo']).", Platea: ".utf8($platea['nombre'])."</h3>
						<p><img src='https://ideasbinarias.net/valiticket/multimedia/eventos/".$evento['imgmain']."-recorte.jpg' width='600' /></p>
						<p>Su entrada para el día ".tfecha($evento['fecha']).", hora ".$evento['hora'].", <br />
						<img src='https://ideasbinarias.net/valiticket/".$PNG_WEB_DIR.basename($filename)."' /></p>";
				
						$_SESSION['xtexto'][]="<h5>Evento: ".utf8($evento['titulo']).", Platea: ".utf8($platea['nombre'])."</h5>";
						
				
				
						}//foreach entradas
				
				
					//print_r($evento);
					//$evento['id']//utf8($evento['titulo'])
					//$indx//utf8($platea['nombre'])
					//$item*$platea['precio'];
					$sum+=$item*$platea['precio'];
					//$platea['id'];

					}//foreach carro
					
				//echo utf8($cuerpo);
				
				
				
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
					$mail->setFrom('envios@ideasbinarias.net', 'Valiticket le envia sus entradas');
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
				//guardar los cupones aplicados
				$sql="select * from temp_cupones where preferencia='".$preferencia."'";
				$cuponesaplicados=gtabla($sql);
				if ($cuponesaplicados) {
					foreach ($cuponesaplicados as $elcuponazo) {
						//tema a resolver en la reunión próxima (dscuento por evento o por entrada)//ya resuelto
						$sql="update cupones set aplicados=aplicados+1 where idevento=".$elcuponazo['idevento'];
						gexecute($sql);
						
						//buscar id cupon
						$sql="select * from cupones where cupon='".$elcuponazo['cupon']."' and idevento=".$elcuponazo['idevento'];
						$elcupon=gfila($sql);
						$sql="insert into cupones_aplicados (idpersona, idcupon, idevento) values (".$elcuponazo['idpersona'].", ".$elcupon['id'].", ".$elcuponazo['idevento'].")";
						ginsert($sql);
						}
					}

				//borrar los temporales
				$sql="delete from temp_carro where preferencia='".$preferencia."'";
				gexecute($sql);
				$sql="delete from temp_cupones where preferencia='".$preferencia."'";
				gexecute($sql);
				
				}//if carro
				
				





				}
			}
		}
	} else {
	//header("HTTP/1.1 200 OK");
	}
header("HTTP/1.1 200 OK");






function get_venta($params, $token) {//
	$path_webservice_clientes="https://api.mercadopago.com/v1/payments/".$params;
	$url=$path_webservice_clientes;
	//echo $url;
	//echo $params."<br />";//.$token."<br />";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_URL, $url);
	//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
	//curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	
	// This should be the default Content-type for POST requests
	//curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded"));
	$authorization = "Authorization: Bearer ".$token;

	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json", $authorization));
	//echo "aca";
	$result = curl_exec($ch);
	//print_r(curl_getinfo($ch));
	curl_close($ch);
	$response=$result; 
	//echo $response;
	//$response=str_replace("??", "a", $response);
	//$array=json_decode($response);
	//echo ($response);
	/*

	*/

	return $response;



	}

?>
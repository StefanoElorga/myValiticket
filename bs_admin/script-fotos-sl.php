<?php

require_once("conexion/funciones.php");

$insert=substr($_GET['id'],0,10);

$folder=str_pad($_GET['id'],5,"0",STR_PAD_LEFT);

$result = array();

if (isset($_FILES['photoupload']) )

{

	$file = $_FILES['photoupload']['tmp_name'];

	$error = false;

	$size = false;

 

	if (!is_uploaded_file($file)  )

	{

		$error = 'Por favor, suba archivos mas chicos de 20Mb!';

	}

/*	if (!$error && !($size = @getimagesize($file) ) )

	{

		$error = 'Please upload only images, no other files are supported.';

	}

*//*	if (!$error && !in_array($size[2], array(1, 2, 3, 7, 8) ) )

	{

		$error = 'Please upload only images of type JPEG.';

	}*/

/*	if (!$error && ($size[0] < 25) || ($size[1] < 25))

	{

		$error = 'Please upload an image bigger than 25px.';

	}

*/ 

	if (!$error) {

		

/*		if (!is_dir("../foto-galerias/".$folder)) {

			mkdir("../foto-galerias/".$folder);

			}

/*		$rnd=rand(100000,999999);

		move_uploaded_file($_FILES['photoupload']['tmp_name'],"../temp/".$rnd.$_FILES['photoupload']['name']);

*/

		$folder_u="../multimedia/imagenes/cs_sl_fotos/";

		$imag=$_FILES['photoupload'];

		$ext=extension($imag['name']);
		if ($ext=="jpg" or $ext=="jpeg") {
			$newname=$insert."-".date("YmdHis")."-sl-".rand(10000,99999).".jpg";
			}
		if ($ext=="png") {
			$newname=$insert."-".date("YmdHis")."-sl-".rand(10000,99999).".png";
			}
		//move_uploaded_file($imag[tmp_name],"../galeria/".$newname);

		list($width, $height)=getimagesize($imag['tmp_name']);
		if ($ext=="jpg" or $ext=="jpeg") {
		if (1==2) {//$height>$width

/*			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname."_big.jpg",450,95,'');
			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname,409,95,'');
			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname."_tb.jpg",86,85,'');
*/
			}

			else {

//			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname."_big.jpg",1280,95,'');//x acá
			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname,300,95,'');
//			redimensionar($ext,$imag['tmp_name'],$folder_u.$newname."_tb.jpg",185,85,'');

			}
			}
			else {
			if ($ext=="png") {
				//mover o copiar archivo
				move_uploaded_file($imag['tmp_name'], $folder_u.$newname);
				}
			}
		ginsert("INSERT INTO cs_sl_fotos (filename, idp) VALUES ('$newname', $insert)");

		}

	$addr = gethostbyaddr($_SERVER['REMOTE_ADDR']);

 

	$log = fopen('script.log', 'a');

	fputs($log, ($error ? 'FAILED' : 'SUCCESS') . ' - ' . preg_replace('/^[^.]+/', '***', $addr) . ": {$_FILES['photoupload']['name']} - {$_FILES['photoupload']['size']} byte\n" );

	fclose($log);

 

	if ($error)

	{

		$result['result'] = 'failed';

		$result['error'] = $error;

	}

	else

	{

		$result['result'] = 'success';

		$result['size'] = "Uploaded an image ({$size['mime']}) with  {$size[0]}px/{$size[1]}px.";

	}

 

}

else

{

	$result['result'] = 'error';

	$result['error'] = 'Missing file or internal error!';

}

 

if (!headers_sent() )

{

	header('Content-type: application/json');

}

 

echo json_encode($result);

 

?>
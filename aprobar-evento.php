<?
require 'init.php';
$ide=$_GET['id'];
$hash=$_GET['hash'];
if (md5($ide)==$hash) {
	//do
	//$ide=substr($_GET['id'],0,10);
	
	$sql="select * from eventos where id=".$ide." and aprobada=0";
	//echo $sql;
	$evento=gfila($sql);
	
	if ($evento) {
		//aprobar evento
		$sql="update eventos set aprobada=1, fechaaprobacion='".date("Y-m-d H:i:s")."' where id=".$ide;
		gexecute($sql);
		
		//ajustar las imagenes
		$imgmain=$evento['imgmain'];
		$folder_u="multimedia/eventos/";
		$imag=$imgmain;
		$ext=extension($imgmain);
		$nomfoto=$imgmain."-recorte.jpg";
		redimensionar_central($ext, $folder_u.$imgmain, $folder_u.$nomfoto, 1280, 85,'');
		$nomfoto=$imgmain."-cuadrado.jpg";
		recortar_cuadrado($ext, $folder_u.$imgmain."-recorte.jpg", $folder_u.$nomfoto, 350, 85,'');
		//
		//aprobar platea
		$sqlu="update evento_plateas set aprobada=1 where idevento=".$ide;
		$fff=gexecute($sqlu);
		//echo "crear entradas";
		$sql="select * from evento_plateas where idevento=".$ide;
		$plateas=gtabla($sql);
		$tt=0;
		foreach ($plateas as $platea) {
			//echo $platea['cantidad']."<br>";
			for ($e=1; $e<=$platea['cantidad']; $e++) {
				$uniqueid=uniqid("", true);
				$sql="insert into entradas (idp, uniqueid, fechagen) values (".$platea['id'].", '".$uniqueid."', '".date("Y-m-d H:i:s")."')";
				ginsert($sql);
				$tt++;
				}
			}
		//avisar q se aprob�
		echo "Evento aprobado exitosamente!";
		//echo $tt;
		} else {
		//avisar q no existe o ya est� aprobado
		echo "Evento fue aprobado con anterioridad! (O no existe).";
		}
	}
?>
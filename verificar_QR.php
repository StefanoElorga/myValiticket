<?
require 'init.php';
//print_r($_POST);
$valor=$_GET['valor'];

$destripar="https://".$_SERVER['HTTP_HOST']."/valiticket/check/";

$valor=str_replace($destripar, "", $valor);
$sql="select * from entradas where uniqueid='".$valor."' and vendida=1";
$entrada=gfila($sql);
if ($entrada) {
	if ($entrada['fechaexe']=='') {
		$msj="<span style='color:blue;'>Entrada v&aacute;lida!</span>";
		} else {
		$msj="<span style='color:red;'>Entrada ya ejecutada!</span>";
		$error=true;
		}
	echo "<center>";
	echo "<h5>".$msj."</h5><br />";
	//if (!$error) echo $btn="<a href='ejecutar-QR.php?id=".$entrada['uniqueid']."' class='btn btn-success' onClick='ejecutar_QR();'>Ejecutar</a>";
	if (!$error) echo $btn="<a href='' class='btn btn-success' onClick='ejecutar_QR(); return false;'>Ejecutar</a>";
	echo "</center>";
	} else {
		echo $msj="<span style='color:red;'>Entrada no existe!</span>";
		$error=true;
	
	}
	


?>
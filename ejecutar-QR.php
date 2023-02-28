<?
require 'init.php';
//print_r($_POST);
$qr=$_GET['id'];
$destripar="https://".$_SERVER['HTTP_HOST']."/valiticket/check/";

$qr=str_replace($destripar, "", $qr);

$sql="update entradas set fechaexe='".date("Y-m-d H:i:s")."' where uniqueid='".$qr."'";
gexecute($sql);

echo "Hecho!";
//header("location: chekinera.php");


?>
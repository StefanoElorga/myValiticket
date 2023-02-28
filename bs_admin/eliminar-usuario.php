<?
require_once("init.php");
if ($_GET['id']!='admin') 
	$sql=gexecute("delete from cs_admin where user='".$_GET['id']."'");
irphp("usuarios.php");
?>
<?
require 'init.php';
if (is_numeric($_GET['id'])) {
	$sql="delete from validadores where id=".$_GET['id'];
	gexecute($sql);
	}
header("location: nuevo-validador.php#validadores");

?>
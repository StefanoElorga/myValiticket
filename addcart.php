<?
require 'init.php';
//print_r($_POST);

if (is_numeric($_POST['quanty'])) {
	$_SESSION['carrito'][$_POST['hidplatea']]=$_POST['quanty'];
	}
header("location: entrada.php?id=".$_POST['hidplatea']);
?>
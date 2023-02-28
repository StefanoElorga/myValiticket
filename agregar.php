<?
require 'init.php';
//print_r($_POST);

if (is_numeric($_POST['quanty'])) {
	if ($_POST['quanty']==0) {
		unset($_SESSION['carrito'][$_POST['hidplatea']]);
		} else {
		$_SESSION['carrito'][$_POST['hidplatea']]=$_POST['quanty'];
		}
	}
//header("location: entrada.php?id=".$_POST['hidplatea']);
?>
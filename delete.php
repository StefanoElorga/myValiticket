<?
require 'init.php';
//print_r($_POST);

if (is_numeric($_GET['id'])) {
	unset($_SESSION['carrito'][$_GET['id']]);
	}
header("location: cart.php");
?>
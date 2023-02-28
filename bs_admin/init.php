<?
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
require_once("conexion/conexion.php");
require_once("conexion/funciones.php");
if ($_SESSION['logued']!='auto0.com.ar') {
	irphp("login.php");
	}
?>
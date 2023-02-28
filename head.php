<?
if ($_GET['skin']=="dark") {
	$_SESSION['skin']="dark";
	}
if ($_GET['skin']=="white") {
	$_SESSION['skin']="white";
	}
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<? if ($eventos!=1) {?>
	<meta name="description" content="La plataforma más conveniente Valiticket te permite crear un evento en nuestro sitio web en segundos para que puedas vender en tus entradas, no importa dónde estés. Más comodidad para tus asistentes Los asistentes de tus eventos podrán comprar las entradas a través de MercadoPago y recibirán un código QR en sus e-mails. Acceso seguro Con nuestro software de validación de asistentes, podrás acreditar el ingreso escaneando los códigos QR desde cualquier dispositivo móvil. Gestioná tu evento profesionalmente Con los datos que te brinda Valiticket Analytics, sabrás cuántas entradas vendiste, quiénes compraron tus entradas, quiénes fueron tus mejores vendedores y cuánto dinero generaste. ¿Necesitás dinero para organizar tu evento? Valiticket tiene la solución. Te adelantamos dinero para que lo organices, y nos devolvés cuando termina. Sin costo alguno." />
	<title>Valiticket</title>
	<? } else {
	//print_r($evento);
	?>
	<meta name="description" content="<?=utf8($evento['descripcion'])?>" />
	<title><?=utf8($evento['titulo'])?> - Valiticket</title>
	<meta property="og:image" content="multimedia/eventos/<?=$evento['imgmain'];?>-recorte.jpg" />
	<link rel="image_src" href="multimedia/eventos/<?=$evento['imgmain'];?>-recorte.jpg" />
	<? } ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<? if ($_SESSION['skin']=="dark") {?>
    <link rel="stylesheet" href="css/style.css" >
    <? }  else { ?>
    <link rel="stylesheet" href="css/style.back.css" >
    <? } ?>
    <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
<!--/*    <link rel="stylesheet" href="css/owl.carousel.css">*/-->
    <link rel="stylesheet" href="css/icofont.css">
	<link rel="stylesheet" href="css/responsive.css">
    <style>
	.btn-submit {
		text-transform:uppercase;
		font-size:13px;
		padding:0px 20px;
		background-color:#FFF;
		color:#000;
		border:1px solid #333333;
		}
	.btn-submit:hover {
		background-color:#FF004D;
		color:#FFFFFF;
		border:0 none;
		}
	</style>
<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<!--
    <script src="js/owl.carousel.min.js"></script>
    <script>
	$(document).ready(function() { 
	   $("#owl-wrapper").owlCarousel({
			navigation : true, // Show next and prev buttons
			slideSpeed : 300,
			paginationSpeed : 400,
			singleItem:true,
			// Navigation
			navigationText : ["Anterior","Siguiente"],
			rewindNav : true,
			scrollPerPage : true,
			//Pagination
			pagination : true,
			paginationNumbers: false
		});
	});
	</script>
-->
    
  </head>
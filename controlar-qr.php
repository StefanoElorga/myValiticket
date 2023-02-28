<?
require 'init.php';

//validar el login del controlador
//leer el code y buscar en la bbdd
//obtengo el di de la platea
//la platea pertenece a un evento creado por su patr�n?

//si ok, marcar entrada como ejecutada, poner en verde la pantalla, volver al lector

//no, avisar y volver al lector
$linky=conectar();
$qr=mysqli_real_escape_string($linky, $_GET['qr']);
$sql="select * from entradas where uniqueid='".$qr."' and vendida=1";
//echo $sql;

$existe=gfila($sql);

if ($existe) {//entrada existe
	//print_r($existe);
	//validar al controlador
	$idplatea=$existe['idp'];
	//busco al owner de la platea para saber el evento
	$sql="select * from evento_plateas where id=".$idplatea;
	$platea=gfila($sql);
	//print_r($platea);
	$idevento=$platea['idevento'];
	//busco el evento
	$sql="select * from eventos where id=".$idevento;
	$evento=gfila($sql);
	//print_r($evento);
	$idprop=$evento['idprop'];//el due�o o creador del evento
	//echo $_SESSION['idu'];
	//busco controladores
	$sql="select * from validadores where idp=".$idprop." and idvali=".$_SESSION['idu'];
	//echo $sql;
	$tienepermiso=gfila($sql);
	
	if ($tienepermiso) {
		//es alguien v�lido
		//controlar la hora de ejecuci�n
		$fechaevento=$evento['fecha'];
		$horaexe=$evento['horaexe'];
		
		$hoy=date("Y-m-d");
		$ahora=date("H:i");
		//
		$sql="select * from eventos where id=".$idevento;//." and fecha<='".$hoy."' and horaexe<='".$ahora."'";
		//echo $sql;
		$todook=gfila($sql);
		if ($todook) {
			//hay que controloar q la entrada ya no haya sido le�da
			if ($existe['fechaexe']=='') {
				//ejecutar la entrada
				$sql="update entradas set fechaexe='".date("Y-m-d H:i:s")."' where uniqueid='".$qr."'";
				gexecute($sql);
				//echo "aca";
				$color="green";
				$msg="Entrada correctamente validada";
				} else {
				//ya se ley� el QR y ya se ejecut�, o sea alguien ya ingres� al evento
				$color="red";
				$msg="Entrada ya validada y ejecutada!!";
				
				
				}
			} else {
			//intenta escanear un QR v�lido pero a�n no es la hora
			$color="#0099FF";
			$msg="Entrada correcta pero a&uacute;n no est&aacute; habilitada la entrada";
			}
		
		} else {
		//persona no existe
		//est� intentando ejecutar una entrada alguien que no es controlador o escanearon nom�s
		//echo "est� intentando ejecutar una entrada alguien que no es controlador o escanearon nom�s";
		$msg="Entrada correcta";
		$color="black";
		}
	
	//est� en rango de ser ejecutada?
	
	} else {
	//echo "no se encuentra";
	$msg="Error, QR inexistente";
	$color="brown";
	}

//header("location: nuevo-validador.php#validadores");

?><body style="background-color:<?=$color;?>">
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<center>
	<h1><?=$msg?></h1>
	
</center>
<style>
h1 {
	margin-top:100px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	color:#FFFFFF;
	}
</style>
</body>
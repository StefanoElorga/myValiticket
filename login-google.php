<?php
require 'init.php';
//Include Configuration File
include('config-google-auth.php');

$login_button = '';

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {

        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
	
		//validar usuario, existe?
	$sql="select * from personas where email='".$data['email']."'";
	$haymail=gfila($sql);
	if ($haymail) {
		//echo "hay mail"; exit();
		//ya estaba registrado, puede acceder sin problm
		$sql="select * from personas where email='".$data['email']."' and activo=1";
		//echo $sql; exit();
		$user=gfila($sql);

		$_SESSION['logedp']='valiticket';
		$_SESSION['usuario']=$user['email'];
		$_SESSION['idu']=$user['id'];

		} else {
		//se lo debe registrar
		//insertar al menos
		$hash=md5(date("Y-m-d H:i:s").rand(0,99999));
		$rand=rand(1000,9999);
		$sql="insert into personas (nombre, telefono, email, pass, activo, timetohash, organizador) values ('".utf8d($data['given_name'] . ' ' . $data['family_name'])."', '', '".$data['email']."', '', 1, '".date("Y-m-d H:i:s")."', 0)";
		//echo $sql; //exit();
		$idu=ginsert($sql);
		$msj= 'Se ha registrado correctamente';
		$alert="alert-success";

		$_SESSION['logedp']='valiticket';
		$_SESSION['usuario']=$data['email'];
		$_SESSION['idu']=$idu;
		
		}
	if ($_SESSION['from']=='login') {
		$go="cart.php";
		} else {
		$go="mi-perfil.php";
		}
	ir($go);
	
	
    }
}

//Ancla para iniciar sesión
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" style=" background: #dd4b39; border-radius: 5px; color: white; display: block; font-weight: bold; padding: 20px; text-align: center; text-decoration: none; width: 200px;">Login With Google</a>';
}
?><?php

if ($login_button == '') {
	echo '<div class="card-header">Welcome User</div><div class="card-body">';
	echo '<img src="' . $_SESSION["user_image"] . '" class="rounded-circle container"/>';
	echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
	echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
	echo '<h3><a href="logout-google.php">Logout</h3></div>';
	} else {
	echo '<div align="center">' . $login_button . '</div>';
	}
	
?>
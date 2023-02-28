<?php
//start session on web page
session_start();
//config.php
//Include Google Client Library for PHP autoload file
require_once 'vendor2/autoload.php';
//Make object of Google API Client for call Google API
$google_client = new Google_Client();
//Set the OAuth 2.0 Client ID | Copiar "ID DE CLIENTE"
$google_client->setClientId('832458441213-ucfvlnna1s6i7a59off838esmgh7oil1.apps.googleusercontent.com');
//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');
//Set the OAuth 2.0 Redirect URI | URL AUTORIZADO
$google_client->setRedirectUri('https://ideasbinarias.net/valiticket/login-google.php');
// to get the email and profile 
$google_client->addScope('email');
$google_client->addScope('profile');
?>
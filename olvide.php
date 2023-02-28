<? require 'init.php';

if ($_POST['enviar']) {
	$mail = new PHPMailer(true);
	//conectar();
	$txtuser=$_POST['txtu'];
	//$txtuser=mysql_real_escape_string($_POST['txtu']);
	$sql="select * from personas where email='".$txtuser."' and activo=1";
	//echo $sql; exit();
	$user=gfila($sql);
	
	if ($user) {

		
		try {
		$hash=md5(date("Y-m-d H:i:s").rand(0,99999));
		$sql="update personas set hash='".$hash."', rp=1 where email='".$txtuser."'";
		$exito=gexecute($sql);
		
		//mandar mail al inscripto
		$linky="https://www.ideasbinarias.net/valiticket/recupero-pass.php?hash=".$hash;
		$cuerpo ="<a href='".$linky."'>Deseo cambiar mi contrase&ntilde;a</a>";
		$email=$txtuser;
		$para=strtolower($email);
		//echo $para;
		$asunto="Hola ".htmlentities($user['nombre']).". Recibimos su petici&oacute;n de cambio de contrase&ntilde;a";

		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'www.ideasbinarias.net';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'envios@ideasbinarias.net';                     //SMTP username
		$mail->Password   = 'Azul2001%%';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;//465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		$mail->setFrom('envios@ideasbinarias.net', 'Registro en Valiticket');
		$mail->addAddress($para);     //Add a recipient
		//$mail->addAddress('ellen@example.com');               //Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
	
		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
	
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$enviado=$mail->send();

		if (!$enviado) {//
			$flag='err';
			$tipo="alert alert-danger";
			$msj="Disculpe. Su mail no ha podido ser enviado.. Vuelva a intentarlo luego. Gracias.";
			} else {
			$msj="Gracias. Se le ha enviado un mail. Por favor siga las instrucciones.";
			$tipo="alert alert-success";
			//enviar_sms($tel, $rand);
			unset($_POST);
			}
			
			} catch (Exception $e) {
			$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$alert="alert-danger";
			}
		}
		else {
		//usuario no encontrado
		$error=true;
		$msj="Usuario no se encuentra";
		$tipo="alert alert-danger";
		}
	}
?><!doctype html>
<html lang="en">
  <? require "head.php";
  $login=1;
  ?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Olvid&eacute; mi contrase&ntilde;a</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->


  <div style="display:flex; flex-direction:column; justify-content:center; align-items:center">
<div style="width:50%;padding:25px;">
    	
        	
			<?
            if ($msj) {
                ?>
                <center><div class="alert <?=$tipo?>" role="alert"><?=$msj;?></div></center>
                <? } ?>

            <h1 class="section-title" style="font-family: 'Oswald', sans-serif;">Ingrese los siguientes campos</h1>
            <form action="<?=$PHP_SELF?>" method="post" class="login-form">
              <div class="my-form-group">
                <input class="form-control" type="email" name="txtu" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                <label class="form-label" for="exampleInputEmail1">Email address</label>
              </div>

              <div style="padding-top:20px">
			<a href="login.php" class="my-a-login">Iniciar sesi&oacute;n</a>
            </div>

                <div class="upcomming-ticket text-center">
                    <input type="submit" class="my-button" value="Recuperar" name="enviar" />
                </div>
            </form>

        
    </div>
</div>






<footer class="footer">
        <ul class="my-webs">
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-instagram ig"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-google gl"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-twitter tw"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-vimeo vm"></i></a></li>
            <li><a href="#" class="icon-container"><i class="zmdi zmdi-pinterest ps"></i></a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Portada</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Nosotros</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Servicios</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Equipo</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contacto</a></li>
        </ul>
    
        <p>&copy;2023 Gonzalo Martos | All Rights Reserved</p>
  </footer>




</main>
	
    <script src="js/main.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    
<style>
    	@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');
        	/* ESTILOS PARA EL FORMULARIO comienzo */

.my-a-login{
    font-size:18px;
    font-family: 'Oswald', sans-serif;
 }

.my-a-login:hover{
    color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" :  "#5700e0" ?>;
 }


.my-form-group {
  position: relative;
  font-size: 15px;
  color:  <?php echo $_SESSION['skin']=="dark" ? "#fff" : "#666" ?>;
  font-family: 'Oswald', sans-serif;
}

.my-form-group + .my-form-group {
  margin-top: 30px;
}

.my-form-group .form-label {
  position: absolute;
  z-index: 1;
  left: 0;
  top: 5px;
  transition: .3s;
}

.my-form-group .form-control {
  width: 100%;
  position: relative;
  z-index: 3;
  height: 35px;
  background: none;
  border: none;
  padding: 5px 0;
  transition: .3s;
  border-bottom: 1px solid #777;
  color: #555;
}

.my-form-group .form-control:invalid {
  outline: none;
}

.my-form-group .form-control:focus,
.my-form-group .form-control:valid {
  outline: none;
  box-shadow: 0 1px <?php echo $_SESSION['skin']=="dark" ? "#daff06" : "#3b0082" ?>;
  border-color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" : "#3b0082" ?>;
}

.my-form-group .form-control:focus + .form-label,
.my-form-group .form-control:valid + .form-label {
  font-size: 13px;
  color: <?php echo $_SESSION['skin']=="dark" ? "#daff06" : "#3b0082" ?>;
  transform: translateY(-20px);
}
.login-form{
	background:<?php echo $_SESSION['skin']=="dark" ? "#17161a" : "#eae6f0" ?>;
	padding:20px;
	border:solid #000 2px;
  	box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
}
/* ESTILOS PARA EL FORMULARIO fim */

/* ESTILOS DEL FOOTER comienzo */
.footer {
            position: relative;
            width: 100%;
            background-color:<?php echo $_SESSION['skin']=="dark" ? "#050c40" :  "#3b0082"?>;
            min-height: 100px;
            padding: 20px 50px;
             display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .my-webs{
            display:flex;
            flex-direction:row;
        }


        .icon-container{
            display: inline-block;
            position: relative;
            padding:0;
            margin:10px
        }

        .icon-container i {
            transition: transform 0.5s ease-in-out;
            font-size:25px;
            color:#fff;

        }




        .ig:hover {
            color:#d75457;
            animation-duration: 1s;
            animation-name: jumpAndSpin;
 
        }

        @keyframes jumpAndSpin {
            0% {
                transform: translateY(0) rotate(0deg) ;
            }
  

            50% {
                transform: translateY(-3px) rotate(360deg) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100% {
                transform: translateY(0) rotate(360deg) ;
            }
        }



        .gl:hover {
            color:#fbbb00;
            animation-duration: 1s;
            animation-name: jump;
        }

        @keyframes jump {
            0% {
                transform: translateY(0) ;
            }
  
            25% {
                transform: translateY(-10px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            75% {
                transform: translateY(-5px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100%{
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
        }


        .tw:hover  {
            color:#1d9bf0;
            animation-duration: 1s;
            animation-name: leftAndRight;
        }

        @keyframes leftAndRight {
            0% {
                transform: translateX(0);
            }
  
            25%{
                transform: translateX(-5px);
            }
            50% {
                transform: translateX(5px);
            }

            100% {
                transform: translateX(0) ;

            }
        }


        .vm:hover  {
            transform:  rotate(360deg);
            color:#41b1db
        }

        .ps:hover  {
            color:#e60023;
            animation-duration: 0.8s;
            animation-name: circleMove;
        }

        @keyframes circleMove {
            0% {
                transform: translateX(0);
            }
  
            20%{
                transform: translateX(5px);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateX(-5px);
            }

            80%{
                transform: translateY(5px);
            }

            100%{
                transform: translate(0,0);
             }
        }

        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .menu__item {
            list-style: none;
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }

        .menu__link:hover {
            color:#daff06;
            transform:translateY(-5px)
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }
   /* ESTILOS DEL FOOTER fin */
</style>
  </body>
</html>
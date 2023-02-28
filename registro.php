<? require 'init.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$hoy=date("Y-m-d");
if ($_POST['enviar']) {
	$error=false;
	$enviarc=true;

	//validar usuario, existe?
	$sql="select * from personas where email='".$_POST['email']."'";
	$haymail=gfila($sql);
	if ($haymail) {
		//echo "hay mail"; exit();
		$error=true;
		$tipoerror="email";
		}
	if ($_POST['pass']!=$_POST['pass2']) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="pass";
		}

	if ($_POST['email']!=$_POST['email2']) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="email2";
		}

	if ($_POST['organizador']) {
		$chkorg=1;
		} else {
		$chkorg=0;
		}
/*	$sql="select * from personas where telefono='".$_POST['movil']."'";
	$haymovil=gfila($sql);
	if ($haymovil) {
		//echo "hay movil"; exit();
		$error=true;
		$tipoerror="movil";
		}*/
						
						
						
						
						
	//Import PHPMailer classes into the global namespace
	//These must be at the top of your script, not inside a function
	
	//Create an instance; passing `true` enables exceptions
	if (!$error) {
		$hash=md5(date("Y-m-d H:i:s").rand(0,99999));
		$rand=rand(1000,9999);
		$sql="insert into personas (nombre, telefono, email, pass, activo, timetohash, organizador) values ('".utf8d($_POST['tname'])."', '".$_POST['movil']."', '".$_POST['email']."', '".md5($pass)."', 1, '".date("Y-m-d H:i:s")."', ".$chkorg.")";
		//echo $sql; //exit();
		$idu=ginsert($sql);
		$msj= 'Se ha registrado correctamente';
		$alert="alert-success";

		$mail = new PHPMailer(true);
		
		try {
	
			//Server settings
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'www.ideasbinarias.net';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'envios@ideasbinarias.net';                     //SMTP username
			$mail->Password   = 'Azul2001%%';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;//465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('envios@ideasbinarias.net', 'Ud. se ha registrado en Valiticket');
			$para=strtolower($_POST['email']);
			$mail->addAddress($para);     //Add a recipient
			//$mail->addAddress("lic.diego.arce@gmail.com");     //Add a recipient
			//$mail->addAddress('ellen@example.com');               //Name is optional
			//$mail->addReplyTo('info@example.com', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			//Content
			$cuerpo ="<p>Bienvenido a  ".$_SERVER['HTTP_HOST'].": "."</p>";
			$cuerpo.="<p>Su nombre: ".$_POST['tname']."</p>";
			$cuerpo.="<p>Su email: ".$_POST['email']."</p>";
			$cuerpo.="<p>Su password: ".$_POST['pass']."</p>";

			$asunto="Registro a nombre de ".utf8d($_POST['tname']." y mail ". $_POST['email']).", desde el sitio web ".$_SERVER['HTTP_HOST'];
			$mail->isHTML(true);//Set email format to HTML
			$mail->Subject = $asunto;
			$mail->Body    = $cuerpo;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		
			$enviado=$mail->send();
			} catch (Exception $e) {
			$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			$alert="alert-danger";
			}
		} else {
		//echo "error";
		if ($tipoerror=="email") {
			$msj= 'El email especificado ya existe en nuestra base de datos!';
			$alert="alert-danger";
			}
		if ($tipoerror=="email2") {
			$msj= 'El email especificado deben coincidir en ambas cajas de texto';
			$alert="alert-danger";
			}
		if ($tipoerror=="pass") {
			$msj= 'La contrase&ntilde;a debe ser la misma en ambas cajas de texto!';
			$alert="alert-danger";
			}
		/*if ($error) {
			$msj= 'Error';
			$alert="alert-danger";
			}*/
		}
	}
?><!doctype html>
<html lang="en">
  <? require "head.php";
  $registro=1;
  ?>
  <body>
<? require "cabecera.php";?>

<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Registrate</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->


<div  style="display:flex; flex-direction:column; justify-content:center; align-items:center">
    	
        <div style="width:50%;padding:25px">
			<?
			if ($msj) {
            ?>
            <center><div class="alert <?=$alert?>" role="alert"><?=$msj;?></div></center>
            <? } ?>
			
            <h1 class="section-title" style="font-family: 'Oswald', sans-serif;">Rellene los siguientes campos</h1>
            <form action="registro.php" method="post" name="form" class="register-form">
              <div class="my-form-group">
				<input  class="form-control" type="text" name="tname" id="nya" aria-describedby="nya" required value="<?=$_POST['tname']?>">
				<label for="exampleInputEmail1" class="form-label">Apellido y Nombre</label>
              </div>

              <div class="my-form-group" >
				<input  class="form-control" type="email" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?=$_POST['email']?>">
                <label class="form-label" for="exampleInputEmail1">Email</label>
              </div>

              <div class="my-form-group" >
				<input  class="form-control" type="email" name="email2"  id="exampleInputEmail12" aria-describedby="emailHelp" required value="<?=$_POST['email2']?>" />
                <label class="form-label" for="exampleInputEmail1">Repita Email</label>
              </div>

              <div class="my-form-group" >
				<input  class="form-control" type="number" name="movil"  id="celular" aria-describedby="celular" required value="<?=$_POST['movil']?>">
                <label class="form-label" for="exampleInputEmail1">Celular</label>
              </div>

              <div class="my-form-group" >
				<input class="form-control" type="password" name="pass"  id="exampleInputPassword1" required />
                <label class="form-label" for="exampleInputPassword1">Password</label>
              </div>

              <div class="my-form-group" >
				<input class="form-control" type="password" name="pass2"  id="exampleInputPassword2" required />
                <label class="form-label" for="exampleInputPassword1">Repita Password</label>
              </div>
              <div class="form-group form-check">
              <!--captcha-->
<!--                <label for="chkorg" class="form-check-label"><input type="checkbox" name="organizador" id="chkorg" class="form-check-input" <? if ($_POST['organizador']) {?>checked<? } ?> /> <span style="line-height:55px;">Deseo ser Organizador</span></label>
<br>
-->               
              <!--captcha-->

			<div style="display:flex;flex-direction:row;align-items:center;margin-top:25px">
				<div class="checkbox-wrapper-10">
  					<input class="tgl tgl-flip" name="agree" id="agree" type="checkbox" <? if ($_POST['agree']) {?>checked<? } ?> onClick="show_botones();" />
  					<label class="tgl-btn" data-tg-off="Nop" data-tg-on="Síp!" for="agree"></label>
				</div>

				<span style="line-height:55px; margin-left:10px; font-family: 'Oswald', sans-serif;">Estoy de acuerdo con la <a href="">pol&iacute;tica de privacidad</a></span>
			</div>
        </div>

				<div id="botones" style="display:none;">
                <div class="upcomming-ticket text-center">
                    <input type="submit" class="my-button" value="Registrarme" name="enviar" />
                </div>
			<br><br>

			<?
			include('config-google-auth.php');
			
			$login_button = '';
			//Ancla para iniciar sesi�n
			//if (!isset($_SESSION['access_token'])) {
				$login_button = '<a href="' . $google_client->createAuthUrl() . '" class="my-button google-button">Registrarme con Google</a>';
                echo '<div align="center">' . $login_button . '</div>';
				//}
			?>
			</div>
			<br>
			<br>
			<a href="registro-organizador.php" class="register-by-organizer">Deseo registrarme como organizador de eventos</a>
			
            </form>

            </div>
       
   
</div>
<script>
function show_botones() {
	var check=document.getElementById("agree");
	//alert(check.checked);
	if (check.checked) {
		$("#botones").slideDown("slow");
		} else {
		$("#botones").slideUp("slow");
		}
	}
</script>



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
<!--    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    <style>
		@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');

		/* ESTILOS PARA EL FORMULARIO comienzo*/
  
    /* container de cada <input> y su <label> */
.my-form-group {
  position: relative;
  font-size: 15px;
  color:  <?php echo $_SESSION['skin']=="dark" ? "#fff" : "#666" ?>;
  font-family: 'Oswald', sans-serif;
  margin-top: 30px;
}
  
/* .my-form-group + .my-form-group {
  margin-top: 30px;
} */

/* estilos para el label */
.my-form-group .form-label {
  position: absolute;
  z-index: 1;
  left: 0;
  top: 5px;
  transition: .3s;
}

/* estilos para el input */
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

/* container principal de todo el formulario */
.register-form{
	background:<?php echo $_SESSION['skin']=="dark" ? "#17161a" : "#eae6f0" ?>;
	padding:20px;
	border:solid #000 2px;
  	box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
}




/* ESTILOS PARA BOTON CHECK  comienzo */
.checkbox-wrapper-10 .tgl {
    display: none;
  }
  .checkbox-wrapper-10 .tgl,
  .checkbox-wrapper-10 .tgl:after,
  .checkbox-wrapper-10 .tgl:before,
  .checkbox-wrapper-10 .tgl *,
  .checkbox-wrapper-10 .tgl *:after,
  .checkbox-wrapper-10 .tgl *:before,
  .checkbox-wrapper-10 .tgl + .tgl-btn {
    box-sizing: border-box;
  }
  .checkbox-wrapper-10 .tgl::-moz-selection,
  .checkbox-wrapper-10 .tgl:after::-moz-selection,
  .checkbox-wrapper-10 .tgl:before::-moz-selection,
  .checkbox-wrapper-10 .tgl *::-moz-selection,
  .checkbox-wrapper-10 .tgl *:after::-moz-selection,
  .checkbox-wrapper-10 .tgl *:before::-moz-selection,
  .checkbox-wrapper-10 .tgl + .tgl-btn::-moz-selection,
  .checkbox-wrapper-10 .tgl::selection,
  .checkbox-wrapper-10 .tgl:after::selection,
  .checkbox-wrapper-10 .tgl:before::selection,
  .checkbox-wrapper-10 .tgl *::selection,
  .checkbox-wrapper-10 .tgl *:after::selection,
  .checkbox-wrapper-10 .tgl *:before::selection,
  .checkbox-wrapper-10 .tgl + .tgl-btn::selection {
    background: none;
  }
  .checkbox-wrapper-10 .tgl + .tgl-btn {
    outline: 0;
    display: block;
    width: 4em;
    height: 2em;
    position: relative;
    cursor: pointer;
    -webkit-user-select: none;
       -moz-user-select: none;
        -ms-user-select: none;
            user-select: none;
  }
  .checkbox-wrapper-10 .tgl + .tgl-btn:after,
  .checkbox-wrapper-10 .tgl + .tgl-btn:before {
    position: relative;
    display: block;
    content: "";
    width: 50%;
    height: 100%;
  }
  .checkbox-wrapper-10 .tgl + .tgl-btn:after {
    left: 0;
  }
  .checkbox-wrapper-10 .tgl + .tgl-btn:before {
    display: none;
  }
  .checkbox-wrapper-10 .tgl:checked + .tgl-btn:after {
    left: 50%;
  }

  .checkbox-wrapper-10 .tgl-flip + .tgl-btn {
    padding: 2px;
    transition: all 0.2s ease;
    font-family: sans-serif;
    perspective: 100px;
  }
  .checkbox-wrapper-10 .tgl-flip + .tgl-btn:after,
  .checkbox-wrapper-10 .tgl-flip + .tgl-btn:before {
    display: inline-block;
    transition: all 0.4s ease;
    width: 100%;
    text-align: center;
    position: absolute;
    line-height: 2em;
    font-weight: bold;
    color: #fff;
    position: absolute;
    top: 0;
    left: 0;
    -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
    border-radius: 4px;
  }
  .checkbox-wrapper-10 .tgl-flip + .tgl-btn:after {
    content: attr(data-tg-on);
    background: #02C66F;
    transform: rotateY(-180deg);
  }
  .checkbox-wrapper-10 .tgl-flip + .tgl-btn:before {
    background: #FF3A19;
    content: attr(data-tg-off);
  }
  .checkbox-wrapper-10 .tgl-flip + .tgl-btn:active:before {
    transform: rotateY(-20deg);
  }
  .checkbox-wrapper-10 .tgl-flip:checked + .tgl-btn:before {
    transform: rotateY(180deg);
  }
  .checkbox-wrapper-10 .tgl-flip:checked + .tgl-btn:after {
    transform: rotateY(0);
    left: 0;
    background: #7FC6A6;
  }
  .checkbox-wrapper-10 .tgl-flip:checked + .tgl-btn:active:after {
    transform: rotateY(20deg);
  }
  /* ESTILOS PARA BOTON CHECK  fin */


/* ESTILOS EXTRA PARA EL BOTON DE REGISTRARTE CON GOOGLE comienzo */
.google-button{
	background:#dd4b39;
	 box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#ba4030 0 -3px 0 inset;
	 color: #fff;
}
.google-button:hover{
	box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #ba4030 0 -3px 0 inset;
	color:#fff
}
/* ESTILOS EXTRA PARA EL BOTON DE REGISTRARTE CON GOOGLE fin */


/* BOTON DE "REGISTRARME COMO ORGANIZADOR" comienzo */
.register-by-organizer {
  position: relative;
  color:<?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?>;
  display:inline-block;
  background:none;
  margin:30px;
  text-align:center;
  font-size:20px;
  border: solid <?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?> 3px;
  font-family: 'Oswald', sans-serif;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
  text-transform:uppercase;
  padding:10px
}

.register-by-organizer:hover{
  box-shadow: none;
  transition:1s;
  color:<?php echo $_SESSION['skin']=="dark" ? "#daff06" :"#5700e0"?>;
}
/* BOTON DE "REGISTRARME COMO ORGANIZADOR" fin */


/* ESTILOS PARA EL FOOTER comienzo */
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
/* ESTILOS PARA EL FOOTER fin */
        

	</style>

  </body>
</html>
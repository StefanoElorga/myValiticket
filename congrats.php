<? require 'init.php';

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	//Load Composer's autoloader
	require 'vendor/autoload.php';

?><!doctype html>
<html lang="en">
  <? require "head.php";
  $carrito=1;
  ?>
  <body>
<? require "cabecera.php";?>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style-jui.css">
<!--  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/jquery-ui.js"></script>
<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Le hemos enviado un mail</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->
<?

if ($_POST) {
	
	$mail = new PHPMailer(true);
	
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
	$mail->setFrom('envios@ideasbinarias.net', 'Ud. ha recibido una entrada de Valiticket');
	
	$me=0;
	foreach ($_SESSION['xentradas'] as $xe) {
		if ($_POST['email'.$me]!='') {
			//es un email?
			//suponinendo que sí
			try {
				$para=strtolower($_POST['email'.$me]);
				$mail->clearAddresses();
				$mail->addAddress($para);     //Add a recipient
				//$mail->addAddress("lic.diego.arce@gmail.com");     //Add a recipient
				//$mail->addAddress('ellen@example.com');               //Name is optional
				//$mail->addReplyTo('info@example.com', 'Information');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');
			
				//Content
				/*$cuerpo ="<p>Bienvenido a  ".$_SERVER['HTTP_HOST'].": "."</p>";
				$cuerpo.="<p>Su nombre: ".$_POST['tname']."</p>";
				$cuerpo.="<p>Su email: ".$_POST['email']."</p>";
				$cuerpo.="<p>Su password: ".$_POST['pass']."</p>";*/
				$cuerpo=$_SESSION['xentradas'][$me];
				$asunto="Valiticket le envia su entrada desde el sitio web ".$_SERVER['HTTP_HOST'];
				$mail->isHTML(true);//Set email format to HTML
				$mail->Subject = $asunto;
				$mail->Body    = $cuerpo;
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
				$enviado=$mail->send();
				//echo "aca<br>";
				}
				catch (Exception $e) {
				$msj= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				$alert="alert-danger";
				}
			}
		$me++;
		}
	
	
} else {
unset($_SESSION['carrito']);

}
?>

<div class="off-white ptb100">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            <h1 class="section-title">Compra exitosa!</h1>
            <center>
            	<div class="alert alert-success" role="alert">
                Su compra fue Exitosa!. Le hemos enviado por mail sus entradas.
                </div>
            </center>
            </div>
        </div>
    </div>
</div>
<?
//print_r($_SESSION['xentradas']);
?>
<div class="off-white ptb10" style="display:none;">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
<!--            <h1 class="section-title">Compra exitosa!</h1>-->
            <form method="post">
            <div>
            	<?
				$e=0;
                foreach ($_SESSION['xentradas'] as $xe) {//hay q usar el carro session y dps vaciarlo aca
					echo "<div>".$_SESSION['xtexto'][$e]."</div>";
				?>
                    Enviar entrada a:<br>
                    <input type="text" class="form-control" name="nombre<?=$e;?>" placeholder="Nombre" />
                    <input type="text" class="form-control" name="email<?=$e;?>" placeholder="Email" /><br>
	                <?
					$e++;
					}
					?>
            <center><input type="submit" class="btn btn-primary" /></center>
            </div><br><br>
            </form>
			</div>
        </div>
    </div>
</div>




<div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-area">
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-area">
                            <ul>
                                <li><a href=""><img src="imgs/pay-01.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-02.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-03.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-04.webp" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</main>
	
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    

  </body>
</html>
<?

session_start();

require_once("conexion/conexion.php");

require_once("conexion/funciones.php");

if ($_POST) {

	$link=conectar();

	$txtuser=mysqli_real_escape_string($link, $_POST['txtu']);

	$txtpass=mysqli_real_escape_string($link, $_POST['txtp']);

	$sql="select * from cs_admin where user='".$txtuser."'";

	//echo $sql; exit();

	$user=gfila($sql);

	

	if ($user) {

		if ($user['pass']==md5($txtpass)) {

			//adentro

			$_SESSION['logued']='auto0.com.ar';

			$_SESSION['usuario']=$txtuser;
			$_SESSION['cusuario']=$user['controlusuarios'];
			irphp("listado-personas.php");

			}

			else {

			//afuera

			$_SESSION['logued']='';

			session_destroy();

			}

		}

	}



?><!doctype html>

<html lang="en">

<?

require 'headers.php';

?>

  <body>

<div class="container">

  <!-- Content here -->

	<?

    //require 'menu.php';

    ?>

<br>

<br>



    <form action="<?=$PHP_SELF?>" method="post" name="formlogin">

      <div class="form-group">

        <label for="exampleInputEmail1">Nombre de usuario</label>

        <input name="txtu" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario" required>

      </div>

      <div class="form-group">

        <label for="exampleInputPassword1">Contrase&ntilde;a</label>

        <input name="txtp" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>

      </div>

      <div class="form-group form-check">

      </div>

      <button type="submit" class="btn btn-primary" name="acceder">Acceder</button>

      <input type="hidden" value="enviar" name="enviar" />

    </form>



</div>

<?

require 'js-includes.php';

?>

</body>

</html>
<? require 'init.php';
$sqlmail="select email from personas where idlanding=".$_POST['idl'];
$mail=gfila($sqlmail);
//echo $mail['email'];
if ($mail) {
//editar
	$sql="update personas set 
			email='".$_POST['nmail']."'
			where idlanding='".$_POST['idl']."'";
	//echo $sql; exit();
	$idu=gexecute($sql);
	//echo $idu;
	if ($idu==0) {
	echo $_POST['nmail'];
	?><br><button class="btn btn-success btn-sm" onClick="gomail(<?=$_POST['idl']?>);">Editar</button>	
	<?
	} else {
	if ($idu==-1) {
	echo $mail['email'];
	?>
	<br>No se pudo cambiar el mail<br><button class="btn btn-success btn-sm" onClick="gomail(<?=$_POST['idl']?>);">Editar</button>
	<? 
		} else {
		//es 1
		echo $_POST['nmail'];
		?>
		<br><button class="btn btn-success btn-sm" onClick="gomail(<?=$_POST['idl']?>);">Editar</button>
		<?
		}
	} ?>
<? } else {
//insertar
$hash=md5(date("Y-m-d H:i:s").rand(0,99999));
$rand=rand(1000,9999);
$sql="select seccion from cs_entidades where id=".$_POST['idl'];
//echo $sql;
$entidad=gfila($sql);
$nombree=$entidad['seccion'];
$sql="insert into personas (nombre, email, hash, sms, pass, activo, timetohash, idlanding) values ('".$nombree."', '".$_POST['nmail']."', '".$hash."', '".$rand."', '".$hash."', 1, '".date("Y-m-d H:i:s")."', ".$_POST['idl'].")";
//echo $sql; //exit();
$idu=ginsert($sql);
//echo $idu; exit();
if ($idu==0) {
	?>No pudo crearse el mail
	<br><button class="btn btn-danger btn-sm" onClick="gomail(<?=$_POST['idl']?>);">Agregar mail</button>
	<?
	} else {
	echo $_POST['nmail'];
?><br><button class="btn btn-success btn-sm" onClick="gomail(<?=$_POST['idl']?>);">Editar</button>
<? } } ?>
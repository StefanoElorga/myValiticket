<?
require_once("init.php");
if ($_SESSION['cusuario']!=1) irphp('index.php');
if ($_POST['enviar']) {
	$nom=utf8d(addslashes($_POST['tnombre']));
	$pass=substr($_POST['tpass'],0,10);
	$pass2=substr($_POST['tpass2'],0,10);
	
	//validar
	$valido=true;
	if ($nom=='') $valido=false;
	if ($pass=='') $valido=false;
	if ($pass!=$pass2) $valido=false; 
	if (strlen($pass)<6) $valido=false;
	if ($_POST['cs']==1) {
		$cs=1;
		} else {
		$cs=0;
		}
	if ($valido) {
			$sql="insert into cs_admin (user, pass, controlusuarios) values ('$nom', '".md5($pass)."', $cs)";
			//echo $sql;
			$cc=gexecute($sql);
			}
	if ($cc>=1) {
		$ok=1;
		irphp("usuarios.php?ok=1");
		}
		else {
		$msj="Hubo un error al agregar!<br />Verifique los campos! O las contrase&ntilde;as no coinciden o el usuario ya existe o la contrase&ntilde;a es menor a 6 letras";	
		$error=true; $class="alert-warning";
		}
	}

?><!doctype html>
<html lang="en">
<?
require 'headers.php';
?>
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<?
if ($_GET['ok']==1) {
	$msj="Se agreg&oacute; correctamente";
	}
?>
<body>
<div class="container-fluid">
<? require "menu.php";?>
<h3>AGREGAR USUARIO ADMINISTRADOR</h3>
<div class="alert <?=$class;?>" role="alert"><?=$msj;?></div>
<form action="<?=$PHP_SELF?>" method="post" name="form-ag-unidad">
<table class="table table-striped">
  <tr>
    <td align="right">Nombre:</td>
    <td><input name="tnombre" type="text" id="tit" size="50" value="<?=utf8d($_POST['tnombre'])?>"  class="form-control"  /></td>
  </tr>
  <tr>
    <td><div align="right">Contraseña:</div></td>
    <td><input name="tpass" type="password" id="tpass" value="<?=($_POST['tpass'])?>" size="50" maxlength="10"  class="form-control"  /></td>
  </tr>
  <tr>
    <td><div align="right">Repetir contraseña:</div></td>
    <td><input name="tpass2" type="password" id="tpass2" value="<?=($_POST['tpass2'])?>" size="50" maxlength="10"  class="form-control"  /></td>
  </tr>
  <tr>
    <td><div align="right">Control de usuarios (es admin)</div></td>
    <td><div align="left">
      <input type="checkbox" name="cs" value="1">
    </div></td>
  </tr>

  <tr>
    <td colspan="2" align="center"><input type="submit" name="enviar" id="enviar" value="Guardar" class="btn btn-success" />&nbsp;
      
      <input type="button" name="cancelar" id="cancelar" value="Cancelar" onClick="location.href='usuarios.php';" class="btn btn-warning" /></td>
  </tr>
</table>


</form>
</div>
</body>
</html>
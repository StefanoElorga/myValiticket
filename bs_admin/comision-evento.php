<?
require_once("init.php");

if ($_POST['enviar']) {
	$cometa=addslashes($_POST['cometa']);
	
	//validar
	$valido=true;
	if (!is_numeric($cometa)) $valido=false;
	if ($valido) {
			//borra el viejo
			$sql="delete from comisiones where idevento=".$_POST['hid'];
			gexecute($sql);
			//nueva cometa
			$sql="insert into comisiones (porcentaje, idevento) values (".$cometa.", ".$_POST['hid'].")";
			//echo $sql;
			$cc=ginsert($sql);
			}
	if ($cc>=1) {
		$ok=1;
		irphp("listado-eventos.php?ok=1");
		}
		else {
		$msj="Hubo un error!";	
		$error=true; $class="alert-warning";
		}
	} else {
	$_POST['hid']=$_GET['id'];
	
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
<?
require "menu.php";
$sql="select * from eventos where id=".$_GET['id'];
$evento=gfila($sql);

$sql="select * from comisiones where idevento=".$_GET['id'];
$cometa=gfila($sql);
?>
<div class="alert <?=$class;?>" role="alert"><?=$msj;?></div>

<h3>Comisi&oacute;n para evento: <?=utf8($evento['titulo']);?></h3>
<form action="<?=$PHP_SELF?>" method="post" name="form-ag-unidad">
<table class="table table-striped">
  <tr>
    <td align="right">Comisi&oacute;n:</td>
    <td><input name="cometa" type="decimal" id="cometa" value="<?=$cometa['porcentaje']?>"  class="form-control" required  /></td>
  </tr>

  <tr>
    <td colspan="2" align="center"><input type="hidden" value="<?=$_POST['hid']?>" name="hid" /><input type="submit" name="enviar" id="enviar" value="Guardar" class="btn btn-success" />&nbsp;
      
      <input type="button" name="cancelar" id="cancelar" value="Cancelar" onClick="location.href='listado-eventos.php';" class="btn btn-warning" /></td>
  </tr>
</table>


</form>
</div>
</body>
</html>
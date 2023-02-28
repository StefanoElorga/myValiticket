<?
require_once("init.php");

if ($_POST['enviar']) {
	//print_r($_POST);
	$cupon=addslashes($_POST['cupon']);
	$cometa=$_POST['cometa'];
	$cantidad=addslashes($_POST['cantidad']);
	if ($_POST['chkactivo']) {
		$activo=1;
		} else {
		$activo=0;
		}
	
	//validar
	$valido=true;
	if (!is_numeric($cometa)) $valido=false;
	if (!is_numeric($cantidad)) {
		$valido=false;
		} else {
		if ($cantidad<=$_POST['aplicados']) {
			$valido=false;
			}
		}
	
	if ($valido) {
			//si cupon ya existe se modifica, sino se inserta
			$sql="select * from cupones where idevento=".$_POST['hid'];
			$acupon=gfila($sql);
			if ($acupon) {
				//cupon ya existe
				$sql="update cupones set cupon='".$cupon."', porcentaje=".$cometa.", cantidad=".$cantidad.", activo=".$activo.", idplatea=".$_POST['idplatea']." where idevento=".$_POST['hid'];
				
				$cc=gexecute($sql);
				} else {
				//nuevo cupon
				$sql="insert into cupones (cupon, porcentaje, cantidad, aplicados, activo, idevento, idplatea) values ('".$cupon."', ".$cometa.", ".$cantidad.", 0, ".$activo.", ".$_POST['hid'].", ".$_POST['idplatea'].")";
				//echo $sql;
				$cc=ginsert($sql);
				}
			//echo $sql; exit();
			}
		
	if ($cc>=1) {
		$ok=1;
		//irphp("listado-eventos.php?ok=1");
		$msj="Agregado o Modificado correctamente!";	
		$class="alert-success";

		}
		else {
		if ($cc==0) {
			$msj="Modificado correctamente!";	
			$class="alert-success";
			} else {
			$msj="Hubo un error!";	
			$error=true; $class="alert-warning";
			}
		}
	} else {
	//nopost
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

$sql="select * from cupones where idevento=".$_GET['id'];
$cometa=gfila($sql);
?>
<div class="alert <?=$class;?>" role="alert"><?=$msj;?></div>

<h3>Comisi&oacute;n para evento: <?=utf8($evento['titulo']);?></h3>
<form action="<?=$PHP_SELF?>" method="post" name="form-ag-unidad">
<table class="table table-striped">
  <tr>
    <td align="right">Cup&oacute;n:</td>
    <td><input name="cupon" type="text" id="cupon" value="<?=$cometa['cupon']?>"  class="form-control" required maxlength="15"  /></td>
  </tr>
  <tr>
    <td align="right">Comisi&oacute;n:</td>
    <td><input name="cometa" type="decimal" id="cometa" value="<?=$cometa['porcentaje']?>"  class="form-control" required  /></td>
  </tr>
  <tr>
    <td align="right">Cantidad</td>
    <td><input name="cantidad" type="number" id="cantidad" value="<?=$cometa['cantidad']?>"  class="form-control" required  /></td>
  </tr>
  <tr>
    <td align="right">Platea a aplicar</td>
	<?
    $sql="select * from evento_plateas where idevento=".$_GET['id'];
	$plateas=gtabla($sql);
	?>
    <td><select name="idplatea" class="form-control">
    		<? foreach ($plateas as $row) {?>
    		<option value="<?=$row['id']?>" <? if ($cometa['idplatea']==$row['id']) {?>selected<? } ?>><?=$row['nombre']?></option>
            <? } ?>
    	</select>
    </td>
  </tr>
  <tr>
    <td align="right">Aplicados</td>
    <td><input name="aplicados" type="number" id="aplicados" value="<?=$cometa['aplicados']?>"  class="form-control" readonly  /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><label><input type="checkbox" value="1" name="chkactivo" <? if ($cometa['activo']) {?>checked<? } ?> /> Activo</label></td>
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
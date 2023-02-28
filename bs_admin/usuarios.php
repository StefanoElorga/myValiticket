<?
require_once("init.php");
if ($_SESSION['cusuario']!=1) irphp('index.php');
$cantpp=15;
$pag=$_GET['pag'];
if ($pag=='') {
	$pag=1;
	}
$pagmy=($pag-1)*$cantpp;
$sqlp="select * from cs_admin order by user limit $pagmy, $cantpp";
$registros=gtabla($sqlp);

$totalreg=gfila("select count(*) as total from cs_admin");
$total=$totalreg['total'];
$cantp=ceil($total/$cantpp);
?><!doctype html>
<html lang="en">
<?
require 'headers.php';
?>
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<?
if ($_GET['ok']==1) {
	$msj="Se agreg&oacute; correctamente";
	$error=false; $class="alert-success";
	}
if ($_GET['ok']==2) {
	$msj="Se modific&oacute; correctamente";
	$error=false; $class="alert-success";
	}

?>
<body>
<div class="container-fluid">
<? require "menu.php";?>
<h3>Usuarios administradores de la p&aacute;gina</h3>
<div class="alert <?=$class;?>" role="alert"><?=$msj;?></div>
<form action="<?=$PHP_SELF?>" method="get" name="formlistado">
<div class="table-responsive">
<table class="table table-striped">

  <tr>
    <td colspan="5" align="center"><a href="agregar-usuario.php" class="btn btn-primary">Agregar</a></td>
  </tr>
<?
if ($registros) {
	foreach ($registros as $regi) {
	?>
  <tr class="trover">
    <td height="23"><?=$regi['user']?></td>
    <td width="62">
	<div class="custom-control custom-switch">
	  <input type="checkbox" class="custom-control-input" id="Switch<?=$regi['user']?>" <? if ($regi['controlusuarios']==1) {?>checked="checked"<? } ?> onClick="cambiar2admin('<?=$regi['user']?>', this.checked);">
	  <label class="custom-control-label" for="Switch<?=$regi['user']?>" >Admin</label>
	</div>
	</td>
    <td width="81" align="center"><a href="modificar-usuario.php?id=<?=$regi['user']?>" class="btn btn-warning">Contrase&ntilde;a</a></td>
    <td width="81" align="center"><? if ($regi['user']!='admin') {?><a href="eliminar-usuario.php?id=<?=$regi['user']?>" class="btn btn-danger" onClick="return confirm('¿Está seguro?');">Eliminar</a><? } ?></td>
  </tr>
  <? 
	}
	//paginador
	?>
    <tr>
      <td colspan="4" align="center">
      <?
      if ($pag>=2) {
	  ?>
    <a href="?id=<?=$id?>&pag=<?=$pag-1?>">&lt;&lt; </a><? } ?>
    P&aacute;gina <?=$pag?> 
    <? if ($pag<$cantp) {?>
    <a href="?id=<?=$id?>&pag=<?=$pag+1?>">&gt;&gt;</a><? } ?>    </td></tr>
    <?
  }
  else {?>
  <tr>
    <td colspan="5" align="center"><?="No hay Unidades a mostrar"?></td>
  </tr>
  <?
  }
  ?>
  <tr>
    <td colspan="5" align="center">&nbsp;</td>
  </tr>
</table>
</div>
</form>
</div>
<script>
function cambiar2admin(id, valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'cambiar2admin.php',
          data: {id: id, ivalor: ivalor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}

</script>
</body>
</html>
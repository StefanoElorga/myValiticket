<?
require_once("init.php");
if ($_SESSION['cusuario']!=1) irphp('index.php');
?><!doctype html>
<html lang="en">
<?
require 'headers.php';
?>
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<?
if ($_POST) {
	$_POST['linkadduser']=utf8d(addslashes($_POST['linkadduser']));
	$_POST['linkdonar']=utf8d(addslashes($_POST['linkdonar']));
	$_POST['linkasesor']=utf8d(addslashes($_POST['linkasesor']));
	
	$sql="update cs_config set valor='".$_POST['linkadduser']."' where param='pie_adduser'";
	gexecute($sql);
	$sql="update cs_config set valor='".$_POST['linkdonar']."' where param='pie_donar'";
	gexecute($sql);
	$sql="update cs_config set valor='".$_POST['linkasesor']."' where param='pie_asesor'";
	$succ=gexecute($sql);
	
	//echo $succ;
if ($succ>=0) {
	$msj="Se modific&oacute; correctamente";
	$error=false; $class="alert-success";
	}
	}


if ($_GET['ok']==2) {
	$msj="Se modific&oacute; correctamente";
	$error=false; $class="alert-success";
	}

?>
<body>
<div class="container-fluid">
<? require "menu.php";?>
<h3>Configuraci&oacute;n de la p&aacute;gina</h3>
<div class="alert <?=$class;?>" role="alert"><?=$msj;?></div>
<form action="<?=$PHP_SELF?>" method="post" name="formlistado">
<div class="table-responsive">
<?
$sql="select * from cs_config where param='pie_adduser'";
$adduser=gfila($sql);
$sql="select * from cs_config where param='pie_asesor'";
$asesor=gfila($sql);
$sql="select * from cs_config where param='pie_donar'";
$donar=gfila($sql);
?>
<table class="table table-striped">
  <tr>
    <td colspan="5" align="center">Links de pie de p&aacute;gina</td>
  </tr>
  <tr class="trover">
    <td height="30%"><div align="right">Link Agregar Usuario</div></td>
    <td width="70%">
	<input type="text" class="form-control" value="<?=$adduser['valor'];?>" name="linkadduser" />	</td>
  </tr>

  <tr class="trover">
    <td height="30%"><div align="right">Link Donar</div></td>
    <td width="70%">
	<input type="text" class="form-control" value="<?=$donar['valor'];?>" name="linkdonar" />	</td>
  </tr>

  <tr class="trover">
    <td height="30%"><div align="right">Link Asesor</div></td>
    <td width="70%">
	<input type="text" class="form-control" value="<?=$asesor['valor'];?>" name="linkasesor" />	</td>
  </tr>

  <tr class="trover">
    <td height="30%"><div align="right">&nbsp;</div></td>
    <td width="70%">
	<?
	$sql="select * from cs_config where param='vistaPC'";
	$row=gfila($sql);
	?>
	<div class="custom-control custom-switch">
			  <input type="checkbox" class="custom-control-input" id="Switchpie" <? if ($row['valor']==1) {?>checked="checked"<? } ?> onClick="vistaPC(this.checked);">
			  <label class="custom-control-label" for="Switchpie" >Permitir vista del sitio en PC</label>
			</div>
	</td>
  </tr>


  <tr>
    <td colspan="5" align="center"><input type="submit" class="btn btn-success" value="Guardar" /></td>
  </tr>
</table>
</div>
</form>
</div>
<script>
function vistaPC(valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'vistaPC.php',
          data: {ivalor: ivalor},
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
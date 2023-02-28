<? require 'init.php';?><!doctype html>

<html lang="en">

<?

require 'headers.php';

?>
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
  <body>

<div class="container-fluid">

  <!-- Content here -->

	<?

    require 'menu.php';

	$search=$_GET['search'];

	if ($search=='') {
		$sql="select * from cs_secciones_portada order by id desc";
		}
	//echo $sql;
	$clientes=gtabla($sql);
    if ($clientes) {
	?>
	<div class="row">
	<table class="table table-striped"><tr><td>
	Elija tipo de Entidad:
	<?
	$sql="select * from entidadtipo";
	$tipos=gtabla($sql);
	foreach ($tipos as $type) {
	?>
	<label><input name="etipos" type="radio" id="radio3" value="<?=$type['id'];?>" <? if ($_POST['etipos']==$type['id']) {?>checked="checked" <? } ?> onClick="select_child(this.value);"/> <?=$type['nombre'];?></label>&nbsp;
	<? } ?><label><input name="etipos" type="radio" id="radio3" value="0" <? if ($_POST['etipos']==0) {?>checked="checked" <? } ?> onClick="select_child(this.value);"/> Home</label>&nbsp;
	</td>
	</tr>
	<tr>
	<td>
	<div id="combo_e">
	</div>
	</td></tr>
	</table>
	<div id="table_listado">
        
	</div>
    </div>

	<?

    }

	?>

</div>

<?

require 'js-includes.php';

?>
<script>
function select_child(valor) {
	//alert(valor);
	$("#combo_e").html("");
	//alert ("lalaal");
        $.ajax({
          url:'select_child-lsp.php',
          data: {valor: valor},
          type:'post',
          success:function(data)
          {
            $("#combo_e").html(data);
          }
        })
	}

function refresh_listado(valor) {
	//alert(valor);
	$("#table_listado").html("");
	//alert ("lalaal");
        $.ajax({
          url:'table-listado.php',
          data: {valor: valor},
          type:'post',
          success:function(data)
          {
            $("#table_listado").html(data);
          }
        })
	}
select_child(0);
//refresh_listado(7);
</script>
</body>

</html>
<? require 'init.php';
//echo $_SESSION['cusuario'];
//print_r($_GET);
?><!doctype html>
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
	?>
  <h3>Listado de Personas</h3>
    <?
	$search=$_GET['search'];
	if ($_GET['visibles']=="") {
		$_GET['visibles']=1;
		}
	if ($_GET['visibles']==1) {
		$sqlvisible=" and organizador=1";
		} else {
		$sqlvisible=" and organizador=0";
		}
	if ($_GET['visibles']==-1) {
		$sqlvisible="";
		}

	if ($search=='') {
		if ($_GET['idreferido']=='') {
			$sql="select * from personas where 1 $sqlvisible $sqltipo $useradmin $orderby";
			} 

		}
	else {
	if (is_numeric($search)) {
		$sql="select * from personas where telefono like '%$search%' $useradmin ";			
		} else {
		$sql="select * from personas where nombre like '%".utf8d($search)."%' $useradmin ";			
		}
		}
	//echo $sql;
	$clientes=gtabla($sql);
    if ($clientes) {
	?>
	<div class="row">
	<div id="filtros"><form method="get" name="form" id="form">
		<div class="row">
			<div class="col-md-6"> 
			<select class="form-control-lg" name="visibles" onChange="this.form.submit();">
			<!--<option value="-1" <? if ($_GET['visibles']=="-1") {?>selected="selected"<? } ?>>Todos</option>-->
			<option value="1" <? if ($_GET['visibles']==1) {?>selected="selected"<? } ?>>Organizadores</option>
			<option value="0" <? if ($_GET['visibles']==0) {?>selected="selected"<? } ?>>No Organizadores</option>
			</select></div>
			
			Buscar:
			<div class="col-md-4">
            <input class="form-control-lg" type="search" aria-label="Buscar" name="search" value="<?=$_GET['search']?>" placeholder="Nombre"> <? if ($_GET['search']!='' or $_GET['idreferido']!='') {?><a href="listado-personas.php" class="btn btn-warning">Ver todos</a><? }?>
			</div>
		</div></form>
	</div>

	</div>
	<div class="row">
		<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
              <th scope="col">Nombre</th>
			  <th scope="col">Mail</th>
			  <th scope="col">Celular</th>
              <th scope="col"></th>
			  <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
		<?
		$r=0;
		foreach ($clientes as $row) {
			$r++;
        ?>
            <tr class="over">
              <th scope="row"><?=$r;?></th>
              <th scope="row"></th>
              <td><?=utf8($row['nombre']);?></td>
			  <td><small style=""><span id="mymail<?=$row['id'];?>"><? echo $row['email']; ?></span></small></td>
				<td><?=$row['telefono']?></td>
              <td>
					<div class="custom-control custom-switch">
					  <input type="checkbox" class="custom-control-input" id="Switch<?=$row['id']?>" <? if ($row['organizador']==1) {?>checked="checked"<? } ?> onClick="cambiar_visibilidad(<?=$row['id']?>,this.checked);">
					  <label class="custom-control-label" for="Switch<?=$row['id']?>" >Organizador</label>
					</div>
				</td>
              <td><? if ($_SESSION['cusuario']==1) {?>
              <a href="borrar-entidad.php?idu=<?=$row['id']?>" class="btn btn-danger" onClick="return confirm('Atenci&oacute;n! Est&aacute; seguro que desea borrar esta persona?? (<?=utf8($row['nombre'])?>)');">Deshabilitar</a><? } ?></td>
            </tr>
         <?
         } 
		 ?>
          </tbody>
        </table>
		</div>
    </div>
	<?
    }
	else { ?>
		 <div class="alert alert-primary" role="alert">Sin coincidencias <a href="listado-personas.php" class="btn btn-primary">Ver todos</a></div>
		 <?
		 }
	?>
</div>
<?
require 'js-includes.php';
?>
<script>
function cambiar_visibilidad(id, valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'cambiar-visibilidad.php',
          data: {id: id, ivalor: ivalor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}

function asistencia(id, valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'asistente.php',
          data: {id: id, ivalor: ivalor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}
	
function pie(id, valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'pie.php',
          data: {id: id, ivalor: ivalor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}

function volver(id, valor) {
		//alert(id);
		if (valor) {
			ivalor=1;
			} else {
			ivalor=0;
			}
		//alert(ivalor);
        $.ajax({
          url:'volver.php',
          data: {id: id, ivalor: ivalor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}



function gomail(idlanding) {
		//alert(idlanding);
        $.ajax({
          url:'gomail.php',
          data: {idl: idlanding},
          type:'post',
          success:function(data)
          {
            $("#mymail"+idlanding).html(data);
          }

        })
	}
function guardarmail(idlanding) {
		//alert(idlanding);
		nmail=$("#txtmm"+idlanding).val();
        $.ajax({
          url:'guardarmail.php',
          data: {nmail: nmail, idl: idlanding},
          type:'post',
          success:function(data)
          {
            $("#mymail"+idlanding).html(data);
          }

        })
	}
</script>
</body>
</html>
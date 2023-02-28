<? require 'init.php';?><!doctype html>
<html lang="en">
<?
require 'headers.php';
?>
  <body>
<div class="container-fluid">
  <!-- Content here -->
	<?
    require 'menu.php';
	$search=$_GET['search'];
	if ($search=='') {
		$sql="select * from personas order by nombre";
		}
	else {
		$sql="select * from personas where nombre like '%$search%' order by nombre";
		}
	//echo $sql;
	$clientes=gtabla($sql);
    if ($clientes) {
	?>
	<div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Apellido y Nombres</th>
              <th scope="col">Mail</th>
              <th scope="col">Celular</th>
              <th scope="col">Mail<br>valido</th>
              <th scope="col">Cel<br>valido</th>
              <th scope="col">#</th>
              <th scope="col">#</th>
              <th scope="col">#</th>
              <th scope="col">#</th>
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
              <td><?=utf8($row['nombre']);?></td>
              <td><?=$row['email'];?></td>
              <td><?=$row['telefono'];?></td>
              <td><? if ($row['validado']==1) {?><i class="fas fa-check-square"></i><? } ?></td>
              <td><? if ($row['validadosms']==1) {?><i class="fas fa-check-square"></i><? } ?></td>
              <td><a href="billetera.php?idu=<?=$row['id']?>" class="btn btn-primary">Billetera</a></td>
              <td><a href="datos-extras.php?idu=<?=$row['id']?>" class="btn btn-primary">Datos Extras</a></td>
				<?
				if ($row['esproductor']==1) {
					$class="btn btn-warning";
					$no="Quitar productor";
					} else {
					$class="btn btn-info";
					$no='Hacerlo productor';
					}
				?>
              <td><a href="es-productor.php?idp=<?=$row['id']?>" class="<?=$class;?>"><?=$no;?></a></td>
              <td><a href="borrar-cliente.php?idu=<?=$row['id']?>" class="btn btn-danger" onClick="return confirm('Atenci&oacute;n! Est&aacute; seguro que desea borrar este cliente?? (<?=utf8($row['nombre'])?>)');">Eliminar</a></td>
            </tr>
         <?
         }
		 ?>
          </tbody>
        </table>
    </div>
	<?
    }
	?>
</div>
<?
require 'js-includes.php';
?>
</body>
</html>
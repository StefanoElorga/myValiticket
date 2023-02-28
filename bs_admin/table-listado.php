<?
require 'init.php';
$sql="select * from cs_secciones_portada where id_pro=".$_POST['valor']." order by orden";
//echo $sql;
$childs=gtabla($sql);
//echo stripAccents(utf8d($_POST['valor']));
if ($childs) {
?><div class="table-responsive">
<table class="table table-striped">

          <thead>

            <tr>

              <th scope="col">#</th>

              <th scope="col">Titulo</th>

              <th scope="col">Texto</th>

              <th scope="col">Imagen intro </th>

              <th scope="col">Imagen principal </th>

              <th scope="col">Visible</th>

              <th scope="col">Pesta&ntilde;a</th>
			  <th scope="col">Privada</th>
              <th scope="col">Editar</th>
            </tr>
          </thead>

          <tbody>

		<?

		$r=0;

		foreach ($childs as $row) {

			$r++;

        ?>

            <tr class="over">

              <th scope="row"><?=$row['id'];?></th>

              <td><?=utf8($row['titulo']);?></td>

              <td><?=$row['texto'];?></td>

              <td><img src="../multimedia/imagenes/cs_portada/<?=$row['imagen1']?>" width="100" /></td>

              <td><img src="../multimedia/imagenes/cs_portada/<?=$row['imagen2']?>" width="200" /></td>

              <td>
				<div class="custom-control custom-switch">
				  <input type="checkbox" class="custom-control-input" id="Switch<?=$row['id']?>" <? if ($row['visible']==1) {?>checked="checked"<? } ?> onClick="cambiar_visibilidad(<?=$row['id']?>,this.checked);">
				  <label class="custom-control-label" for="Switch<?=$row['id']?>" >Visible</label>
				</div>

			  
			  <? if ($row['visible']==2) {?>
			  
			  
			  <i class="fas fa-check-square"></i><? } ?></td>

              <td>
				<div class="custom-control custom-switch">
				  <input type="checkbox" class="custom-control-input" id="Switchtab<?=$row['id']?>" <? if ($row['pestania']==1) {?>checked="checked"<? } ?> onClick="cambiar_visibilidad_tab(<?=$row['id']?>,this.checked);">
				  <label class="custom-control-label" for="Switchtab<?=$row['id']?>" >Visible</label>
				</div>
				</td>
              <td>
				<div class="custom-control custom-switch">
				  <input type="checkbox" class="custom-control-input" id="Switchpriv<?=$row['id']?>" <? if ($row['privada']==1) {?>checked="checked"<? } ?> onClick="cambiar_privacidad(<?=$row['id']?>,this.checked);">
				  <label class="custom-control-label" for="Switchpriv<?=$row['id']?>" >Privada</label>
				</div>
				</td>
              <td><a href="modificar-caja.php?id=<?=$row['id'];?>"><i class="far fa-edit"></i></a></td>
            </tr>

         <?

         }

		 ?>
          </tbody>
        </table>
</div>
<? } ?>
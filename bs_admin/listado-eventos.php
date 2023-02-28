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
  <h3>Listado de Eventos</h3>
    <?
	$search=$_GET['search'];
	if ($_GET['aprobados']=="") {
		$_GET['aprobados']=1;
		} 

	switch ($_GET['aprobados']) {
		case 1:
		$sqlvisible=" and aprobada=1 and fecha>='".date("Y-m-d")."'";
		break;
		case 0:
		$sqlvisible=" and aprobada=0";
		break;
		case -1:
		$sqlvisible="";
		break;
		case 3:
		$sqlvisible=" and fecha<'".date("Y-m-d")."'";
		break;
		}
	$orderby=" order by fecha desc";


	if ($search=='') {
		//main
		$sql="select * from eventos where 1 $sqlvisible $sqltipo $useradmin $orderby";
		} else {
		if (is_numeric($search)) {
			$sql="select * from eventos where id=$search $useradmin ";
			} else {
			$sql="select * from eventos where titulo like '%".utf8d($search)."%' $useradmin ";
			}
		}
	//echo $sql;
	$clientes=gtabla($sql);

	?>
	<div class="row">
	<div id="filtros"><form method="get" name="form" id="form">
		<div class="row">
			<div class="col-md-6"> 
			<select class="form-control-lg" name="aprobados" onChange="this.form.submit();">
			<option value="-1" <? if ($_GET['aprobados']=="-1") {?>selected="selected"<? } ?>>Todos</option>
			<option value="1" <? if ($_GET['aprobados']==1) {?>selected="selected"<? } ?>>Aprobados</option>
			<option value="0" <? if ($_GET['aprobados']==0) {?>selected="selected"<? } ?>>No Aprobados</option>
            <option value="3" <? if ($_GET['aprobados']==3) {?>selected="selected"<? } ?>>Caducados</option>
			</select></div>
			
			Buscar:
			<div class="col-md-4">
            <input class="form-control-lg" type="search" aria-label="Buscar" name="search" value="<?=$_GET['search']?>" placeholder="Titulo Evento"> <? if ($_GET['search']!='' or $_GET['idreferido']!='') {?><a href="listado-eventos.php" class="btn btn-warning">Ver todos</a><? }?>
			</div>
		</div></form>
	</div>

	</div>
    <? if ($clientes) { ?>
	<div class="row">
		<div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
              <th scope="col">Nombre</th>
			  <th scope="col">Portada</th>
			  <th scope="col">Comisi&oacute;n</th>
			  <th scope="col">Cup&oacute;n</th>
			  <th scope="col">Plateas</th>
			  <th scope="col">Fecha Evento</th>
              <th scope="col">Organizador</th>
			  <th scope="col"></th>
			  <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
		<?
		$r=0;
		foreach ($clientes as $row) {
			$r++;
			$sql="select * from comisiones where idevento=".$row['id'];
			$cometa=gfila($sql);
			$sql="select * from cupones where idevento=".$row['id'];
			$cupon=gfila($sql);
			
        ?>
            <tr class="over">
              <th scope="row"><?=$r;?></th>
              <th scope="row"></th>
              <td><?=utf8($row['titulo']);?></td>
			  <td>
              	<small><label><input type="radio" value="" onClick="aportada('2', '<?=$row['id'];?>')" name="rad<?=$row['id']?>" <? if ($row['portada']==2) {?>checked<? } ?> />Slider Principal</label></small><br>
              	<small><label><input type="radio" value="" onClick="aportada('1', '<?=$row['id'];?>')" name="rad<?=$row['id']?>" <? if ($row['portada']==1) {?>checked<? } ?>/>Slider Secundario</label></small><br>
             	<small><label><input type="radio" value="" onClick="aportada('0', '<?=$row['id'];?>')" name="rad<?=$row['id']?>" <? if ($row['portada']==0) {?>checked<? } ?>/>Sin destacar</label></small><br>
                </td>
			  <td><? if ($cometa) { echo $cometa['porcentaje']."%<br>"; } else { echo "0%<br>"; } ?><a class="btn btn-primary btn-sm" href="comision-evento.php?id=<?=$row['id'];?>">Comisi&oacute;n</a></td>
			  <td><? if ($cupon) { echo $cupon['cupon']."<br>"; } else { echo ""; } ?><a class="btn btn-warning btn-sm" href="cupones-evento.php?id=<?=$row['id'];?>">+ Cup&oacute;n</a></td>
			  <td><a href="<?=$row['id'];?>" data-toggle="modal" data-target="#exampleModal<?=$row['id']?>">M&aacute;s Info</a>
              <?
			  $sqlplateas="select * from evento_plateas where idevento=".$row['id']." and aprobada=0";
			  $hayplateasnuevas=gfila($sqlplateas);
			  //echo $sqlplateas;
              if ($row['aprobada']==1 and $hayplateasnuevas) {?>
              	<a href="aprobar-plateas.php?idevento=<?=$row['id']?>" class="btn btn-danger btn-sm">Aprobar plateas nuevas</a><? } ?>              </td>
				<td><?=tfecha($row['fecha'])." ".$row['hora'];?></td>
              <td>
              <?
              $sql="select * from personas where id=".$row['idprop'];
			  $orga=gfila($sql);
			  echo utf8($orga['nombre'])."<br>";
			  echo "<span style='font-size:12px;'>".$orga['telefono']."</span>";
			  ?>              </td>
              <td>
					<div class="custom-control custom-switch" style="display:none;">
					  <input type="checkbox" class="custom-control-input" id="Switch<?=$row['id']?>" <? if ($row['organizador']==1) {?>checked="checked"<? } ?> onClick="cambiar_visibilidad(<?=$row['id']?>,this.checked);">
					  <label class="custom-control-label" for="Switch<?=$row['id']?>" >Organizador</label>
					</div>
                    <? if ($row['aprobada']==0) {?><a href="aprobar-evento.php?id=<?=$row['id']?>" class="btn btn-primary">Aprobar</a><? } ?>				</td>
              <td><? if ($_SESSION['cusuario']==1) {?>
              <a href="aborrar-entidad.php?idu=<?=$row['id']?>" class="btn btn-danger" onClick="return confirm('Atenci&oacute;n! Est&aacute; seguro que desea borrar esta persona?? (<?=utf8($row['nombre'])?>)');">Deshabilitar</a><? } ?>              </td>
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
		 <div class="alert alert-primary" role="alert">Sin coincidencias <a href="listado-eventos.php?aprobados=-1&search=" class="btn btn-primary">Ver todos</a></div>
		 <?
		 }
	?>
</div>
<?
require 'js-includes.php';
?>
<?
if ($clientes) {
foreach ($clientes as $row) {
?>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?=$row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?=utf8($row['titulo']);?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Fecha y hora:
      	<b><? $explota=explode("-",$row['fecha']); echo $explota[2]." de ". mes($explota[1])." de ".$explota[0].", ".$row['hora']."hs.";?></b><br>
      Imagen Principal:<br>
		<img src="../multimedia/eventos/<?=$row['imgmain']?>-recorte.jpg" width="300" /><br>
      Imagen Plateas:<br>
		<img src="../multimedia/eventos/<?=$row['imgsec']?>" width="300" /><br>
		Descripci&oacute;n:<br>
		<small><?=utf8($row['descripcion'])?></small>
       <table style="width:100%;" class="table table-striped"><tr><td><b>Nombre</b></td><td align="right"><b>Cantidades</b></td><? if ($row['aprobada']==1) {?><td align="right"><b>Vendidas</b></td><? } ?><td align="right"><b>Precio</b></td></tr><?
	   $sql="select * from evento_plateas where idevento=".$row['id'];
	   //echo $sql;
	   $plateas=gtabla($sql);
	   $enrojo=0;
	   foreach ($plateas as $platea) {
	   	if ($platea['aprobada']==0) {
			$estilo='style="color:red;"';
			$enrojo=1;
			} else {
			$estilo='style="color:black;"';
			}
       ?><tr <?=$estilo;?>>
       <td><?=utf8($platea['nombre'])?></td>
       <td align="right"><?=$platea['cantidad']?></td>
       <? if ($row['aprobada']==1) {
	   $sql="select sum(vendida) as cantv from entradas where vendida=1 and idp=".$platea['id'];//
	   //echo $sql;
	   $cvendidas=gfila($sql);
	   ?><td align="right"><? if ($cvendidas['cantv']) echo $cvendidas['cantv']; else echo "0";?></td><? }?>
       <td align="right">$ <?=$platea['precio'];?></td>
       <h6></h6>
       </tr><? } ?></table>
       <? if ($enrojo==1) {?><span style="color:red;">* en rojo las plateas nuevas</span><? } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<? } } ?>
<script>
function aportada(valor, id) {
		//alert(id);
        $.ajax({
          url:'aportada.php',
          data: {id: id, valor: valor},
          type:'post',
          success:function(data)
          {
            //$("#link").val(data);
          }

        })
	}


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
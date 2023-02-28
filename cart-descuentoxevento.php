<? require 'init.php';?><!doctype html>
<html lang="en">
  <? require "head.php";
  $carrito=1;
  ?>
  <body>
<? require "cabecera.php";?>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/style-jui.css">
<!--  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>-->
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/jquery-ui.js"></script>
<script>
function agregar(idplatea, cantidad) {
	var nc="eplatea"+idplatea;
	var tv=document.getElementById(nc).value;
	//alert (tv);
	if (cantidad==1) {
		tv++;
		} else {
		if (tv>0) {
			tv--;
			}
		}
	$("#"+nc).val(tv);
	//alert(tv);
	$.ajax({
	type: "POST",
	url: "agregar.php",
	data: 'hidplatea='+idplatea+"&quanty="+tv,
	success: function(datos){
		//$('#stotal').html(datos);
		}
	});
	if (tv==0) {
		location.href="cart.php";
		}
	}
</script>
<main role="main">

<div class="breadcumb-area bg-overlay">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="active">Carrito</li>
                </ol>
            </div>
        </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <!-- /.container -->


<div class="off-white ptb100">
	<div class="container">
    	<div class="row">
        	<div class="col-12">
            <a name="cart"></a>
            <h1 class="section-title">Listado de entradas a comprar</h1>
            <? if ($_SESSION['carrito']) {?>
			<div class="table-responsive">
<?
if ($_POST) {
	//aplicar cupones si los hubiera
	for ($c=1; $c<=$_POST['hccupones']; $c++) {
		$nc="cupon".$c;
		if ($_POST[$nc]!='') {
			$cupon=$_POST[$nc];
			//hay un cupon con este code?
			$sql="select * from cupones where cupon='".$cupon."' and activo=1";
			//echo $sql;
			$haycupon=gfila($sql);
			//print_r($haycupon);
			//no hay que aplicar de más
			//no hay que aplicar 2 veces a la misma persona
			$control=true;
			
			if ($haycupon) {
				$sql="select count(*) as aplicados from cupones_aplicados where idevento=".$haycupon['idevento'];
				$aplicados=gfila($sql);
				if ($aplicados['aplicados']>=$haycupon['cantidad']) {
					$control=false;
					//echo "iguala al limite";
					}
				
				$sql="select * from cupones_aplicados where idevento=".$haycupon['idevento']." and idpersona=".$_SESSION['idu']." and idcupon=".$haycupon['id'];
				$fueaplicado=gfila($sql);				
				if ($fueaplicado) {
					$control=false;
					//echo "fue aplicado";
					}
				}
			if ($haycupon and $control) {//hay cupon
				$_SESSION['cupon'.$haycupon['idevento']]=$haycupon['cupon'];
				//echo "aplicar"; //exit();
				}
			}
		}
	}
?>
			<form action="" method="post">
			<table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Evento</th>
                  <th scope="col">Platea</th>
                  <th scope="col"><div align="center" style="width:70px;">Cantidad</div></th>
                  <th scope="col"><div align="right">Subtotal</div></th>
				  <th scope="col"><div align="right"></div></th>
                </tr>
              </thead>
              <tbody>
		<? $q=0; $sum=0; $arreventos=array(); $lastev=0; $sumaeve=array();
        foreach ($_SESSION['carrito'] as $indx => $item) {
			$q++;
			$sql="select * from evento_plateas where id=".$indx;
			$platea=gfila($sql);
			
			$sql="select id, titulo from eventos where id=".$platea['idevento'];
			$evento=gfila($sql);
			//print_r($evento);
			if (!in_array($platea['idevento'], $arreventos)) {
			//if ($lastev!=$platea['idevento']) {
				//$lastev=$platea['idevento'];
				$arreventos[]=$platea['idevento'];
				}
		?>
                <tr>
                  <th scope="row"><?=$q;?></th>
                  <td><a href="evento.php?id=<?=$evento['id']?>"><?=utf8($evento['titulo'])?></a></td>
                  <td><a href="evento.php?id=<?=$evento['id']?>"><?=utf8($platea['nombre'])?></a></td>
                  <td align="right"> <a href="cart.php"><input type="button" class="btn-chico" value="-" onClick="agregar('<?=$platea['id']?>', '-1')" /></a> <input type="text" value="<?=$item?>" id="eplatea<?=$platea['id']?>" readonly class="btn-chico" style="text-align:center;" /> <a href="cart.php"><input type="button" class="btn-chico" value="+" onClick="agregar('<?=$platea['id']?>', '1')" /></a> </td>
                  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($item*$platea['precio'],2,",",""); $sum+=$item*$platea['precio']; $sumaeve[$evento['id']]+=$item*$platea['precio']; ?></span></b></td>
				  <td><a href="delete.php?id=<?=$platea['id']?>"><i class="zmdi zmdi-delete" style="font-size:20px;"></i></a></td>
                </tr>
			<? } ?>
                <tr style="background-color:#FFCCCC;">
                  <th colspan="4"><div align="right">SubTotal a abonar $</div></th>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($sum,2,",","") ?></span></b></td>
				  <td>&nbsp;</td>
                </tr>
			<?
			
			$cupon=true;
			if ($cupon) {
				//print_r($arreventos);
				$ccupones=0; $sumdescuento=0;
				foreach ($arreventos as $even) {
					$ccupones++;
					$sql="select id, titulo from eventos where id=".$even;
					$evento=gfila($sql);

					$sql="select * from cupones where idevento='".$even."' and activo=1";
					//echo $sql;
					$excupon=gfila($sql);
					if (isset($_SESSION['cupon'.$even])) {
						//echo "lalala";
							}
					if ($excupon or isset($_SESSION['cupon'.$even])) {
					?>
				<tr>
                  <th colspan="3"><div align="left"><span style="float:left;">Cup&oacute;n de descuento: <br>
				  <input type="text" class="form-control" name="cupon<?=$ccupones;?>" style="width:250px; float:left;" <? if (isset($_SESSION['cupon'.$even])) {
				  //buscar cupon y descontar
					$sql="select * from cupones where cupon='".$_SESSION['cupon'.$even]."' and activo=1";
					//echo $sql;
					$descuento=gfila($sql);
					//echo $descuento['porcentaje'];

				  ?>value="<?=$_SESSION['cupon'.$even];?>" readonly=""<? } ?> /><? if (!isset($_SESSION['cupon'.$even])) {?>&nbsp;<input type="submit" class="btn btn-info" value="Aplicar" style="height:35px; font-size:16px;" /><? } ?>
                  <span style="font-size:10px; font-weight:normal;"><?=utf8($evento['titulo']);?></span></span><br>
				  </div></th>
				  <td align="right"><?=$descuento['porcentaje'];?>%</td>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; color:#339900;">$<?=number_format($sumaeve[$even]*$descuento['porcentaje']/100,2,",",""); $sum-=$sumaeve[$even]*$descuento['porcentaje']/100;?></span></b></td>
				  <td>&nbsp;</td>
				</tr>
				<?		}
					}
					?>
					<input type="hidden" name="hccupones" value="<?=$ccupones;?>" />
					<?
				} 
				?>
<!--                <tr>
                  <th colspan="4"><div align="right">Total a abonar con descuentos aplicados $</div></th>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($sum,2,",","") ?></span></b></td>
				  <td>&nbsp;</td>
                </tr>
-->

			<?
			$cupon=true;
			if ($cupon) {
				//print_r($arreventos);
				$ccupones=0;
				foreach ($arreventos as $even) {
					$ccupones++;
					$sql="select id, titulo from eventos where id=".$even;
					$evento=gfila($sql);
					$sql="select * from comisiones where idevento=".$even;
					//echo $sql;
					$descuento=gfila($sql);
					if ($descuento) {
					?>
				<tr>
                  <th colspan="3"><div align="left"><span style="float:left;">Comisiones: <br><span style="font-size:10px; font-weight:normal;"><?=utf8($evento['titulo']);?></span></span>
				  </div></th>
				  <td align="right"><?=$descuento['porcentaje'];?>%</td>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; color:#FF0000;">$<?=number_format($sumaeve[$even]*$descuento['porcentaje']/100,2,",",""); $sum+=$sumaeve[$even]*$descuento['porcentaje']/100;?></td>
				  <td>&nbsp;</td>
				</tr>
				<?		}
					}
				} 
				?>
                <tr style="background-color:#99FF99;">
                  <th colspan="4"><div align="right">Total a abonar $</div></th>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($sum,2,",","") ?></span></b></td>
				  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table>
			</form>
			</div>
            <center>
            	<?
				//print_r($sumaeve);
                if (is_numeric($_SESSION['idu'])) {
				?>
                <a href="cerrar.php" class="btn-def bnt-2">Comprar</a>
                <? } else {
				$_SESSION['from']="login";
				?>
                <a href="login.php" class="btn-def bnt-2">Iniciar sesi&oacute;n</a>
                <? } ?>
            </center>
			<? } else {?>
			Su carrito est&aacute; vac&iacute;o
			<? } ?>
            </div>
        </div>
    </div>
</div>
<style>
.btn-chico {
	margin:0px;
	border-radius:15px;
	border:0px;
	padding:0px;
	height:25px;
	width:20px;
	line-height:0px;
	}
</style>





<div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-area">
                            <ul>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-vimeo"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-area">
                            <ul>
                                <li><a href=""><img src="imgs/pay-01.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-02.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-03.webp" alt=""></a></li>
                                <li><a href=""><img src="imgs/pay-04.webp" alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</main>
	
    <!-- Optional JavaScript; choose one of the two! -->


    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
    
    

  </body>
</html>
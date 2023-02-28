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


<div class="off-white ptb100" style="padding:35px">

    	
        	<div class="col-12" >
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
			//no hay que aplicar de m�s
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
              
              <tbody>
		<? $q=0; $sum=0; $arreventos=array(); $lastev=0; $sumaeve=array();
		//$sum es el total a cobrar
		
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
            <div class="cart-cards">
                <a href="evento.php?id=<?=$evento['id']?>"><?=utf8($evento['titulo'])?></a>
                <a href="evento.php?id=<?=$evento['id']?>"><?=utf8($platea['nombre'])?></a>

                <div>
                <a href="cart.php"><input type="button" class="btn-chico" value="-" onClick="agregar('<?=$platea['id']?>', '-1')" /></a> <input type="text" value="<?=$item?>" id="eplatea<?=$platea['id']?>" readonly class="btn-chico" style="text-align:center;" /> <a href="cart.php"><input type="button" class="btn-chico" value="+" onClick="agregar('<?=$platea['id']?>', '1')" /></a>
                </div>

                <b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($item*$platea['precio'],2,",",""); $sum+=$item*$platea['precio']; $sumaeve[$evento['id']]+=$item*$platea['precio']; ?></span></b>
                <a href="delete.php?id=<?=$platea['id']?>"><i class="zmdi zmdi-delete" style="font-size:20px;"></i></a>
            </div>
                
			<? } ?>

            <div style="background-color:red">
                <p>SubTotal a abonar $</p>
                <b><span style="font-family:'Courier New', Courier, monospace; ">$<?=number_format($sum,2,",","") ?></span></b>
            </div>    

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
						//echo $sql="select * from cupones where cupon='".$_SESSION['cupon'.$even]."' and activo=1";;
					?>
				<tr>
                  <th colspan="3"><div align="left"><span style="float:left;">Cup&oacute;n de descuento: <br>
				  <input type="text" class="form-control" name="cupon<?=$ccupones;?>" style="width:250px; float:left;" <? if (isset($_SESSION['cupon'.$even])) {
				  //buscar cupon y descontar
					$sql="select * from cupones where cupon='".$_SESSION['cupon'.$even]."' and activo=1";
					//echo $sql;
					$descuento=gfila($sql);
					//echo $descuento['porcentaje'];
					//echo $descuento['idplatea']; exit();
				  ?>value="<?=$_SESSION['cupon'.$even];?>" readonly=""<? } ?> /><? if (!isset($_SESSION['cupon'.$even])) {?>&nbsp;<input type="submit" class="btn btn-info" value="Aplicar" style="height:35px; font-size:16px;" /><? } ?>
                  <span style="font-size:10px; font-weight:normal;"><?=utf8($evento['titulo']);?></span></span><br>
				  </div></th>
				  <td align="right"><?=$descuento['porcentaje'];?>%</td>
				  <td align="right"><b><span style="font-family:'Courier New', Courier, monospace; color:#339900;">
				  <?
				  //s�lo se debe aplicar el descuento a una entrada y a una platea
				  if (isset($_SESSION['carrito'][$descuento['idplatea']])) {
				  	$sql="select * from evento_plateas where id=".$descuento['idplatea'];
					$aplatea=gfila($sql);
					$precioentrada=$aplatea['precio'];
					//echo $precioentrada;
				  	$adescontar=$precioentrada*$descuento['porcentaje']/100;
					}
				  ?>
				  $<?=number_format($adescontar,2,",",""); $sum-=$adescontar;?>
				  </span></b></td>
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
					<?
                    if (1==1) {//ojo en local no anda
					require_once __DIR__ . "/mercadopago/vendor/autoload.php";
                    // Agrega credenciales
                    MercadoPago\SDK::setAccessToken("APP_USR-5928348539970896-100723-72de34ccf0adfb5d4ce719ee3c18cf0e-833921102");
                    // Crea un �tem en la preferencia
                    
                    $preference = new MercadoPago\Preference();
                    // Crea un �tem en la preferencia
                    $item = new MercadoPago\Item();
                    $item->title = 'Valiticket';
                    $item->quantity = 1;
                    $item->picture_url = $web."app/imgs/logo.png";
                    $item->unit_price = $sum;
                    
                    $preference->items = array($item);
                    
                    /*
                    $preference->payment_methods = array(
                        "excluded_payment_methods"=> array(
                            "id"=>"oxxo"
                        ),
                        "excluded_payment_types"=> array (
                            "id"=>"cash"
                            )
                        );
                    */

					$preference->payment_methods = array(
					  "excluded_payment_methods" => array(
						array("id" => "rapipago")
					  ),
					  "excluded_payment_methods" => array(
						array("id" => "pagofacil")
					  ),
					  "installments" => 1
					);
			
					$preference->binary_mode = true;
            

                    $preference->back_urls = array(
                        "success" => "https://ideasbinarias.net/valiticket/congrats.php",
                        "failure" => "https://ideasbinarias.net/valiticket/pago-rechazado.php",
                        "pending" => "https://ideasbinarias.net/valiticket/pago-pendiente.php"
                    );
			
					$preference->notification_url = "https://ideasbinarias.net/valiticket/notificacion-ipn.php";
					$preference->external_reference=date("Y-m-d-H:i:s").rand(1000, 9999);
					$er=$preference->external_reference;
					$preference->save();
			
					$fecha=date("Y-m-d");
					$hora=date("H:i:s");
					$id_pedido = ginsert("INSERT INTO carrito_pedidos (id_pedido, id_cliente, fecha, hora, estado, preference_id, estado_pago, idventa, external_reference) VALUES (NULL, '".$_SESSION['idusuario']."', '".$fecha."', '".$hora."', '0', '".$preference->id."', '0', '', '".$er."')");
					$_SESSION['preferencia']=$preference->id;
					}
					//guardar el carro
					guardar_carro_temporal($arreventos);
           
                
                ?>
                <a href="<?php echo $preference->init_point; ?>" class="btn btn-primary " role="button" id="showcartas" style="visibility: visible;margin-top: 0px;background-color: #d03010;font-weight: bold;letter-spacing: 4px;border-radius: 3px;">PAGAR</a>
                <? //<a href="cerrar.php" class="btn-def bnt-2">Comprar</a> ?>
                <? } else {
				$_SESSION['from']="login";
				?>
                <a href="login.php" class="my-button">Iniciar sesi&oacute;n</a>
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
<?
function guardar_carro_temporal($arreventos) {
	//$_SESSION['idu']
	foreach ($_SESSION['carrito'] as $indx => $item) {
		$q++;
		$sql="select * from evento_plateas where id=".$indx;
		$platea=gfila($sql);
		
		$sql="select id, titulo from eventos where id=".$platea['idevento'];
		$evento=gfila($sql);
		//print_r($evento);
		$sql="insert into temp_carro (idevento, idplatea, idcliente, cantidad, fecha, preferencia) values (".$platea['idevento'].", ".$indx.", ".$_SESSION['idu'].", ".$item.", '".date("Y-m-d H:i:s")."', '".$_SESSION['preferencia']."')";
		ginsert($sql);
		}
	foreach ($arreventos as $arrai) {
		if ($_SESSION['cupon'.$arrai]) {
			//echo "cupon".$arrai;
			$sql="insert into temp_cupones (cupon, idevento, idpersona, preferencia) values ('".$_SESSION['cupon'.$arrai]."', ".$arrai.", ".$_SESSION['idu'].", '".$_SESSION['preferencia']."')";
			ginsert($sql);
			}

		}


	}
?>




<footer class="footer">
    <ul class="my-webs">
        <li><a href="#" class="icon-container"><i class="zmdi zmdi-instagram ig"></i></a></li>
        <li><a href="#" class="icon-container"><i class="zmdi zmdi-google gl"></i></a></li>
        <li><a href="#" class="icon-container"><i class="zmdi zmdi-twitter tw"></i></a></li>
        <li><a href="#" class="icon-container"><i class="zmdi zmdi-vimeo vm"></i></a></li>
        <li><a href="#" class="icon-container"><i class="zmdi zmdi-pinterest ps"></i></a></li>
    </ul>
    <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#">Portada</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Nosotros</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Servicios</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Equipo</a></li>
            <li class="menu__item"><a class="menu__link" href="#">Contacto</a></li>
        </ul>
    <p>&copy;2023 Gonzalo Martos | All Rights Reserved</p>
</footer>



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
    
    
<style>

@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');


.cart-cards{
  display:flex;
  flex-direction:row;
  justify-content:space-around;
  align-items:center;
  width:95%;
  height:150px;
  margin-bottom:25px ;
  border-radius:20px;
  transition: 1s;
  /* opacity: 0; */
  /* transform: translateY(50%); */
  /* overflow: hidden; */
  position: relative;
  background-color: <?php echo $_SESSION['skin']=="dark" ? "#17161a" :  "#eae6f0" ?>;
  box-shadow: <?php echo $_SESSION['skin']=="dark" ? "rgba(218, 255, 6, 0.4) 5px 5px, rgba(218, 255, 6, 0.3) 10px 10px, rgba(218, 255, 6, 0.2) 15px 15px, rgba(218, 255, 6, 0.1) 20px 20px, rgba(218, 255, 6, 0.05) 25px 25px;" :  "rgba(87, 0, 224, 0.4) 5px 5px, rgba(87, 0, 224, 0.3) 10px 10px, rgba(87, 0, 224, 0.2) 15px 15px, rgba(87, 0, 224, 0.1) 20px 20px, rgba(87, 0, 224, 0.05) 25px 25px;" ?>;
}



/* EMPIEZA EL FOOTER */
.footer {
            position: relative;
            width: 100%;
            background-color:<?php echo $_SESSION['skin']=="dark" ? "#050c40" :  "#3b0082"?>;
            min-height: 100px;
            padding: 20px 50px;
             display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .my-webs{
            display:flex;
            flex-direction:row;
        }


        .icon-container{
            display: inline-block;
            position: relative;
            padding:0;
            margin:10px
        }

        .icon-container i {
            transition: transform 0.5s ease-in-out;
            font-size:25px;
            color:#fff;

        }




        .ig:hover {
            color:#d75457;
            animation-duration: 1s;
            animation-name: jumpAndSpin;
 
        }

        @keyframes jumpAndSpin {
            0% {
                transform: translateY(0) rotate(0deg) ;
            }
  

            50% {
                transform: translateY(-3px) rotate(360deg) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100% {
                transform: translateY(0) rotate(360deg) ;
            }
        }



        .gl:hover {
            color:#fbbb00;
            animation-duration: 1s;
            animation-name: jump;
        }

        @keyframes jump {
            0% {
                transform: translateY(0) ;
            }
  
            25% {
                transform: translateY(-10px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            75% {
                transform: translateY(-5px) ;
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }

            100%{
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
            }
        }


        .tw:hover  {
            color:#1d9bf0;
            animation-duration: 1s;
            animation-name: leftAndRight;
        }

        @keyframes leftAndRight {
            0% {
                transform: translateX(0);
            }
  
            25%{
                transform: translateX(-5px);
            }
            50% {
                transform: translateX(5px);
            }

            100% {
                transform: translateX(0) ;

            }
        }


        .vm:hover  {
            transform:  rotate(360deg);
            color:#41b1db
        }

        .ps:hover  {
            color:#e60023;
            animation-duration: 0.8s;
            animation-name: circleMove;
        }

        @keyframes circleMove {
            0% {
                transform: translateX(0);
            }
  
            20%{
                transform: translateX(5px);
            }

            40% {
                transform: translateY(-5px);
            }

            60% {
                transform: translateX(-5px);
            }

            80%{
                transform: translateY(5px);
            }

            100%{
                transform: translate(0,0);
             }
        }

        .menu {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
            flex-wrap: wrap;
        }

        .menu__item {
            list-style: none;
        }

        .menu__link {
            font-size: 1.2rem;
            color: #fff;
            margin: 0 10px;
            display: inline-block;
            transition: 0.5s;
            text-decoration: none;
            opacity: 0.75;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }

        .menu__link:hover {
            color:#daff06;
            transform:translateY(-5px)
        }

        .footer p {
            color: #fff;
            margin: 15px 0 10px 0;
            font-size: 1rem;
            font-weight: 400;
            font-family: 'Oswald', sans-serif;
        }

</style>

  </body>
</html>
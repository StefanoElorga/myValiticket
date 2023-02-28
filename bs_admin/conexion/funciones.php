<?
require_once("conexion.php");
$host=$_SERVER['HTTP_HOST'];
if (strpos($_SERVER['HTTP_HOST'],"server")===false) {
	$home="https://".$_SERVER['HTTP_HOST']."/";
	}
	else {
	$home="http://".$_SERVER['HTTP_HOST']."/valiticket/";
	}
function gtabla($query)
       {
//		   echo $query;
               $link = conectar();
               $result=mysqli_query($link, $query);
			   if ($result) {
				   while($row = mysqli_fetch_array($result)) {
						   $datos[] = $row;
				   }
				   mysqli_free_result($result);
			   }
               mysqli_close($link);
               return $datos;
       }

function gfila($query)
       {
               $link = conectar();
               $result=mysqli_query($link, $query);
               if ($result) {
				   $row = mysqli_fetch_array($result);
				   $datos = $row;
				   mysqli_free_result($result);
			   }
               mysqli_close($link);
               return $datos;
       }

function gexecute($query)
       {
               $link = conectar();
               $result = mysqli_query($link, $query);
               $ret = mysqli_affected_rows($link);
               //mysql_free_result($result);
               mysqli_close($link);
               return $ret;
       }

function ginsert($query)
       {
               $link = conectar();
               $result = mysqli_query($link, $query);
               $ret = mysqli_insert_id($link);
               //mysql_free_result($result);
               mysqli_close($link);
               return $ret;
       }

function getRowCount($query)
       {
               $link = conectar();
               $result = mysqli_query($link, $query);
               return mysqli_num_rows($result);
       }
function ir($pag) {
	echo "<script>location.href='".$pag."';</script>";
}

function irphp($pag) {
	header("location: ".$pag);
}

function avisar($msj) {
	echo "<script>alert('".$msj."');</script>";
}
function utf8 ($frase) {
	$frase=utf8_encode($frase);
	return $frase;
}
function utf8d ($frase) {
	$frase=utf8_decode($frase);
	return $frase;
}

function redimensionar($type, $img_original, $destino, $img_nueva_anchura, $img_nueva_calidad,$nombre_foto)
{
		if(file_exists($img_original)) 
		{
			// crear imagen desde original
			$type=strtolower($type);
			switch($type)
			{
				case 'jpeg': $img = imagecreatefromjpeg($img_original); break;
				case 'jpg': $img = imagecreatefromjpeg($img_original); break;
				case 'png': $img = imagecreatefrompng($img_original); break;
				case 'gif': $img = imagecreatefromgif($img_original); break;
				case 'wbmp': $img = imagecreatefromwbmp($img_original); break ;
			}
		} 
		
		if(!empty($img)) {
		$new_w_R = ImageSX($img);
		$new_h_R = ImageSY($img);
		$coef=$new_w_R/$new_h_R;
		$img_nueva_altura =(int)(($img_nueva_anchura / $new_w_R)*$new_h_R);			
		$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
		
		imagecopyresampled($thumb,$img,0,0,0,0,$img_nueva_anchura,$img_nueva_altura,ImageSX($img),ImageSY($img));//$img_nueva_altura
		imagejpeg($thumb,$destino.$nombre_foto,$img_nueva_calidad);
		}
}

function redimensionar_central($type, $img_original, $destino, $img_nueva_anchura, $img_nueva_calidad,$nombre_foto)
{
		if(file_exists($img_original)) 
		{
			// crear imagen desde original
			$type=strtolower($type);
			switch($type)
			{
				case 'jpeg': $img = imagecreatefromjpeg($img_original); break;
				case 'jpg': $img = imagecreatefromjpeg($img_original); break;
				case 'png': $img = imagecreatefrompng($img_original); break;
				case 'gif': $img = imagecreatefromgif($img_original); break;
				case 'wbmp': $img = imagecreatefromwbmp($img_original); break ;
			}
		} 
		
		if(!empty($img)) {
		$new_w_R = ImageSX($img);
		$new_h_R = ImageSY($img);
		$coef=$new_w_R/$new_h_R;
		$img_nueva_altura_posible =(int)(($img_nueva_anchura / $new_w_R)*$new_h_R);			
		$img_nueva_altura=575;
		$dife=$img_nueva_altura_posible-$img_nueva_altura; //exit();
		$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
		
		imagecopyresampled($thumb,$img,0,-intval($dife/2),0,0,$img_nueva_anchura,$img_nueva_altura+intval($dife/2)+100,ImageSX($img),ImageSY($img));//$img_nueva_altura
		imagejpeg($thumb,$destino.$nombre_foto,$img_nueva_calidad);
		}
}


function recortar_cuadrado($type, $img_original, $destino, $img_nueva_anchura, $img_nueva_calidad,$nombre_foto)
{
		if(file_exists($img_original)) 
		{
			// crear imagen desde original
			//echo extension($img_original); exit();
/*			$type=strtolower($type);
			switch($type)
			{*/
				//case 'jpeg': $img = imagecreatefromjpeg($img_original); break;
				//case 'jpg':
				$img = imagecreatefromjpeg($img_original); //break;
				/*case 'png': $img = imagecreatefrompng($img_original); break;
				case 'gif': $img = imagecreatefromgif($img_original); break;
				case 'wbmp': $img = imagecreatefromwbmp($img_original); break ;
			}*/
		} 
		
		if(!empty($img)) {
		$new_w_R = ImageSX($img);
		$new_h_R = ImageSY($img);
		$coef=$new_w_R/$new_h_R;
		$img_nueva_altura =(int)(($img_nueva_anchura / $new_w_R)*$new_h_R);	
		$img_nueva_altura=$img_nueva_anchura;
		
		$thumb = imagecreatetruecolor($img_nueva_anchura,$img_nueva_altura);
		imagecopyresampled($thumb,$img,-250,0,0,0,$img_nueva_anchura+350,$img_nueva_altura,ImageSX($img),ImageSY($img));
		imagejpeg($thumb,$destino.$nombre_foto,$img_nueva_calidad);
		}
}


function extension($arch) {
	$ext=pathinfo($arch);
	return strtolower($ext['extension']);
}

function cortar_texto($vble, $canti) {
	$avble=explode(" ",$vble);
	$cant=count($avble);
	$texto="";
	for ($x=1; $x<=$canti;$x++) {
		$texto.=$avble[$x-1]." ";
	}
	return $texto."..";
}

function randomText($length) {
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    for($i=0;$i<$length;$i++) {
      $key .= $pattern{rand(0,35)};
    }
    return $key;
}

$tweb="Administraci&oacute;n del sitio ".$_SERVER['HTTP_HOST'];

function get_url_ytb($cadena) {
//si tiene iframe
$cadena=stripslashes($cadena);
//if (eregi("iframe", $cadena) or eregi("object", $cadena)) {
//if (strpos("iframe", $cadena) ){
if (preg_match('/'."iframe".'/i', $cadena)) {
	//echo "iframe true";
		$explota=explode(" ", $cadena);
			foreach($explota as $linea) {
				if (preg_match('/'."src=".'/i', $linea)) {
				$row=$linea;
				}
			}
		$row=str_replace('src=', "",$row);
		$row=str_replace('"', "",$row);
		$row=str_replace('http://www.youtube.com/embed/', "",$row);//si es iframe
		$row=str_replace('http://www.youtube.com/v/', "",$row);//si es object
		$row=str_replace('//www.youtube.com/embed/', "",$row);//si es iframe
		$row=str_replace('//www.youtube.com/v/', "",$row);//si es object
		
		$explota2=explode("?", $row);// si es object
		$row=$explota2[0];
	
	}
	else {
		//echo $cadena."<br />";
		//echo strpos("//youtu.be/", $cadena); exit();
		//if (strpos("//youtu.be/", $cadena)) {
		if (preg_match('/'."youtu.be".'/i', $cadena)) {
		
		//echo "$cadena<br />";
		$row=str_replace('https://youtu.be/', "", $cadena); //si es //youtu.be/
		//https://youtu.be/ https://youtu.be/
		//echo $row."<---"; exit();
		$row=str_replace('http://youtu.be/', "", $row); //si es //youtu.be/
		//echo $row."<---"; exit();
		}
		else {
			//if (strpos("http://", $cadena)) {
			if (@preg_match('/'."http://".'/i', $cadena)) {
			//echo "caca";
			$row=str_replace('http://www.youtube.com/watch?v=', "", $cadena); //si es url
			}
			else {
				//echo "kaka";
				//if (strpos("https://", $cadena)) {
				if (@preg_match('/'."https://".'/i', $cadena)) {
				$row=str_replace('www.youtube.com/watch?v=', "", $cadena); //si es url
				}
				else {
				$row=str_replace('https://www.youtube.com/watch?v=', "", $cadena); //si es url
				}
			}
		}
	
	}
	return $row;
	}
/*function codigo_video_ytb ($url, $width, $height) {//oldddddddddddddd
return '<object width="'.$width.'" height="'.$height.'"><param
name="movie" value="'.$url.'"></param><param name="allowFullScreen"
value="true"></param><param name="allowscriptaccess"
value="always"></param><param name="wmode" value="transparent"
/><embed src="'.$url.'" type="application/x-shockwave-flash"
allowscriptaccess="always" allowfullscreen="true" width="'.$width.'"
height="'.$height.'" wmode="transparent"></embed></object>';
}*/

function codigo_video_ytb ($url, $width, $height) {
return '<iframe width="'.$width.'" height="'.$height.'"
src="http://www.youtube.com/embed/'.$url.'" frameborder="0"
allowfullscreen></iframe>';
}

function tfecha ($fechaingles) {
	$afecha=explode("-", $fechaingles);
	$fecha=$afecha[2]."-".$afecha[1]."-".$afecha[0];
	return $fecha;
}

function gfecha($fechayhora) {
	$afecha=explode(" ", $fechayhora);
	return tfecha($afecha[0]);
}
function ghora($fechayhora) {
	$afecha=explode(" ", $fechayhora);
	return $afecha[1];
}

function imp_seccion($ids){
	$aseccion=gfila("select * from cs_seccion_padreweb where id=".$ids);
	return $aseccion['nombre'];
	}


function mes($mes) {
	switch ($mes) {
		case 1:
			$nmes="Enero";
			break;
		case 2:
			$nmes="Febrero";
			break;
		case 3:
			$nmes="Marzo";
			break;
		case 4:
			$nmes="Abril";
			break;
		case 5:
			$nmes="Mayo";
			break;
		case 6:
			$nmes="Junio";
			break;
		case 7:
			$nmes="Julio";
			break;
		case 8:
			$nmes="Agosto";
			break;
		case 9:
			$nmes="Septiembre";
			break;
		case 10:
			$nmes="Octubre";
			break;
		case 11:
			$nmes="Noviembre";
			break;
		case 12:
			$nmes="Diciembre";
			break;
	}
	return $nmes;
}

function ndia($dia) {
	switch ($dia) {
		case 1:
			$nmes="Lunes";
			break;
		case 2:
			$nmes="Martes";
			break;
		case 3:
			$nmes="Mi&eacute;rcoles";
			break;
		case 4:
			$nmes="Jueves";
			break;
		case 5:
			$nmes="Viernes";
			break;
		case 6:
			$nmes="S&aacute;bado";
			break;
		case 6:
			$nmes="Domingo";
			break;
		}
		return $nmes;
}

function stripAccents($string){
	$string=str_replace(" ", "-", $string);
	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ"¿?,°',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY-----');
}
function get_seccion($ids){
	$sql="select nombre from cs_seccion_padreweb where id=".$ids;
	$seccion=gfila($sql);
	return utf8($seccion['nombre']);
	}
function milink($link){
	$banner['link']=$link;
	if ($banner['link']!='') {
		if (strpos($banner['link'],"http://")===false) {
			if (strpos($banner['link'],"https://")===false) {
				$link="http://".$banner['link'];
				}
				else {
				$link=$banner['link'];
				}
			}
			else {
			$link=$banner['link'];
			}
	}
	return $link;
	}

function banners($ids) {
			$banners=gtabla("select * from banners where seccion=".$ids." order by orden");
			if ($banners) {
				//busco el ancho
				$sql="select * from secciones_banners where id=".$ids;
				$ancho=gfila($sql); $ancho=$ancho['ancho'];
				foreach ($banners as $banner) {
					$link='';
					if (extension($banner['banner'])!='swf') {
					if ($banner['link']!='') {
						if (strpos($banner['link'],"http://")===false) {
							if (strpos($banner['link'],"https://")===false) {
								$link="http://".$banner['link'];
								}
								else {
								$link=$banner['link'];
								}
							}
							else {
							$link=$banner['link'];
							}
					}
					if ($link!='') { ?><a href="<?=$link;?>" target="_blank"><? } ?>
                    <div class="banners"><img src="multimedia/banners/<?=$banner['banner']?>" width="<?=$ancho?>" class="banner" border="0" /></div>
                    <? if ($link!='') {?></a><? } ?>
                    <?
					}
					else {
						?>
                        <div class="banners">
                        <?
						getbannerflash($banner['banner'], $ancho, $banner['alto']);
						?>
                        </div>
                        <?
					}
				}
			}
	}

function banner($id) {
		$banner=gfila("select * from banners where id=".$id);
		//echo "select * from banners where id=".$id;
		if ($banner) {
			//busco el ancho
			$sql="select * from secciones_banners where id=".$banner['seccion'];
			$ancho=gfila($sql); $ancho=$ancho['ancho'];
			//foreach ($banners as $banner) {
				$link='';
				if (extension($banner['banner'])!='swf') {
				if ($banner['link']!='') {
					if (strpos($banner['link'],"http://")===false) {
						if (strpos($banner['link'],"https://")===false) {
							$link="http://".$banner['link'];
							}
							else {
							$link=$banner['link'];
							}
						}
						else {
						$link=$banner['link'];
						}
				}
				if ($link!='') { ?><a href="<?=$link;?>" target="_blank"><? } ?>
				<div class="banners"><img src="multimedia/banners/<?=$banner['banner']?>" width="<?=$ancho?>" class="banner" border="0" /></div>
				<? if ($link!='') {?></a><? } ?>
				<?
				}
				else {
					?>
					<div class="banners">
					<?
					getbannerflash($banner['banner'], $ancho, $banner['alto']);
					?>
					</div>
					<?
				}
			//}
		}
	}

function sumar() {
	$sql="update visitas set contador=contador+1";
	gexecute($sql);
	return true;
	}

function visitas() {
	$sql="select contador from visitas";
	$valor=gfila($sql);
	return $valor['contador'];
	}

function gcolor($idc) {
	$sql="select color from colores where id=".$idc;
	$gcol=gfila($sql);
	return $gcol['color'];
	}
	
function bannersnoticia($idn) {
			$banners=gtabla("select * from banners where idn=".$idn." order by orden");
			if ($banners) {
				//busco el ancho
				$ids=1;
				$sql="select * from secciones_banners where id=".$ids;
				$ancho=gfila($sql); $ancho=$ancho['ancho'];
				foreach ($banners as $banner) {
					$link='';
					if (extension($banner['banner'])!='swf') {
					if ($banner['link']!='') {
						if (strpos($banner['link'],"http://")===false) {
							if (strpos($banner['link'],"https://")===false) {
								$link="http://".$banner['link'];
								}
								else {
								$link=$banner['link'];
								}
							}
							else {
							$link=$banner['link'];
							}
					}
					if ($link!='') { ?><a href="<?=$link;?>" target="_blank"><? } ?>
                    <div class="banners"><img src="multimedia/banners/<?=$banner['banner']?>" width="<?=$ancho?>" class="banner" border="0" /></div>
                    <? if ($link!='') {?></a><? } ?>
                    <?
					}
					else {
						?>
                        <div class="banners">
                        <?
						getbannerflash($banner['banner'], $ancho, $banner['alto']);
						?>
                        </div>
                        <?
					}
				}
			}
	}

function dif_dias($f1, $f2) {
	$sf1=strtotime($f1)+86400;
	$sf2=strtotime($f2);
	//echo $sf1.$sf2;
	return intval($sf1-$sf2)/86400;
	}
?>
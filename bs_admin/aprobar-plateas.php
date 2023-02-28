<?
require 'init.php';
$ide=substr($_GET['idevento'],0,10);

$sql="select * from eventos where id=".$ide." and aprobada=1";
//echo $sql;
$evento=gfila($sql);
//exit();
if ($evento) {
	//echo "crear entradas";
	$sql="select * from evento_plateas where idevento=".$ide." and aprobada=0";
	//echo $sql; exit();
	$plateas=gtabla($sql);
	$tt=0;
	foreach ($plateas as $platea) {
		//echo $platea['cantidad']."<br>";
		for ($e=1; $e<=$platea['cantidad']; $e++) {
			$uniqueid=uniqid("", true);
			$sql="insert into entradas (idp, uniqueid, fechagen) values (".$platea['id'].", '".$uniqueid."', '".date("Y-m-d H:i:s")."')";
			ginsert($sql);
			$tt++;
			}
		}

	//aprobar platea
	$sqlu="update evento_plateas set aprobada=1 where idevento=".$ide." and aprobada=0";
	$fff=gexecute($sqlu);

	header("location: listado-eventos.php?aprobados=0&search=");
	//echo $tt;
	} else header("location: listado-eventos.php?aprobados=0&search=");

?>
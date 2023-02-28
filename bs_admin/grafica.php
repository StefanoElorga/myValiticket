<? require 'init.php';
//print_r($_GET);
?><!doctype html>
<html lang="en">
<?
require 'headers.php';
?>
<script type="text/javascript" src="js/jquery-1.2.3.pack.js"></script>
<?
$row['id']=substr($_GET['id'],0,9);
$sql="select * from cs_entidades where id=".$row['id'];
$entidad=gfila($sql);

$sqla6="select count(*) as visitas from visitas where id=".$row['id']." and fecha<='".date("Y-m-d", strtotime("-6 month"))."'";
$data6=gfila($sqla6);
$d6=$data6['visitas'];

$sqla6="select count(*) as visitas from visitas where id=".$row['id']." and fecha<='".date("Y-m-d", strtotime("-3 month"))."'";
$data3=gfila($sqla6);
$d3=$data3['visitas'];

$sqla6="select count(*) as visitas from visitas where id=".$row['id']." and fecha<='".date("Y-m-d", strtotime("-1 month"))."'";
$data1=gfila($sqla6);
$d1=$data1['visitas'];

$sqla6="select count(*) as visitas from visitas where id=".$row['id']." and fecha<='".date("Y-m-d")."'";
$data=gfila($sqla6);
$dactual=$data['visitas'];
$da3=($data['visitas']-$data3['visitas'])*3;
$da6=($data['visitas']-$data3['visitas'])*6;
?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['meses', 'Visitas'],
          ['hace 6 meses',  <?=$d6;?>],
          ['hace 3 meses',  <?=$d3;?>],
          ['hace 1 mes',  <?=$d1;?>],
          ['Actualmente',  <?=$dactual;?>],
          ['a 3 meses',  <?=$da3;?>],
          ['a 6 meses',  <?=$da6;?>]
        ]);

        var options = {
          title: '\u00DAltimos 6 meses y Proyecci\u00F3n Estimada para 6 meses',
          curveType: 'function',
          legend: { position: 'bottom' }
        };
		<?
		switch ($_GET['tipo']) {
			case 1:
			$tipog="LineChart";
			break;
			case 2:
			$tipog="ColumnChart";
			break;
			case 3:
			$tipog="PieChart";
			break;
			default:
			$tipog="LineChart";
			break;
			}
		?>
        var chart = new google.visualization.<? echo $tipog;?>(document.getElementById('curve_chart'));
        chart.draw(data, options);
      }
    </script>
<body>
<h3>Landing: <?=utf8($entidad['seccion']);?></h3>
<div class="container-fluid">
    <div id="curve_chart" style="width: 850px; height: 500px"></div>
</div>
<center>
<a href="?tipo=2&id=<?=$row['id'];?>" class="btn btn-primary">Ver Columnas</a>
<a href="?tipo=1&id=<?=$row['id'];?>" class="btn btn-primary">Ver L&iacute;neas</a>
<a href="?tipo=3&id=<?=$row['id'];?>" class="btn btn-primary">Ver Torta</a>

</center>
<?
require 'js-includes.php';
?>
</body>
</html>
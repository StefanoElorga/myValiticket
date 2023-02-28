<? require 'init.php';
$idu=substr($_GET['idu'],0,5);
$sql="delete from personas where id=".$idu;
gexecute($sql);
header("location: listado-clientes.php");


?>
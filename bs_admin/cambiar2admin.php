<?
require 'init.php';
$id=$_POST['id'];
$valor=$_POST['ivalor'];


$sql="update cs_admin set controlusuarios=$valor where user='".$id."'";
//echo $sql;
gexecute($sql);
?>
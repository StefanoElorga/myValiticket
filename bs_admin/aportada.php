<?
require 'init.php';
$id=$_POST['id'];
$valor=$_POST['valor'];


$sql="update eventos set portada=$valor where id=".$id;
gexecute($sql);
?>
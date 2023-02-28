<?
require 'init.php';
$id=$_POST['id'];
$valor=$_POST['ivalor'];


$sql="update cs_entidades set piecustom=$valor where id=".$id;
gexecute($sql);
?>
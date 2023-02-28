<? require 'init.php';
$sqlmail="select email from personas where idlanding=".$_POST['idl'];
$mail=gfila($sqlmail);
echo "<input type'text' class='form-control' value='".$mail['email']."' style='font-size:12px;' id='txtmm".$_POST['idl']."' /><input type='button' value='Guardar' onclick='guardarmail(".$_POST['idl'].");' class='btn btn-primary btn-sm' />";


?>
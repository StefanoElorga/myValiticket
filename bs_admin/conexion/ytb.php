<?
require "funciones.php";
if ($_POST) {
	echo $code=get_url_ytb($_POST['name']);
	echo codigo_video_ytb($code, 400, 300);
	}
?>
<form method="post">
	<input type="text" name="name" value="<?=$_POST['name']?>" />
</form>
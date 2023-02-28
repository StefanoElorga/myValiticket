<?
function conectar() {
$host=$_SERVER['HTTP_HOST'];
if (strpos($_SERVER['HTTP_HOST'],"server")===false) {
	$user="root";
	$pass="";
	$db="valiticket";
	}
	else {
	$user="root";
	$pass="pass";
	$db="valiticket";
	}
$link = "";
    if (!($link=mysqli_connect("localhost",$user,$pass)))
               {
                   echo "Error conectando a la base de datos.";
                   exit();
               }
               if (!mysqli_select_db($link, $db))
               {
                   echo "Error seleccionando la base de datos.-";
                       exit();
               }
				else
               {
                    mysqli_set_charset($link, 'latin1');
					//echo "charset";
				   //print_r( mysqli_get_charset($link) );
                   
               }

               return $link;		
	}
?>
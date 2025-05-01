<?
$dbhost = "localhost";
$dbuser = "poramor_Fede"; // MySQL Username
$dbpass = "Lautaroo"; // MySQL Password
$dbname = "poramor_Fede"; // Database Name

if (@mysql_connect($dbhost,$dbuser,$dbpass)){
 echo "HAY CONEXION"; 
}else{
 echo "No hay conexion ";
}
?>

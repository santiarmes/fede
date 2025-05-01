<? 
// seguridad.php
// nivel de seguridad que no permite que usuarios
// fuera de sesion accedan a paginas restringidas


//Inicio la sesión
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO

if (!session_is_registered('AUTORIZADO')) {
 header ("Location: mensajes.php?nro_error=6&volver=3&tipo=login");
  //ademas salgo de este script
  exit();
}else{
 if ($_SESSION["AUTORIZADO"] != "SI") {
  //si no existe, se envia al usuario a la página de inicio
  header ("Location: mensajes.php?nro_error=5&volver=3&tipo=login");
  //ademas salgo de este script
  exit();
 }else{
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 7200) { 
      //si pasaron 10 minutos (600) o más (7200 son 2hs)
      session_destroy(); // destruyo la sesión 
      header("Location: login.php"); //envío al usuario a la pag. de autenticación 
      exit();
    }else { 
      //sino, actualizo la fecha de la sesión 
      $_SESSION["ultimoAcceso"] = $ahora; 
   } 
 }
}
?>

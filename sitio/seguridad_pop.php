<? 
// seguridad_pop.php
// nivel de seguridad que no permite que usuarios
// fuera de sesion accedan a paginas restringidas


//Inicio la sesi�n
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO

if (!session_is_registered('AUTORIZADO')) {
   echo "Expiro la sesion o no esta autorizado";
  //ademas salgo de este script
  exit();
}else{
 if ($_SESSION["AUTORIZADO"] != "SI") {
  echo "Expiro la sesion o no esta autorizado";
  exit();
 }else{
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-n-j H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 7200) { 
      //si pasaron 10 minutos (600) o m�s 
      session_destroy(); // destruyo la sesi�n 
        echo "Expiro la sesion o no esta autorizado";
      exit();
    }else { 
      //sino, actualizo la fecha de la sesi�n 
      $_SESSION["ultimoAcceso"] = $ahora; 
   } 
 }
}
?>

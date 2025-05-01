<?php
Class msj{
 function mensaje($nro_error,$volver) {
  $error_msj[0]="Comuniquese con el Administrador del Sistema"; //La variable $accion del form no esta seteada.
  $error_msj[1]="No se pudo conectar con Base de datos";
  $error_msj[2]="No se pudo realizar consulta a la Base de datos";
  $error_msj[3]="Password no valida";
  $error_msj[4]="Usuario no existe";
  $error_msj[5]="No está autorizado para realizar esta acción o entrar en esta página";
  $error_msj[6]="Acceso no autorizado! Registrese";
  $error_msj[7]="El dato no es tipo numerico";
  $error_msj[8]="El dato no es tipo carater";
  $error_msj[9]="El año debe ser un dato numerico";
  $error_msj[10]="El mes debe ser un dato numerico";
  $error_msj[11]="No se encontro ningun registro";
  $error_msj[12]="Hay un item cargado para ese dia y hora";
  $error_msj[13]="El item se cargo con exito";
  $error_msj[14]="La fecha es invalida";
  $error_msj[15]="Hay un item cargado para ese dia y hora";
  $error_msj[16]="El item se modifico con exito";
  $error_msj[17]="El item se borro con exito";
  $error_msj[18]="No hay items cargados para este dia";
  $error_msj[19]="El usuario esta inactivo";
  $error_msj[20]="Debe repetir la clave las dos veces";
  $error_msj[21]="Comuniquese con el Administrador del Sistema";
  $error_msj[22]="La extensión del archivo no es correcta (.gif o .jpg) o es mayor a 2 MB";
  $error_msj[23]="El archivo ha sido cargado correctamente";
  $error_msj[24]="Ocurrió algún error al subir el archivo. No pudo guardarse";
  $error_msj[25]="No hay imagenes cargadas";
  $error_msj[26]="Hay una foto cargada con ese nombre";
  $error_msj[27]="La foto fue borrada con exito";
  $error_msj[28]="Hay un tema cargado con ese nombre";
  $error_msj[29]="La extensión del archivo no es correcta (.mp3) o es mayor a 10 MB";
  $error_msj[30]="No hay archivos cargados";
  $error_msj[31]="El archivo fue borrado con exito";
  $error_msj[32]="Hay un Video cargado con ese nombre";
  $error_msj[33]="La extensión del archivo no es correcta (.flv) o es mayor a 20 MB";
  $error_msj[34]="El archivo XML se creo correctamente";
  $error_msj[35]="No se ha podido leer el archivo XML";

  echo "<center>Mensaje Nro. ".$nro_error.": ".$error_msj[$nro_error];

  if ($volver==1){
   echo "<center><a href=javascript:history.go(-1)><q>Volver</q></a>";
  }else if ($volver==2){
   echo "<script>Cerr_Ref(1)</script>";
  }else if ($volver==3){
   echo "<center><a href=login.php><q>Volver al Login</q></a>";
  }
 }
}
?>
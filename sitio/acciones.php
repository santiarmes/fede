<?php

 if (!isset($accion)){ 
header ("Location: mensajes.php?nro_error=0&volver=3&tipo=login");
}else{
 switch($accion) {
  case "agenda":
   require_once("class_agenda.php");
   $Cagenda=new Cagenda();
    switch($tarea) {
     case "insertar":
      $Cagenda->agenda_insertar($ano,$mes,$dia,$hora,$minutos,$titulo,$direccion);
      break;
     case "modificar":
      $Cagenda->agenda_modificar($ano,$mes,$dia,$hora,$minutos,$titulo,$direccion,$agenda_id);
      break;
     case "borrar":
      $Cagenda->agenda_borrar($agenda_id);
      break;
    }
 case "control":
  require_once("class_control.php");
  $Control=new Control();
   switch($tarea) {
     case "login":
      $Control->control_usr($usuario,$clave);
      break;
     case "clave":
      $Control->cambiar_clave($clave,$repita_clave,$usuario);
      break;
   }
 case "archivos":
  require_once("class_archivos.php");
  $Archivo=new Carchivo();
  switch($tarea) {
   case "subir":
    $Archivo->subir_archivo($seccion,$titulo,$descripcion,$archivo,$activo,$posicion,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name']);
    break;
   case "modificar":
    if (isset($posicion)) {
     $pposicion=$posicion;
    }else{
     $pposicion=$img_posicion;
    }
    $Archivo->modificar_archivo($seccion,$titulo,$descripcion,$archivo,$activo,$img_posicion_viejo,$pposicion,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name'],$img_id,$img_nom_viejo);
    break;
   case "borrar":
    $Archivo->borrar_archivo($img_id,$seccion,$posicion);
    break;
   case "subir_musica":
    $Archivo->subir_musica($descripcion,$archivo,$activo,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name']);
    break;
   case "modificar_musica":
    $Archivo->modificar_musica($descripcion,$archivo,$activo,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name'],$mus_id,$mus_nom_viejo);
    break;
   case "borrar_musica":
    $Archivo->borrar_musica($mus_id);
    break;
   case "subir_video":
    $Archivo->subir_video($descripcion,$archivo,$activo,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name']);
    break;
   case "modificar_video":
    $Archivo->modificar_video($descripcion,$archivo,$activo,$HTTP_POST_FILES['archivo']['name'],$HTTP_POST_FILES['archivo']['type'],$HTTP_POST_FILES['archivo']['size'],$HTTP_POST_FILES['archivo']['tmp_name'],$vid_id,$vid_nom_viejo);
    break;
   case "borrar_video":
    $Archivo->borrar_video($vid_id);
    break;
  }
 }
}
require_once("header.php");
$Header=new Header();
$Header->header_msj("Mensaje del Sistema",0);

require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_pop();
?>
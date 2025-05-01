<?php
Class Header {

 function header_login($titulo) {
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

  <html>
  <head>
	<title><?=$titulo?></title>
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	<script language="JavaScript" src="funciones.js"></script>
  </head>

  <body>

  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <tr>
      <td width="100%" align=center><b>Administrador del Sitio FedericoSchrager.com.ar</td>
    </tr>
  </table>
  <?
 }

 function header_admin($titulo) {
  require_once("seguridad.php");
  require_once("class_msj.php");
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

  <html>
  <head>
	<title><?=$titulo?></title>
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	<script language="JavaScript" src="funciones.js"></script>
  </head>

  <body>

  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <tr>
     <td width="100%"><b>Administrador del Sitio FedericoSchrager.com.ar</td>
    </tr>
    <tr>
     <td width="100%"><a href="cambiar_clave.php"><q>Cambiar Clave</q></a> | <a href="agenda.php"><q>Mi Agenda</q></a> | <a href="fotos.php"><q>Mis Fotos</q></a> | <a href="musica.php"><q>Mi Musica</q></a> | <a href="videos.php"><q>Mis Videos</q></a> | <a href="logout.php"><q>Logout</q></a> |</td>
    </tr>
  </table>
  <?
 }

 function header_pop($titulo) {
  require_once("seguridad_pop.php");
  require_once("class_msj.php");
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

  <html>
  <head>
	<title><?=$titulo?></title>
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	<script language="JavaScript" src="funciones.js"></script>
  </head>

  <body>

  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
   <tr>
     <td width="70%" valign="top">
  <table border="0" width="100%" cellpadding="0" cellspacing="0">
   <tr>
    <td width="100%"><p></td>
   </tr>
  </table>
  <?
 }

 function header_msj($titulo,$seg) {
  if ($seg==1){
   require_once("seguridad.php");
  }
  require_once("class_msj.php");
  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

  <html>
  <head>
	<title><?=$titulo?></title>
	<link rel="STYLESHEET" type="text/css" href="estilo.css">
	<script language="JavaScript" src="funciones.js"></script>
  </head>

  <body>

  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
   <tr>
     <td width="70%" valign="top">
  <table border="0" width="100%" cellpadding="0" cellspacing="0">
   <tr>
    <td width="100%"><p></td>
   </tr>
  </table>
  <?
 }

}
?>
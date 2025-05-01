<?
require_once("header.php");
$Header=new Header();
$Header->header_admin("Administrador");
?>
<br>

<table cellpadding="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
    <td width=100% colspan=2 align=center class=tit>Mis Videos</td>
  </tr>
  <tr>
    <td width="100%" colspan=2 align=center ><a href="javascript:popUp('subir_video.php',500,400)"><q>Agregar nuevo Archivo</q></a><p></td>
  </tr>

<?
require_once("class_archivos.php");
$Carchivo=new Carchivo();
$Carchivo->buscar_videos();

require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_admin();
?>

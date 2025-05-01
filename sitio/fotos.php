<?
require_once("header.php");
$Header=new Header();
$Header->header_admin("Administrador");
?>
<br>

<form name="formul" action="fotos.php" method="post">
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="buscar">
<table cellpadding="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
    <td width=100% colspan=2 align=center class=tit>Mis Fotos</td>
  </tr>
  <tr>
    <td width="100%" colspan=2 align=center ><a href="javascript:popUp('subir_foto.php',500,400)"><q>Agregar nueva foto</q></a><p></td>
  </tr>
  <tr>
    <td width="100%" colspan=2 align=center >Seccion a mostrar
     <select name=seccion>
      <option value="">Seleccionar</option>
      <option value="Eventos">Eventos</option>
      <option value="Fiestas">Fiestas</option>
      <option value="Bares">Bares</option>
      <option value="Discos">Discos</option>
      <option value="Fotos">Fotos</option>
     </select>
    </td>
  </tr>
  <tr>
    <td width="100%" colspan=2 align=center ><INPUT TYPE="button" VALUE="Mostrar" onclick="valida_campo(this.form,'seccion','');"></td>
  </tr>
</form>
<?
if (isset($seccion)) {
 require_once("class_archivos.php");
 $Carchivo=new Carchivo();
 $Carchivo->buscar_archivo($seccion);
}


require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_admin();
?>

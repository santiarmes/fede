<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Agregar Musica");
?>
<br>
<form action="acciones.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="subir_musica">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000">

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width=100% colspan=3 align=center class=altn>Subir Musica</td>
  </tr>
  <tr>
    <td width="35%" class=tit>Descripcion</td>
    <td width="65%"><input type="text" name="descripcion" size="50" maxlength="100" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Musica (Max 10 MB)</td>
    <td width="65%"><input name="archivo" type="file" size="40" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Activo</td>
    <td width="65%"><select name=activo><option value="1">SI</option><option value="0">NO</option></select>
    </td>
  </tr>
  <tr>
    <td width=100% colspan=3 align=center class=altn>
      <INPUT TYPE="button" VALUE="Subir" onclick="valida_campo(this.form,'descripcion,archivo,activo','Musica');">
    </td>
  </tr>
</table>
</form>
<div id="detalles" align="center"></div>
<?
require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_pop();
?>

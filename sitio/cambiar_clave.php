<?
require_once("header.php");
$Header=new Header();
$Header->header_admin("Administrador");
?>
<br>

<form name="formul" action="acciones.php" method="post">
<input type="hidden" name="accion" value="control">
<input type="hidden" name="tarea" value="clave">
<input type="hidden" name="usuario" value="<?=$_SESSION["username"]?>">

<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
    <td width=100% colspan=2 align=center class=tit>Cambiar Clave</td>
  </tr>
  <tr>
    <td width="25%">Clave</td>
    <td width="75%"><input type="password" name="clave" size="12" maxlength="10" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="25%">Repita la Clave</td>
    <td width="75%"><input type="password" name="repita_clave" size="12" maxlength="10" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width=100% colspan=2 align=center class=altn>
      <INPUT TYPE="button" VALUE="Cambiar" onclick="valida_campo(this.form,'clave,repita_clave','');">
    </td>
  </tr>
</table>
</form>

<?
require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_admin();
?>

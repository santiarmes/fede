<?
require_once("header.php");
$Header=new Header();
$Header->header_login("Bienvenido");
?>

<br>

<form action="acciones.php" method="post">
<input type="hidden" name="accion" value="control">
<input type="hidden" name="tarea" value="login">

<table border="1" cellpadding="0" cellspacing="0" align=center style="border-collapse: collapse" bordercolor="#111111" width="50%" id="AutoNumber1">
  <tr>
    <td width=100% colspan=2 align=center class=tit>Ingresar al Administrador</td>
  </tr>
  <tr>
    <td width="50%" align=right>Usuario: </td>
    <td width="50%" align=left><input type="text" name="usuario" size="12" maxlength="10" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="50%" align=right>Clave: </td>
    <td width="50%"><input type="password" name="clave" size="12" maxlength="10" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width=100% colspan=2 align=center class=altn>
      <INPUT TYPE="button" VALUE="Ingresar" onclick="valida_campo(this.form,'usuario,clave','');">
    </td>
  </tr>
</table>
</form>

<?
require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_admin();
?>
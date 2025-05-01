<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Modificar Musica");

require_once("class_db.php");
$Base=new Base();
$Base->connect();
$Base->busqueda("select * from musica where mus_id=".$mus_id.";");

if (@$Base->numRows()) {
 while ($row = $Base->getArray()){
?>
<form action="acciones.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="modificar_musica">
<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
<input type="hidden" name="mus_id" value="<?=$row["mus_id"]?>">
<input type="hidden" name="mus_nom_viejo" value="<?=$row["mus_nombre"]?>">

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width=100% colspan=4 align=center class=altn>Modificar Musica</td>
  </tr>
  <tr>
    <td width="35%" class=tit>Descripcion</td>
    <td width="65%"><input type="text" name="descripcion" value="<?=$row["mus_descrip"]?>" size="50" maxlength="100" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Nombre</td>
    <td width="65%"><?=$row["mus_nombre"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Archivo (Max 10 MB)</td>
    <td width="65%"><input name="archivo" type="file" size="40" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Activo</td>
    <td width="65%">
     <?
     if ($row["mus_activo"]==1) {
      echo "<select name=activo><option value=1>SI</option><option value=0>NO</option></select>";
     }else{
      echo "<select name=activo><option value=0>NO</option><option value=1>SI</option></select>";
     }
     ?>
    </td>
  </tr>
  <tr>
    <td width=100% colspan=4 align=center class=altn>
      <INPUT TYPE="button" VALUE="Modificar" onclick="valida_campo(this.form,'descripcion,activo','Musica');">
    </td>
  </tr>
</table>
<div id="detalles" align="center"></div>
</form>
<?
 }
}else{
 $msj=new msj();
 $msj->mensaje(11,1);
}

require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_pop();
?>
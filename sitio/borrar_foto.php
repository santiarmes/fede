<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Borrar Foto");
//http://localhost/FedericoSchrager/

require_once("class_db.php");
$Base=new Base();
$Base->connect();
$Base->busqueda("select * from imagenes where img_id=".$img_id.";");

if (@$Base->numRows()) {
 while ($row = $Base->getArray()){
?>
<form action="acciones.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="borrar">
<input type="hidden" name="MAX_FILE_SIZE" value="100000">
<input type="hidden" name="img_id" value="<?=$row["img_id"]?>">
<input type="hidden" name="seccion" value="<?=$row["img_seccion"]?>">
<input type="hidden" name="posicion" value="<?=$row["img_posicion"]?>">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width=100% colspan=5 align=center class=altn>Borrar Foto</td>
  </tr>
  <tr>
    <td width="35%" class=tit>Seccion</td>
    <td width="65%"><?=$row["img_seccion"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Titulo</td>
    <td width="65%"><?=$row["img_titulo"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Descripcion</td>
    <td width="65%"><?=$row["img_descrip"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Nombre</td>
    <td width="65%"><?=$row["img_nombre"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Activo</td>
    <td width="65%">
     <?
     if ($row["img_activo"]==1) {
      echo "SI";
     }else{
      echo "NO";
     }
     ?>
    </td>
  </tr>
  <tr>
    <td width=100% colspan=4 align=center class=altn>
      <INPUT TYPE="button" VALUE="Borrar" onclick="valida_campo(this.form,'img_id','');">
    </td>
  </tr>
</table>

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
<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Borrar Video");
//http://localhost/FedericoSchrager/

require_once("class_db.php");
$Base=new Base();
$Base->connect();
$Base->busqueda("select * from videos where vid_id=".$vid_id.";");

if (@$Base->numRows()) {
 while ($row = $Base->getArray()){
?>
<form action="acciones.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="borrar_video">
<input type="hidden" name="MAX_FILE_SIZE" value="5000000">
<input type="hidden" name="vid_id" value="<?=$row["vid_id"]?>">

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width=100% colspan=4 align=center class=altn>Borrar Video</td>
  </tr>
  <tr>
    <td width="35%" class=tit>Descripcion</td>
    <td width="65%"><?=$row["vid_descrip"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Nombre</td>
    <td width="65%"><?=$row["vid_nombre"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Activo</td>
    <td width="65%">
     <?
     if ($row["vid_activo"]==1) {
      echo "SI";
     }else{
      echo "NO";
     }
     ?>
    </td>
  </tr>
  <tr>
    <td width=100% colspan=4 align=center class=altn>
      <INPUT TYPE="button" VALUE="Borrar" onclick="valida_campo(this.form,'vid_id','');">
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
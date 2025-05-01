<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Borrar Item");
//http://localhost/FedericoSchrager/

require_once("class_db.php");
$Base=new Base();
$Base->connect();
$Base->busqueda("select * from agenda where agenda_id=".$agenda_id.";");

if (@$Base->numRows()) {
 while ($row = $Base->getArray()){
?>
<form method = "POST" action = "acciones.php">
<input type="hidden" name="accion" value="agenda">
<input type="hidden" name="tarea" value="borrar">
<input type="hidden" name="agenda_id" value="<?=$row["agenda_id"]?>">
     <table border="0" width="100%" cellpadding="0" cellspacing="0">
     <tr>
	<td width=100% colspan=2 align=center class=altn>Borrar Item</td>
     </tr>
      <tr>
       <td width="20%" class=tit>Año</td>
       <td width="80%"><?=date("Y", strtotime($row["agenda_fecha"]))?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Mes</td>
       <td width="80%"><?=date("m", strtotime($row["agenda_fecha"]))?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Dia</td>
       <td width="80%"><?=date("d", strtotime($row["agenda_fecha"]))?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Hora</td>
       <td width="80%"><?=date("H", strtotime($row["agenda_fecha"]))?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Minutos</td>
       <td width="80%"><?=date("i", strtotime($row["agenda_fecha"]))?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Titulo</td>
       <td width="80%"><?=$row["agenda_titulo"]?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Direccion</td>
       <td width="80%"><?=$row["agenda_direccion"]?>
       </td>
     </tr>
   <tr>
	<td width=100% colspan=2 align=center class=altn>
         <INPUT TYPE="button" VALUE="Borrar" onclick="valida_campo(this.form,'agenda_id','');">
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
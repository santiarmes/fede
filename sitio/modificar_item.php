<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Modificar Item");
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
<input type="hidden" name="tarea" value="modificar">
<input type="hidden" name="agenda_id" value="<?=$row["agenda_id"]?>">
     <table border="0" width="100%" cellpadding="0" cellspacing="0">
     <tr>
	<td width=100% colspan=2 align=center class=altn>Modificar Item</td>
     </tr>
      <tr>
       <td width="20%" class=tit>Año</td>
       <td width="80%">

<?
 echo "<select name=ano>";
 for ($i=date("Y", time())-5;$i<date("Y", time())+10;$i++){
  if ($i==date("Y", strtotime($row["agenda_fecha"]))){
   echo "<option selected value=".$i.">".$i;
  }else{
   echo "<option value=".$i.">".$i;
  }
 }
?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Mes</td>
       <td width="80%">
<?
 echo "<select name=mes>";
 for ($i=1;$i<13;$i++){
  if ($i==date("m", strtotime($row["agenda_fecha"]))){
   echo "<option selected value=".$i.">".$i;
  }else{
   echo "<option value=".$i.">".$i;
  }
 }
?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Dia</td>
       <td width="80%">
<?
 echo "<select name=dia>";
 for ($i=1;$i<32;$i++){
  if ($i==date("d", strtotime($row["agenda_fecha"]))){
   echo "<option selected value=".$i.">".$i;
  }else{
   echo "<option value=".$i.">".$i;
  }
 }
?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Hora</td>
       <td width="80%">
<?
 echo "<select name=hora>";
 for ($i=0;$i<24;$i++){
  if ($i==date("H", strtotime($row["agenda_fecha"]))){
   echo "<option selected value=".$i.">".$i;
  }else{
   echo "<option value=".$i.">".$i;
  }
 }
?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Minutos</td>
       <td width="80%">
<?
 echo "<select name=minutos>";
 for ($i=0;$i<60;$i++){
  if ($i==date("i", strtotime($row["agenda_fecha"]))){
   echo "<option selected value=".$i.">".$i;
  }else{
   echo "<option value=".$i.">".$i;
  }
 }
?>
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Titulo</td>
       <td width="80%">
        <input type="Text" name="titulo" size="60" value="<?=$row["agenda_titulo"]?>" maxlength=200 onKeypress="ValidaCarac()">
       </td>
     </tr>
      <tr>
       <td width="20%" class=tit>Direccion</td>
       <td width="80%">
        <input type="Text" name="direccion" size="60" value="<?=$row["agenda_direccion"]?>" maxlength=200 onKeypress="ValidaCarac()">
       </td>
     </tr>
   <tr>
	<td width=100% colspan=2 align=center class=altn>
         <INPUT TYPE="button" VALUE="Modificar" onclick="valida_campo(this.form,'ano,mes,dia,hora,minutos,titulo,direccion,agenda_id','');">
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
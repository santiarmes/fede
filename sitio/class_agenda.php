<?php
require_once("class_db.php");
require_once("class_xml.php");

class Cagenda extends Base {
 var $agenda_fecha;
 var $agenda_titulo;
 var $agenda_direccion;

 function __construct(){
  $this->agenda_fecha="";
  $this->agenda_titulo="";
  $this->agenda_direccion="";
 }

 function agenda_insertar($pano,$pmes,$pdia,$phora,$pmin,$pagenda_titulo,$pagenda_direccion) {
  if (@checkdate($pmes,$pdia,$pano)) {
   $pagenda_fecha=$pano."-".$pmes."-".$pdia." ".$phora.":".$pmin.":00";
   $this->connect();
   $Xml=new Xml();

   //Verificar si hay un item yo cargado en esa fecha/hora
   $sql_verif="select * from agenda where agenda_fecha='".strtoupper($pagenda_fecha)."';";
   $this->busqueda($sql_verif);

   if (@$this->numRows()) {
    header ("Location: mensajes.php?nro_error=12&volver=1&tipo=pop");
   }else{
     //No hay resultado
     $sql="insert into agenda values (0,";
     $sql=$sql."'".$pagenda_fecha."',";
     $sql=$sql."'".$pagenda_titulo."',";
     $sql=$sql."'".$pagenda_direccion."');";
     $this->ejecutar($sql);
     //header ("Location: mensajes.php?nro_error=13&volver=2&tipo=pop");
     $Xml->xml_agenda();
   }
  }else{
   header ("Location: mensajes.php?nro_error=14&volver=1&tipo=pop");
  }
 }

 function agenda_modificar($pano,$pmes,$pdia,$phora,$pmin,$pagenda_titulo,$pagenda_direccion,$pagenda_id) {
  if (@checkdate($pmes,$pdia,$pano)) {
   $pagenda_fecha=$pano."-".$pmes."-".$pdia." ".$phora.":".$pmin.":00";
   $this->connect();
   $Xml=new Xml();

   //Verificar si hay un item yo cargado en esa fecha/hora
   $sql_verif="select * from agenda where agenda_fecha='".strtoupper($pagenda_fecha)."' and agenda_id<>".$pagenda_id.";";
   $this->busqueda($sql_verif);

   if (@$this->numRows()) {
     header ("Location: mensajes.php?nro_error=15&volver=1&tipo=pop");
   }else{
    // Modificar el usuario
     $sql="update agenda set ";
     $sql=$sql."agenda_fecha='".$pagenda_fecha."',";
     $sql=$sql."agenda_titulo='".$pagenda_titulo."',";
     $sql=$sql."agenda_direccion='".$pagenda_direccion."' ";
     $sql=$sql."where agenda_id='".$pagenda_id."';";
     $this->ejecutar($sql);
     //header ("Location: mensajes.php?nro_error=16&volver=2&tipo=pop");
     $Xml->xml_agenda();
   }
  }else{
   header ("Location: mensajes.php?nro_error=14&volver=1&tipo=pop");
  }
 }

 function agenda_borrar($pagenda_id) {
  $Xml=new Xml();
  $this->connect();
  $this->ejecutar("delete from agenda where agenda_id=".$pagenda_id.";");
  $Xml->xml_agenda();
  header ("Location: mensajes.php?nro_error=17&volver=2&tipo=pop");
  exit();
 }

 function agenda_busca($pagenda_dia) {
  $Xml=new Xml();
  $msj=new msj();
  $this->connect();
  //Busca los item para el dia en curso
  $sql_verif="select * from agenda where agenda_fecha Between '".$pagenda_dia."' and DATE_ADD('".$pagenda_dia."',INTERVAL 1 day) order by agenda_fecha;";
  $this->busqueda($sql_verif);

  if (@$this->numRows()) {
    ?>
     <table border="0" width="100%" cellpadding="0" cellspacing="0">
      <tr>
       <td width="15%" class=tit>Fecha</td>
       <td width="10%" class=tit>Hora</td>
       <td width="35%" class=tit>Titulo</td>
       <td width="40%" class=tit>Direccion</td>
     </tr>
    <?
    while ($row = $this->getArray()){
      echo "<tr><td width=15%>". strftime("%d-%m-%y", strtotime($row["agenda_fecha"])) ."</td>";
      echo "<td width=10%>". strftime("%H:%M", strtotime($row["agenda_fecha"])) ."</td>";
      echo "<td width=35%>". $row["agenda_titulo"] ."</td>";
      echo "<td width=40%>". $row["agenda_direccion"] ."</td></tr>";
      echo "<tr><td width=100% colspan=4 align=center class=altn><a href=javascript:popUp('modificar_item.php?agenda_id=".$row["agenda_id"]."',500,400)><q>Modificar</q></a> | <a href=javascript:popUp('borrar_item.php?agenda_id=".$row["agenda_id"]."',500,400)><q>Borrar</q></a></td></tr>";
//modificar_item.php
     }
    echo "</table>";
  }else{
    $msj->mensaje(18,0);
  }
 }

}
?>

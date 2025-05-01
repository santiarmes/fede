<?
require_once("class_db.php");
require_once("class_msj.php");

class Xml extends Base {


 function xml_agenda() {
  $this->connect();
  $sql_verif="select * from agenda order by agenda_fecha desc;";
  $this->busqueda($sql_verif);

  $msj=new msj();

  $cadena="";
  if (@$this->numRows()) {
   while ($row = $this->getArray()){
    //$cadena=$cadena."&lt;font size='+2'&gt;".$row["agenda_fecha"]."&lt;/font&gt;\r&lt;font size='+5'&gt;".$row["agenda_titulo"]."&lt;/font&gt;\r".$row["agenda_direccion"]."\r----------------------------------------------------------------------------------\r";
    $cadena=$cadena."&lt;font size='+2'&gt;".date("d", strtotime($row["agenda_fecha"]))."/".date("m", strtotime($row["agenda_fecha"]))."/".date("Y", strtotime($row["agenda_fecha"]))."&lt;/font&gt;\r&lt;font size='+5'&gt;".$row["agenda_titulo"]."&lt;/font&gt;\r".$row["agenda_direccion"]."\r".date("H", strtotime($row["agenda_fecha"])).":".date("i", strtotime($row["agenda_fecha"]))."hs\r----------------------------------------------------------------------------------\r";
   }
   $this->crea_xml($cadena,'agenda');
  }else{
   //header ("Location: mensajes.php?nro_error=30&volver=1&tipo=pop");
   $cadena="";
   $this->crea_xml($cadena,'agenda');
  }
 }

 function xml_videos() {
  $this->connect();
  $sql_verif="select * from videos where vid_activo=1;";
  $this->busqueda($sql_verif);

  $msj=new msj();

  $cadena="";
  if (@$this->numRows()) {
   while ($row = $this->getArray()){
    $cadena=$cadena."<item tipo=\"video\" src=\"flv/".$row["vid_nombre"]."\" nombre=\"".$row["vid_descrip"]."\" ></item>";
   }
   $this->crea_xml($cadena,'video');
  }else{
   //header ("Location: mensajes.php?nro_error=30&volver=1&tipo=pop");
   $cadena="";
   $this->crea_xml($cadena,'video');
  }
 }

 function xml_fotos($seccion) {
  $this->connect();
  $sql_verif="select * from imagenes where img_activo=1 and img_seccion='".$seccion."' order by img_posicion;";
  $this->busqueda($sql_verif);
  $msj=new msj();

  $cadena="";
  $cadena1="";
  if (@$this->numRows()) {

   switch($seccion) {
    case "Eventos":
     while ($row = $this->getArray()){
      $cadena=$cadena."<item tipo=\"fotos\" src=\"".$row["img_nombre"]."\" titulo=\"".$row["img_titulo"]."\" texto=\"\" ></item>";
     }
     $sql_tit="select distinct(img_titulo) as titulo from imagenes where img_activo=1 and img_seccion='".$seccion."';";
     $this->busqueda($sql_tit);
     while ($row1 = $this->getArray()){
      $cadena1=$cadena1."<item tipo=\"texto\" texto=\"".$row1["titulo"]."\" ></item>";
     }
     $cadena=$cadena.$cadena1;
     break;
    case "Fiestas":
     while ($row = $this->getArray()){
      $cadena=$cadena."<item tipo=\"fotos\" src=\"".$row["img_nombre"]."\" titulo=\"".$row["img_titulo"]."\" texto=\"\" ></item>";
     }
     $sql_tit="select distinct(img_titulo) as titulo from imagenes where img_activo=1 and img_seccion='".$seccion."';";
     $this->busqueda($sql_tit);
     while ($row1 = $this->getArray()){
      $cadena1=$cadena1."<item tipo=\"texto\" texto=\"".$row1["titulo"]."\" ></item>";
     }
     $cadena=$cadena.$cadena1;
     break;
    case "Bares":
     while ($row = $this->getArray()){
      $cadena=$cadena."<item tipo=\"fotos\" src=\"".$row["img_nombre"]."\" titulo=\"".$row["img_titulo"]."\" texto=\"\" ></item>";
     }
     $sql_tit="select distinct(img_titulo) as titulo from imagenes where img_activo=1 and img_seccion='".$seccion."';";
     $this->busqueda($sql_tit);
     while ($row1 = $this->getArray()){
      $cadena1=$cadena1."<item tipo=\"texto\" texto=\"".$row1["titulo"]."\" ></item>";
     }
     $cadena=$cadena.$cadena1;
     break;
    case "Discos":
     while ($row = $this->getArray()){
      $cadena=$cadena."<item tipo=\"fotos\" src=\"".$row["img_nombre"]."\" titulo=\"".$row["img_titulo"]."\" texto=\"".$row["img_descrip"]."\"></item>";
     }
     break;
    case "Fotos":
     while ($row = $this->getArray()){
      $cadena=$cadena."<item tipo=\"fotos\" alto=\"100\" ancho=\"200\" src=\"".$row["img_nombre"]."\" titulo=\"".$row["img_titulo"]."\" texto=\"".$row["img_descrip"]."\"></item>";
     }
     break;
   }
   $this->crea_xml($cadena,$seccion);
  }else{
   $cadena="";
   $this->crea_xml($cadena,$seccion);
  }
 }

 function xml_musica() {
  $this->connect();
  $sql_verif="select * from musica where mus_activo=1;";
  $this->busqueda($sql_verif);

  $msj=new msj();

  $cadena="";
  if (@$this->numRows()) {
   while ($row = $this->getArray()){
    $cadena=$cadena."<item tipo=\"mp3\" src=\"mp3/".$row["mus_nombre"]."\" nombre=\"".$row["mus_descrip"]."\"></item>";
   }
   $this->crea_xml($cadena,'musica');
  }else{
   //header ("Location: mensajes.php?nro_error=30&volver=1&tipo=pop");
   $cadena="";
   $this->crea_xml($cadena,'musica');
  }
 }

 function crea_xml($cadena,$tipo) {
 
  switch($tipo) {
   case "agenda":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><contacto><item tipo=\"visor_texto_1\" alto=\"300\" ancho=\"300\" scrollbars=\"si\" velocidad=\"20\" eshtml=\"si\" incremento=\"10\" texto=\"".$cadena."\"></item></contacto>";
    $archivo="xml/agenda.xml"; 
    break;
   case "musica":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><sets><item tipo=\"player_audio\">".$cadena."</item></sets>";
    $archivo="xml/dj_sets.xml"; 
    break;
   case "video":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><videos><item tipo=\"player_video\">".$cadena."</item></videos>";
    $archivo="xml/dj_videos.xml"; 
    break;
   case "Eventos":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><contacto><item tipo=\"visor_texto_fotos_2\" altoFoto=\"330\" anchoFoto=\"247\" velocidadFoto=\"3000\" altoTextoColumna=\"430\" anchoTextoColumna=\"100\">".$cadena."</item></contacto>";
    $archivo="xml/dj_eventos.xml";
    break;
   case "Fiestas":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><fiestas><item tipo=\"visor_texto_fotos_2\" altoFoto=\"330\" anchoFoto=\"247\" velocidadFoto=\"3000\" altoTextoColumna=\"430\" anchoTextoColumna=\"100\">".$cadena."</item></fiestas>";
    $archivo="xml/dj_fiestas.xml";
    break;
   case "Bares":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><bares>  <item tipo=\"visor_texto_fotos_2\" altoFoto=\"330\" anchoFoto=\"247\" velocidadFoto=\"3000\" altoTextoColumna=\"430\" anchoTextoColumna=\"100\">".$cadena."</item></bares>";
    $archivo="xml/bares.xml";
    break;
   case "Discos":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><contacto><item tipo=\"visor_fotos_3\">".$cadena."</item></contacto>";
    $archivo="xml/discos.xml";
    break;
   case "Fotos":
    $contenido="<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><contacto><item tipo=\"visor_fotos_1\">".$cadena."</item></contacto>";
    $archivo="xml/dj_fotos.xml";
    break;
  }
 
  $fp=fopen($archivo,"r+");
  if($da = fopen($archivo,"w")) {
   fwrite($fp,$contenido); 
   fclose($da);
   header ("Location: mensajes.php?nro_error=34&volver=2&tipo=pop");
   exit();
  }else{
   header ("Location: mensajes.php?nro_error=35&volver=1&tipo=pop");
   exit();
  }

 }


}
?>
<?php
require_once("class_db.php");
require_once("class_xml.php");

class Carchivo extends Base {
 var $path;
 function __construct(){
  $this->path="/home/poramor/domains/fedeschrager.com.ar/public_html/test";
  //$this->path="C:/Inetpub/wwwroot/FedericoSchrager/";
 }

 function subir_archivo($seccion,$ptitulo,$pdescripcion,$parchivo,$pactivo,$posicion,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name) {
  switch($seccion) {
   case "Eventos":
    $var_file="fotos/eventos/";
    break;
   case "Fiestas":
    $var_file="fotos/fiestas/";
    break;
   case "Bares":
    $var_file="fotos/bares/";
    break;
   case "Discos":
    $var_file="fotos/discos/";
    break;
   case "Fotos":
    $var_file="fotos/";
    break;
  }
  $descripcion = $pdescripcion;
  $this->connect();
  $Xml=new Xml();
  $sql_busca="select * from imagenes where img_nombre='".$var_file.strtolower($nombre_archivo)."'";
  $this->busqueda($sql_busca);
  if (@$this->numRows()) {
   header ("Location: mensajes.php?nro_error=26&volver=1&tipo=pop");
  }else{
   //No hay resultado
   if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 2000000))) { 
    header ("Location: mensajes.php?nro_error=22&volver=1&tipo=pop");
   }else{
    if (move_uploaded_file($tmp_name, $var_file.strtolower($nombre_archivo))){ 
     $sql_ordena1="update imagenes set img_posicion=img_posicion+1 where img_seccion='".$seccion."' and img_posicion>=".$posicion.";";
     $this->ejecutar($sql_ordena1);
     $sql="insert into imagenes (img_id,img_seccion,img_posicion,img_titulo,img_descrip,img_nombre,img_activo,img_fecha_ing) values (0,'".$seccion."',".$posicion.",'".$ptitulo."','".$pdescripcion."','".$var_file.strtolower($nombre_archivo)."',".$pactivo.",now());";
     $this->ejecutar($sql);
     $Xml->xml_fotos($seccion);
    }else{ 
     header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
    } 
   }
  }
 }

 function foto_ordena($seccion,$var_pos) {
  $this->connect();
  $sql_busca="select img_posicion from imagenes where img_seccion='".$seccion."' order by img_posicion asc";
  $this->busqueda($sql_busca);

  if (@$this->numRows()) {
   ?><select name=posicion><?
   while ($row = $this->getArray()) {
    $Var1=$Var1+1;
    if ($var_pos==$row["img_posicion"]) {
     ?>
      <option selected value=<?=$row["img_posicion"]?>><?=$row["img_posicion"]?></option>
     <?
    }else{
     ?>
      <option value=<?=$row["img_posicion"]?>><?=$row["img_posicion"]?></option>
     <?
    }
   }
    if ($var_pos==0) {
     $Var1=$Var1+1
     ?><option selected value=<?=$Var1?>><?=$Var1?></option></select><?
    }
  }else{
   ?><select name=posicion><option value=1>1</option></select><?
  }
 }

 function buscar_archivo($seccion) {
  $msj=new msj();
  $this->connect();
  $sql_busca="select * from imagenes where img_seccion='".$seccion."' order by img_seccion,img_posicion";
  $this->busqueda($sql_busca);

  if (@$this->numRows()) {
    ?>
     <table cellpadding="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <?
   while ($row = $this->getArray()) {
    ?>
    <tr>
     <td width=33% align=center rowspan=7><img border=0 src=<?=$row["img_nombre"]?> width=150 height=100></td>
     <td width=67%>Archivo: <?=$row["img_nombre"]?></td>
    </tr>
    <tr>
     <td width=67%>Seccion: <?=$row["img_seccion"]?></td>
    </tr>
    <tr>
     <td width=67%>Posicion: <?=$row["img_posicion"]?></td>
    </tr>
    <tr>
     <td width=67%>Titulo: <?=$row["img_titulo"]?></td>
    </tr>
    <tr>
     <td width=67%>Descripcion: <?=$row["img_descrip"]?></td>
    </tr>
    <tr>
     <td width=67%>Fecha Carga: <?=$row["img_fecha_ing"]?></td>
    </tr>
    <tr>
     <td width=67%>Estado: 
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
     <td width=100% colspan=2 align=center class=altn><a href=javascript:popUp('modificar_foto.php?img_id=<?=$row["img_id"]?>',500,400)><q>Modificar</q></a> | <a href=javascript:popUp('borrar_foto.php?img_id=<?=$row["img_id"]?>',500,400)><q>Borrar</q></a></td>
    </tr>
    <?
   }
    echo "</table>";
  }else{
   ?>
   <tr>
    <td width=100% colspan=2 align=center><?=$msj->mensaje(25,0)?></td>
   </tr>
   <?
  }

 }

 function modificar_archivo($seccion,$ptitulo,$pdescripcion,$parchivo,$pactivo,$img_posicion_viejo,$posicion,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name,$img_id,$img_nom_viejo) {
  switch($seccion) {
   case "Eventos":
    $var_file="fotos/eventos/";
    break;
   case "Fiestas":
    $var_file="fotos/fiestas/";
    break;
   case "Bares":
    $var_file="fotos/bares/";
    break;
   case "Discos":
    $var_file="fotos/discos/";
    break;
   case "Fotos":
    $var_file="fotos";
    break;
  }
  $this->connect();
  $Xml=new Xml();
 $sql2="";

 if ($img_posicion_viejo>$posicion) {
  $sql2="update imagenes set img_posicion=img_posicion+1 where img_seccion='".$seccion."' and img_posicion>=".$posicion." and img_posicion<".$img_posicion_viejo.";";
 } else if ($img_posicion_viejo<$posicion) {
  $sql2="update imagenes set img_posicion=img_posicion-1 where img_seccion='".$seccion."' and img_posicion>".$img_posicion_viejo." and img_posicion<=".$posicion.";";
 }

  if ($nombre_archivo <> "" ) {
   $descripcion = $pdescripcion;
   $sql_busca="select * from imagenes where img_nombre='".$var_file.strtolower($nombre_archivo)."' and img_id<>".$img_id.";";
   $this->busqueda($sql_busca);
   if (@$this->numRows()) {
    header ("Location: mensajes.php?nro_error=26&volver=1&tipo=pop");
   }else{
    //No hay resultado
    if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 2000000))) { 
     header ("Location: mensajes.php?nro_error=22&volver=1&tipo=pop");
    }else{
     if (move_uploaded_file($tmp_name, $var_file.strtolower($nombre_archivo))){ 
      unlink($this->path.$img_nom_viejo);
      $sql="update imagenes set img_seccion='".$seccion."',img_posicion=".$posicion.",img_titulo='".$ptitulo."',img_descrip='".$pdescripcion."',img_nombre='".$var_file.strtolower($nombre_archivo)."',img_activo=".$pactivo." where img_id=".$img_id.";".$sql2;
      $this->ejecutar($sql);
      $Xml->xml_fotos($seccion);
     }else{ 
      header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
     } 
    }
   }
  }else{
   $this->ejecutar($sql2);
   $sql="update imagenes set img_seccion='".$seccion."',img_posicion=".$posicion.",img_titulo='".$ptitulo."',img_descrip='".$pdescripcion."',img_activo=".$pactivo." where img_id=".$img_id.";";
   $this->ejecutar($sql);
   $Xml->xml_fotos($seccion);
  }
 }

 function borrar_archivo($img_id,$seccion,$posicion) {
  $this->connect();
  $Xml=new Xml();
  $sql_busca="select * from imagenes where img_id=".$img_id.";";
  $this->busqueda($sql_busca);
  if (@$this->numRows()) {
   while ($row = $this->getArray()) {
    unlink($this->path.$row["img_nombre"]);
    $sql="delete from imagenes where img_id=".$img_id.";";
    $sql_ordena1="update imagenes set img_posicion=img_posicion-1 where img_seccion='".$seccion."' and img_posicion>".$posicion.";";
    $this->ejecutar($sql_ordena1);
    $this->ejecutar($sql);
    //header ("Location: mensajes.php?nro_error=27&volver=2&tipo=pop");
    $Xml->xml_fotos($seccion);
   }
  }else{
   header ("Location: mensajes.php?nro_error=25&volver=1&tipo=pop");
  }
 }

 function subir_musica($pdescripcion,$parchivo,$pactivo,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name) {
  $descripcion = $pdescripcion;
  $this->connect();
  $Xml=new Xml();
  $sql_busca="select * from musica where mus_nombre='".strtolower($nombre_archivo)."'";
  $this->busqueda($sql_busca);

  if (@$this->numRows()) {
   header ("Location: mensajes.php?nro_error=28&volver=1&tipo=pop");
  }else{
   //No hay resultado
   if (!((strpos($nombre_archivo, "mp3") || strpos($tipo_archivo, "wma")) && ($tamano_archivo < 10000000))) { 
    header ("Location: mensajes.php?nro_error=29&volver=1&tipo=pop");
   }else{ 
    if (move_uploaded_file($tmp_name, "mp3/".strtolower($nombre_archivo))){ 
     $sql="insert into musica (mus_id,mus_descrip,mus_nombre,mus_activo,mus_fecha_ing) values (0,'".$pdescripcion."','".strtolower($nombre_archivo)."',".$pactivo.",now())";
     $this->ejecutar($sql);
     //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
     $Xml->xml_musica();
    }else{ 
     header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
    } 
   }
  }
 }

 function buscar_musica() {
  $msj=new msj();
  $this->connect();
  $sql_busca="select * from musica";
  $this->busqueda($sql_busca);

  if (@$this->numRows()) {
    ?>
     <table cellpadding="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <?
   while ($row = $this->getArray()) {
    ?>
    <tr>
     <td width=33% align=center rowspan=4><img border=0 src=mp3/musica.jpg width=150 height=100></td>
     <td width=67%>Nombre: <?=$row["mus_nombre"]?></td>
    </tr>
    <tr>
     <td width=67%>Descripcion: <?=$row["mus_descrip"]?></td>
    </tr>
    <tr>
     <td width=67%>Fecha Carga: <?=$row["mus_fecha_ing"]?></td>
    </tr>
    <tr>
     <td width=67%>Estado: 
    <?
     if ($row["mus_activo"]==1) {
      echo "SI";
     }else{
      echo "NO";
     }
    ?>
     </td>
    </tr>
    <tr>
     <td width=100% colspan=2 align=center class=altn><a href=javascript:popUp('modificar_musica.php?mus_id=<?=$row["mus_id"]?>',500,400)><q>Modificar</q></a> | <a href=javascript:popUp('borrar_musica.php?mus_id=<?=$row["mus_id"]?>',500,400)><q>Borrar</q></a></td>
    </tr>
    <?
   }
    echo "</table>";
  }else{
   ?>
   <tr>
    <td width=100% colspan=2 align=center><?=$msj->mensaje(30,0)?></td>
   </tr>
   <?
  }
 }

 function modificar_musica($pdescripcion,$parchivo,$pactivo,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name,$mus_id,$mus_nom_viejo) {
  $this->connect();
  $Xml=new Xml();

  if ($nombre_archivo <> "" ) {
   $descripcion = $pdescripcion;
   $sql_busca="select * from musica where mus_nombre='".strtolower($nombre_archivo)."' and mus_id<>".$mus_id.";";
   $this->busqueda($sql_busca);

   if (@$this->numRows()) {
    header ("Location: mensajes.php?nro_error=28&volver=1&tipo=pop");
   }else{
    //No hay resultado
    if (!((strpos($nombre_archivo, "mp3") || strpos($tipo_archivo, "wma")) && ($tamano_archivo < 10000000))) { 
     header ("Location: mensajes.php?nro_error=29&volver=1&tipo=pop");
    }else{ 
     if (move_uploaded_file($tmp_name, "mp3/".strtolower($nombre_archivo))){ 
      unlink($this->path."mp3/".$mus_nom_viejo);
      $sql="update musica set mus_descrip='".$pdescripcion."',mus_nombre='".strtolower($nombre_archivo)."',mus_activo=".$pactivo." where mus_id=".$mus_id.";";
      $this->ejecutar($sql);
      //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
      $Xml->xml_musica();
     }else{ 
      header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
     } 
    }
   }
  }else{
   $sql="update musica set mus_descrip='".$pdescripcion."',mus_activo=".$pactivo." where mus_id=".$mus_id.";";
   $this->ejecutar($sql);
   //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
   $Xml->xml_musica();
  }
 }

 function borrar_musica($mus_id) {
  $this->connect();
  $Xml=new Xml();
  $sql_busca="select * from musica where mus_id=".$mus_id.";";
  $this->busqueda($sql_busca);
  if (@$this->numRows()) {
   while ($row = $this->getArray()) {
    unlink($this->path."mp3/".$row["mus_nombre"]);
    $sql="delete from musica where mus_id=".$mus_id.";";
    $this->ejecutar($sql);
    //header ("Location: mensajes.php?nro_error=31&volver=2&tipo=pop");
    $Xml->xml_musica();
   }
  }else{
   header ("Location: mensajes.php?nro_error=30&volver=1&tipo=pop");
  }
 }

 function buscar_videos() {
  $msj=new msj();
  $this->connect();
  $sql_busca="select * from videos";
  $this->busqueda($sql_busca);

  if (@$this->numRows()) {
    ?>
     <table cellpadding="1" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
    <?
   while ($row = $this->getArray()) {
    ?>
    <tr>
     <td width=33% align=center rowspan=4><img border=0 src=flv/video.jpg width=150 height=100></td>
     <td width=67%>Nombre: <?=$row["vid_nombre"]?></td>
    </tr>
    <tr>
     <td width=67%>Descripcion: <?=$row["vid_descrip"]?></td>
    </tr>
    <tr>
     <td width=67%>Fecha Carga: <?=$row["vid_fecha_ing"]?></td>
    </tr>
    <tr>
     <td width=67%>Estado: 
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
     <td width=100% colspan=2 align=center class=altn><a href=javascript:popUp('modificar_video.php?vid_id=<?=$row["vid_id"]?>',500,400)><q>Modificar</q></a> | <a href=javascript:popUp('borrar_video.php?vid_id=<?=$row["vid_id"]?>',500,400)><q>Borrar</q></a></td>
    </tr>
    <?
   }
    echo "</table>";
  }else{
   ?>
   <tr>
    <td width=100% colspan=2 align=center><?=$msj->mensaje(30,0)?></td>
   </tr>
   <?
  }
 }

 function subir_video($pdescripcion,$parchivo,$pactivo,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name) {
  $descripcion = $pdescripcion;
  $this->connect();
  $sql_busca="select * from videos where vid_nombre='".strtolower($nombre_archivo)."'";
  $this->busqueda($sql_busca);

  $Xml=new Xml();

  if (@$this->numRows()) {
   header ("Location: mensajes.php?nro_error=32&volver=1&tipo=pop");
  }else{
   //No hay resultado
   if (!((strpos($nombre_archivo, "flv") || strpos($tipo_archivo, "flv")) && ($tamano_archivo < 20000000))) { 
    header ("Location: mensajes.php?nro_error=33&volver=1&tipo=pop");
   }else{ 
    if (move_uploaded_file($tmp_name, "flv/".strtolower($nombre_archivo))){ 
     $sql="insert into videos (vid_id,vid_descrip,vid_nombre,vid_activo,vid_fecha_ing) values (0,'".$pdescripcion."','".strtolower($nombre_archivo)."',".$pactivo.",now())";
     $this->ejecutar($sql);
     //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
     $Xml->xml_videos();
    }else{ 
     header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
    } 
   }
  }
 }

 function modificar_video($pdescripcion,$parchivo,$pactivo,$nombre_archivo,$tipo_archivo,$tamano_archivo,$tmp_name,$vid_id,$vid_nom_viejo) {
  $this->connect();
  $Xml=new Xml();

  if ($nombre_archivo <> "" ) {
   $descripcion = $pdescripcion;
   $sql_busca="select * from videos where vid_nombre='".strtolower($nombre_archivo)."' and vid_id<>".$vid_id.";";
   $this->busqueda($sql_busca);

   if (@$this->numRows()) {
    header ("Location: mensajes.php?nro_error=32&volver=1&tipo=pop");
   }else{
    //No hay resultado
    if (!((strpos($nombre_archivo, "flv") || strpos($tipo_archivo, "flv")) && ($tamano_archivo < 20000000))) { 
     header ("Location: mensajes.php?nro_error=33&volver=1&tipo=pop");
    }else{ 
     if (move_uploaded_file($tmp_name, "videos/".strtolower($nombre_archivo))){ 
      unlink($this->path."flv/".$vid_nom_viejo);
      $sql="update videos set vid_descrip='".$pdescripcion."',vid_nombre='".strtolower($nombre_archivo)."',vid_activo=".$pactivo." where vid_id=".$vid_id.";";
      $this->ejecutar($sql);
      //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
      $Xml->xml_videos();
     }else{ 
      header ("Location: mensajes.php?nro_error=24&volver=1&tipo=pop");
     } 
    }
   }
  }else{
   $sql="update videos set vid_descrip='".$pdescripcion."',vid_activo=".$pactivo." where vid_id=".$vid_id.";";
   $this->ejecutar($sql);
   //header ("Location: mensajes.php?nro_error=23&volver=2&tipo=pop");
   $Xml->xml_videos();
  }
 }

 function borrar_video($vid_id) {
  $this->connect();
  $Xml=new Xml();
  $sql_busca="select * from videos where vid_id=".$vid_id.";";
  $this->busqueda($sql_busca);
  if (@$this->numRows()) {
   while ($row = $this->getArray()) {
    unlink($this->path."flv/".$row["vid_nombre"]);
    $sql="delete from videos where vid_id=".$vid_id.";";
    $this->ejecutar($sql);
    //header ("Location: mensajes.php?nro_error=31&volver=2&tipo=pop");
    $Xml->xml_videos();
   }
  }else{
   header ("Location: mensajes.php?nro_error=30&volver=1&tipo=pop");
  }
 }

}

?>

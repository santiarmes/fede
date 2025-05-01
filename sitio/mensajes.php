<?
require_once("header.php");
$Header=new Header();
$Header->header_msj("Mensaje del Sistema",0);

$msj=new msj();

require_once("botton.php");
$Botton=new Botton();

if (@isset($nro_error) and @isset($volver) and  @isset($tipo)) {
 if (is_numeric($nro_error)) {
  if (is_numeric($volver)) {
   $msj->mensaje($nro_error,$volver);
  }else{
   $msj->mensaje(7,1);
  }
 }else{
  $msj->mensaje(7,1);
 }
 if ($tipo=="pop") {
  $Botton->Botton_pop();
 }else{
  $Botton->botton_login();
 }
}else{
 $msj->mensaje(0,0);
}

?>
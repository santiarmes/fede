<?
require_once("header.php");
$Header=new Header();
$Header->header_admin("Administrador");
?>

<br>
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
    <td width=100% colspan=4 align=center class=tit>Mi Agenda</td>
  </tr>
  <tr>
    <td width="30%">
    <div align="center">
<?
require ("calendario.php");

if (!$HTTP_POST_VARS && !$HTTP_GET_VARS){
	$tiempo_actual = time();
	$mes = date("n", $tiempo_actual);
	$ano = date("Y", $tiempo_actual);
	$h = "3";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
	$hm = $h * 60; 
	$ms = $hm * 60;
	//$gmdate1 = gmdate("y-m-d g:i:s A", time()-($ms)); // the "-" can be switched to a plus if that's what your time zone is.
	$gmdate1 = gmdate("y-m-d", time()-($ms)); // the "-" can be switched to a plus if that's what your time zone is.

}else {
	$mes = $nuevo_mes;
	$ano = $nuevo_ano;
	if (!isset($nuevo_dia)) {
		$dia = 00;
	}else{
		$dia = $nuevo_dia;
	}
	$gmdate1 = $ano."-".$mes."-".$dia;
}

$msj=new msj();
if (is_numeric($mes)) {
 if (is_numeric($ano)) {
  mostrar_calendario($mes,$ano);
  formularioCalendario($mes,$ano);
 }else{
  $msj->mensaje(9,0);
 }
}else{
 $msj->mensaje(10,0);
}
?>
</div>
    </td>
    <td width="70%" valign="top">
<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%"><a href="javascript:popUp('agregar_item.php',500,400)"><q>Agregar nuevo item</q></a><p></td>
  </tr>
</table>
<?
require_once("class_agenda.php");
$Cagenda=new Cagenda();
$Cagenda->agenda_busca($gmdate1);
?>
	</td>
  </tr>
</table>

<?
require_once("botton.php");
$Botton=new Botton();
$Botton->Botton_admin();
?>
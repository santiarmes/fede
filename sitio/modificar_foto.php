<?
require_once("header.php");
$Header=new Header();
$Header->header_pop("Modificar Foto");

require_once("class_db.php");
$Base=new Base();
$Base->connect();
$Base->busqueda("select * from imagenes where img_id=".$img_id.";");

if (@$Base->numRows()) {
 while ($row = $Base->getArray()){
?>
<script>
function fun_sec(Var_Secc,Var_Pos){
 if (Var_Secc=='Eventos'){
   document.forms.formul.titulo.value = '';
   document.forms.formul.descripcion.value = 'N/A';   
   document.forms.formul.titulo.readOnly=0;
   document.formul.descripcion.readOnly=1;
   document.formul.titulo.style.backgroundColor="White";
   document.formul.descripcion.style.backgroundColor="#cccccc";
 }

 if (Var_Secc=='Fiestas'){
   document.forms.formul.titulo.value = '';
   document.forms.formul.descripcion.value = 'N/A';
   document.forms.formul.titulo.readOnly=0;
   document.formul.descripcion.readOnly=1;
   document.formul.titulo.style.backgroundColor="White";
   document.formul.descripcion.style.backgroundColor="#cccccc";
 }

 if (Var_Secc=='Bares'){
   document.forms.formul.titulo.value = '';
   document.forms.formul.descripcion.value = 'N/A';
   document.forms.formul.titulo.readOnly=0;
   document.formul.descripcion.readOnly=1;
   document.formul.titulo.style.backgroundColor="White";
   document.formul.descripcion.style.backgroundColor="#cccccc";
 }

 if (Var_Secc=='Discos'){
   document.forms.formul.titulo.value = '';
   document.forms.formul.descripcion.value = '';
   document.forms.formul.titulo.readOnly=0;
   document.formul.descripcion.readOnly=0;
   document.formul.titulo.style.backgroundColor="White";
   document.formul.descripcion.style.backgroundColor="White";
 }

 if (Var_Secc=='Fotos'){
   document.forms.formul.descripcion.value = 'N/A';
   document.forms.formul.titulo.value = 'N/A';
   document.forms.formul.titulo.readOnly=1;
   document.formul.descripcion.readOnly=1;
   document.formul.titulo.style.backgroundColor="#cccccc";
   document.formul.descripcion.style.backgroundColor="#cccccc";
 }

url = 'foto_ordena.php?Var_Secc=' + Var_Secc + '&Var_Pos=' + Var_Pos;
    if(url==''){
        return;
    }
    //  Otro Navegador
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET", url, true);
        req.send(null);
    //  Internet Explorer Windows
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("GET", url, true);
            req.send();
        }
    }

}

function processReqChange(){
    var posicion = document.getElementById("posicion");
    if(req.readyState == 4){
	posicion.innerHTML = req.responseText;
    } else {
        posicion.innerHTML = '<img src="loading.gif" align="absmiddle" /> Cargando...';
    }
}

</script>
<form name="formul" action="acciones.php" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="accion" value="archivos">
<input type="hidden" name="tarea" value="modificar">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input type="hidden" name="img_id" value="<?=$row["img_id"]?>">
<input type="hidden" name="img_posicion_viejo" value="<?=$row["img_posicion"]?>">
<input type="hidden" name="img_posicion" value="<?=$row["img_posicion"]?>">
<input type="hidden" name="img_nom_viejo" value="<?=$row["img_nombre"]?>">

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
    <td width=100% colspan=6 align=center class=altn>Modificar Foto</td>
  </tr>
  <tr>
    <td width="35%" class=tit>Seccion</td>
    <td width="65%">
     <select name=seccion onchange="fun_sec(document.formul.seccion.value,'<?=$row["img_posicion"]?>');">
      <option value="Eventos">Eventos</option>
      <option value="Fiestas">Fiestas</option>
      <option value="Bares">Bares</option>
      <option value="Discos">Discos</option>
      <option value="Fotos">Fotos</option>
     </select>
    </td>
  </tr>
  <tr>
    <td width="35%" class=tit>Titulo</td>
    <td width="65%"><input type="text" name="titulo" readonly value="<?=$row["img_titulo"]?>" size="50" maxlength="100" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Descripcion</td>
    <td width="65%"><input type="text" name="descripcion" readonly value="<?=$row["img_descrip"]?>" size="50" maxlength="100" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Nombre</td>
    <td width="65%"><?=$row["img_nombre"]?></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Foto (Max 2 mb)</td>
    <td width="65%"><input name="archivo" type="file" size="40" onKeypress="ValidaCarac()"></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Posicion</td>
    <td width="65%"><div id="posicion" align="left"></div></td>
  </tr>
  <tr>
    <td width="35%" class=tit>Activo</td>
    <td width="65%">
     <?
     if ($row["img_activo"]==1) {
      echo "<select name=activo><option value=1>SI</option><option value=0>NO</option></select>";
     }else{
      echo "<select name=activo><option value=0>NO</option><option value=1>SI</option></select>";
     }
     ?>
    </td>
  </tr>
  <tr>
    <td width=100% colspan=4 align=center class=altn>
      <INPUT TYPE="button" VALUE="Modificar" onclick="valida_campo(this.form,'titulo,descripcion,activo','Foto');">
    </td>
  </tr>
</table>
<div id="detalles" align="center"></div>
</form>
<script>
for (i=0; i<document.forms.formul.seccion.length; i++) {
 if (document.forms.formul.seccion[i].value=="<?=$row["img_seccion"]?>") {
  document.forms.formul.seccion.selectedIndex=i;
  fun_sec(document.formul.seccion[i].value,'<?=$row["img_posicion"]?>');
  break;
 }
}
</script>

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
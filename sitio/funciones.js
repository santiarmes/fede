// /////////////////////////////////////////////////////////////////////////
// //  Funciones de validaciones y script's varios.                       //
// /////////////////////////////////////////////////////////////////////////

function Mensaje(msj){
 alert(msj);
}

function Error(mensaje,volver) {
 alert(mensaje);
 if(volver == 1){
  window.history.back();
 }
}

function Cerr_Ref(volver) {
 window.close();
 if(volver == 1){
  top.window.opener.location.reload();
 }
}

function Volver(){
 history.go(-1);
}

function ValidaCarac(){
 if (event.keyCode==34 || event.keyCode==39){
  event.returnValue = false;
 }
}

function ValidaNro(){
 if (event.keyCode < 45 || event.keyCode > 57){
  event.returnValue = false;
 }
}

function UpCarac(form){
 form.value=form.value.toUpperCase();
}

function SelectIdx(usr){
 for (i = 0; i < formul.usr_id.options.length; i++){
  if (formul.usr_id.options[i].value==usr) {
   formul.usr_id.selectedIndex=i;
  }
 }
}

function verifica_clave(form,clave1,clave2) {
 if (form.elements[clave].value == "" || form.elements[repita_clave].value == "") {
  alert("Debe completar todos los campos ");
  return;
 }else{
  if(clave1 != clave2){
   alert("Las claves deben ser iguales");
   return;
  }else{
   form.submit();
  }
 }
}

function valida_campo(form,name,carga){ 
var var1 = name;
 while (var1 != ""){
  var patron = /,/i;
  var pos = var1.search(patron);
  if(pos < 1){
   pos = var1.length;
  }
  var nombre = var1.slice(0, pos);
   if (form.elements[nombre].value == ""){
    alert("Complete el campo " + form.elements[nombre].name);
    return;
   }else{
    var1 = var1.substr(pos+1);
   }
 }
 if (carga != "") {
  var detalles = document.getElementById("detalles");
  detalles.innerHTML = '<img src="loading.gif" align="absmiddle" /> Cargando&nbsp;' + carga + '...';
 }
 //form.submit();
validaSubmite(form)
}

function derecha(e) {
 if (navigator.appName == 'Netscape' && (e.which == 3 || e.which == 2)){
  alert('Accion no permitida')
  return false;
 }
 else if (navigator.appName == 'Microsoft Internet Explorer' &&   (event.button == 2)){
  alert('Accion no permitida')
 }
}
document.onmousedown=derecha

var var1="0";
function validaSubmite(form){
  if (var1=="0"){
   var1="1";
  }else{
   alert ('Aguarde, su transaccion esta siendo procesada . . .');	
   return	
  }
 form.submit();
}

function Concatena(form,concat1,concat2,donde){
 form.elements[donde].value = form.elements[concat1].value + ' ' + form.elements[concat2].value
}

function popUp(URL,w,h) {
 day = new Date();
 id = day.getTime();
 //id='pagina'
  width=w
  height=h
  eval("page" + id + " = window.open(URL , '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=" + width + ",height=" + height + ",left = 150,top = 100');");
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit) // if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
		// otherwise, update 'characters left' counter
	else 
		countfield.value = maxlimit - field.value.length;
}

function cambiarHojaEstilos(objeto,formul,si,no1,no2,camp,valor) {
  //var var1=document.activeElement.className
  objeto.style.backgroundColor='green';
  document.getElementById(no1).style.backgroundColor='#E6E6E6';
  document.getElementById(no2).style.backgroundColor='#E6E6E6';
  document.formul.valor[camp].value=valor;
}

/*
function HomePage() {
 this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.FedericoSchrager.com.ar');
}

function Favorite() {
 window.external.AddFavorite('http://www.FedericoSchrager.com.ar');
}
*/
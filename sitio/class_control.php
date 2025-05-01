<?
include("class_db.php");
include("class_msj.php");

class Control extends Base {

 function control_usr($pusuario,$pclave) {
  $this->connect();
  $sql_verif="select * from usuarios where usr_id='".strtoupper($pusuario)."';";
  $this->busqueda($sql_verif);

  $msj=new msj();

  if (@$this->numRows()) {
   while ($row = $this->getArray()){
    if ($row["usr_clave"] == $pclave){
     if ($row["usr_activo"] == "1") {
      session_start();
      $_SESSION["AUTORIZADO"] = "SI";
      $_SESSION["username"] = $pusuario;
      $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s"); 
      header ("Location: agenda.php");
     }else{
      //$msj->mensaje(19,1);
      header ("Location: mensajes.php?nro_error=19&volver=3&tipo=login");
     }
    }else{
     //$msj->mensaje(3,1);
     header ("Location: mensajes.php?nro_error=3&volver=3&tipo=login");
    }
   }
  }else{
   //$msj->mensaje(4,1);
   //header ("Location: mensajes.php?nro_error=4&volver=3&tipo=login");
echo "Sql ".$sql_verif;
  }
 }

 function cambiar_clave($pclave,$prepita_clave,$pusuario) {
  $msj=new msj();
  if ($pclave==$prepita_clave){
   $this->connect();
   $this->ejecutar("update usuarios set usr_clave='".$prepita_clave."' where usr_id='".$pusuario."';");
   header ("Location: cambiar_clave.php");
  }else{
   $msj->mensaje(20,1);
  }
 }
}
?>
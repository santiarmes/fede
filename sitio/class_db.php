<?php
class Base {
/*
 var $dbname = "db_dj";
 var $dbserver = "localhost";
 var $dbuser = "root";
 var $dbpass = "nehuen09";
*/
 var $dbname = "poramor_Fede";
 var $dbserver = "localhost";
 var $dbuser = "poramor_Fede";
 var $dbpass = "Lautaroo";

 var $DB = null;
 var $RS = null;
 var $sql = "";
 var $error_message = "";

 function connect() {
  if($this->DB == null) {
   $this->RS = null;
   $this->DB = mysql_connect ($this->dbserver, $this->dbuser, $this->dbpass)
    or $error_message = mysql_errno().": ".mysql_error();
   if(!mysql_select_db($this->dbname, $this->DB)) {
    $error_message = mysql_errno().": ".mysql_error();
   }
  }        
 }

 function busqueda($sql) {
  if($this->DB != null) {
   $this->RS = mysql_query ($sql);
    $error_message = mysql_errno().": ".mysql_error();
  }    
   return $this->RS;
  }

 function ejecutar($sql) {
  //return $this->exec($sql);    
  mysql_query ($sql);
 }

 function getSQL() {
  return $this->sql;    
 }
    
 function close() {
  if($this->DB != null) {
   mysql_close($this->DB);
   $this->DB = null;
    if($this->RS != null) {
     mysql_free_result($this->RS);
     $this->RS = null;
    }
   }    
 }

    ////////////////////////
    // Resultset related
    ////////////////////////    
    function getRow() {
        $obj = null;
        if($this->RS != null) {
            $obj = mysql_fetch_row ($this->RS);
        }            
        return $obj;
    }    
    function getObject() {
        $obj = null;
        if($this->RS != null) {
            $obj = mysql_fetch_object ($this->RS);
        }           
        return $obj;
    }
    function getArray() {
        $obj = null;
        if($this->RS != null) {
            $obj = mysql_fetch_array ($this->RS);
        }            
        return $obj;
    }    
    function getAssoc() {
        $obj = null;
        if($this->RS != null) {
            $obj = mysql_fetch_assoc ($this->RS);
        }            
        return $obj;
    }
    
    function numCols() {
        $r = 0;
        if($this->RS != null) {
            $r = mysql_num_fields($this->RS);    
        }    
        return $r;
    }
    
    function numRows() {
        $r = 0;
        if($this->RS != null) {
            $r = mysql_num_rows($this->RS);    
        }
        return $r;
    }
    
    function affectedRows() {
        $r = 0;
        if($this->RS != null) {
            $r = mysql_affected_rows();    
        }    
        return $r;
    }
    
    function lastOID() {
        $id = null;
        if ($this->RS != null) {
            $id = mysql_insert_id ($this->DB);
        }
        return $id;
    }
    
    // replaces unix wildcard chars with sql wildcard chars
    function sqlSearchStr($srch_str) {
        $srch_str = str_replace("*", "%", $srch_str);
        $srch_str = str_replace("?", "_", $srch_str);
        return $srch_str;
    }
    
    ////////////////////////
    // Transaction related
    ////////////////////////
    function beginTrans() {
        return @mysql_query($this->DB, "begin");
    }

    function commitTrans() {
        return @mysql_query($this->DB, "commit");
    }

    // returns true/false
    function rollbackTrans() { 
        return @mysql_query($this->DB, "rollback");
    }
}
?>
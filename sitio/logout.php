<?
// destruimos la session de usuarios.
session_start();
session_destroy();
header ("Location: login.php");
?>
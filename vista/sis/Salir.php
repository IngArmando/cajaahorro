<?php
session_start();
  require_once("../../modelo/MSesion.php");
    $user = new clsSesion;
  $user->insertarBitacora($_SESSION["idUsuario"],"El usuario cerró sesión");
  $user->logOut();
  echo "<script> location.href='../pub/Acceso.php' </script>";
  exit();
?>
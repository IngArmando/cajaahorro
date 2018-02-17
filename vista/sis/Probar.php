<?php
session_start();
  include_once ('../../modelo/MSesion.php');
    $OSes = new clsSesion;
?>

<!DOCTYPE html>
<html>
<head>
  <title>Configuración | Servicios</title>


</head>
<body>  
 <?php 
      echo $OSes->getRealIP();
      echo $OSes->getBrowser();
  ?>
</body>
</html>
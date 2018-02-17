<?php
	include_once("../modelo/MSocio.php");
    $OSocio = new Socio();

    $OSocio->setCedula($_GET["cedula"]);
    $consulta = $OSocio->busCedula();
    echo json_encode($OSocio->getArreglo($consulta));
?>
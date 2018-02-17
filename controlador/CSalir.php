<?php
session_start();
if(!isset($_SESSION))
	header("Location: ../vista/pub/Acceso.php");
else {
	session_unset();
	session_destroy();
	header("Location: ../vista/pub/Acceso.php");
}
?>
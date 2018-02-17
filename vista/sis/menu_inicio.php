<?php session_start();
    if(!isset($_SESSION["user_name"])){
        header("location: ../pub/inise.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inicio</title>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="generator" content="Bootply" />
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/dist/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../js/toggle_menu.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/dist/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>
    <?php echo $_SESSION['menu_bar']; ?> <!-- Menu Lateral -->
    <?php echo $_SESSION['menu_icon']; ?><!--Menu iconos -->
</body>
</html>
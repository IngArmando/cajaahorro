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
    <style type="text/css"> .container2{ padding: 10px; margin: auto; margin-top: 25px; } </style>
    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
    <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script type="text/javascript" src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script type="text/javascript" src="../../js/toggle_menu.js"></script> <!--Configura Interfaz -->
    <script type="text/javascript" src="../../css/SemanticUI/dist/semantic.js"></script><!-- Interface de usuario -->
    <script type="text/javascript" src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>
    <?php 
        /* vamos a buscar los datos del usuario */
        $usuarioLogeado = $_SESSION['user'];
        include_once("../../mdl/m_usuario.php");
        $objUsuario = new user;
        $datosSocio = $objUsuario->getByUser($usuarioLogeado);

     ?>
    <?php echo $_SESSION['menu_bar']; ?> <!-- Menu Lateral -->
    <div class="container">
        <form class="ui form" method="POST" action="../../ctrl/c_perfil.php" name="f_perfil">
        <h2 class="ui center aligned small block icon inverted header">
            <i class="user icon"></i>
            Perfil (Mis Datos)
        </h2>
        <b>Datos Personales</b>
        <h4 class="ui dividing header"></h4>

        <div class="three fields">
            <div class="field">
                <label>Nombre</label>
                <input type="text" name="txtNombre" value="<?php echo $datosSocio['nombre_socio'] ?>">
            </div>
            <div class="field">
                <label>Apellido</label>
                <input type="text" name="txtApellido" value="<?php echo $datosSocio['apellido_socio'] ?>">
            </div>
            <div class="field">
                <label>Fecha de Nacimiento</label>
                <input type="text" id="datepicker" class="hasDatepicker" placeholder="dd/mm/aaaa" readonly="" name="txtFechaNacimiento" value="<?php echo $objUsuario->set_fecha($datosSocio['fecha_nacimiento_socio']) ?>">
            </div>
        </div>
        <div class="three fields">
            <div class="field">
                <label>Telefono Fijo</label>
                <input type="text" name="txtTelefonoFijo" value="<?php echo $datosSocio['telf_fijo_socio'] ?>">
            </div>
            <div class="field">
                <label>Telefono Movil</label>
                <input type="text" name="txtTelefonoMovil" value="<?php echo $datosSocio['telf_movil_socio'] ?>">
            </div>
            <div class="field">
                <label>Email</label>
                <input type="text" name="txtEmail" value="<?php echo $datosSocio['email_socio'] ?>">
            </div>
        </div>
        <div class="one field">
            <div class="field">
                <label>Dirección</label>
                <textarea name="txtDirecion" style="resize: none; height: 30px"><?php echo $datosSocio['direccion_socio'] ?></textarea>
            </div>
        </div>
        <b>Clave</b>
        <h4 class="ui dividing header"></h4>
        <div class="three fields">
            <div class="field">
                <label>Clave Actual</label>
                <input type="password" name="txtClave">
            </div>
            <div class="field">
                <label>Nueva Clave</label>
                <input type="password" name="txtNuevaClave1">
            </div>
            <div class="field">
                <label>Repita Nueva Clave</label>
                <input type="password" name="txtNuevaClave2">
            </div>
        </div>
        <div class="ui center aligned block inverted header">
            <input type="hidden" name="opera" id="opera">
            <input type="submit" class="ui primary button" value="Aceptar" name="evento">
            <a class="ui red button" href="menu_inicio.php">Cancelar</a>   
        </div>
    </div>
</body>
</html>
<?php if(isset($_GET["msj"]) && !empty($_GET["msj"])): ?>
<script type="text/javascript">
    
    alert("<?php echo $_GET['msj'] ?>");
    
</script>
<?php endif; ?>
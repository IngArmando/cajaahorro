<?php
session_start();

  include_once("../../modelo/MUsuario.php");
  $lista = new Usuario();

  if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/inise.php");
    }


?>

<!DOCTYPE html>
<html>
<head>
  <title>Configuración | Usuarios</title>

  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   

  <!--  Propiedades -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"> <!--Bootstrap -->
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/DataTablesConfig.js"></script> <!--Configura Interfaz -->
  <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
  <?php include_once('Menu.php'); ?>

  <div class="ui container">
    <h2 class="ui center aligned small block icon inverted header">
      <i class="users icon"></i>
      Usuarios                
    </h2>   
    <a class="ui labeled icon button" href="Inicio.php">
      <i class="left arrow icon"></i>
      Volver
    </a>
	<h4 class="ui centered block dividing header">Usuarios del Sistema</h4>
	<form name="formulario" id="formulario" action="../../controlador/CUsuario.php" method="POST">
        <?php
            $listado=$lista->listar();
            foreach ($listado as $tagtp){echo $tagtp;}
        ?>

		<input type="hidden" name="opera" id="opera">
		<input type="hidden" name="IdUser" id="IdUser">
		<script type="text/javascript">		
		/*
							function enviar(operacion,id){
							    document.getElementById("opera").value=operacion;
							    document.getElementById("IdUser").value=id;
							    if(confirm("Esta seguro de realizar esta operación?")){
							        document.formulario.submit();
							    }
							}
							*/
			

			function enviar(operacion,id){ 
		    swal({
		          text: "¿Está seguro de realizar ésta acción?",
		          type: "info",
		          showCancelButton: true,
		          cancelButtonText: "Cancelar",
		          cancelButtoncolor: "#d01919",
		          confirmButtonText: "Aceptar",
		          confirmButtonColor: "#2185d0",
		          closeOnConfirm: false,
		    },
		    function(){
		        swal.disableButtons();
		          setTimeout(function(){
				    document.getElementById("opera").value=operacion;
				    document.getElementById("IdUser").value=id;
		            $(this).addClass("ui loading form");
		            $("#formulario").submit(function(e){
		              var postData = $(this).serialize();
		              var formURL = $(this).attr("action");
		              $.ajax({
		                url : formURL,
		                type: "POST",
		                data : postData
		            });
		              e.preventDefault(); 
		          });
		            $("#formulario").submit();
		            swal({
		              type:"success",
		              text:"Operacion exitosa",
		              showCancelButton: false,
		              confirmButtonText: "Continuar",
		              confirmButtonColor: "#2185d0",
		          },function(){
		            window.location='ConfigUsuarios.php';
		          }
		          );
		        },1500);
		      });
		    }		
			


		</script>
    </form>
  </div>



</body>
</html>
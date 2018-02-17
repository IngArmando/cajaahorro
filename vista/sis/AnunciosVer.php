<?php
	/*session_start();
	if(!isset($_SESSION["user_name"])){
        header("location: ../pub/inise.php");
    }*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Anuncios</title>	
	<!-- Standard Meta -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
	<!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
	<link rel="stylesheet" type="text/css" href="../../js/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
	<!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
	<script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
	<script src="../../js/main.js"></script> <!--Configura Interfaz -->
	<script src="../../js/js_socio.js"></script> <!--Validaciones --> 
	<script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
	<script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
	<script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
	<script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
</head>

<body>	
<?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
   <div class="ui container"> 
      <form class="ui form" method="POST" action="../../controlador/.php" name="formulario">
	         <h2 class="ui center aligned small block icon inverted header">
			    <i class="announcement  icon"></i>
			    Anuncios
			 </h2>

			 <a class="ui labeled icon button" href="Anuncios.php">
			 	<i class="left arrow icon"></i>
			 	Volver
			 </a> 

		    <button type="button" class="ui right floated labeled icon button" href="">
		      <i class="send icon"></i>
		      Difundir
		   </button>

		    <button type="button" class="ui right floated labeled icon button" href="">
		      <i class="print icon"></i>
		      Imprimir
		   </button>

		 <h4 class="ui dividing header"></h4>

		 <div class="fields"><!-- -->
		    
			<div class="twelve wide field"><!-- Titulo -->
			   <label>Título</label>
			   <div class="ui input">
			      <input type="text" name="titulo_anuncio" id="titulo_anuncio" placeholder="Título del Anuncio" maxlength="80" readonly="">
			   </div>
		    </div>
			  
			<div class="field"><!-- Fecha  -->
			   <label>Fecha del Anuncio:</label>
			   <div class="ui left icon input">
			      <input type="text" name="fecha_anuncio" id="fecha_anuncio" placeholder="dd/mm/aaaa" readonly>
				   <i class="calendar icon"></i>
			   </div>
			</div>

		</div>

		<div class="field"><!-- Contenido -->		   
		   <label>Contenido:</label>
		   <textarea name="contenido_anuncio" id="contenido_anuncio" rows="10" readonly=""> </textarea>
		</div>

		<div class="ui center aligned block inverted header">
			<input type="hidden" name="opera" id="opera">
			<a class="ui red button" href="Anuncios.php">Cancelar</a>   
		</div>

	</form>
	</div>  
</body>
</html>
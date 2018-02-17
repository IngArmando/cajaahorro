<?php
	session_start();
	/*if(!isset($_SESSION["user_name"])){
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
	<script src="../../js/tinymce/tinymce.min.js"></script><!-- Libreria del campo con Editor de texto -->
	<script type="application/x-javascript"><!-- Inicia y configura Editor de texto -->
		tinymce.init({
			  selector: 'textarea',  // Campo que afecta
  			  content_style: " .{font-color: red; }",
			  menubar: false,  
  			  language: 'es',
  			  browser_spellcheck: true,
  			  content_css : '../../css/text_editor.css'
			});
	</script> 
</head>

<body>	
<?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
   <div class="ui container"> 
      <form class="ui form" method="GET" action="" name="f_anuncios">
	         <h2 class="ui center aligned small block icon inverted header">
			    <i class="announcement  icon"></i>
			    Anuncios
			 </h2>

		 <h4 class="ui center aligned header"> Nuevo Anuncio </h4>               
		 <p>  Complete el siguiente formulario para registrar un nuevo anuncio, que aparecerá en la página web principal.
		 </p>
		 
		 <h4 class="ui dividing header"></h4>

		 <div class="fields"><!-- -->
		    
			<div class="twelve wide field"><!-- Titulo -->
			   <label>Título</label>
			   <div class="ui input">
			      <input type="text" name="titulo_anuncio" id="titulo_anuncio" placeholder="Título del Anuncio" maxlength="80">
			   </div>
		    </div>
			  
			<div class="field"><!-- Fecha  -->
			   <label>Fecha del Anuncio:</label>
			   <div class="ui left icon input">
			      <input type="text" name="fecha_anuncio" id="datepicker" placeholder="dd/mm/aaaa" readonly>
				   <i class="calendar icon"></i>
			   </div>
			</div>

		</div>

		<div class="field"><!-- Contenido -->		   
		   <label>Contenido:</label>
		   <textarea name="contenido_anuncio" id="contenido_anuncio" rows="10"> </textarea>
		</div>

		<div class="ui center aligned block inverted header">
			<input type="hidden" name="opera" id="opera">
			<input type="button" class="ui primary button" value="Guardar" onclick="enviar(this.value)">
			<a class="ui red button" href="Anuncios.php">Cancelar</a>   
		</div>

	</form>
	</div> 

	
</body>
</html>
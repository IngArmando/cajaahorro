<?php
	session_start();
	include_once("../../modelo/MCombo.php");
	$combo = new Combo();

	$hoy=gmdate("d/m/Y");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socios | Registrar</title>	
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
	<script src="../../js/JsSocio.js"></script> <!--Validaciones --> 
	<script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
	<script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
	<script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
	<script src="../../js/sweetalert2/dist/sweetalert2.min.js"></script>
</head>
<body>	
	<?php include_once('Menu.php'); ?> <!-- Menu Lateral -->         
	<div class="ui container"> 
		<h2 class="ui center aligned small block icon inverted header">
	  		<i class="user icon"></i>
	  		Socios
		</h2>
    	<h3 class="ui center aligned dividing header">Registrar Socio</h3>
      	<form class="ui large form" method="POST" action="../../controlador/CSocio.php" name="formulario" id="formulario">
      		<p>Complete los datos del siguiente formulario y presione "Registrar". Solo los campos marcados con * son obligatorios.</p>
      		<div class="dividing header"></div>
      		<div class="ui info message">
				<div class="ui required inline field"><!-- Fecha de Nacimiento -->
				   <label>Fecha de inscripción a la Caja de Ahorros</label>
				   <div class="ui left icon input">
				      <input type="text" name="FechaIns" id="FechaIns"  readonly value="<?php echo $hoy;  ?>" class="FechaIns">
					   <i class="calendar icon"></i>
				   </div>
				</div>      			
      		</div>
			<h4 class="ui dividing header">Datos Personales</h4>
		 	<div class="two fields">
		     	
		     	<div class="ui required field">
			   		<label>Cédula</label>
		     		<div class="fields">
		     			<input type="hidden" name="Nacionalidad" value="V">
				     	<!--<div class="field">
					   		<?php
					            //$tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=9", "nombre_corto","nombre_corto", isset($_GET[''])?$_GET['']:'','Nacionalidad',' class="ui compact dropdown"');
					            //foreach ($tagcbotp as $tagtp){echo $tagtp;}
				            ?>
						</div>-->
						<div class="field"><!-- Nro Cedula -->
						    <input type="text" name="CI" id="CI" placeholder="Cédula" maxlength="10" onkeypress="return soloNumeros(event)">
					    </div>
		     		</div>
		     	</div>
			  
				<div class="ui field"><!-- Fecha de Nacimiento -->
				   <label>Fecha de Nacimiento</label>
				   <div class="ui left icon input">
				      <input type="text" name="FechaNac" id="FechaNac" placeholder="dd/mm/aaaa" readonly class="Fecha">
					   <i class="calendar icon"></i>
				   </div>
				</div>

			</div>

		<div class="ui required field">
		   <label>Nombre</label>
		   <div class="two fields">			   
			   	<div class="field"><!-- Nombre -->
					<input type="text" name="Nombre1" id="Nombre1" maxlength="20" placeholder="Primer Nombre" onkeypress="return soloLetras(event)">
			   	</div>
			   	<div class="field"><!-- Nombre -->
				    <input type="text" name="Nombre2" id="Nombre2" maxlength="20" placeholder="Segundo Nombre" onkeypress="return soloLetras(event)">
			   	</div>		   	
		   </div>
		</div>

		<div class="ui required field">
		    <label>Apellido</label>
		    <div class="two fields">
			   	<div class="field"><!-- Apellido -->
					<input type="text" name="Apellido1" id="Apellido1" placeholder="Primer Apellido" onkeypress="return soloLetras(event)">
			   	</div>
			   	<div class="field"><!-- Apellido -->
					<input type="text" name="Apellido2" id="Apellido2" placeholder="Segundo Apellido" onkeypress="return soloLetras(event)">
			   	</div>		    	
		    </div>
		</div>
		
		<div class="ui two fields"><!-- Telefonos -->
		   	<div class="field">
		   		<input type="hidden" name="CodMovil" value="">
		   		<label>Teléfono Móvil</label>
		      	<!--div class="fields">
		      		<div class="five wide field">
				   		<?php
				            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=4", "nombre_largo","nombre_largo", isset($_GET[''])?$_GET['']:'','CodMovil',' class="ui compact dropdown"');
				            foreach ($tagcbotp as $tagtp){echo $tagtp;}
			            ?>
					</div>
			 	    <div class="field"-->
						<input type="text" name="TelfMov" id="TelfMov" placeholder="Teléfono Móvil" maxlength="20">
		      	<!--/div-->
		   </div>
		   	<div class="field">
		   		<label>Teléfono Habitación</label>
		   		<input type="hidden" name="CodHab" value="">
		      	<!--div class="fields">
		      		<div class="five wide field">
				   		<?php
				            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=5", "nombre_largo","nombre_largo", isset($_GET[''])?$_GET['']:'','CodHab',' class="ui compact dropdown"');
				            foreach ($tagcbotp as $tagtp){echo $tagtp;}
			            ?>
					</div>
			 	    <div class="field"-->
						<input type="text" name="TelfHab" id="TelfHab" placeholder="Teléfono Hab." maxlength="20">
				  	<!--/div>
		      	</div-->
		   </div>
		</div>
		
		<div class="ui required field"><!-- Email -->
		   <label>Correo Electrónico <i class='fitted help circle icon link' data-title="Ayuda" data-content='En éste correo recibirá notificaciones e información importante relacionada a la Caja de Ahorros.' data-variation='basic'></i></label>
		   <div class="ui left icon input">
		      <input type="text" name="Email" id="Email" placeholder="Correo Electrónico" >
			  <i class="mail outline icon"></i>
		   </div>
		</div>

		<div class="ui two fields">
			<div class="ui field">
	    		<label>Lugar de Nacimiento</label>
				<textarea name="LugarNac" id="LugarNac" placeholder="Lugar de nacimiento" onkeypress="return soloLetras(event)"></textarea>
		   	</div>
		   	<div class="ui required field">
		   		<label>Tipo de Inscripción</label>
		   		<?php
		            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_tipo_persona WHERE estatus='1'", "id_tipo_persona","nombre", isset($_GET[''])?$_GET['']:'','TipoPersona',' class="ui compact dropdown" onchange="TipoPers2(this.value);"');
		            foreach ($tagcbotp as $tagtp){echo $tagtp;}
	            ?>
	            <br>

	            <table class="ui celled center aligned table" style="width: 100%; margin-top: 5px;" border="0">
			      	<tr style="background: #EEE;">
			      		<th>Accion</th>
			      		<th align="center">Fondo</th>
			      		<th>Aporte Inicial</th>
			      	</tr>
			      	<tr>
			      		<td style="width: 5%; background: #EEE; " align="center"><input type="checkbox" name="fondoco" value="1"></td>
			      		<td>Fondo Comun</td>
			      		<td> <input type="text" name="aporteco" style="width: 25%;" class="form-control"></td>
			      	</tr>
		      	<tr>
		      		<td align="center" style="width: 5%; background: #EEE; "><input type="checkbox" name="fondoce" value="1"></td>
		      		<td>Fondo Cesantia</td>
		      		<td> <input type="text" name="aportece" style="width: 25%;" class="form-control"></td>
		      	</tr>
		      </table>
	            <div id="divFondos" style="display:none">
		            <div id="divFCesantia" style="color:blue;">Será inscrito en el fondo de cesantía</div>
		            <br>
		            <div id="divFComun">
				   		<label>¿Desea inscribirse en el banco de fondo común?</label>
						<input type="checkbox" name="FondoComun" id="FondoComunSi" value="1" onchange="fondoComun();">
						<input type="checkbox" name="FondoComun" id="FondoComunNo" value="0" checked style="display:none;">
					</div>
				</div>
		   	</div>
		</div>

		


		<!-- CAMPOS INVISIBLES (NO SON NECESARIOS) -->
		<div style="display:none;">
			<h4 class="ui dividing header">Datos Bancarios</h4>
			<div class="three fields">
				<div class="ui required field">
					<label>Banco</label>
					<?php 
						$tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE id_lista=7", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','Banco',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
					?>
				</div>
				<div class="ui required field">
					<label>Nro. de Cuenta<i class='fitted help circle icon link' data-title="Ayuda" data-content='Número de la cuenta donde se transferirán los fondos de las solicitudes aprobadas, en caso de que el método de liquidacién sea por transferencia.' data-variation='basic'></i></label>
					<input type="text" name="txtNroCuenta" id="txtNroCuenta" placeholder="Número de Cuenta" maxlength="20" onkeypress="return soloNumeros(event)">
				</div>
				<div class="ui required field">
					<label>Tipo de Cuenta</label>
					<select name="txtTipoCuenta" id="txtTipoCuenta" class="ui compact dropdown">
						<option value=""></option>
						<option value="1">Corriente</option>
						<option value="2">Ahorro</option>
					</select>
				</div>
			</div>
	        <h4 class="ui dividing header">Datos Residenciales</h4>
			
			<div class="three fields"><!-- Estado - Municipio - Parroquia -->		  
			   
				<div class="ui required field">
					<label>Estado</label>
					<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_estado WHERE estatus='1'", "id_estado","estado", isset($_GET[''])?$_GET['']:'','Estado',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

				<div class="ui required field">
					<label>Municipio</label>
					<?php
					    $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_municipio WHERE estatus='1'", "id_municipio","municipio", isset($_GET[''])?$_GET['']:'','Municipio',' class="ui compact dropdown"',"id_estado");
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

				<div class="ui required field">
					<label>Parroquia</label>
					<?php
					    $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_parroquia WHERE estatus='1'", "id_parroquia","parroquia", isset($_GET[''])?$_GET['']:'','Parroquia',' class="ui compact dropdown"',"id_municipio");
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

	        </div>

	        <div class="ui required field"><!-- Direccion -->
			   <label>Dirección</label>
			   <div class="field">
			      <textarea name="Dir" id="Dir" rows="2"> </textarea>
			   </div>
			</div>

	        <h4 class="ui dividing header">Datos Ocupacionales</h4>
	        
	        <div class="three fields">

		        <div class="ui required field">
			        <label>Cargo</label>
			        <?php
						$tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=14", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','TipoDocente',' class="ui compact dropdown"');
						foreach ($tagcbotp as $tagtp){echo $tagtp;}
					?>
			    </div>

			    <div class="ui required field">
		    		<label>Salario Mensual</label>
		    		<div class="ui left labeled input">
						<div class="ui label">Bs.</div>
		    			<input type="text" id="Salario" name="Salario" placeholder="Salario" onkeypress="return soloNumeros(event)">
		    		</div>
		    	</div>

		    	<div class="ui required field">
		    		<label>Sede</label>
		    		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=3", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','Sede',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
		    	</div>  
	        	
	        </div>
	    </div>


        <div id="SoloProf" class="ui hidden message">
        	<p>Campos obligatorios sólo en caso de que el socio sea un docente.</p>
	        
	        <div class="three fields">
	        	<div class="ui required field"><!-- Fecha de Nacimiento -->
				   <label>Fecha de Ingreso <i class='fitted help circle icon link' data-title="Ayuda" data-content='Fecha en la que ingresó como docente a la UPTP.' data-variation='basic'></i></label>
				   <div class="ui left icon input">
				      <input type="text" name="FechaIng" id="FechaIng" placeholder="dd/mm/aaaa" readonly class="FechaIng">
					   <i class="calendar icon"></i>
				   </div>
				</div>
	        	<div class="ui required field">
	        		<label>Categoria</label>
	        		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=16", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','Categoria',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
	        	</div>
	        	<div class="ui required field">
	        		<label>Dedicación</label>
	        		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=15", "id_lista_valor","nombre_largo", isset($_GET[''])?$_GET['']:'','Dedicacion',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
	        	</div>
	        </div>
        </div>

		<div class="ui error message"></div> 
		<div class="ui center aligned block inverted header">
			<input type="hidden" name="opera" id="opera" value="Registrar">
			<!--input type="submit" class="ui sumbit primary button" value="Registrar" onclick="enviar(this.value)"!-->
			<input type="button" class="ui sumbit primary button" value="Registrar" onclick="enviar(this.value)">
			<input type="button" class="ui red button" value="Cancelar" onclick="cancelar()">   
		</div>
	</form>
	</div>  
</body>
</html> 
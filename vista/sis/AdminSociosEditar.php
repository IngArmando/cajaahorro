<?php
	session_start();

	include_once("../../modelo/MCombo.php");
	$combo = new Combo();
	include_once("../../modelo/MSocio.php");
	$OSocio = new Socio();
	 if (isset($_GET['id']))
  	{
	    $OSocio -> setIdPersona($_GET['id']);
	    $registro=$OSocio -> consultar();
	    while ( $fila = $OSocio->setArreglo( $registro ))
	        $datos[] = $fila;
	      foreach ($datos as $Soc) { $Soc; }
  	}

	$hoy=date("d/m/Y");

	echo 'adfasdfasdfasdf';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Socios | Editar</title>	
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
      		Socio
    	</h2>
    	<h3 class="ui center aligned dividing header">Editar Socio</h3>
      	<form class="ui large form" method="POST" action="../../controlador/CSocio.php" name="formulario" id="formulario">
      		<div class="dividing header"></div>
      		
			<h4 class="ui dividing header">Datos Personales</h4>
		 	<div class="two fields">
		     	
		     	<div class="ui required field">
			   		<label>Cédula</label>
		     			<div class="ui transparent input"><!-- Nro Cedula -->
						    <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($Soc['cedula'])) echo $Soc['nacionalidad'].'-'.$Soc['cedula']; ?>" readonly>
					    </div>
		     	</div>
			  
				<div class="ui field"><!-- Fecha de Nacimiento -->
				   <label>Fecha de Nacimiento</label>
				   <div class="ui transparent input">
				      <input type="text" name="FechaNac" id="FechaNac" readonly value="<?php if(isset($Soc['fecha_nacimiento']) && $Soc['fecha_nacimiento'] != '1970-01-01' ) echo date('d/m/Y',strtotime( $Soc['fecha_nacimiento'])) ?>">
				   </div>
				</div>

			</div>

		<div class="ui required field">
		   <label>Nombre</label>
		   <div class="two fields">			   
			   	<div class="field"><!-- Nombre -->
					<input type="text" name="Nombre1" id="Nombre1" maxlength="20" placeholder="Primer Nombre" onkeypress="return soloLetras(event)" value="<?php if(isset($Soc['nombre1'])) echo $Soc['nombre1']; ?>">
			   	</div>
			   	<div class="field"><!-- Nombre -->
				    <input type="text" name="Nombre2" id="Nombre2" maxlength="20" placeholder="Segundo Nombre" onkeypress="return soloLetras(event)" value="<?php if(isset($Soc['nombre2'])) echo $Soc['nombre2']; ?>">
			   	</div>		   	
		   </div>
		</div>
		<input type="hidden" name="IdPersona" id="IdPersona" value="<?php if(isset($_GET['id'])) echo $_GET['id']; ?>">
		<div class="ui required field">
		    <label>Apellido</label>
		    <div class="two fields">
			   	<div class="field"><!-- Apellido -->
					<input type="text" name="Apellido1" id="Apellido1" placeholder="Primer Apellido" onkeypress="return soloLetras(event)" value="<?php if(isset($Soc['apellido1'])) echo $Soc['apellido1']; ?>">
			   	</div>
			   	<div class="field"><!-- Apellido -->
					<input type="text" name="Apellido2" id="Apellido2" placeholder="Segundo Apellido" onkeypress="return soloLetras(event)" value="<?php if(isset($Soc['apellido2'])) echo $Soc['apellido2']; ?>">
			   	</div>		    	
		    </div>
		</div>
		
		<div class="ui two fields"><!-- Telefonos -->
		   	<div class="field">
		   		<label>Teléfono Móvil</label>
		   		<input type="hidden" name="CodMovil" value="">
		      	<!--div class="fields">
		      		<div class="five wide field">
				   		<?php
				            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=4", "nombre_largo","nombre_largo", isset($Soc['cod_telf_movil'])?$Soc['cod_telf_movil']:'','CodMovil',' class="ui compact dropdown"');
				            foreach ($tagcbotp as $tagtp){echo $tagtp;}
			            ?>
					</div>
			 	    <div class="field"-->
						<input type="text" name="TelfMov" id="TelfMov" placeholder="Teléfono Móvil" maxlength="20" value="<?php if(isset($Soc['telf_movil'])) echo $Soc['telf_movil']; ?>">
				  	<!--/div>
		      	</div-->
		   </div>
		   	<div class="field">
		   		<label>Teléfono Habitación</label>
		   		<input type="hidden" name="CodHab" value="">
		      	<!--div class="fields">
		      		<div class="five wide field">
				   		<?php
				            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=5", "nombre_largo","nombre_largo", isset($Soc['cod_telf_fijo'])?$Soc['cod_telf_fijo']:'','CodHab',' class="ui compact dropdown"');
				            foreach ($tagcbotp as $tagtp){echo $tagtp;}
			            ?>
					</div>
			 	    <div class="field"-->
						<input type="text" name="TelfHab" id="TelfHab" placeholder="Teléfono Hab." maxlength="20" value="<?php if(isset($Soc['telf_fijo'])) echo $Soc['telf_fijo']; ?>">
				  	<!--/div>
		      	</div--> 
		   </div>
		</div>
		
		<div class="ui required field"><!-- Email -->
		   <label>Correo Electrónico <i class='fitted help circle icon link' data-title="Ayuda" data-content='En éste correo recibirá notificaciones e información importante relacionada a la Caja de Ahorros.' data-variation='basic'></i></label>
		   <div class="ui left icon input">
		      <input type="text" name="Email" id="Email" placeholder="Correo Electrónico" value="<?php if(isset($Soc['email'])) echo $Soc['email']; ?>">
			  <i class="mail outline icon"></i>
		   </div>
		</div>

		<div class="ui two fields">
			<div class="ui field">
	    		<label>Lugar de Nacimiento</label>
				<textarea name="LugarNac" id="LugarNac" placeholder="Lugar de nacimiento" onkeypress="return soloLetras(event)"> <?php if(isset($Soc['lugarnac'])) echo $Soc['lugarnac']; ?> </textarea>
		   	</div>
		   	<div class="ui required field">
		   		<label>Tipo de Inscripción</label>
		   		<?php
		            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_tipo_persona WHERE estatus='1'", "id_tipo_persona","nombre", isset($Soc['id_tipo_persona'])?$Soc['id_tipo_persona']:'','TipoPersona',' class="ui compact dropdown" onchange="TipoPers(this.value);"');
		            foreach ($tagcbotp as $tagtp){echo $tagtp;}
	            ?>
	            <div id="divFondos" style="display:<?php if ($Soc['id_tipo_persona']=='1') echo 'none' ?>">
		          
		            <div id="divFComun">
				   		

						<table class="ui celled center aligned table" style="width: 100%; margin-top: 5px;" border="0">
					      	<tr style="background: #EEE;">
					      		<th>Estatus</th>
					      		<th align="center">Fondo</th>
					      		<th>Aporte Inicial</th>
					      	</tr>
					      	<tr>
					      		<td style="width: 5%; " align="center">
					      			<?php
					      				if($Soc['fcomun'] == 1){ echo '<img src="../../image/bien.jpg" style="width:60%;">';
					      					$campo=' <input type="text" name="aporteco" style="background: #eee;" readonly="" value="'.$Soc['aporte_comun'].'" class="form-control">
					      					<input type="hidden" name="fondoco" value="1">
					      					<input type="hidden" name="nuevoco" value="0">
					      					';
					      					$por='<input type="text" name="porcefco" style="background: #eee;" readonly="" value="'.$Soc['porcentajefco'].'" class="form-control">';
					      				 }else{ 
					      					echo '<input type="checkbox" name="fondoco" value="1">
					      					<input type="hidden" name="nuevoco" value="1">

					      					';

					      					$campo='<input type="text" name="aporteco" value="" class="form-control">'; 
					      					$por='<input type="text" name="porcefco"  readonly="" value="" class="form-control">';
					      				}
					      			?>

					      		</td>
					      		<td>Fondo Comun</td>
					      		<td><?php echo $campo; ?></td>
					      	</tr>
				      	<tr>
				      		<td align="center" style="width: 5%;  ">
				      			<?php
					      				if($Soc['fcesantia'] == 1){

					      					 echo '<img src="../../image/bien.jpg" style="width:60%;">

					      					 ';
					      					 $campo=' <input type="text" name="aportece" style="background: #eee;" readonly="" value="'.$Soc['aporte_cesantia'].'" class="form-control">
					      					<input type="hidden" name="fondoce" value="1">
					      					<input type="hidden" name="nuevoce" value="0">
					      					'; 

					      				}else{

					      				 	echo '<input type="checkbox" name="fondoce" value="1">
					      				 	<input type="hidden" name="nuevoce" value="1">
					      				 	';

					      					$campo='<input type="text" name="aportece" value="" class="form-control">'; 

					      				  }
					      			?>
				      		</td>
				      		<td>Fondo Cesantia</td>
				      		<td> <?php echo $campo; ?></td>
				      	</tr>
				      </table>


					</div>
				</div>
		   	</div>		    	
		</div>

		<div style="display:none;">

	        <h4 class="ui dividing header">Datos Residenciales</h4>
			
			<div class="three fields"><!-- Estado - Municipio - Parroquia -->		  
			   
				<div class="ui required field">
					<label>Estado</label>
					<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_estado WHERE estatus='1'", "id_estado","estado", isset($Soc['estado'])?$Soc['estado']:'','Estado',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

				<div class="ui required field">
					<label>Municipio</label>
					<?php
					    $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_municipio WHERE estatus='1'", "id_municipio","municipio", isset($Soc['municipio'])?$Soc['municipio']:'','Municipio',' class="ui compact dropdown"',"id_estado");
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

				<div class="ui required field">
					<label>Parroquia</label>
					<?php
					    $tagcbotp=$combo->gen_combo_dependiente("SELECT * FROM cappiutep.t_parroquia WHERE estatus='1'", "id_parroquia","parroquia", isset($Soc['parroquia'])?$Soc['parroquia']:'','Parroquia',' class="ui compact dropdown"',"id_municipio");
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
				</div>

	        </div>

	        <div class="ui required field"><!-- Direccion -->
			   <label>Dirección</label>
			   <div class="field">
			      <textarea name="Dir" id="Dir" rows="2"><?php if(isset($Soc['direccion'])) echo $Soc['direccion']; ?></textarea>
			   </div>
			</div>

	        <h4 class="ui dividing header">Datos Ocupacionales</h4>
	        
	        <div class="three fields">

		        <div class="ui required field">
			        <label>Cargo</label>
			        <?php
						$tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=14", "id_lista_valor","nombre_largo", isset($Soc['tipo_docente'])?$Soc['tipo_docente']:'','TipoDocente',' class="ui compact dropdown"');
						foreach ($tagcbotp as $tagtp){echo $tagtp;}
					?>
			    </div>

			    <div class="ui required field">
		    		<label>Salario Mensual</label>
		    		<div class="ui left labeled input">
						<div class="ui label">Bs.</div>
		    			<input type="text" id="Salario" name="Salario" placeholder="Salario" onkeypress="return soloNumeros(event)" value="<?php if(isset($Soc['salario'])) echo $Soc['salario']; ?>">
		    		</div>
		    	</div>

		    	<div class="ui required field">
		    		<label>Sede</label>
		    		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=3", "id_lista_valor","nombre_largo", isset($Soc['id_sede'])?$Soc['id_sede']:'','Sede',' class="ui compact dropdown"');
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
				      <input type="text" name="FechaIng" id="FechaIng" placeholder="dd/mm/aaaa" readonly class="FechaIng" value="<?php if(isset($Soc['fecha_ini_docente'])) echo $Soc['fecha_ini_docente']; ?>">
					   <i class="calendar icon"></i>
				   </div>
				</div>
	        	<div class="ui required field">
	        		<label>Categoria</label>
	        		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=16", "id_lista_valor","nombre_largo", isset($Soc['categ_docente'])?$Soc['categ_docente']:'','Categoria',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
	        	</div>
	        	<div class="ui required field">
	        		<label>Dedicación</label>
	        		<?php
					    $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE estatus='1' AND id_lista=15", "id_lista_valor","nombre_largo", isset($Soc['dedic_docente'])?$Soc['dedic_docente']:'','Dedicacion',' class="ui compact dropdown"');
					    foreach ($tagcbotp as $tagtp){echo $tagtp;}
				    ?>
	        	</div>
	        </div>
        </div>

        <div class="two fields">

        	      

        </div>
		<div class="ui error message"></div> 
		<div class="ui center aligned block inverted header">
			
			<input type="hidden" name="opera" id="opera" value="GUARDAR CAMBIOS">
			<!--input type="submit" class="ui sumbit primary button" value="GUARDAR CAMBIOS" onclick="envsiar(this.value)"!-->
			<input type="button" class="ui sumbit primary button" value="GUARDAR CAMBIOS" onclick="enviar(this.value)">
			<input type="button" class="ui red button" value="CANCELAR" onclick="cancelar()">   
			<input type="hidden" name="FechaIns" id="FechaIns" value="00-00-0000">
			<input type="hidden" name="Nacionalidad" id="Nacionalidad" value="a">
			<input type="hidden" name="CI" id="CI" value="2222222">
			<input type="hidden" name="Parroquia" id="Parroquia" value="a">
		</div>
	</form>
	</div>  
</body>
</html> 
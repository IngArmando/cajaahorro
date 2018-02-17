<form method="post"  enctype="multipart/form-data">
	<label for="archivoCSV">Archivo Csv:</label> 
	<input type="file" id="archivoCSV" name="archivoCSV" accept=".csv">
	<br />
	<label for="separador">Separador (delimitador): </label> 
	<select name="separador" id="separador">
		<option value=",">,</option>
		<option value=";">;</option>
	</select>
	<br />
	<input type="submit" name="btnAceptar" value="Aceptar" >
</form>
<table width="100%"  border="1">
<?php
	function eliminarFormato($nombre){
		$arrNombre = explode(".",$nombre);
		return strtolower($arrNombre[0]);
	}
	$siExiste = false;
	if(isset($_POST["btnAceptar"]) && $_POST["btnAceptar"]=="Aceptar"){
		$fila = 1;
		$tablaImportar = eliminarFormato($_FILES["archivoCSV"]["name"]);
		if (($gestor = fopen($_FILES["archivoCSV"]["name"], "r")) !== FALSE) {
			$sqlCreada = "";
			$siExiste = true;
		    while (($datos = fgetcsv($gestor, 1000, $_POST["separador"])) !== FALSE) {
		        $numero = count($datos);
		        if($fila==1){
		        	$sqlCreada = "INSERT INTO cappiutep.".$tablaImportar."(";
		        	for ($c=0; $c < $numero; $c++) {
		        		if($c == ($numero-1))
		        			$sqlCreada .= $datos[$c]." ) VALUES(";
		        		else
		        			$sqlCreada .= $datos[$c].",";
			        }
		        }else if($fila > 1){
		        	for ($c=0; $c < $numero; $c++) {
		        		if($c == ($numero-1)){
		        			$sqlCreada .= $datos[$c]." ), (";
		        		}else{
		        			if(intval($datos[$c]) || $datos[$c]=="NULL"){
		        				$sqlCreada .= $datos[$c].",";
		        			}else{
		        				$sqlCreada .= "\"".$datos[$c]."\",";
		        			}
		        		}
			        }
		        }

		        $fila++;
		        echo "<tr>";
		        for ($c=0; $c < $numero; $c++) {
		            echo "<td>".$datos[$c]." </td>";
		        }
		        echo "</tr>";
		        
		    }
		    fclose($gestor);
		}
	}
	$sqlCreada = substr($sqlCreada, 0, -3).";";
?>
</table>
<?php if($siExiste): ?>
	<input type="submit" name="btnImportar" value="Importar Datos"><br />
	<b>esta es la SQL de prueba</b> <br />
<?php echo $sqlCreada; endif; ?>
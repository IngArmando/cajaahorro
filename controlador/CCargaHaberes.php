<?php 
	require_once("../../modelo/MSocio.php");
	$objSocio = new Socio;
	function eliminarFormato($nombre){
		$arrNombre = explode(".",$nombre);
		return strtolower($arrNombre[0]);
	}
	$sqlCreada ='';
	$siExiste = false;
	$tablaMostrar = "";
	if(isset($_POST["btnAceptar"]) && $_POST["btnAceptar"]=="Aceptar"){
		$fila = 1;
		$tablaImportar = eliminarFormato($_FILES["archivoCSV"]["name"]);
		if (($gestor = fopen($_FILES["archivoCSV"]["tmp_name"], "r")) !== FALSE) {
			$sqlCreada = "INSERT INTO cappiutep.".$tablaImportar."(id_persona,saldo,saldo_bloq_prestamo,saldo_bloq_fianza) VALUES(";
			$siExiste = true;
			while (($datos = fgetcsv($gestor, 1000, $_POST["separador"])) !== FALSE) {
				$numero = count($datos);
				
				/*if($fila==1){
					$sqlCreada = "INSERT INTO cappiutep.".$tablaImportar."(";
					for ($c=0; $c < $numero; $c++) {
						if($c == ($numero-1))
							$sqlCreada .= $datos[$c].") VALUES(";
						else
							$sqlCreada .= $datos[$c].",";
					}
				}else if($fila > 1){
				*/
				if($fila > 1){
					for ($c=0; $c < $numero; $c++) {
						if($c == ($numero-1)){
							$sqlCreada .= $datos[$c]."), (";
						}else{
							if(is_numeric($datos[$c])){
								if(strlen($datos[$c])>6){
									$objSocio->setCedula($datos[$c]);
									$consulta = $objSocio->busCedula();
									$dataPersona = $objSocio->getArreglo($consulta);
									$id_persona=$dataPersona["id_persona"];
									$sqlCreada .= $id_persona.",";
								}else{
									$sqlCreada .= $datos[$c].",";	
								}
							}else{
								if(strlen($datos[$c])>6){
									$objSocio->setCedula($datos[$c]);
									$consulta = $objSocio->busCedula();
									$dataPersona = $objSocio->getArreglo($consulta);
									$id_persona=$dataPersona["id_persona"];
									$sqlCreada .= $id_persona.",";
								}else{
									$sqlCreada .= "'".$datos[$c]."',";	
								}
								
							}
						}
					}
				}
				
				$fila++;
				$tablaMostrar .= "<tr>";
				for ($c=0; $c < $numero; $c++) {
					$tablaMostrar .= "<td>".$datos[$c]." </td>";
				}
				$tablaMostrar .= "</tr>";

			}
			fclose($gestor);
		}
		$sqlCreada = substr($sqlCreada, 0, -3).";";
		$_SESSION["sql"] = base64_encode($sqlCreada);
	}

	if(isset($_POST["btnImportar"]) && $_POST["btnImportar"]=="Importar Datos"){
		//xxxxxxxxxxxxxxxxxxxxxxxxxxx
		//aqui se va a guardar la SQL que se creo, 
		//mañana se lo muestro a edgar porque el standar es hacerlo con Sweet Alert y Ajax
		$sql = base64_decode($_SESSION["sql"]);
		$resultado = $objSocio->ejecutar2($sql);

	}		
?>
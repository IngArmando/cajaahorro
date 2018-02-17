<?php 
	if($_REQUEST["envio"]=="ajax"){ //preguntamos si el envio es por ajax ya sea POST o GET
		require_once("../../modelo/MServicio.php");
		//require_once("../../modelo/MBitacoraOperaciones.php");
	}else{
		require_once("../../modelo/MServicio.php");
		//require_once("../../modelo/MBitacoraOperaciones.php");
	}

	$OServ = new Servicio;
	//$OBit  = new BitacoraOperaciones;

	if(isset($_POST["opera"])){

	//--------------------------------------------------------------------
	//       Datos recibidos del formulario
	//--------------------------------------------------------------------

		$Mod    =trim( $_POST['Mod'] );    
		$Des    =trim( $_POST['Des'] );
		$TipVis =trim( $_POST['TipVis'] );    
		$URL    =trim( $_POST['URL'] );		  
		$Icon   ="NULL";
		if(isset($_POST['Icon']) && $_POST['Icon']!='' )
			$Icon=trim( $_POST['Icon'] );
		$Pos    ="NULL";
		if(isset($_POST['Pos'])&& $_POST['Pos']!='')
			$Pos=trim( $_POST['Pos'] );

		$OServ->setIdModulo  ( $Mod    );
		$OServ->setDesc      ( $Des    );
		$OServ->setIdTipoVis ( $TipVis );
		$OServ->setIdIcon    ( $Icon   );
		$OServ->setPos       ( $Pos    );
		$OServ->setURL       ( $URL    );        
	    
	//--------------------------------------------------------------------
	//    Selector de operaciones
	//--------------------------------------------------------------------        

		switch ($_POST["opera"]) {  
			case 'Registrar':
				echo '<script>swal({
							          type:"success",
							          text:"Operacion exitosa Registrar",
							          showCancelButton: false,
							          confirmButtonText: "Continuar",
							          confirmButtonColor: "#2185d0",
							        });
							alert("exitoo");
				  	  </script>';
			break;
			case 'Guardar Cambios':
				echo '<script>swal({
							          type:"success",
							          text:"Operacion exitosa Editar",
							          showCancelButton: false,
							          confirmButtonText: "Continuar",
							          confirmButtonColor: "#2185d0",
							        });
				  	  </script>';
			break;

		
	}//fin del if
	}//fin del if

	
	
?>
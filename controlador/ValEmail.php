<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
	$email = trim( $_POST['Email'] );

//--------------------------------------------------------------------
//		Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
  	include_once("../modelo/MSocio.php");
  	$o_socio = new Socio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
 	
 	$o_socio->setEmail( $email );
 	$existe=$o_socio->busEmail();
    if($o_socio->setNoTupla($existe)>0)
       echo 1;
	
//Fin del controlador
?>
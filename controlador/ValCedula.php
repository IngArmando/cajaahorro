<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
	$ci = trim( $_POST['CI'] );

//--------------------------------------------------------------------
//		Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
  	include_once("../modelo/MSocio.php");
  	$o_socio = new Socio();

//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
 	
 	$o_socio->setCedula       ( $ci );
 	$existe=$o_socio->busCedula();
    if($o_socio->setNoTupla($existe)>=1)
        echo 1;
//Fin del controlador
?>
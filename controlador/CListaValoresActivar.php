<?php
//--------------------------------------------------------------------
//       Datos recibidos del formulario
//--------------------------------------------------------------------
	$ID = trim( $_GET['id'] );

//--------------------------------------------------------------------
//		Llama a la clase y se crea el objeto
//--------------------------------------------------------------------
    include_once("../mdl/MListaValores.php");
    $OLista = new ListaValores();
//--------------------------------------------------------------------
//     Se llama a los metodos de la clase
//--------------------------------------------------------------------
	
	  $OLista -> setIdListaValor($ID);
	  $registro=$OLista -> consultar();
	  while ( $fila = $OLista->setArreglo( $registro ))
	      $datos[] = $fila;
	    foreach ($datos as $Lista) { $Lista; }

 	
    if($hecho=$OLista->activar())
    	header("Location: ../vista/sis/ConfigListaValores.php?id=".$Lista['id_lista']);

//Fin del controlador
?>
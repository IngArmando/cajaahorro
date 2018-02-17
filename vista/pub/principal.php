<?php 
  include('../../modelo/MOrganizacion.php');
  $OOrg = new Organizacion;
  //$OOrg -> setIdListaValor($_GET['id']);
  $registro=$OOrg -> consultar();
  while ( $fila = $OOrg->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Org) { $Org; }

  /*include('../../modelo/MBeneficios.php');
  $OBeneficio = new Beneficio;*/

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA</title>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="author" content="UPTP">
   <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/pub_style.css"><!-- Interface de usuario -->
    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
</head>

<body>
    
    <div class="center aligned cabecera">
    	<div class="ui grid container" style="background: none">
            <div class="four wide column">
                <img class="ui small centered image" src="../../image/logop.png?nocache">
            </div>
            <div class="twelve wide middle aligned column">
                <h3 class="font-style ui center aligned mobile-small"><?php echo $Org['razon_social'];  ?></h3>
            </div>  
        </div>          
    </div>
   
   <?php require_once('NavBar.php');  ?>

    <!-- Contenido -->
    <div class="ui container">
        <div class="ui dividing header"></div>
        
        <div class="ui two column stackable grid">
            
            <div class="eight wide column">
                <h3 class="ui header">¿Quiénes somos?</h3>
                <p align="justify">ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA</p>
                <p align="justify">Es una asociación civil sin fines de lucros, autónoma, con personalidad jurídica propia, con más de 17 años de funcionamiento, tiempo durante el cual se ha venido fortaleciendo con el objetivo de contar con una organización social, con apego al marco legal vigente.</p>
                <a class="ui left floated small basic button" href="nosotros.php">
                  <i class="icon plus"></i>
                  Leer más...
                </a>    
            </div>

            <div class="eight wide column">
                <div class="ui segment">
                    <div class="ui header">
                        <i class="ui blue call square icon"></i>
                        <div class="content">
                            Contáctanos
                        </div>
                    </div>
                    <h1 class="ui sub header">
                        RIF:
                    </h1>
                    <p align="justify"><?php echo $Org["rif"]; ?></p>
                    <h1 class="ui sub header">
                        Dirección:
                    </h1>
                    <address>
                        <strong>Oficina Principal</strong>
                        <p align="justify"><?php echo $Org["dir_fiscal"]; ?><p>
                    </address>
                    <h1 class="ui sub header">
                        Teléfono:
                    </h1>
                    <p align="justify"><?php echo $Org["telefono"]; ?></p>
                     <h1 class="ui sub header">
                        Correo Electrónico:
                    </h1>
                    <address>
                        <a href="mailto:<?php echo $datos['email'] ?>"><?php echo $Org['email'] ?></a>
                    </address>
                </div>                
            </div>
        </div>

        <!--
        <div class="ui centered stackable grid">
	        <div class="one column row">
	        	<div class="column">
	        		<div class="ui dividing header">Beneficios</div>
	        	</div>
	        </div>
	        <div class="one column row">
	        	<div class="column">
	        		<p>Al ser asociado de la Caja de Ahorros podrá disfrutar de los siguientes beneficios:</p>
	        	</div>
	        </div>
        </div>
        <?php
         	//$cartas=$OBeneficio ->mostrar();
      		//foreach ($cartas as $tagtp){echo $tagtp;} 
        ?>


        Footer -->
    </div>
</body>
<footer>
    <div class="ui blue inverted segment">
        <div class="ui centered grid">
            <div class="row">
                
                <div class="center aligned column">
                    <img class="ui centered image" src="../../image/licencia.png"/>
                    <span>
                    Ésta obra esta hecha bajo una 
                    <a href="http://creativecommons.org/" target="_blank" style="color: white"> Licencia de Creative Commons.</a>&nbsp
                    <i class="ve flag"></i></span>
                </div>
            </div>
                <!--<a class="ui violet image label">
                <img src="../../image/bigott.jpg">
                   Bigott</a>
                   <a class="ui gray image label">
                <img src="../../image/sarzalejo.jpg">
                   Sarzalejo</a>
                   <a class="ui teal image label">
                <img src="../../image/martinez.jpg">
                   Martinez</a>
                   <a class="ui pink image label">
                <img src="../../image/garcia.jpg">
                   Garcia</a>
                   <a class="ui brown image label">
                <img src="../../image/nogera.jpg">
                   Noguera</a>
                -->

            <div class="row">
                <div class="center aligned column">                   
                    <div class="ui images">
                        <img class="ui image" src="../../image/boo.png"/>
                        <img class="ui image" src="../../image/js.png"/>
                        <img class="ui image" src="../../image/se.png"/>
                    </div>
                        <i class="ui big html5 icon "></i>
                        <i class="ui big css3 icon "></i>
                        <i class="ui big database icon"></i>
                </div>
            </div>

        </div>
    </div>
</footer>
</html>
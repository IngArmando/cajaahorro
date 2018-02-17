<?php session_start(); 
  
  require_once("../../funciones.php");

  include('../../modelo/MOrganizacion.php');
  $OOrg = new Organizacion;
  //$OOrg -> setIdListaValor($_GET['id']);
  $registro=$OOrg -> consultar();
  while ( $fila = $OOrg->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Org) { $Org; }


    if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
        header("location: ../sis/Inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>CAPPIUTEP - Galeria</title>
	<!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="author" content="UPTP">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->
    <!--  Propiedades -->
    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link href="../../css/pub-style.css" rel="stylesheet">
    <link href="../../css/cssgale.css" rel="stylesheet">
	<link href="../../css/least.min.css" rel="stylesheet" /><!-- jQuery libary -->
    <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->
	<script src="http://code.jquery.com/jquery-latest.js" defer="defer"></script><!-- least.js JS-file -->
	<script src="../../js/jquery.lazyload.min.js" defer="defer"></script><!-- least.js CSS-file -->
	<script src="../../js/least.min.js" defer="defer"></script><!-- Lazyload JS-file -->
</head>
<body>
<div class="center aligned cabecera">
        <div class="ui grid container" style="background: none">
            <div class="four wide column">
                <img class="ui small centered image" src="../../image/logop.png">
            </div>
            <div class="twelve wide middle aligned column">
                <h3 class="font-style ui center aligned mobile-small"><?php echo $Org['razon_social'];  ?></h3>
            </div>  
        </div>          
    </div>
   <?php require_once('NavBar.php');  ?>

    <div class="ui container" style="margin-top:30px">

	
        <div id="gale_t">

        	<section>

        		<ul id="gallery">

        			<li id="fullPreview"></li>

        			<li>
        				<a href="../../image/galeria/full/gale1.jpg"></a>
        				<img src="../../image/galeria/mini/gale1.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />

        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>

        				<div class="projectInfo">
        					<b>
        						Plaza Simon Bolivar de la UPTP "J.J Montilla"
        					</b> 
        				</div>
        			</li>

        			<li>

        				<a href="../../image/galeria/full/gale2.jpg"></a>
        				<img src="../../image/galeria/mini/gale2.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Pasillos de la "UPTP"
        					</b> 
        				</div>





        			</li>

        			<li>

        				<a href="../../image/galeria/full/gale3.jpg"></a>
        				<img src="../../image/galeria/mini/gale3.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Pasillos de la "UPTP"
        					</b> 
        				</div>


        			</li>


        			<li>

        				<a href="../../image/galeria/full/gale4.jpg"></a>
        				<img src="../../image/galeria/mini/gale4.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Pasillo antes de ingresar a las oficinas de CAPPIUTEP
        					</b> 

        				</div>






        			</li>


        			<li>

        				<a href="../../image/galeria/full/gale5.jpg"></a>
        				<img src="../../image/galeria/mini/gale5.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Pasillos de la "UPTP"
        					</b> 
        				</div>






        			</li>


        			<li>

        				<a href="../../image/galeria/full/gale6.jpg"></a>
        				<img src="../../image/galeria/mini/gale6.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Entrada a las oficinas de CAPPIUTEP
        					</b> 
        				</div>






        			</li>


        			<li>

        				<a href="../../image/galeria/full/gale7.jpg"></a>
        				<img src="../../image/galeria/mini/gale7.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>
        						Parte de las instanlaciones de CAPPIUTEP
        					</b> 
        				</div>






        			</li>


        			<li>

        				<a href="../../image/galeria/full/gale8.jpg"></a>
        				<img src="../../image/galeria/mini/gale8.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>

        					</b> 
        				</div>






        			</li>



        			<li>

        				<a href="../../image/galeria/full/gale9.jpg"></a>
        				<img src="../../image/galeria/mini/gale9.jpg" src="../../image/galeria/effects/white.gif" width="240" height="150" alt="Plaza" />
        				<div class="overLayer"></div>
        				<div class="infoLayer">
        					<ul>
        						<li>
        							<h2>
        								CAPPIUTEP
        							</h2>
        						</li>
        						<li>
        							<p>
        								Ver Imagen
        							</p>
        						</li>
        					</ul>
        				</div>            
        				<div class="projectInfo">
        					<b>

        					</b> 
        				</div>






        			</li>

        		</ul>	
        	</section>
        </div>
	
	
	
	

	
	</div>	
	
      
    
    
</body>



</html>
<?php 
    require_once("mdl/m_configuracion.php");
    $conf = new configuracion();
    $datos = $conf->listar();
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>ASOCIACIÓN DE EMPLEADOS MUNICIPALES DE PASTAZA</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CAJA DE AHORROS">
    <meta name="author" content="UPTP">
    <!-- Bootstrap CODIGO CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/business-frontpage.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="image/favicon.png" />
	<link rel="stylesheet" type="text/css" href="css/SemanticUI/dist/semantic.css">	
</head>
<body>
    <!-- Navegacion -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container2">           
           
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				
				    <li>
				<a href="vista/pub/misionv2.html"> <i class="glyphicon glyphicon-unchecked"></i> Nosotros</a>
                    </li>
				
                    <li>
                        <a href="vista/pub/galeria.html"> <i class="glyphicon glyphicon-list-alt"></i> Galeria</a>
                    </li>
                    <li>
                        <a href="vista/pub/bene.html"> <i class="glyphicon glyphicon-credit-card"> </i>Beneficios</a>
                    </li>
					
                    <li>
                        <a href="vista/pub/inise.php"> <i class="glyphicon glyphicon-log-in"></i><font color="#fa8b15">  Iniciar Sesión</a></font>
                    </li>
                </ul>
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header class="business-header">
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr>

        <div class="row">
            <div class="col-sm-8">
                <h2>¿Qué es CAPPIUTEP?</h2>
                <p align="justify">La Caja de Ahorro y Préstamo de los Profesores del Instituto Universitario de Tecnológica del Estado Portuguesa CAPPIUTEP</p>
                <p align="justify">Es una asociación civil sin fines de lucros, autónoma, con personalidad jurídica propia, con 17 años de funcionamiento, tiempo durante el cual se ha venido fortaleciendo con el objetivo de contar con una organización social, con apego al marco legal vigente..</p>
                <p>
                    <a class="btn btn-default btn-lg" href="vista/pub/misionv2.php">Leer más.. &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4">
               <h2><i class="glyphicon glyphicon-phone-alt"></i> Contáctanos</h2>
                <address>
                    <strong>Sede Principal</strong>
                    <br> <?php echo $datos["direccion"]; ?>
                    <br>0255-6144078
                    <br>
                </address>
                <address>                    
                        <abbr title="Email">Correo Electrònico:</abbr> <a href="mailto:<?php echo $datos['correo'] ?>"><?php echo $datos['correo'] ?></a>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <hr>

         <div class="row">
            <div class="col-sm-4">
										<div id="coloratras">
                <img class="img-circle img-responsive img-center rotate reveal image"	src="image/logo2.jpg" alt="">
				
											</div>
                <h2>Prestamos</h2>
               <b>Préstamo Normal</b>.
				<p align="justify" > El socio debe Tener disponibilidad del ahorro de un 80 % en base a su 100 % para dejar un 20 %</p>
				 </br>
				<b>Préstamo Especial</b>.
				<p align="justify"> El préstamo especial es de 4 meses y debe ir respaldado con un ahorro y el tope máximo de dinero a prestar es de 4.000 BsF.</p>
            </div>
            <div class="col-sm-4">
											<div id="coloratras">
                <img class="img-circle img-responsive img-center" src="image/logo3.jpg" alt="">
											</div>
                <h2>Financiamientos</h2>
                <p align="justify">Acto de dotar de dinero y de crédito a una empresa, organización o individuo, es decir, es la contribución de dinero que se requiere para concretar un proyecto o actividad.</p>
            </div>
            <div class="col-sm-4">
											<div id="coloratras">
                <img class="img-circle img-responsive img-center" src="image/logo4.jpg" alt="">
													</div>
                <h2>Retiros</h2>
				<b>Retiro Parcial</b>				
                <p align="justify">Debe el usuario estar registrado como socio en la caja de ahorro, el usuario debe tener una antigüedad mínima de 3 meses en la caja de ahorro.</p>
				<br>
				<b>Retiro Total</b>				
                <p align="justify">Debe el usuario estar registrado como socio en la caja de ahorro, el usuario debe tener una antigüedad mínima de 3 meses en la caja de ahorro, el socio debe estar solvente con la caja de ahorros.</p>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
				
                  <center> 
						<img src="image/licencia.png" alt="Texto"  />
				<font color="white" > <p>Esta Obra esta bajo una</font><a href="http://www.creativecommonsvenezuela.org.ve/" target="_blank"> Licencia de Creative Commons</a> <i class="ve flag"></i></p>
				<!--<img src="image/prog.png"/> <img src="image/progb.png"/> <img src="image/dise.png"/> <img src="image/bbdd.png"/> <img src="image/info.png"/><br>-->
				<i class=" ui html5 icon white big link " data-content='HTML5' data-variation='basic'  ></i>
				<i class="css3 icon white big link"></i>
				<i class="database icon white big link"></i>
				<img src="image/boo.png"/>
				<img src="image/js.png"/>
				<img src="image/se.png"/>
				</center>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

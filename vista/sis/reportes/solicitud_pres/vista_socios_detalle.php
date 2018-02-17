<?php
session_start();

    include_once("../../mdl/m_genera_combo.php");
    $combo = new cl_combo();

  include_once('../../mdl/m_socio.php');//Datos del socio
  $o_socio = new socio;
  $o_socio -> setCI( $_GET['ci'] );
  $registro = $o_socio->consultar_detalle();
  while ( $fila = $o_socio->setArreglo( $registro ))
      $datos[] = $fila;
    foreach ($datos as $Socio) { $Socio; }

  $dia=substr($Socio['fecha_nacimiento_socio'],8,2);
  $mes=substr($Socio['fecha_nacimiento_socio'],5,2);
  $ano=substr($Socio['fecha_nacimiento_socio'],0,4);
  $fecha_nac=$dia."/".$mes."/".$ano;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Socios</title>
  
  <!-- Standard Meta -->
  <
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   
    
  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/dist/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  
  <style type="text/css">         
    .container2
    {
      padding: 10px;
      margin: auto;
      margin-top: 25px;
    }

  </style>


  <!-- - - - - - - - - - - - - - - - Librerias Java- - - - - - - - - - - - - - -  -->

  <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
  <script src="../../js/main.js"></script> <!--Configura Interfaz -->
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <srcipt src="../../css/SemanticUI/dist/semantic.min.js"></script><!-- Interface de usuario -->
  <script src="../../css/SemanticUI/dist/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->

</head>
<body>  
    <div class="ui inverted menu menu-top"  align="center">
        <div class="ui large center inverted labeled icon menu">
          <a class="header item" href="menuadm.php">
            <i class="home icon"></i>
            Inicio
          </a>
          <a class="item">
            <i class="users icon"></i>
            Socios
          </a> 
          <a class="item">
            <i class="money icon"></i>
            Préstamos
          </a> 
          <a class="item">
            <i class="suitcase icon"></i>
            Financiamientos
          </a>  
          <a class="item">
            <i class="male icon"></i>
            Estados de Cuenta
          </a> 
          <a class="item">
            <i class="sun icon"></i>
            ARENAL
          </a>  
          <a class="item">
            <i class="lock icon"></i>
            Seguridad
          </a>  
          <a class="item">
            <i class="setting icon"></i>
            Configuraciones
          </a>    
          <a class="item">
            <i class="sign out icon"></i>
            Salir
          </a>         
        </div>
    </div>


  <div class="container"> 
       <form class="ui form" method="POST" action="../../ctrl/c_solicitud_rep.php" target="_BLANK">
           <h2 class="ui center aligned small block icon header">
              <i class="users icon"></i>
                Socio                
           </h2>

             <h4 class="ui dividing header">Información del Prestamo</h4>


                  <label>Fecha de Solicitud del Prestamo:</label>
              
                <div class="six wide field"><!-- FECHA SOLI -->
                  <label>&nbsp</label>
                  <div class="ui input">
                    <input type="date" name="fecha_sol" id="fecha_sol" value="<?php if (isset($_GET['fecha_sol'])) echo $_GET['fecha_sol'] ?>" readonly>
                  </div>
                </div>

                 <div class="two fields"><!-- Cargo y Salario -->
                <div class="field"><!-- Cargo -->
                  <label>Cargo</label>
                    <input type="text" name="status_sol" id="status_sol" value="<?php if (isset($Socio['status_sol'])) echo $Socio['status_sol'] ?>" readonly>
                </div>

                </div>
                <div class="field"><!-- Nro de cuenta -->
                  <label>Nro. de Solicitud de prestamo</label>
                  <input type="text" name="nro_sol_prestamo" id="nro_sol_prestamo" placeholder="Número de Solcitud" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['nro_sol_prestamo'])) echo $Socio['nro_sol_prestamo'] ?>" readonly>
                </div>

         
                <div class="field"><!-- Nro de cuenta -->
                  <label>Tipos de Prestamo</label>
                  <input type="text" name="id_tipos_prestamo" id="id_tipos_prestamo" placeholder="tipos de prestamo" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['id_tipos_prestamo'])) echo $Socio['id_tipos_prestamo'] ?>" readonly>
                </div>
             
             <div class="field"><!-- Nro de cuenta -->
                  <label>Plazo de Pago</label>
                  <input type="text" name="id_plazo" id="id_plazo" placeholder="plazo" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['id_plazo'])) echo $Socio['id_plazo'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Monto Solicitado</label>
                  <input type="text" name="cantidad_sol" id="cantidad_sol" placeholder="monto solicitado" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['cantidad_sol'])) echo $Socio['cantidad_sol'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Nro. de Cuotas</label>
                  <input type="text" name="cuotas" id="cuotas" placeholder="Nro. de Cuotas" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['cuotas'])) echo $Socio['cuotas'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Monto por Cuotas</label>
                  <input type="text" name="m_cuotas" id="m_cuotas" placeholder="monto por cuota" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['m_cuotas'])) echo $Socio['m_cuotas'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Motivo del Prestamo</label>
                  <input type="text" name="motivo" id="motivo" placeholder="motivo del prestamo" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['motivo'])) echo $Socio['motivo'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Observaciones</label>
                  <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['observaciones'])) echo $Socio['observaciones'] ?>" readonly>
                </div>

                <div class="field"><!-- Nro de cuenta -->
                  <label>Fecha de Inscripcion</label>
                  <input type="text" name="fecha_ins" id="fecha_ins" placeholder="fecha de inscripcion" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['fecha_ins'])) echo $Socio['fecha_ins'] ?>" readonly>
                </div>




          
















           <h4 class="ui dividing header">Información Personal</h4>

              <div class="fields"><!-- Nacionalidad, Nro Cedula, Fecha Nacimiento -->
                <div class="one wide field"><!-- Nacionalidad -->
                  <label>Cédula:</label>
                    <input type="text" name="nacionalidad" id="nacionalidad" value="<?php if (isset($Socio['nacionalidad_socio'])) echo $Socio['nacionalidad_socio'] ?>" readonly>
                </div>
                <div class="six wide field"><!-- Nro Cedula -->
                  <label>&nbsp</label>
                  <div class="ui input">
                    <input type="text" name="ci" id="ci" value="<?php if (isset($_GET['ci'])) echo $_GET['ci'] ?>" readonly>
                  </div>
                </div>
                <div class="one wide field"></div>
                <div class="field"><!-- Fecha de Nacimiento -->
                  <label>Fecha de Nacimiento:</label>
                    <div class="ui left icon input">
                      <input type="text" name="fecha_nac" value="<?php if (isset($Socio['fecha_nacimiento_socio'])) echo $fecha_nac ?>" readonly>
                      <i class="calendar icon"></i>
                  </div>
                </div>
              </div>

              <div class="two fields"><!-- Nombre y Apellido -->
                <div class="field"><!-- Nombre -->
                  <label>Nombre:</label>
                  <div class="ui left icon input">
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" onkeypress="return soloLetras(event)" value="<?php if (isset($Socio['nombre_socio'])) echo $Socio['nombre_socio'] ?>" readonly>
                    <i class="male icon"></i>
                  </div>
                </div>
                <div class="field"><!-- Apellido -->
                  <label>Apellido:</label>
                  <div class="ui left icon input">
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido" onkeypress="return soloLetras(event)" value="<?php if (isset($Socio['apellido_socio'])) echo $Socio['apellido_socio'] ?>" readonly>
                    <i class="male icon"></i>
                  </div>
                </div>
              </div>

              <div class="two fields"><!-- Cargo y Salario -->
                <div class="field"><!-- Cargo -->
                  <label>Cargo</label>
                    <input type="text" name="cargo" id="cargo" value="<?php if (isset($Socio['descripcion_cargo'])) echo $Socio['descripcion_cargo'] ?>" readonly>
                </div>
                <div class="field"> <!-- Salario -->
                  <label>Salario</label>
                  <div class="ui left icon input">
                    <input type="text" name="salario" id="salario" placeholder="Salario" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['salario_socio'])) echo $Socio['salario_socio'] ?>" readonly>
                    <i class="money icon"></i>
                  </div>
                </div>
              </div>

              <div class="two fields"> <!-- Banco y Nro de Cuenta -->
                <div class="field"><!-- Banco -->
                  <label>Banco</label>
                    <input type="text" name="banco" id="banco" value="<?php if (isset($Socio['nombre_banco'])) echo $Socio['nombre_banco'] ?>" readonly>
                </div>
                <div class="field"><!-- Nro de cuenta -->
                  <label>Nro. de Cuenta</label>
                  <input type="text" name="nro_cuenta" id="nro_cuenta" placeholder="Número de Cuenta" maxlength="20" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['nro_cuenta_socio'])) echo $Socio['nro_cuenta_socio'] ?>" readonly>
                </div>
              </div>

          <h4 class="ui dividing header">Información de Contacto</h4>
               <div class="field"><!-- Telefonos -->
                   <label>Teléfonos</label>
                     <div class="two fields">
                       <div class="field">
                           <div class="ui left icon input">
                             <input type="text" name="telf_mov" id="telf_mov" placeholder="Móvil" maxlength="11" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['telf_movil_socio'])) echo $Socio['telf_movil_socio'] ?>" readonly>
                             <i class="call icon"></i>
                           </div>
                       </div>
                       <div class="field">
                           <div class="ui left icon input">
                             <input type="text" name="telf_loc" id="telf_loc" placeholder="Habitación" maxlength="11" onkeypress="return soloNumeros(event)" value="<?php if (isset($Socio['telf_fijo_socio'])) echo $Socio['telf_fijo_socio'] ?>" readonly>
                             <i class="call square icon"></i>
                           </div>                            
                       </div>
                     </div>
               </div>
               <div class="field"><!-- Email -->
                   <label>Correo Electrónico</label>
                   <div class="ui left icon input">
                      <input type="text" name="email" id="email" placeholder="Correo Electrónico" value="<?php if (isset($Socio['email_socio'])) echo $Socio['email_socio'] ?>" readonly>
                       <i class="mail outline icon"></i>
                   </div>
               </div>    

          <h4 class="ui dividing header">Información de Residencia</h4>
               <div class="fields"><!-- Estado - Ciudad -->
                   <div class="five wide field">
                       <label>Estado</label>
                       <div class="field">
                             <input type="text" name="estado" id="estado" value="<?php if (isset($Socio['estado'])) echo utf8_encode($Socio['estado']) ?>" readonly>
                       </div>
                   </div>
                   <div class="five wide field">
                       <label>Ciudad</label>
                       <div class="field">
                              <input type="text" name="ciudad" id="ciudad" value="<?php if (isset($Socio['ciudad'])) echo utf8_encode($Socio['ciudad']) ?>" readonly>
                       </div>
                   </div>
               </div>
               <div class="fields"><!-- Municipio - Parroquia -->
                   <div class="field five wide ">
                       <label>Municipio</label>
                       <div class="field">
                             <input type="text" name="municipio" id="municipio" value="<?php if (isset($Socio['municipio'])) echo utf8_encode($Socio['municipio']) ?>" readonly>
                       </div>
                   </div>
                   <div class="field five wide ">
                       <label>Parroquia</label>
                       <div class="field">
                             <input type="text" name="parroquia" id="parroquia"  value="<?php if (isset($Socio['parroquia'])) echo utf8_encode($Socio['parroquia']) ?>" readonly>
                       </div>
                   </div>
               </div>
               <div class="fiedl"><!-- Direccion -->
                   <label>Dirección</label>
                   <div class="field">
                       <textarea name="direccion" id="direccion" readonly> <?php if (isset($Socio['direccion_socio'])) echo $Socio['direccion_socio'] ?></textarea>
                   </div>
               </div>
               
          <br><br>
            <input type="hidden" name="opera" id="opera">
          <div class="ui center aligned block header">
            <input type="submit" value="Imprimir" class="ui blue button">&nbsp&nbsp
            <a class="ui red button" href="vista_lista_socios.php">Volver</a>   

       </form>
  </div>  


</body>
</html>
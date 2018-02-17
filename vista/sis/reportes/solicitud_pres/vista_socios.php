<?php
session_start();

    include_once("../../mdl/m_genera_combo.php");
    $combo = new cl_combo();

    include_once("../../mdl/m_genera_lista.php");
    $lista = new cl_list();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Socios</title>
  
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->   
    
  <!--  Propiedades -->

  <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->

  <link rel="stylesheet" type="text/css" href="../../css/Bootstrap/css/bootstrap.css"><!-- Bootstrap -->  
  <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/dist/semantic.css"><!-- Interface de usuario -->
  <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
  <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->
  <link rel="stylesheet" type="text/css" href="../../js/DataTables/media/css/dataTables.bootstrap.css"><!-- Bootstrap Tablas -->
  
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
  <script src="../../js/js_socio_nuevo.js"></script> <!--Validaciones --> 
  <script src="../../js/chainSelect.min.js"></script> <!--Validaciones --> 
  <srcipt src="../../css/SemanticUI/dist/semantic.min.js"></script><!-- Interface de usuario -->
  <script src="../../css/SemanticUI/dist/semantic.js"></script><!-- Interface de usuario -->
  <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
  <script src="../../js/DataTables/media/js/jquery.dataTables.js"></script><!-- Filtro de tabla -->
  <script src="../../js/DataTables/media/js/dataTables.bootstrap.min.js"></script><!-- Bootstrap -->
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
    <h2 class="ui center aligned small block icon header">
      <i class="users icon"></i>
      Socios                
    </h2>
    <div class="ui labeled icon adduser button">
      <i class="add user icon"></i>
      Registrar Socio
    </div>
    <br>
    <br>
    <h4 class="ui centered block dividing header">Listado de Socios Inscritos</h4>
    <?php
      $listado=$lista->generar_list_socio();
      foreach ($listado as $tagtp){echo $tagtp;}
    ?>
  </div>

  <div class="ui test button">Launch modal</div>
                       

  <div class="ui modal">
    <div class="container2"> 
         <form class="ui form" method="POST" action="../../ctrl/c_socio.php">
             <h2 class="ui center aligned small block icon header">
                <i class="users icon"></i>
                  Registro de Socio                
             </h2>
             <p>Por favor complete todos los campos del siguiente formulario:</p>


              <h4 class="ui dividing header">Información del Prèstamo</h4>

                       <label>Fecha de la Solicitud:</label>
                      <select class="ui dropdown" name="fecha_sol" id="fecha_sol" style="width:50px;">
            
                      </select>

                       <div class="one wide field"></div>
                  <div class="field"><!-- Fecha de la solicitud-->
                    <label>Fecha de la Solicitud :</label>
                      <div class="ui left icon input">
                        <input type="date" name="fecha_sol" id="datepicker" placeholder="dd/mm/aaaa" readonly>
                        <i class="calendar icon"></i>
                    </div>
                  </div>
                </div>


            
                 <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Estatus de la Solicitud:</label>
                      <div class="ui left icon input">
                        <input type="text" name="status_sol" id="status_sol" placeholder="status_sol" readonly>
                        <i class="male icon"></i>
                    </div>
                  </div>
                </div>

                  <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Numero de Solicitud:</label>
                      <div class="ui left icon input">
                        <input type="text" name="nro_sol_prestamo" id="nro_sol_prestamo" placeholder="nro_sol_prestamo" readonly>
                        <i class="male icon"></i>
                    </div>

                    <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Tipos de Prestamo:</label>
                      <div class="ui left icon input">
                        <input type="text" name="id_tipos_prestamo" id="id_tipos_prestamo" placeholder="id_tipos_prestamo" readonly>
                        <i class="male icon"></i>
                    </div>

                      <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Plazos de pago:</label>
                      <div class="ui left icon input">
                        <input type="text" name="id_plazo" id="id_plazo" placeholder="id_plazo" readonly>
                        <i class="male icon"></i>
                    </div>

                      <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>monto solicitado:</label>
                      <div class="ui left icon input">
                        <input type="text" name="cantidad_sol" id="cantidad_sol" placeholder="cantidad_sol" readonly>
                        <i class="male icon"></i>
                    </div>
                  
                    <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Nro. de Cuotas:</label>
                      <div class="ui left icon input">
                        <input type="text" name="cuotas" id="cuotas" placeholder="cuotas" readonly>
                        <i class="male icon"></i>
                    </div>
                  
                   <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Monto por Cuota:</label>
                      <div class="ui left icon input">
                        <input type="text" name="m_cuotas" id="m_cuotas" placeholder="m_cuotas" readonly>
                        <i class="male icon"></i>
                    </div>

                     <div class="one wide field"></div>
                  <div class="field"><!-- STATUS -->
                    <label>Motivo del Prestamo:</label>
                      <div class="ui left icon input">
                        <input type="text" name="motivo" id="motivo" placeholder="motivo" readonly>
                        <i class="male icon"></i>
                    </div>
                  
                  <div class="fiedl"><!-- Observacion -->
                     <label>Observaciones</label>
                     <div class="field">
                         <textarea name="observaciones" id="observaciones"> </textarea>
                     </div>
                 </div>

                  <div class="fiedl"><!-- Observacion -->
                     <label>Fecha de Inscripcion</label>
                     <div class="field">
                         <textarea name="fecha_ins" id="fecha_ins"> </textarea>
                     </div>
                 </div>






             <h4 class="ui dividing header">Información Personal</h4>

                <div class="fields"><!-- Nacionalidad, Nro Cedula, Fecha Nacimiento -->
                  <div class="one wide field"><!-- Nacionalidad -->
                    <label>Cédula:</label>
                      <select class="ui dropdown" name="nacionalidad" id="nacionalidad" style="width:50px;">
                        <option value="V">V</option>
                        <option value="E">E</option>
                      </select>
                  </div>
                  <div class="six wide field"><!-- Nro Cedula -->
                    <label>&nbsp</label>
                    <div class="ui fluid action input">
                      <input type="text" name="ci" id="ci" placeholder="Cédula" maxlength="8" onkeypress="numeros()">
                      <div class="ui button">Verificar</div>
                    </div>
                  </div>
                  <div class="one wide field"></div>
                  <div class="field"><!-- Fecha de Nacimiento -->
                    <label>Fecha de Nacimiento:</label>
                      <div class="ui left icon input">
                        <input type="text" name="fecha_nac" id="datepicker" placeholder="dd/mm/aaaa" readonly>
                        <i class="calendar icon"></i>
                    </div>
                  </div>
                </div>

                <div class="two fields"><!-- Nombre y Apellido -->
                  <div class="field"><!-- Nombre -->
                    <label>Nombre:</label>
                    <div class="ui left icon input">
                      <input type="text" name="nombre" id="nombre" placeholder="Nombre" onkeydown="letras()">
                      <i class="male icon"></i>
                    </div>
                  </div>
                  <div class="field"><!-- Apellido -->
                    <label>Apellido:</label>
                    <div class="ui left icon input">
                      <input type="text" name="apellido" id="apellido" placeholder="Apellido" onkeydown="letras()">
                      <i class="male icon"></i>
                    </div>
                  </div>
                </div>

                <div class="two fields"><!-- Cargo y Salario -->
                  <div class="field"><!-- Cargo -->
                    <label>Cargo</label>
                      <?php
                        $tagcbotp=$combo->generar_combo("select id_cargo,descripcion_cargo from cargo where status_cargo='a' order by descripcion_cargo", "id_cargo","descripcion_cargo", isset($_GET[''])?$_GET['']:'','cargo',' class="ui dropdown"');
                        foreach ($tagcbotp as $tagtp){echo $tagtp;}
                      ?>
                  </div>
                  <div class="field"> <!-- Salario -->
                    <label>Salario</label>
                    <div class="ui left icon input">
                      <input type="text" name="salario" id="salario" placeholder="Salario" onkeypress="numeros()">
                      <i class="money icon"></i>
                    </div>
                  </div>
                </div>

                <div class="two fields"> <!-- Banco y Nro de Cuenta -->
                  <div class="field"><!-- Banco -->
                    <label>Banco</label>
                    <?php
                      $tagcbotp=$combo->generar_combo("select id_banco,nombre_banco from bancos where status_banco='a' order by nombre_banco", "id_banco","nombre_banco", isset($_GET[''])?$_GET['']:'','banco',' class="ui dropdown"');
                      foreach ($tagcbotp as $tagtp){echo $tagtp;}
                    ?>
                  </div>
                  <div class="field"><!-- Nro de cuenta -->
                    <label>Nro. de Cuenta</label>
                    <input type="text" name="nro_cuenta" id="nro_cuenta" placeholder="Número de Cuenta" maxlength="20" onkeypress="numeros()">
                  </div>
                </div>

            <h4 class="ui dividing header">Información de Contacto</h4>
                 <div class="field"><!-- Telefonos -->
                     <label>Teléfonos</label>
                       <div class="two fields">
                         <div class="field">
                             <div class="ui left icon input">
                               <input type="text" name="telf_mov" id="telf_mov" placeholder="Móvil" maxlength="11" onkeypress="numeros()">
                               <i class="call icon"></i>
                             </div>
                         </div>
                         <div class="field">
                             <div class="ui left icon input">
                               <input type="text" name="telf_loc" id="telf_loc" placeholder="Habitación" maxlength="11" onkeypress="numeros()">
                               <i class="call square icon"></i>
                             </div>                            
                         </div>
                       </div>
                 </div>
                 <div class="field"><!-- Email -->
                     <label>Correo Electrónico</label>
                     <div class="ui left icon input">
                        <input type="text" name="email" id="email" placeholder="Correo Electrónico" >
                         <i class="mail outline icon"></i>
                     </div>
                 </div>    

            <h4 class="ui dividing header">Información de Residencia</h4>
                 <div class="fields"><!-- Estado - Ciudad -->
                     <div class="five wide field">
                         <label>Estado</label>
                         <div class="field">
                                <?php
                                     $tagcbotp=$combo->generar_combo("select id_estado,descripcion from estado order by descripcion", "id_estado","descripcion", isset($_GET[''])?$_GET['']:'','estado',' class="ui dropdown"');
                                     foreach ($tagcbotp as $tagtp){echo $tagtp;}
                                 ?>
                         </div>
                     </div>
                     <div class="five wide field">
                         <label>Ciudad</label>
                         <div class="field">
                                <?php
                                     $tagcbotp=$combo->generar_combo_dependiente("select id_ciudad,descripcion,id_estado from ciudad order by descripcion", "id_ciudad","descripcion", isset($_GET[''])?$_GET['']:'','ciudad',' class="ui dropdown"',"id_estado");
                                     foreach ($tagcbotp as $tagtp){echo $tagtp;}
                                 ?>
                         </div>
                     </div>
                 </div>
                 <div class="fields"><!-- Municipio - Parroquia -->
                     <div class="field five wide ">
                         <label>Municipio</label>
                         <div class="field">
                                <?php
                                     $tagcbotp=$combo->generar_combo_dependiente("select id_municipio,municipio,id_estado from municipio order by municipio", "id_municipio","municipio", isset($_GET[''])?$_GET['']:'','municipio',' class="ui dropdown"',"id_estado");
                                     foreach ($tagcbotp as $tagtp){echo $tagtp;}
                                 ?>
                         </div>
                     </div>
                     <div class="field five wide ">
                         <label>Parroquia</label>
                         <div class="field">
                                <?php
                                     $tagcbotp=$combo->generar_combo_dependiente("select id_parroquia,parroquia,id_municipio from parroquia order by parroquia", "id_parroquia","parroquia", isset($_GET[''])?$_GET['']:'','parroquia',' class="ui dropdown"',"id_municipio");
                                     foreach ($tagcbotp as $tagtp){echo $tagtp;}
                                 ?>
                         </div>
                     </div>
                 </div>
                 <div class="fiedl"><!-- Direccion -->
                     <label>Dirección</label>
                     <div class="field">
                         <textarea name="direccion" id="direccion"> </textarea>
                     </div>
                 </div>
                 
            <br><br>
            <div class="ui centered actions">
              <input type="submit" class="ui primary button" value="Guardar">
              <div class="ui close button">Cancelar</div>   
            </div>
         </form>
    </div>  
  </div>

  <script type='text/javascript'> 
$('.ui.modal')
  .modal('setting', 'closable', false)
  .modal('attach events', '.adduser.button', 'show')
  .modal('attach events', '.close.button', 'hide')
;
  </script>
</body>
</html>
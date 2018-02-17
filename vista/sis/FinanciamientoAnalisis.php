<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(5);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $tipoDocente = $OSocio->getTipoDocente($_SESSION["userActivo"]);
    $condiciones = $OBenef->getCondiciones(5,$tipoDocente);

    $montoMin   = $condiciones["monto_min"];
    $haberesReq = $condiciones["haberes_req"];
    $fiadores   = $condiciones["max_fiadores"];

    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }
    $haberesSocio = $OSocio->getHaberes($Soc["id_persona"]);
    $haberesDispo = $haberesSocio * $haberesReq / 100;

    $montoMax=$haberesDispo;// El monto max. son los haberes disponibles

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //obtenemos los datos del prestamo
        $datosSolicitud = $OBenef->buscarSolicitud($id);
        $haberesSocio = $OSocio->getHaberes($datosSolicitud["id_persona"]);
    }
    //OBTENER REQUISITOS
    $requisitos = $OBenef->getRequisitos(5);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Financiamientos</title>

    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="../../image/favicon.png" /> <!-- Icono en el navegador -->

    <!-- - - - - - - - - - - - - - - -    CSS - - -  - - - - - - - - - - - - - - -  -->
    <link rel="stylesheet" type="text/css" href="../../css/SemanticUI/semantic.css"><!-- Interface de usuario -->
    <link rel="stylesheet" type="text/css" href="../../css/css.css" /><!-- CSS Base -->
    <link rel="stylesheet" type="text/css" href="../../js/jquery-ui/jquery-ui.css" /><!-- JQuery UI CSS -->

    <script src="../../js/jquery-2.1.4.min.js"></script><!--JQuery -->
    <script src="../../js/main.js"></script> <!--Configura Interfaz -->
    <script src="../../css/SemanticUI/semantic.js"></script><!-- Interface de usuario -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
    <script src="../../js/jquery-ui/jquery-ui.js"></script><!-- Selector de fecha -->
</head>
<body>  
    <?php include_once('Menu.php'); ?> <!-- Menu Lateral -->
    <div class="ui container"> 
        <h2 class="ui center aligned small block icon inverted header">
            <i class="add cart icon"></i>
            Financiamientos                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CPrestamoPersonal.php">
        
            <h3 class="ui center aligned header"> Solicitud de Programa de Financiamiento</h3> 
             <h4 class="ui dividing header">Datos del solicitante</h4>
            <div class="three fields">
                <div class="field">
                  <label>Cédula</label>
                  <div class="ui transparent input"><!-- Nro Cedula -->
                    <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
                  </div>
                </div>

                <div class="field"><!-- Nombre -->
                  <label>Nombre y Apellido</label>
                  <div class="ui transparent input">
                    <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                  </div>
                </div>
            </div>

            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="two fields">
                <div class="field">
                   <div class="field"><!-- Nombre -->
                  <label>Programa</label>
                  <div class="ui transparent input">
                    <input type="text" name="Programa" id="Programa"  value="<?php if(isset($datosSolicitud['programa'])) echo $datosSolicitud['programa']; ?>" readonly>
                  </div>
                </div>
                </div> 

                <div class="field">
                   <label>Monto solicitado</label>
                   <div class="ui transparent input">
                        <input type="text" name="MontoVer" id="MontoVer" value="<?php if(isset($datosSolicitud['monto'])) echo 'Bs. '.number_format($datosSolicitud['monto'], 2, ',', '.') ?>" readonly>
                   </div>
                </div>       

            </div>
            
            <div class="three fields">     

                <div class="field">
                   <label>Plazo de pago <i class='fitted help circle icon link' data-title="Ayuda" data-content='Las cuotas serán descontadas por nómina mensualmente.' data-variation='basic'></i></label>
                   <div class="field"><!-- Nacionalidad -->
                      <?php
                            $tagcbotp=$combo->gen_combo("SELECT p.*, CONCAT (p.nombre_plazo,' - ', p.min_meses,' cuotas') as Desc FROM cappiutep.t_beneficio_plazo as p WHERE id_beneficio=5 AND estatus='1' ", "min_meses","desc", isset($datosSolicitud['cuotas'])?$datosSolicitud['cuotas']:'','Plazo',' class="ui compact dropdown"');
                            foreach ($tagcbotp as $tagtp){echo $tagtp;}
                          ?>
                   </div>
                </div>

                <div class="field">
                    <label>Tasa de Interés</label>
                    <div class="ui transparent left labeled input">
                      <div class="ui label">%</div>
                      <input type="text" name="Interes" id="Interes" value="<?php if (isset($tasaInteres)) echo $tasaInteres; else echo "12";?>" readonly>
                    </div>
                </div>   

                <div class="field">
                    <label>Monto de la cuota</label>
                    <div class="ui transparent left labeled input">
                      <div class="ui label">Bs.</div>
                      <input type="text" name="MontoCuota" id="MontoCuota" readonly>
                    </div>
                </div> 

                
            </div>

            <p align="justify">
                Requisitos:
              </p>
              
              <?php foreach($requisitos as $index => $requisito): ?>
                  <div class="inline field">
                      <div class="ui checkbox">
                          <input id="terminos_analisis" name="terminos_analisis" type="checkbox" value="<?php echo $requisito[0] ?>">
                          <label ><b><?php echo $requisito[1] ?><b></label>
                      </div>
                  </div>
                  
              <?php endforeach; ?>
            <!--
             <h4 class="ui dividing header">Analisado por</h4>
            <div class="three fields">
                <div class="field">
                  <label>Cédula</label>
                  <div class="ui transparent input"> Nro Cedula 
                    <input type="text" name="Cedu" id="Cedu" value="<?php if(isset($datosSolicitud['cedula'])) echo $datosSolicitud['nacionalidad'].'-'.$datosSolicitud['cedula']; ?>" readonly>
                  </div>
                </div>

                <div class="field">
                  <label>Nombre y Apellido</label>
                  <div class="ui transparent input">
                    <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                  </div>
                </div>

                <div class="field">
                  <label>Fecha</label>
                  <div class="ui transparent input">
                    <input type="text" name="Nombre" id="Nombre"  value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                  </div>
                </div>
            </div>
            -->
            <div class="ui  message">
              
              <div class="ui center aligned basic segment">
                <div class="inline  field">
                  <div class="ui checkbox">
                    <input type="checkbox" name="terminos_analisis" id="terminos_analisis">
                    <label for="terminos_analisis"><b>El socio cumple con los requisitos para solicitar éste beneficio.<b></label>
                  </div>
                </div>
              </div>

            </div>

            <div class="ui center aligned block inverted header">
                <input type="hidden" name="opera" id="opera">
                <!--   Valores para validaciones -->
                <input type="hidden" name="idSolicitud" value="<?= $_GET['id'] ?>">
                <input type="hidden" name="Monto" id="Monto" value="<?php if(isset($datosSolicitud['monto'])) echo $datosSolicitud['monto'] ?>" readonly>
                <input type="hidden" name="montoMax" id="montoMax" value="<?php if(isset($montoMax))     echo $montoMax; ?>">
                <input type="hidden" name="montoMin" id="montoMin" value="<?php if(isset($montoMin))     echo $montoMin; ?>">
                <!--   Fin de Valores para validaciones -->
                <input type="button" class="ui green button" value="Aprobar"  onclick="enviar(this.value)" >
                <input type="button" class="ui red button"   value="Rechazar" onclick="enviar(this.value)" >
                <input type="button" class="ui button"       value="Volver"   onclick="window.location='GestionSolicitudes.php'">
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $(function(){ //Calcula los intereses
       $('#Plazo').on('change',function(){
       	if ($('#Monto').val()!='') {
            //validaciones necesarias
            var monto   = parseInt( $('#Monto').val());
            var interes = parseInt( $('#Interes').val());
            var cuotas  = parseInt( $('#Plazo').val());
            var total   = parseFloat((monto + (monto * interes / 100))/cuotas).toFixed(2) ;

            $('#MontoCuota').val(total);
        	};
       });
    })
 

    $(function(){ //Calcula los intereses
       $('#Monto').on('blur',function(){
       	if ($('#Plazo').val()!='') {

            //validaciones necesarias
            var monto   = parseInt( $('#Monto').val());
            var interes = parseInt( $('#Interes').val());
            var cuotas  = parseInt( $('#Plazo').val());
            var total   = parseFloat((monto + (monto * interes / 100))/cuotas) ;
            $('#MontoCuota').val(total);
       	};
       });
    })


    $(document).ready(function(){



    
        $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
          var valido = false; 
          var elemento = document.getElementById(maximo).value;
          var a =parseInt(campo);
          var b =parseInt(elemento);
          if (a<b)
            valido=true;     
          return valido;
        };

        $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
          var valido = false; 
          var elemento = document.getElementById(minimo).value;
          var a =parseInt(campo);
          var b =parseInt(elemento);
          if (a>b)
            valido=true;     
          return valido;
        };

    //Inicio Validaciones
        $('.ui.form')
        .form({
          on: 'submit',     
          inline : true,
          fields: {

           

            terminos: {
              identifier: 'terminos',
              rules: [
              {
                type   : 'checked',
                prompt : 'Debe leer y aceptar las condiciones del préstamo.'
              }
              ]
            },

            terminos_analisis: {
              identifier: 'terminos_analisis',
              rules: [
              {
                type   : 'checked',
                prompt : 'Verifique los requisitos de la solicitud antes de proceder.'
              }
              ]
            },

            terminos_aprobacion: {
              identifier: 'terminos_aprobacion',
              rules: [
              {
                type   : 'checked',
                prompt : 'No puede proceder sin previa discusión con el Consejo Administrativo.'
              }
              ]
            },

            terminos_liquidacion: {
              identifier: 'terminos_liquidacion',
              rules: [
              {
                type   : 'checked',
                prompt : 'Confirme la liquidación antes de continuar.'
              }
              ]
            },

            observacion: {
              optional: true,
              identifier: 'observacion',
              rules: [
              {
                type   : 'minLength[10]',
                prompt : 'Debe contener al menos 10 caractéres.'
              }
              ]
            }, 
          }
        })
    ;
    
    //Fin validariones
    });


    function soloNumeros(e){//Valida para que se escriban solo numeros
           key = e.keyCode || e.which;
           tecla = String.fromCharCode(key).toLowerCase();
           letras = " 0123456789,";
           especiales = "8-37-39-46";

           tecla_especial = false
           for(var i in especiales){
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla)==-1 && !tecla_especial){
                return false;
            }
        }


    function enviar(operacion) { 
      if ( $('form').form('is valid') ){
        switch(operacion){
            case "Solicitar":
                var redireccion="Prestamos.php";
            break;
            case "Aprobar":
            case "Rechazar":
            case "Registrar":
                var redireccion="GestionSolicitudes.php";
            break;
        }

        swal({
          text: "¿Está seguro de realizar ésta acción?",
          type: "info",
          showCancelButton: true,
          cancelButtonText: "Cancelar",
          cancelButtoncolor: "#d01919",
          confirmButtonText: "Aceptar",
          confirmButtonColor: "#2185d0",
          closeOnConfirm: false,
        },
        function(){
             swal.disableButtons();
                setTimeout(function(){
                    document.formulario.opera.value=operacion;
                    $("#formulario").submit(function(e){
                      var postData = $(this).serialize();
                      var formURL = $(this).attr("action");
                      $.ajax({
                        url : formURL,
                        type: "POST",
                        data : postData
                      });
                      e.preventDefault(); 
                    });
                    $("#formulario").submit();
                    swal({
                        type:"success",
                        text:"Operacion exitosa",
                        showCancelButton: false,
                        confirmButtonText: "Continuar",
                        confirmButtonColor: "#2185d0",
                    },function(){
                        window.location=redireccion;
                    }
                );
              },1500);
            });
        }
    }
</script>

</html>

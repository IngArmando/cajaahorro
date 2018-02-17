<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(2);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $tipoDocente = $OSocio->getTipoDocente($_SESSION["userActivo"]);
    $condiciones = $OBenef->getCondiciones(4,$tipoDocente);

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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Retiros</title>

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
            <i class="external share icon"></i>
            Retiro Parcial                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudRetiroParcial.php">
        
            <h3 class="ui center aligned header"> Solicitud de Retiro Parcial </h3> 
            <p align="justify">
               Por favor indique el monto que desea retirar, tenga en cuenta que el monto máximo
               será igual a sus haberes disponibles, adicionalmente escriba el motivo por el que 
               solicita el retiro.
            </p>
            <p>
              Los campos marcados con * son obligatorios.
            </p>
            <div class="ui info message">
                <i class="fitted info circle icon"></i> Sus haberes disponibles son Bs. <?php if (isset($haberesDispo)) echo number_format($haberesDispo, 2, ',', '.') ?>
            </div>
            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="required inline field">
                <label>Monto a solicitar</label>
                <div class="ui left labeled input">
                    <div class="ui label">Bs.</div>
                    <input type="text" name="monto" id="monto" onkeypress="return soloNumeros(event)" maxlength="10">
                </div>
            </div> 

            <div class="required field"><!-- Guardar en observaciones, borrar este comentario despues -->
                <label>Motivo del Retiro</label>
                <textarea id="observacion" name="observacion" class="ui textarea" rows="3" maxlength="150"></textarea>
            </div>       

            <div class="ui center aligned block inverted header">
                <input type="hidden" name="opera" id="opera" value="Solicitar">
                <!--   Valores para validaciones -->
                <input type="hidden" name="montoMax" id="montoMax" value="<?php if(isset($montoMax))     echo $montoMax; ?>">
                <input type="hidden" name="montoMin" id="montoMin" value="<?php if(isset($montoMin))     echo $montoMin; ?>">
                <!--   Fin de Valores para validaciones -->
                <input type="button" class="ui primary button" value="Solicitar" name="btnSolicitar" onclick="enviar(this.value)">
                <a class="ui red button" href="Retiros.php">Cancelar</a>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
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

            monto: {
              identifier: 'monto',
              rules: [
              {
                type   : 'empty',
                prompt : 'No puede estar en blanco.'
              },
              {
                type   : 'integer',
                prompt : 'Sólo puede contener números.'
              },
              {
                type   : 'mayorQueCampo[montoMin]',
                prompt : 'El monto no es suficiente para realizar la solicitud.'
              },
              {
                type   : 'menorQueCampo[montoMax]',
                prompt : 'Debe menor al monto máximo.'
              }
              ]
            },


            observacion: {
              identifier: 'observacion',
              rules: [
              {
                type   : 'minLength[10]',
                prompt : 'Debe contener al menos 10 caractéres.'
              }
              ]
            }

            
          }
        })
    ;
    
    //Fin validariones
    });


    function soloNumeros(e) {//Valida para que se escriban solo numeros
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
        if ( $('form').form('is valid') ) {
            switch(operacion) {
                case "Solicitar":
                    var redireccion="Retiros.php";
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
            },function(){
                swal.disableButtons();
                setTimeout(function(){
                    document.formulario.opera.value=operacion;
                    $("#formulario").submit(function(e) {
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

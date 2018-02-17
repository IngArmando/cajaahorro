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
    $condiciones = $OBenef->getCondiciones(2,$tipoDocente);

 if(isset($_GET["id"])){
        $id = $_GET["id"];
        //obtenemos los datos del prestamo
        $datosSolicitud = $OBenef->buscarSolicitud($id);
        $haberesSocio = $OSocio->getHaberes($datosSolicitud["id_persona"]);
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Amortizaciones</title>

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
            <i class="money icon"></i>
            Amortización                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudEspecial.php">

            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="three fields">

                <div class="field">
                    <label>Solicitante</label>
                    <div class="ui transparent left labeled input">
                      <input type="text" value="<?php if(isset($datosSolicitud['nombre1'])) echo $datosSolicitud['nombre1'].' '.$datosSolicitud['apellido1']; ?>" readonly>
                    </div>
                </div>       

                <div class="field">
                    <label>Tipo de Solicitud</label>
                    <div class="ui transparent left labeled input">
                      <input type="text" value="<?php if(isset($datosSolicitud['tipo'])) echo $datosSolicitud['tipo']; ?>" readonly>
                    </div>
                </div>

                <div class="field">
                    <label>Saldo deudor</label>
                    <div class="ui transparent left labeled input">
                      <input type="text" value="<?php if(isset($datosSolicitud['monto'])) echo 'Bs. '.number_format($datosSolicitud['monto'], 2, ',', '.') ?>" readonly>
                    </div>
                </div>       
            </div>
            
            <h4 class="ui dividing header">Datos de liquidación</h4>

            <div class="three fields">
                <div class="field">
                   <label>Forma de pago</label>
                   <div class="field"><!-- Nacionalidad -->
                      <?php
                            $tagcbotp=$combo->gen_combo("SELECT * FROM cappiutep.t_lista_valor WHERE id_lista=20 AND estatus='1' ", "nombre_largo","nombre_largo", isset($_GET[''])?$_GET['']:'','FormaPago',' class="ui compact dropdown"');
                            foreach ($tagcbotp as $tagtp){echo $tagtp;}
                          ?>
                   </div>
                </div>
                      
                <div class="field">
                   <label>Monto a amortizar</label>
                   <div class="ui left labeled input">
                   		<div class="ui label">Bs. </div>
                        <input type="text" name="MontoAmort" id="MontoAmort" placeholder="" onkeypress="return soloNumeros(event)" maxlength="20">
                   </div>
                </div> 

                <div class="field">
                   <label>N° de referencia</label>
                   <div class="ui left labeled input">
                        <input type="text" name="NroRef" id="NroRef" placeholder="Referencia" onkeypress="return soloNumeros(event)" maxlength="20">
                   </div>
                </div>       

            </div>

            <div class="ui field">
            	<label>Observaciones</label>
            	<textarea class="ui textarea" name="Observ" id="Observ" maxlegnth='250' rows="3"></textarea>
            </div>




            <div class="ui center aligned block inverted header">
            	<input type="hidden" name="Monto" id="Monto" value="<?php if(isset($datosSolicitud['monto'])) echo $datosSolicitud['monto']; ?>" readonly>
                <input type="hidden" name="opera" id="opera" value="Liquidar">
                <input type="button" class="ui primary button" value="Registrar" name="btnSolicitar" onclick="enviar(this.value)">
                <a class="ui red button" href="GestionSolicitudes.php">Cancelar</a>   
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
          if (a<=b)
            valido=true;     
          return valido;
        };

        $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
          var valido = false; 
          var elemento = document.getElementById(minimo).value;
          var a =parseInt(campo);
          var b =parseInt(elemento);
          if (a>=b)
            valido=true;     
          return valido;
        };
    //Inicio Validaciones
        $('.ui.form')
        .form({
          on: 'submit',     
          inline : true,
          fields: {

            FormaPago: {
              identifier: 'FormaPago',
              rules: [
              {
                type   : 'empty',
                prompt : 'No puede estar en blanco.'
              }
              ]
            },

            NroRef: {
              identifier: 'NroRef',
              rules: [
              {
                type   : 'empty',
                prompt : 'No puede estar en blanco.'
              }
              ]
            },

            MontoAmort: {
              identifier: 'MontoAmort',
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
                type   : 'menorQueCampo[Monto]',
                prompt : 'El monto a amortizar no debe ser mayor que la deuda.'
              }
              ]
            },

            observacion: {
              optional: true,
              identifier: 'Observ',
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
            case "Liquidar":
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

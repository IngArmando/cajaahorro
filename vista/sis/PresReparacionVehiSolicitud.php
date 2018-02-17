<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(3);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $tipoDocente = $OSocio->getTipoDocente($_SESSION["userActivo"]);
    $condiciones = $OBenef->getCondiciones(3,$tipoDocente);

    $montoMin   = $condiciones["monto_min"];
    $montoMax   = $condiciones["monto_max"];

    if (isset($_SESSION["userActivo"])){
        $OSocio -> setCedula($_SESSION["userActivo"]);
        $registro=$OSocio -> busCedula();
        while ( $fila = $OSocio->setArreglo( $registro )) $datos[] = $fila;
        foreach ($datos as $Soc) { $Soc; }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Préstamos</title>

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
            Préstamos                
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudVehiculo.php">
        
            <h3 class="ui center aligned header"> Solicitud de Préstamo para Reparación de Vehículo </h3> 
            <p align="justify">
            </p>
            <p>
              Los campos marcados con * son obligatorios.
            </p>
            <div class="ui info message">
                <i class="fitted info circle icon"></i> 
                <b>Montos a Solicitar según el plazo:</b> <br />
                0 a 150000 (24 meses)<br />
                150001 a 300000 (48 meses)<br />
                300001 a 500000 (72 meses)<br />
            </div>
            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="two fields">

                <div class="required field">
                    <label>Plazo de pago <i class='fitted help circle icon link' data-title="Ayuda" data-content='Las cuotas serán descontadas por nómina mensualmente.' data-variation='basic'></i></label>
                    <?php
                        $tagcbotp=$combo->gen_combo("SELECT p.*, CONCAT (p.nombre_plazo,' - ', p.min_meses,' cuotas') as Desc FROM cappiutep.t_beneficio_plazo as p WHERE id_beneficio=3 AND estatus='1' ", "min_meses","desc", isset($_GET[''])?$_GET['']:'','Plazo',' class="ui compact dropdown"');
                        foreach ($tagcbotp as $tagtp){echo $tagtp;}
                    ?>
                </div>
                <div class="required field">
                    <label>Monto a solicitar</label>
                    <div class="ui left labeled input">
                        <div class="ui label">Bs.</div>
                        <input type="text" name="Monto" id="Monto" disabled onkeypress="return soloNumeros(event)" maxlength="10">
                    </div>
                </div>
            </div>
            
            <div class="two fields">     

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

            <div class="field">
              <label>Observaciones</label>
              <textarea name="Observ" id="Obeserv" rows="3" style="resize:none"></textarea>
            </div>

            <div class="ui message">
                <p align="justify">
                  En caso de que la presente solicitud fuese resuesta favorable,
                  me comprometo a cumplir con las disposiciones previstas en los 
                  Estatutos, Reglamentos y demás normativas legales vigentes,
                  que rigen a ésta Asociacion.
                </p>
                <p align="justify">
                   Así mismo, autorizo a CAPPIUTEP para que realice el descuento
                   de mi sueldo mensual o por giros especiales, los montos correspondientes
                   a la cancelación del crédito recibido, de acuerdo al cronograma de pago
                   establecido y aceptado.
                </p>
                <div class="ui center aligned basic segment">
                    <div class="field">
                        <div class="ui checkbox">
                            <input type="checkbox" name="terminos" id="terminos">
                            <label for="terminos"><b>He leído, entiendo y estoy de acuerdo con las condiciones descritas.<b></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui center aligned block inverted header">
                <input type="hidden" name="opera" id="opera" value="Solicitar">
                <!--   Valores para validaciones -->
                <input type="hidden" name="montoMax" id="montoMax" value="<?php if(isset($montoMax))     echo $montoMax; ?>">
                <input type="hidden" name="montoMin" id="montoMin" value="<?php if(isset($montoMin))     echo $montoMin; ?>">
                <!--   Fin de Valores para validaciones -->
                <input type="button" class="ui primary button" value="Solicitar" name="btnSolicitar" onclick="enviar(this.value)">
                <a class="ui red button" href="Prestamos.php">Cancelar</a>   
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    $(function(){ //Calcula los intereses
       $('#Plazo').on('change',function(){
            valor = $(this).val();
            monto = $('#Monto').val();
            $('#Monto').attr("disabled",false);
            switch(valor){
                case "24": minPresta = 0; maxPresta = 150000; break;
                case "48": minPresta = 150001; maxPresta = 300000; break;
                case "72": minPresta = 300001; maxPresta = 500000; break;
            }
            monto=parseInt(monto);
            if (monto > 0) {
                if(monto > minPresta && monto < maxPresta){
                    //validaciones necesarias
                    var interes = parseInt( $('#Interes').val());

                    var p = parseInt( $('#Monto').val());
                    var i = (interes/12)/100;
                    var n = parseInt( $('#Plazo').val());
                    var total = parseFloat(p*((i*Math.pow((1+i),n))/(Math.pow((1+i),n)-1))).toFixed(2) ;

                    $('#MontoCuota').val(total);
                }else{
                    $('#Monto').val("");
                    $('#MontoCuota').val("");
                    alert("el monto no cumple las condiciones del prestamo");
                }
            };
       });
    })


    $(function(){ //Calcula los intereses
        $('#Monto').on('blur',function(){

            var max     = parseInt( $('#montoMax').val());
            var interes = parseInt( $('#Interes').val());

            var p = parseInt( $('#Monto').val());
            var i = (interes/12)/100;
            var n = parseInt( $('#Plazo').val());
            var total = parseFloat(p*((i*Math.pow((1+i),n))/(Math.pow((1+i),n)-1))).toFixed(2) ;
        
            //Calcular couta si existe plazo
            if ($('#Plazo').val()!='') {
                plazo = $('#Plazo').val();
                switch(plazo){
                    case "24": minPresta = 0; maxPresta = 150000; break;
                    case "48": minPresta = 150001; maxPresta = 300000; break;
                    case "72": minPresta = 300001; maxPresta = 500000; break;
                }
                monto = $("#Monto").val();
                monto=parseInt(monto);
                if(monto > minPresta && monto < maxPresta){
                    $('#MontoCuota').val(total);
                }else{
                    $('#Monto').val("");
                    $('#MontoCuota').val("");
                    alert("el monto no cumple las condiciones del prestamo");
                }
            };

            //Mostrar seleccion de fiadores si supera monto maximo            
            if (p>=max){  
                $('#SelecFiadores').transition('show');
                //$('#SelecFiadores').visibility('show');
            }else {  
                $('#SelecFiadores').transition('hide'); 
                //$('#SelecFiadores').visibility('hide');            
            }
       });
    })

  

    $(document).ready(function(){
    
        $.fn.form.settings.rules.menorQueCampo = function(campo,maximo){
            var valido = false; 
            var elemento = document.getElementById(maximo).value;
            var a =parseInt(campo);
            var b =parseInt(elemento);
            if (a<b) valido=true;     
            return valido;
        };

        $.fn.form.settings.rules.mayorQueCampo = function(campo,minimo){
            var valido = false; 
            var elemento = document.getElementById(minimo).value;
            var a =parseInt(campo);
            var b =parseInt(elemento);
            if (a>b) valido=true;     
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
                prompt : 'Verifique los datos de la solicitud antes de proceder.'
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
            }

            
          }
        });
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
                        text:"Operación exitosa",
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
<?php
    session_start();
    if(!isset($_SESSION["userActivo"])){
        header("location: ../pub/Acceso.php");
    }

    include_once("../../modelo/MCombo.php");
    $combo = new Combo();

    include_once("../../modelo/MConfiguracion.php");
    $OConf = new Configuracion;
    $monto = $OConf->consultarConf("monto_max_prestamo");
    $monto = $monto[0];
    $moneda = $OConf->consultarConf("moneda");
    $moneda = $moneda[0];

    include_once("../../modelo/MBeneficios.php");
    $OBenef = new Beneficio();
    $tasaInteres = $OBenef->get_tasa_interes(2);

    include_once("../../modelo/MSocio.php");
    $OSocio = new Socio();
    $tipoDocente = $OSocio->getTipoDocente($_SESSION["userActivo"]);
    $condiciones = $OBenef->getCondiciones(2,$tipoDocente);

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

    include_once("../../modelo/MConfiguracion.php");
    $OConfiguracion = new Configuracion();
    $Datos = $OConfiguracion->consultarConf();
    $dia_max_prestamo = $Datos['dia_max_prestamo'];
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
            Extencion De Préstamos
        </h2>
        <form class="ui large form" method="POST" name="formulario" id="formulario" autocomplete="off" action="../../controlador/CSolicitudPersonal.php">
            <h3 class="ui center aligned header"> Solicitud de Extencion de Préstamo  <h3> 
            <!--<p align="justify">
               El préstamo debe ser respaldado por sus haberes disponibles,
               para solicitar un monto mayor debe indicar <?php echo number_format($fiadores, 0, ',', '.') ?>
               socios que respalden el monto exedente. Es importante que los fiadores 
               tengan haberes disponibles para respaldar la fianza, por lo que se recomienda
               sean consultados previamente a su solicitud.
            </p>-->
            <p>
              Los campos marcados con * son obligatorios.
            </p>
            <div class="ui info message">
              <i class="fitted info circle icon"></i> La cantidad máxima a pedir es: <?= $moneda?><?= $monto ?>
            </div>
            <h4 class="ui dividing header">Datos de la solicitud</h4>
            
            <div class="three fields">

              <div class="required field">
                <label>Monto a solicitar</label>
                <div class="ui left labeled input">
                  <div class="ui label"><?= $moneda ?></div>
                  <input type="text" name="Monto" id="Monto" onkeypress="return soloNumeros(event)" maxlength="10">
                </div>
              </div>       

              <div class="required field">
                <label>Plazo de pago <i class='fitted help circle icon link' data-title="Ayuda" data-content='Las cuotas serán descontadas por nómina mensualmente.' data-variation='basic'></i></label>
                <?php
                //$tagcbotp=$combo->gen_combo("SELECT p.*, CONCAT (p.nombre_plazo,' - ', p.min_meses,' cuotas') as Desc FROM cappiutep.t_beneficio_plazo as p WHERE id_beneficio=5 AND estatus='1' ", "min_meses","desc", isset($_GET[''])?$_GET['']:'','Plazo',' class="ui compact dropdown"');
                //foreach ($tagcbotp as $tagtp){echo $tagtp;}
                ?>
                <select name="Plazo" id="Plazo" class="ui compact dropdown">
                    <?php for($pl=1;$pl<=40;$pl++): ?>
                        <option value="<?=$pl?>"><?=$pl?></option>
                    <?php endfor; ?>
                </select>
              </div>
              <div class="field">
                    <label>Tasa de Interés</label>
                    <div class="ui transparent left labeled input">
                      <div class="ui label">%</div>
                      <input type="text" name="Interes" id="Interes" value="<?php if (isset($tasaInteres)) echo $tasaInteres;?>" readonly>
                    </div>
                </div> 

            </div>
            
            <div class="two fields">

                  

                <!--<div class="field">
                    <label>Monto de la cuota</label>
                    <div class="ui transparent left labeled input">
                      <div class="ui label">Bs.</div>
                      <input type="text" name="MontoCuota" id="MontoCuota" readonly>
                    </div>
                </div> -->
            </div>

            <div class="ui center aligned basic segment">
                <div class="inline field">
                    <button type="button" class='ui labeled icon button' onclick="amortizacionNueva()">
                        <i class='check icon'></i>
                        Ver Tabla de Amortización
                    </button>
                </div>
            </div>                

            <!--
            <div class="ui center aligned basic segment">
                <div class="inline field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="terminos" id="terminos">
                        <label ><b>Permitir Cuotas Especiales</b> (Opcional) <i class='fitted help circle icon link' data-title="Ayuda" data-content='Las cuotas especiales, son cuotas adicionales de caracter opcional que permiten acelerar la amortización del préstamo. Serán dos cuotas anuales y el monto se definirá por la capacidad de pago del socio.' data-variation='basic'></i></label>
                    </div>
                </div>
            </div>
            
            <div id="divCuotasEspeciales" class="">
                <div class="four fields">
                    
                    <div class="field">
                        <label>Monto del Pago Especial</label>
                        <div class="ui left labeled input">
                            <div class="ui label">Bs.</div>
                            <input type="text" name="MontoTotalEspecial" id="MontoEspecial">
                        </div> 
                    </div>
                    <div class="field">
                        <label>Monto a Solitar a Nómina</label>
                        <div class="ui left transparent labeled input">
                            <div class="ui label">Bs.</div>
                            <input type="text" name="MontoNominaReal" id="MontoSolicitarReal" readonly>
                        </div> 
                    </div>
                    <div class="field">
                        <label>Monto de la Cuota</label>
                        <div class="ui left transparent labeled input">
                            <div class="ui label">Bs.</div>
                            <input type="text" name="MontoCuotaReal" id="MontoCuotaReal" readonly>
                        </div> 
                    </div>
                    
                    <div class="field">
                        <br>
                        <div class="ui left labeled input">
                            <button type="button" class='ui labeled icon button' onclick="calcularAmortizacion()">
                                <i class='check icon'></i>
                                Ver Tabla de Amortización
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <div>
                <table class="ui table">
                    <thead>
                        <tr>
                            <th height="10">Nro</th>
                            <th height="20">Mes</th>
                            <th height="40">Año</th>
                            <th height="40">Capital</th>
                            <th height="40">Interés</th>
                            <th height="40">Cuota</th>
                            <th height="40">Saldo</th>
                        </tr>
                    </thead>
                    <tbody id="tablaAmortizacion">

                    </tbody>
                </table>

            </div>

            <div id="SelecFiadores" name="SelecFiadores" style="display:none">
                <div class="ui center aligned block header"> Fiadores</div>
                <div class="ui warning message visible">
                    <i class="fitted info circle icon"></i> El monto a solicitar supera su disponibilidad, por favor indique sus fiadores o solicite un monto menor. 
                </div>
  			    <table class="ui small center aligned table">
                    <thead>
                        <th class="two wide">N°</th>
                        <th class="three wide">Cédula</th>
                        <th>Nombre y Apellido</th>
                    </thead>
                    <tbody>
  	                <?php if($fiadores): ?>
  	                    <?php for($i=1;$fiadores>=$i;$i++){ ?>
  	                        <tr>
  	                        	<td><?php echo $i;  ?></td>
  	                            <td>
  	                            	<div class="ui field">
  	                            		<input type="text" name="txtCiF[]" onblur="buscarSocio(this,'<?= $i ?>')"  id="cedula-<?= $i ?>">
  	                            	</div>
  	                            </td>
  	                            <td>
  									<div class="ui transparent input">
  										<input type="text" name="txtNombreF[]" id="nombre-<?= $i ?>">
                                        <input type="text" name="txtTipoF[]" id="apellido-<?= $i ?>">
  									</div>
  	                            </td>
  	                        </tr>
  	                    <?php }; ?>
  	                <?php endif; ?>
                    </tbody>
                </table>
              
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
                <input type="hidden" name="montoMax" id="montoMax" value="<?php if(isset($monto))     echo $monto; ?>">
                <!--   Fin de Valores para validaciones -->
                <?php 
                    if ( $dia_max_prestamo < date('d') )
                        echo '<input type="button" class="ui primary button" value="Solicitar" name="btnSolicitar" onclick="enviar(this.value)">';
                ?>
                <!--<input type="submit" class="ui primary button" value="Solicitar" name="btnSolicitar">-->
                <a class="ui red button" href="Prestamos.php">Cancelar</a>   
            </div>
        </form>
    </div>
</body>
<script type="text/javascript">
    function buscarSocio(_this,id){
        $.get(URL_ABSOLUTA+"controlador/CbuscarSocio.php",{cedula:_this.value},function(data) {
            datos = JSON.parse(data);
            $("#nombre-"+id).val(datos[3]);
            $("#apellido-"+id).val(datos[5]);
        });
    }
    function colocarMontoTotalNomina(){
        Monto=$("#Monto").val();
        MontoEspecial=$("#MontoEspecial").val();
        total = Monto - MontoEspecial;
        MontoSolicitarReal=$("#MontoSolicitarReal").val(total);

    }
   
    function calcularAmortizacion(){
        limpiarTablaAmortizacion();
        auxHoy = new Date();
        hoy = new Date();
        mes = hoy.getMonth() + 1;
        dia = hoy.getDate();
        anho = hoy.getFullYear();
        hoy = hoy.getDate()+"/"+(hoy.getMonth() + 1)+"/"+hoy.getFullYear();
        prestamo = document.getElementById("MontoEspecial").value;
        prestamoActual = prestamo;
        cuotas = document.getElementById("Plazo").value;
        cantGiros = cuotas / 12 * 2;
        interes = document.getElementById("Interes").value;
        diasAnho = 360;
        cuota = prestamo / cantGiros;
        if(mes>=7){
            entro = 1;
            primermes = 12;
            segundomes = 7;
            diferencia = primermes - segundomes;
            primerafecha = dia+"/12/"+anho;
        }else{
            entro = 2;
            primermes = 7;
            segundomes = 12;
            primerafecha = dia+"/7/"+anho;
        }
        fecha = primerafecha;
        tbody = document.getElementById('tablaAmortizacion');
        for(it = 1;it<=cantGiros;it++){
            row = it-1;
            auxPrestamo = prestamo;
            deuda = prestamo - cuota;
            prestamo = deuda;
            tr=tbody.insertRow(row);
            td0 = tr.insertCell(0);
            td1 = tr.insertCell(1);
            td2 = tr.insertCell(2);
            td3 = tr.insertCell(3);
            td4 = tr.insertCell(4);
            td5 = tr.insertCell(5);

            td0.innerHTML = it;
            if(it==1){
                td1.innerHTML=fecha;
                dias_pasados = calcularDiasRestantes(hoy,fecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;
            }
            fecha2 = fecha.split("/");
            fecha2 = fecha2[2]+"/"+fecha2[1]+"/"+fecha2[0];
            if(it>1 && it%2==0){
                if(entro==2){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 5);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }
                else if(entro==1){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 7);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }

                dias_pasados = calcularDiasRestantes(fecha,auxFecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;

                fecha = auxFecha;
                td1.innerHTML=auxFecha;
            }else if(it>1 && it%2==1){
                if(entro==2){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 7);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }
                else if(entro==1){
                    auxFecha =  new Date(fecha2);
                    auxFecha.setMonth(auxFecha.getMonth() + 5);
                    auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
                }

                dias_pasados = calcularDiasRestantes(fecha,auxFecha);
                giro = (auxPrestamo * interes / diasAnho * dias_pasados) / 100;

                fecha = auxFecha;
                td1.innerHTML=auxFecha;
            }         
            td2.innerHTML=cuota.toFixed(2);
            td3.innerHTML=giro.toFixed(2);
            td4.innerHTML=(parseFloat(cuota)+parseFloat(giro)).toFixed(2);
            td5.innerHTML=deuda.toFixed(2);
        }
    }

    $(function(){ //Calcula los intereses
        $('#Plazo').on('change',function() {
            limpiarTablaAmortizacion();
            if ($('#Monto').val()!='') {
                //validaciones necesarias
                var interes = parseInt( $('#Interes').val());

                var p = parseInt( $('#Monto').val());
                var i = (interes/12)/100;
                var n = parseInt( $('#Plazo').val());
                var total = parseFloat(p*((i*Math.pow((1+i),n))/(Math.pow((1+i),n)-1))).toFixed(2) ;

                $('#MontoCuota').val(total);
            };
        });
        /*
        $("#MontoEspecial").on("blur",function() {
            colocarMontoTotalNomina();

            var interes = parseInt( $('#Interes').val());

            var p = parseInt( $('#MontoSolicitarReal').val());
            var i = (interes/12)/100;
            var n = parseInt( $('#Plazo').val());
            var total = parseFloat(p*((i*Math.pow((1+i),n))/(Math.pow((1+i),n)-1))).toFixed(2) ;
            $("#MontoCuotaReal").val(total);
        });
        */
        $('#Monto').on('blur',function() {

            var max     = parseInt( $('#montoMax').val());
            var monto = $(this).val();
            that = $(this);
            if(monto > max){
                $(this).val("");

                swal({
                    type:"error",
                    text:"El monto a solicitar no puede ser mayor a $"+max,
                    showCancelButton: false,
                    confirmButtonText: "Continuar",
                    confirmButtonColor: "#2185d0",
                },function(){
                    that.focus();
                });
            }
            /*
            var interes = parseInt( $('#Interes').val());

            var p = parseInt( $('#Monto').val());
            var i = (interes/12)/100;
            var n = parseInt( $('#Plazo').val());
            var total = parseFloat(p*((i*Math.pow((1+i),n))/(Math.pow((1+i),n)-1))).toFixed(2) ;
        
            //Calcular couta si existe plazo
            if ($('#Plazo').val()!='') {
                $('#MontoCuota').val(total);
            };
            
            //Mostrar seleccion de fiadores si supera monto maximo            
            if (p>=max){  
                $('#SelecFiadores').transition('show');
                //$('#SelecFiadores').visibility('show');
            }else {  
                $('#SelecFiadores').transition('hide'); 
                //$('#SelecFiadores').visibility('hide');
            }
            */
       });
    });

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

            Monto: {
              identifier: 'Monto',
              rules: [
              {
                type   : 'empty',
                prompt : 'No puede estar en blanco.'
              },
              {
                type   : 'integer',
                prompt : 'Sólo puede contener números.'
              }
              ]
            },
            Plazo: {
                identifier: 'Plazo',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'No puede estar en blanco.'
                    },
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
       letras = " 0123456789.";
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

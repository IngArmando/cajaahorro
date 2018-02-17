
$(function(){ //Validacion de duplicados de cedula
   $('#CI').on('blur',function(){
   
   var cedula = $('#CI').val();
   $.ajax({
       type: "POST",
       url: "../../controlador/ValCedula.php",
       data: ('CI='+cedula),
       success: function(respuesta){
          if (respuesta==1) {
                swal({
                    type:"warning",
                    text:"Éste número de cédula ya está registrado.",
                    showCancelButton: false,
                    confirmButtonText: "Continuar",
                    confirmButtonColor: "#2185d0",
                });
               $('#CI').val('');
            };
           
          }
        })
   })
})

$(function(){ //Validacion de duplicados de nro de cuenta
   $('#Email').on('blur',function(){
   
   var email = $('#Email').val();
   
   $.ajax({
       type: "POST",
       url: "../../controlador/ValEmail.php",
       data: ('Email='+email),
       success: function(respuesta){
          if (respuesta==1) {
                swal({
                    type:"warning",
                    text:"Éste correo electrónico ya está registrado.",
                    showCancelButton: false,
                    confirmButtonText: "Continuar",
                    confirmButtonColor: "#2185d0",
                });
               $('#Email').val('');
            };
           
          }
        })
   })
})

$(document).ready(function(){   

    $.fn.form.settings.rules.DependeDe = function(campo,depende){
      var valido = true;     
      var elemento = $('#'+depende).val();      
      if (elemento != "" && campo == "")
        valido=false;
      return valido;
    };


    $.fn.form.settings.rules.exactLengthAlter = function(campo,depende){
      var valido = true;     
      var elemento = $('#'+depende).val();
      var caracteres = campo.length;     
      if (elemento != "" && campo != "" && caracteres != 7)
        valido=false;
      return valido;
    };

    $.fn.form.settings.rules.DependeDeValor = function(campo,depende){
      var valido = true;     
      var elemento = $('#'+depende).val();      
      if (elemento != "162" && campo == "")
        valido=false;
      return valido;
    };
  

  $(function(){ 
   $('#TipoDocente').on('change',function(){
   
     var tipo = $('#TipoDocente').val();
     
     if (tipo!=162)
     {
        $('#SoloProf').removeClass('ui hidden message');
        $('#SoloProf').addClass('ui message');
     }
     else 
     {     
        $('#SoloProf').removeClass('ui message');
        $('#SoloProf').addClass('ui hidden message');
        $('#Categoria').dropdown("restore defaults");
        $('#Dedicacion').dropdown("restore defaults");
        
     }
     });
  });

 
//Inicio Validaciones
    $('.ui.form')
    .form({
      on: 'submit',
      keyboardShortcuts: false, 
      inline : false,
      fields: {

        Nacionalidad: {
          identifier: 'Nacionalidad',
          rules: [
          {
            type   : 'empty',
            prompt : 'La nacionalidad no puede estar en blanco.'
          }
          ]
        },

        CI: {
          identifier: 'CI',
          rules: [
          {
            type   : 'empty',
            prompt : 'La cédula no puede estar en blanco.'
          },
          {
            type   : 'minLength[7]',
            prompt : 'La cédula, debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[10]',
            prompt : 'La cédula, no debe contener más de {ruleValue} caracteres.'
          }
          ]
        },

        FechaIns: {
          identifier: 'FechaIns',
          rules: [
          {
            type   : 'empty',
            prompt : 'La fecha de inscripción no puede estar en blanco.'
          }
          ]
        },  

        Nombre1: {
          identifier: 'Nombre1',
          rules: [
          {
            type   : 'empty',
            prompt : 'El nombre no puede estar en blanco.'
          },
          {
            type   : 'minLength[3]',
            prompt : 'El nombre, debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'El nombre, no debe contener más de {ruleValue} caracteres.'
          }
          ]
        },

        Nombre2: {
          identifier: 'Nombre2',
          optional: true,
          rules: [
          {
            type   : 'minLength[3]',
            prompt : 'El segundo nombre, debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'El segundo nombre, no debe contener más de {ruleValue} caracteres.'
          }
          ]
        },

        Apellido1: {
          identifier: 'Apellido1',
          rules: [
          {
            type   : 'empty',
            prompt : 'El apellido no puede estar en blanco.'
          },
          {
            type   : 'minLength[3]',
            prompt : 'El apellido, debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'El segundo apellido no debe contener más de {ruleValue} caracteres.'
          }
          ]
        },

        Apellido2: {
          identifier: 'Apellido2',
          optional: true,
          rules: [
          {
            type   : 'minLength[3]',
            prompt : 'El segundo apellido debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'El segundo apellido no debe contener más de {ruleValue} caracteres.'
          }
          ]
        },

        /*CodMovil: {
          identifier: 'CodMovil',
          rules: [
          {
            type   : 'DependeDe[TelfMov]',
            prompt : 'Seleccione una operadora de teléfono móvil.'
          }
          ]
        },

        TelfMov: {
          identifier: 'TelfMov',
          rules: [
          {
            type   : 'DependeDe[CodMovil]',
            prompt : 'Complete el número de teléfono móvil.'
          },
          {
            type   : 'exactLengthAlter[CodMovil]',
            prompt : 'El número de teléfono móvil debe tener 7 dígitos.'
          }

          ]
        },

        CodHab: {
          identifier: 'CodHab',
          rules: [
          {
            type   : 'DependeDe[TelfHab]',
            prompt : 'Seleccione un código de área del teléfono habitación.'
          }
          ]
        },

        TelfHab: {
          identifier: 'TelfHab',
          rules: [
          {
            type   : 'DependeDe[CodHab]',
            prompt : 'Complete el número de teléfono habitación.'
          },
          {
            type   : 'exactLengthAlter[CodHab]',
            prompt : 'El número de teléfono de habitación debe tener 7 dígitos.'
          }

          ]
        },*/

        Email: {
          identifier: 'Email',
          rules: [
          {
            type   : 'empty',
            prompt : 'La dirección de correo electrónico no puede estar en blanco.'
          },
          {
            type   : 'email',
            prompt : 'La dirección de correo electrónico no es válida.'
          }
          ]
        },
        TipoPersona: {
          identifier: 'TipoPersona',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione el tipo de inscripción.'
          }
          ]
        },
        /*

      Banco: {
        identifier  : 'Banco',
        rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione un banco.'
          }
        ]
      },

      txtNroCuenta: {
        identifier  : 'txtNroCuenta',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el número de cuenta.'
          },
          {
            type   : 'length[20]',
            prompt : 'Número de cuenta invalido, por favor verifique.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'Número invalido, por favor verifique.'
          }
        ]
      },

      txtTipoCuenta: {
        identifier  : 'txtTipoCuenta',
        rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione el tipo de cuenta.'
          }
        ]
      },

      txtNroCuenta: {
        identifier  : 'txtNroCuenta',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el número de cuenta.'
          },
          {
            type   : 'length[20]',
            prompt : 'Número de cuenta invalido, por favor verifique.'
          },
          {
            type   : 'maxLength[20]',
            prompt : 'Número invalido, por favor verifique.'
          }
        ]
      },


        Estado: {
          identifier: 'Estado',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione el estado de residencia.'
          }
          ]
        },

        Municipio: {
          identifier: 'Municipio',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione la ciudad de residencia.'
          }
          ]
        },

        Parroquia: {
          identifier: 'Parroquia',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione la ciudad de residencia.'
          }
          ]
        },

        Dir: {
          identifier: 'Dir',
          rules: [
          {
            type   : 'empty',
            prompt : 'La dirección no puede estar en blanco.'
          },
          {
            type   : 'minLength[10]',
            prompt : 'La dirección debe contener al menos {ruleValue} caracteres.'
          },
          {
            type   : 'maxLength[120]',
            prompt : 'La dirección no puede contener más de {ruleValue} caracteres.'
          },
          ]
        },
        
        TipoDocente: {
          identifier: 'TipoDocente',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione el tipo de docente.'
          }
          ]
        },

        FechaIng: {
          identifier: 'FechaIng',
          rules: [
          {
            type   : 'DependeDeValor[TipoDocente]',
            prompt : 'Seleccione la fecha de ingreso a la institución.'
          }
          ]
        },

        Categoria: {
          identifier: 'Categoria',
          rules: [
          {
            type   : 'DependeDeValor[TipoDocente]',
            prompt : 'Seleccione la categoria del docente.'
          }
          ]
        },

        Dedicacion: {
          identifier: 'Dedicacion',
          rules: [
          {
            type   : 'DependeDeValor[TipoDocente]',
            prompt : 'Seleccione el tipo de dedicación del docente.'
          }
          ]
        },

        Salario: {
          identifier: 'Salario',
          rules: [
          {
            type   : 'empty',
            prompt : 'El salario mensual no puede estar en blanco.'
          },
          {
            type   : 'minLength[4]',
            prompt : 'El salario debe contener al menos {ruleValue} dígitos.'
          },
          {
            type   : 'maxLength[7]',
            prompt : 'El salario no puede contener más de {ruleValue} dígitos.'
          },
          ]
        },

        Sede: {
          identifier: 'Sede',
          rules: [
          {
            type   : 'empty',
            prompt : 'Seleccione una sede.'
          }
          ]
        },*/
      }
    })
;
//Fin Validaciones 

  //Combos dependientes
  $("#Municipio").chained("#Estado");
  $("#Parroquia").chained("#Municipio");
  $("#Cargo").chained("#TipoCargo");

 $(".Fecha").datepicker({//inicializacion selector de fechas
            maxDate: "-18Y",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            yearRange: "c-85:+0",
            onClose: function (fecha) 
            {
              var MinFechaIngreso =  $.datepicker.parseDate('dd/mm/yy', fecha);
              var NuevoMin= parseInt(MinFechaIngreso.getFullYear()+18);

              $(".FechaIng").datepicker({
                  maxDate: 0,
                  changeMonth: true,
                  changeYear: true,
                  showButtonPanel: false,
                  yearRange: NuevoMin+':c',
              });
            }
        });
   

 $(".FechaIns").datepicker({//inicializacion selector de fechas
            maxDate: 0,
            minDate: -7,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            yearRange: "c-85:+0"
        });


 
   
   //Array para dar formato en español
  $.datepicker.regional['es'] = 
    {

    closeText: 'Cerrar', 
    currentText: 'Hoy',
    prevText: 'Previo', 
    nextText: 'Próximo',
    
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    monthStatus: 'Ver otro mes', yearStatus: 'Ver otro año',
    dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sáb'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
    dateFormat: 'dd/mm/yy', firstDay: 0, 
    initStatus: 'Selecciona la fecha', isRTL: false};
   $.datepicker.setDefaults($.datepicker.regional['es']);
  })
;


function enviar(operacion)
{	
   $('form').form('validate form');
  if ( $('form').form('is valid') )
  {
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
          window.location="AdminSocios.php";
        }
        );
      },1500);
    });
}
}

function cancelar(){
    swal({
    title: '¿Seguro que desea cancelar?',
    text: "Perderá la información que no se haya guardado",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: "red",
    cancelButtonColor: "gray",
    confirmButtonText: 'Sí, deseo cancelar',
    cancelButtonText: "Volver al formulario",
    closeOnConfirm: true
  },
  function(isConfirm) {
    if (isConfirm) {
      swal(
        window.location="AdminSocios.php"
      );
    }
  })
}

function soloNumeros(e){//Valida para que se escriban ssolo numeros
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

function soloLetras(e) {//Valida para que se escriban solo letras
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function fondoComun()
{
  if (document.getElementById('FondoComunSi').checked == true){
     document.getElementById('FondoComunNo').checked = false;
     document.getElementById('fondoc').style.display='block';
   }else{
     document.getElementById('FondoComunNo').checked = true;
    document.getElementById('fondoc').style.display='none';
    document.getElementById('fondoco').value=0;

   }
   
}

/*$('#TipoPersona').change(function()
{
  alert('hola');
  if ( document.getElementById('TipoPersona').value == '1' )
  {
    $('#divFCesantia').css('display','');
    $('#divFComun').css('display','none');
  }
  else
  {
    $('#divFCesantia').css('display','');
    $('#divFComun').css('display','');
  }
});*/

function TipoPers(ID)
{
  if ( ID == '1' )
  {
    document.getElementById('divFondos').style.display='none';
    document.getElementById('FondoComunSi').checked=false;
    document.getElementById('FondoComunNo').checked=true;
  }
  else
  {
    document.getElementById('divFondos').style.display='';
  }
}
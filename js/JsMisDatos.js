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
  
//Inicio Validaciones
    $('.ui.form')
    .form({
      on: 'blur',
      keyboardShortcuts: false, 
      inline : true,
      fields: {


        CodMovil: {
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
        },

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
        }

      }
    })
;
//Fin Validaciones 

  //Combos dependientes
  $("#Municipio").chained("#Estado");
  $("#Parroquia").chained("#Municipio");
  $("#Cargo").chained("#TipoCargo");
    
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
          window.location="Inicio.php";
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
        window.location="Inicio.php"
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

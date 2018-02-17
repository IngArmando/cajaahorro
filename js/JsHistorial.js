
$(document).ready(function(){   

    $.fn.form.settings.rules.DependeDe = function(campo,depende){
      var valido = true;     
      var elemento = $('#'+depende).val();      
      if (elemento != "" && campo == "")
        valido=false;
      return valido;
    };


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
      keyboardShortcuts: false, 
      inline : false,
      fields: {

        Hasta: {
          identifier: 'Hasta',
          rules: [
          {
            type   : 'DependeDe[Desde]',
            prompt : 'Seleccione una fecha hasta la que desea buscar.'
          },
          {
            type   : 'mayorQueCampo[Desde]',
            prompt : 'Debe ser posterior a la fecha desde la que desea buscar.'
          }
          ]
        },

        Desde: {
          identifier: 'Desde',
          rules: [
          {
            type   : 'DependeDe[Hasta]',
            prompt : 'Seleccione una fecha desde la que desea buscar.'
          },
          {
            type   : 'menorQueCampo[Hasta]',
            prompt : 'Debe ser anterior a la fecha hasta la que desea buscar.'
          }

          ]
        },

        



      }
    })
;
//Fin Validaciones 


 $(".Fecha").datepicker({//inicializacion selector de fechas
            maxDate: "0",
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            yearRange: "c-85:+0",
            
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


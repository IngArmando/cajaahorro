$(document)
  .ready(function(){

    var validacionJD ={//validaciones
      fecha_inicio_jd: {
        identifier  : 'fecha_inicio_jd',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor seleccione la fecha de inicio.'
          }
        ]
      },
    }
  ;

    var validacionJD ={//validaciones
      fecha_cierre_jd: {
        identifier  : 'fecha_cierre_jd',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor seleccione la fecha de cierre.'
          }
        ]
      },
    }
  ;
  $('.ui.form').form(validacionJD,{//funcion que activa las validaciones
    inline: true
  });

});
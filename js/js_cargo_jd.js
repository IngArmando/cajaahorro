$(document)
  .ready(function(){

    var validacionCargo_jd ={//validaciones
      descripcion_cargo_jd: {
        identifier  : 'descripcion_cargo_jd',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el cargo de la junta directiva.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validacionCargo_jd,{//funcion que activa las validaciones
    inline: true
  });

});
$(document)
  .ready(function(){

    var validaciontp ={//validaciones
      descripcion_tipo_pres: {
        identifier  : 'descripcion_tipo_pres',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el tipo de prestamo.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validaciontp,{//funcion que activa las validaciones
    inline: true
  });

});
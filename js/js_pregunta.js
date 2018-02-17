$(document)
  .ready(function(){

    var validacionpregunta ={//validaciones
      pregunta: {
        identifier  : 'pregunta',
        rules: [
          {
            type   : 'empty',
            prompt : 'Por favor escriba el nombre de la pregunta secreta.'
          }
        ]
      },
    }
  ;

  $('.ui.form').form(validacionpregunta,{//funcion que activa las validaciones
    inline: true
  });

});
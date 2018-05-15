$(document)
  .ready(function(){

    $('ui.form').attr("autocomplete","off");//eliminar el autocompletado 
   
    
    $('.ui.modal')//Inicializacion modals
  	.modal()
	;

	$('.button')//Activar pop-ups para clase button
  	.popup()
	;

	$('.icon')//Activar pop-ups para clase icon
  	.popup()
	;

	$('.item')//Activar pop-ups para clase item
  	.popup({
	    on: 'click',
	    position: 'right center',
	    exclusive: true,
	    movePopup: false
	  })
	;

    $('.ui.accordion')//Inicializacion acordiones
      .accordion({
      	exclusive: true
      	})
    ;

    $('.menu .item')//Inicializacion pestañas
	  .tab()
	;

	$('#context1 .menu .item')
	  .tab({
	    context: $('#context1')
	  })
	;
	$('#context2 .menu .item')
	  .tab({
	    // special keyword works same as above
	    context: 'parent'
	  })
	;

    $('.ui.dropdown')//Activa dropdowns
 		 .dropdown()
	;	

	//Combos dependientes
	if($("#IdPadre").length)
		$("#IdPadre").chained("#ListaPadre");


});

	host = window.location.host;
  path = window.location.pathname.split("/");
  //path = path[1]+"/"+path[2];
  path = path[1];
  protocolo = window.location.protocol;
  puerto = window.location.port;
  URL_ABSOLUTA = protocolo+"//"+host+"/"+path+"/";
  
function menu () {
	$('.ui.sidebar')//Menu ocultable
	  .sidebar('toggle')
	;
}

function cerrarSesion () {
	
	swal({
      text: "¿Desea salir del sistema?",
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
      window.location='Salir.php'
    });
	
	
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
function limpiarTablaAmortizacion(){
    tbody = document.getElementById('tablaAmortizacion');
    tbody.innerHTML="";
}
function limpiarTablaAmortizacion2(p){
    tbody = document.getElementById('tablaAmortizacion'+p);
    tbody.innerHTML="";
}
function calcularDiasRestantes(f1,f2){
    var aFecha1 = f1.split('/');
    var aFecha2 = f2.split('/'); 
    var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
    var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
    var dif = fFecha2 - fFecha1;
    dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 

    return dias;
}
function amortizacionNueva() {
  limpiarTablaAmortizacion();
  hoy = new Date();
  mes = hoy.getMonth() + 1;
  dia = hoy.getDate();
  anho = hoy.getFullYear();
  ultimoDia = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0).getDate();
  if(ultimoDia == 31) ultimoDia = 30;
  if(dia.toString().length <= 1) dia = "0"+dia;
  fecha = dia+"/"+mes+"/"+anho;
  if(arguments.length==4){
    prestamo = arguments[0];
    plazo = arguments[1];
    interes = arguments[2];
    tbody = document.getElementById(arguments[3]);
  }else{
    prestamo = document.getElementById("Monto").value;
    plazo = document.getElementById("Plazo").value;
    interes = document.getElementById("Interes").value;
    tbody = document.getElementById('tablaAmortizacion');
  }
  
  capital = parseFloat(prestamo / plazo).toFixed(2);
  capital_diario = parseFloat(prestamo / plazo / 30);
  fecha2 = fecha.split("/");
  fecha2 = fecha2[2]+"/"+fecha2[1]+"/"+fecha2[0];
  
  auxPrestamo = prestamo;
  /**
      el primer capital se calcula en base a los dias que faltan del primer mes
  **/
  fecha3 = ultimoDia+"/"+mes+"/"+anho;

  dias_terminar = calcularDiasRestantes(fecha,fecha3);

  for(it=1;it<=plazo;it++){
      row = it-1;
      tr=tbody.insertRow(row);
      td0 = tr.insertCell(0);
      td1 = tr.insertCell(1);
      td2 = tr.insertCell(2);
      td3 = tr.insertCell(3);
      td4 = tr.insertCell(4);
      td5 = tr.insertCell(5);
      td6 = tr.insertCell(6);
      td0.innerHTML = it + "<input type='hidden' value='"+it+"' name='detalle_nro[]'>";;
      auxFecha =  new Date(fecha2);
      auxFecha.setMonth(auxFecha.getMonth() + it);
      //auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear();
      mes = auxFecha.getMonth();
      if(mes==0){ mes = 12; fanho=auxFecha.getFullYear() -1; }else{ fanho=auxFecha.getFullYear(); }

      td1.innerHTML = mes + "<input type='hidden' value='"+mes+"' name='detalle_mes[]'>";
      td2.innerHTML = fanho + "<input type='hidden' value='"+fanho+"' name='detalle_anho[]'>";
      td3.innerHTML = capital + "<input type='hidden' value='"+capital+"' name='detalle_capital[]'>";
      if(it==1){
          amortizacion = parseFloat(auxPrestamo * (interes / 100 / 12 )).toFixed(2);
          amortizacion = amortizacion / 30 * dias_terminar;
          amortizacion = parseFloat(amortizacion).toFixed(2);
      }else{
          amortizacion = parseFloat(auxPrestamo * (interes / 100 / 12)).toFixed(2);    
      }
      
      pago = parseFloat(parseFloat(capital) + parseFloat(amortizacion)).toFixed(2);
      saldo = parseFloat(parseFloat(auxPrestamo) - parseFloat(capital)).toFixed(2);
      if(saldo < 0 ){ saldo='0.00'; }else{ saldo=saldo; }
      auxPrestamo = saldo;
      td4.innerHTML = amortizacion + "<input type='hidden' value='"+amortizacion+"' name='detalle_amortizacion[]'>";
      td5.innerHTML = pago + "<input type='hidden' value='"+pago+"' name='detalle_pago[]'>";
      td6.innerHTML = saldo + "<input type='hidden' value='"+saldo+"' name='detalle_saldo[]'>";
  }
} 

function amortizacionNueva2() {
  limpiarTablaAmortizacion();
  var g=0;
  hoy = new Date();
  mes = hoy.getMonth() + 1;
  d0a = hoy.getDate();
  anho = hoy.getFullYear();
  ultimoDia = new Date(hoy.getFullYear(), hoy.getMonth() + 1, 0).getDate();
  if(ultimoDia == 31) ultimoDia = 30;
  if(dia.toString().length <= 1) dia = "0"+dia;
  fecha = dia+"/"+mes+"/"+anho;
  if(arguments.length==4){
    prestamo = arguments[0];
    plazo = arguments[1];
    interes = arguments[2];
    tbody = document.getElementById(arguments[3]);
  }else{
    prestamo = document.getElementById("Monto").value;
    plazo = document.getElementById("Plazo").value;
    interes = document.getElementById("Interes").value;
    tbody = document.getElementById('tablaAmortizacion');
  }
  
  capital = parseFloat(prestamo / plazo).toFixed(2);
  capital_diario = parseFloat(prestamo / plazo / 30);
  fecha2 = fecha.split("/");
  fecha2 = fecha2[2]+"/"+fecha2[1]+"/"+fecha2[0];
  
  auxPrestamo = prestamo;
  /**
      el primer capital se calcula en base a los dias que faltan del primer mes
  **/
  fecha3 = ultimoDia+"/"+mes+"/"+anho;

  dias_terminar = calcularDiasRestantes(fecha,fecha3);

  for(it=1;it<=plazo;it++){
      row = it-1;
      tr=tbody.insertRow(row);
      td0 = tr.insertCell(0);
      td1 = tr.insertCell(1);
      td2 = tr.insertCell(2);
      td3 = tr.insertCell(3);
      td4 = tr.insertCell(4);
      td5 = tr.insertCell(5);
      td6 = tr.insertCell(6);
      td0.innerHTML = it + "<input type='hidden' value='"+it+"' name='detalle_nro[]'>";;
      auxFecha =  new Date(fecha2);
      auxFecha.setMonth(xFecha.getMonth() + it);
      //auxFecha = auxFecha.getDate()+"/"+(auxFecha.getMonth()+1)+"/"+auxFecha.getFullYear()

      mes = auxFecha.getMonth();
      
      if(mes==0){ mes = 12; fanho=auxFecha.getFullYear() -1; g++; }else{ fanho=auxFecha.getFullYear(); }
      
    

      td1.innerHTML = mes + "<input type='hidden' value='"+mes+"' name='detalle_mes[]'>";
      td2.innerHTML = fanho + "<input type='hidden' value='"+fanho+"' name='detalle_anho[]'>";
      td3.innerHTML = capital + "<input type='hidden' value='"+capital+"' name='detalle_capital[]'>";
      if(it==1){
          amortizacion = parseFloat(auxPrestamo * (interes / 100 / 12 )).toFixed(2);
          amortizacion = amortizacion / 30 * dias_terminar;
          amortizacion = parseFloat(amortizacion).toFixed(2);
      }else{
          amortizacion = parseFloat(auxPrestamo * (interes / 100 / 12)).toFixed(2);    
      }
      
      pago = parseFloat(parseFloat(capital) + parseFloat(amortizacion)).toFixed(2);
      saldo = parseFloat(parseFloat(auxPrestamo) - parseFloat(capital)).toFixed(2);
      auxPrestamo = saldo;
      td4.innerHTML = amortizacion + "<input type='hidden' value='"+amortizacion+"' name='detalle_amortizacion[]'>";
      td5.innerHTML = pago + "<input type='hidden' value='"+pago+"' name='detalle_pago[]'>";
      td6.innerHTML = saldo + "<input type='hidden' value='"+saldo+"' name='detalle_saldo[]'>";
  }
} 
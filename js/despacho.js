/**
 * @author Venechi
 */

tiemporecarga = 30000;

window.setInterval(function() {

	var data = "cantidad=" +$('.registrosdeordenes').length;

	$.post(direccionRecargarBandejaOrdenes, data, function(respuesta) {

		if(respuesta.estado) {
			$('#tablacontenidoordenes').empty();
			$("#tablacontenidoordenes").append(respuesta.html);
			console.log('Se actualizaron las ordenes');
					}
																	}); 
								
							  }, tiemporecarga);

$('#crearguia').live("click", function() {
	// Sirve para comprobar el estado de los campos y mandar a crear
	// el reporte en la base de datos

	
	if($("#nu_montoguia").attr('validacion')=='false'){
		jAlert('Debe introducir un monto de guia valido', 'Error');
		return false;		
	}

	var fecha = $("#fechaguia").val();
	if(!checkFecha(fecha)){
		jAlert('Debe introducir una fecha valida', 'Error');
		return false;
	}
	var data = 'fecha='+fecha;

	if(!validaCamposSelect($('select')))return false;
	if(!validaCamposLlenos($("input[type=text],textarea").not('.opcional')))return false;
	if(!validaCamposNumericos($('.numero')))return false;

	var numeroguia = parseInt($('#nu_ndeguia').val());
	var orden = parseInt($('#ordendespachoguia').val());
	var producto = parseInt($('#productosorden').val());
	var observacion = $('#observacionguia').val();
	var monto = $('#nu_montoguia').val();
	
	if(orden==0){
		jAlert('Debe seleccionar una orden previamente creada para el cliente', 'Error');
		return false;
				}
	data+= '&orden='+orden+'&observacion='+observacion+'&monto='+monto+'&numeroguia='+numeroguia+'&producto='+producto;	

	$('.loader').css('display','block');
	
	$.post(direccionCrearGuiaDespacho, data, function(respuesta) {

	
	$('.cuadroformulario').css('display','none');
	$('#botonfinal').css('display','none');
	$('.loader').css('display','none');	
	
	if(respuesta.estado=='1')
	$('#subtituloguia').html('La Guia '+numeroguia+' fue agregada con exito');
	else $('#subtituloguia').html('La Guia '+numeroguia+' no pudo ser agregada, intente nuevamente');
	
	

	});	
	

});



$("#buscardespacho").live("click", function() {
	var tipo = $("#tipo").val();
	var fechaInicial = $("#fechainicial").val();
	var fechaFinal = $("#fechafinal").val();

	if(tipo == '0') {
		jAlert('Debe seleccionar un tipo de reporte', 'Error');
		return false;
	} 
	if(!validaCamposFecha($('.fecha')))return false;

	data= 'tipo='+tipo+'&fechaInicial='+fechaInicial+'&fechaFinal='+fechaFinal;	
	$('.formulario2').html('');
	$(".loader").css('display', 'block');
	console.log(data);
	
	$.post(direccionBuscarReporte, data, function(respuesta) {

		$(".loader").css('display', 'none');
		$('.formulario2').html(respuesta.html);
	

	

	});		
	
	

	return false;

});



$('#clienteguia').live("change", function() {
	var seleccionado = $(this).val();
	var filtro = $(this).attr('filtro');
	$('#ordendespachoguia')
    .find('option')
    .remove()
    .end()
    .append('<option value="0">-Seleccione-</option>')
    .val('0');

	$('#productosorden')
    .find('option')
    .remove()
    .end()
    .append('<option value="0">-Seleccione-</option>')
    .val('0');    
    
    
 
	$('#ordendespachoguia').attr('disabled','disabled');
	$('#productosorden').attr('disabled','disabled');
	if(seleccionado != '0'){
		
		var data ="clienteguia="+seleccionado+"&filtro="+filtro;
		$.post(direccionDeterminarOrden, data, function(respuesta) {

			$.each(respuesta.ordenes, function(indice, valor) {
				
				  $('#ordendespachoguia').append($('<option>', { 
        			value: valor.id,
        			text : 'Orden: '+valor.orden+' - Fecha: '+valor.fecha 
    															}));
	                                                  });
	              $('#ordendespachoguia').attr('disabled',false);
	              $('#productosorden').attr('disabled',false);
																      });	
	
	    }
});



$('#ordendespachoguia').live("change", function() {
	var seleccionado = $(this).val();
	
	$('#productosorden')
    .find('option')
    .remove()
    .end()
    .append('<option value="0">-Seleccione-</option>')
    .val('0');    
    
    
 
	$('#productosorden').attr('disabled','disabled');
	if(seleccionado != '0'){
		
		var data ="orden="+seleccionado;
		$.post(direccionDeterminaProductoOrden, data, function(respuesta) {

			$.each(respuesta.ordenes, function(indice, valor) {
				
				  $('#productosorden').append($('<option>', { 
        			value: valor.id,
        			text : valor.nombre
    															}));
	                                                  });
	             
	              $('#productosorden').attr('disabled',false);
																      });	
	
	    }
});





$('#nu_montoguia').live("change", function() {
	
    var desactivar = $(this).next().next().next();
	var activar = $(this).next().next();
	var loader = $(this).next();
	var nombre = $(this).attr('id');
	var valor = $(this).val();
	var nombrelargo = $(this).attr('nombre');
	var orden = $(this).parent().parent().prev().find('#ordendespachoguia').val();
	var actual = $(this);
		
	desactivar.css('display','none');
	activar.css('display','none');
	loader.css('display','block');


	
	
	if(!isNumber(valor) ){
		$(this).attr('validacion','false');
		jAlert('El valor del campo '+nombrelargo+' debe ser numerico', 'Error');
			loader.css('display','none');	
			desactivar.css('display','block');
			return false;
		} 
	else {
			
		var data = 'validacion='+nombre+'&id=' + valor+'&orden='+orden+'&idproducto='+$('#productosorden').val();
		


		$.post(direccionValidacionMontoDespacho, data, function(respuesta) {
			
			loader.css('display','none');
			if(respuesta.estado == '1'){
				activar.css('display','block');
				actual.attr('validacion','true');
											  } 
			else {
				actual.attr('validacion','false');
				desactivar.css('display','block');
				if(nombre =='nu_montoguia')jAlert('El monto supera el limite ('+respuesta.limite+') de la orden de compra', 'Error');
				else if(nombre =='nu_ndeguia')jAlert('El numero de guia ya se encuentra registrado', 'Error');
				 }
				                                                          })
		}
 
	
	
	    
});

$('#nu_unidad').live("change", function() {
	var seleccionado = $(this).val();
	$('#nu_tipodeproducto')
    .find('option')
    .remove()
    .end()
    .append('<option value="0">-Seleccione-</option>')
    .val('0');
    
 
	$('#nu_tipodeproducto').attr('disabled','disabled');
	if(seleccionado != '0'){
		
		var data ="unidad="+seleccionado;
		$.post(direccionDeterminarProducto, data, function(respuesta) {
	

			
			$.each(respuesta.productos, function(indice, valor) {
				
				  $('#nu_tipodeproducto').append($('<option>', { 
        			value: valor.id,
        			text : valor.nombre 
    															}));
	                                                  });
	              $('#nu_tipodeproducto').attr('disabled',false);
																      });	
	
	    }

		

});
$('#tipodereporteacrear').live("change", function() {
	var seleccionado = $(this).val();
	if(seleccionado == '0') {
		$('#crearordendespacho').css('display','none');
		$('#crearreportediariodespacho').css('display','none');
		$('#separador2').css('display','none');
		$('#botonfinal').css('display','none');
	}
	else if(seleccionado == '1'){
		$('#crearordendespacho').css('display','none');
		$('#separador2').css('display','none');
		$('#botonfinal').css('display','none');
	}
	else if(seleccionado == '2'){
		$('#crearreportediariodespacho').css('display','none');
		$('#separador2').css('display','none');
		$('#botonfinal').css('display','none');		
	}
		

});
$('#continuarcontrolsaldo').live("click", function() {
	// Sirve para mostrar los otros atributos que se deben solicitar
	// para crear el nuevo reporte
	//var tipo = parseInt($('#tipodereporteacrear').val());


	
	
	var orden = parseInt($('#ordendespachoguia').val());
	var cliente = parseInt($('#clientecontrolsaldo').val());

	if(cliente==0){
			jAlert('Debe seleccionar un cliente', 'Error');
			return false;
				}
	if(orden==0){
			jAlert('Debe seleccionar una orden previamente creada para el cliente', 'Error');
			return false;
				}
	$('.loader').css('display','block');
	document.location.href = direccionVisualizarControlSaldo + '/' + orden + '/' + 'html';
	
	

});



$('#continuar').live("click", function() {
	// Sirve para mostrar los otros atributos que se deben solicitar
	// para crear el nuevo reporte
	var tipo = parseInt($('#tipodereporteacrear').val());

	$('#crearordendespacho').css('display','none');
	$('#crearguiadespacho').css('display','none');
	
	$('#crearreportediariodespacho').css('display','none');
	
	
	if(tipo== 0){
		return false
	}
	else if(tipo == 1){
		$('#crearreportediariodespacho').css('display','block');
		$('#separador2').css('display','block');
		$('#botonfinal').css('display','block');
			
	}
	else if(tipo == 2){
		$('#crearordendespacho').css('display','block');
		$('#separador2').css('display','block');
		$('#botonfinal').css('display','block');
	}
	else if(tipo == 3){
		$('#crearguiadespacho').css('display','block');
		$('#separador2').css('display','block');
		$('#botonfinal').css('display','block');
	}
	
	

});
$('#crearreporte').live("click", function() {
	// Sirve para comprobar el estado de los campos y mandar a crear
	// el reporte en la base de datos

	var tipo = parseInt($('#tipodereporteacrear').val());
	var fecha = $("#fechainicial").val();
	if(!checkFecha(fecha)){
		jAlert('Debe introducir una fecha valida', 'Error');
		return false;
	}
	var data = 'tipo='+tipo+'&fecha='+fecha;
	
	if(tipo== 0){
		return false
	}
	else if(tipo == 1){

	if(!validaCamposLlenos($("#crearreportediariodespacho").find("input[type=text],textarea").not('.opcional')))
		return false;
	if(!validaCamposNumericos($("#crearreportediariodespacho").find('.numero')))
		return false;
	if(!validaCamposFecha($("#crearreportediariodespacho").find('.fecha')))
		return false;
	if(!validaCamposSelect($("#crearreportediariodespacho").find('select')))
		return false;
	
	$.each($("#crearreportediariodespacho").find("input[type=text],textarea,select"), function(indice, valor) {
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		data += '&' + id + '=' + auxiliar;

	});

	}
	else if(tipo == 2){
		var cliente = parseInt($('#cliente').val());
		var observacion = $('#observacion').val();
		var monto = $('#nu_monto').val();
		if(cliente==0){
			jAlert('Debe seleccionar un cliente', 'Error');
			return false;
		}
		data+= '&cliente='+cliente+'&observacion='+observacion+'&monto='+monto;	
	}
	else if(tipo == 3){
		var orden = parseInt($('#ordendespachoguia').val());
		var observacion = $('#observacionguia').val();
		var monto = $('#nu_montoguia').val();
		if(orden==0){
			jAlert('Debe seleccionar una orden previamente creada para el cliente', 'Error');
			return false;
		}
		data+= '&orden='+orden+'&observacion='+observacion+'&monto='+monto;	
	}

	$('.loader').css('display','block');


	$.post(direccionCrearReporte, data, function(respuesta) {

	if(tipo== 0){
		return false
	}
	else if(tipo > 0){
		document.location.href = direccionVisualizarReporte + '/' + tipo + '/' + respuesta.id+'/html';
	}

	});	
	

});

$('#crear-orden-despacho').live("click", function() {
	
	var cliente = parseInt($('#cliente').val());
	var observacion = $('#observacion').val();
	var data = "tipo=3&cliente="+cliente+"&observacion="+observacion;
	$('.loader').css('display','block');

	$.post(direccionMostrarReporte, data, function(respuesta) {
		
		$('.loader').css('display','none');
		/*
		if(respuesta.estado== '1'){
			var arreglo=data2.split(",");
			var cadena ="";
			if(tipo=='aprobar')cadena ="aprobado";
			else if(tipo=='despachar')cadena ="despachado";
			for(var i=1;i<arreglo.length;i++){		
				$('#t-'+cadena+'-'+arreglo[i]+' img').last().css('display','none');
				$('#t-'+cadena+'-'+arreglo[i]+' img').first().css('display','block');
			}
		}*/
	});	
	
});

$('.verinformedespacho').live("click", function() {
	// Sirve para ver el infome correspondiente
	var tipo = $(this).attr('tipo');
	var id = $(this).attr('id');

	$('.loader').css('display','block');
	$('.formulario2').html('');
	document.location.href = direccionVisualizarInforme + '/' + tipo + '/' + id+'/html';

});


/**
 * @author Jonathan Araul
 *
 */

$('.modifica').live("click", function() {
	var tipo = $(this).attr('tipo');
	var id = $(this).parent().attr('id');
	
	var data = "tipo="+tipo+"&id="+id;
	
	if(tipo=='desaprobar' || tipo=='nodespachar'){
		$(this).css('display','none');
		$(this).prev().css('display','block');
	}
	else{
		$(this).css('display','none');
		$(this).next().css('display','block');
	}

	$.post(direccionModificarEstadoOrden, data, function(respuesta) {
		if(respuesta.estado== '1'){
			
		}
	});
});
$(".modificarestadousuario").live("click", function() {

	var idusuario = $(this).attr('idusuario');
	var tipo = $(this).attr('tipo');
	var loader = '';
	
	if(tipo=='activar'){
		loader = $(this).next();
	}
	else{
		loader = $(this).prev();
	}
	
	$(this).css('display', 'none');
	loader.css('display', 'block');
	var actual = $(this);
	
	var data = 'id=' + idusuario+'&tipo='+tipo;

	$.post(direccionModificarEstadoUsuario, data, function(respuesta) {

		loader.css('display', 'none');
		if(tipo== 'activar') {
			actual.next().next().css('display', 'block');
		} 
		else{
			actual.prev().prev().css('display', 'block');
		}
	})
});
$(".eliminarusuario").live("click", function() {

	var idusuario = $(this).attr('idusuario');
	var loader = $(this).next();
	$(this).css('display', 'none');
	loader.css('display', 'block');
	var actual = $(this);
	
	var data = 'id=' + idusuario;

	$.post(direccionEliminarUsuario, data, function(respuesta) {

		loader.css('display', 'none');
		
		if(respuesta.estado == '1') {
			actual.parent().parent().remove();
	//		
		} 
	})
});
$(".verordendespacho").live("click", function() {
	document.location.href = direccionOrdenDespacho + "/" + $(this).attr('id');
});
$(".editarordendespacho").live("click", function() {
	document.location.href = direccionEmitirOrden + "/" + $(this).attr('id');
});
$(".eliminarordendespacho").live("click", function() {
	var id = $(this).attr('id');
	var data = 'id=' + id;
	var actual = $(this);
	actual.css('display','none');
	actual.next().css('display','block');

	$.post(direccionEliminarOrden, data, function(respuesta) {
		//loader.css('display', 'none');
		
		actual.parent().parent().remove();
									
															 })
});



$(".imprimir").live("click", function() {
	$('#' + $(this).attr('contenido')).printElement();
});
$(".pdf").live("click", function() {
	document.location.href = $(this).attr('url');
});

$(".excel").live("click", function() {

	var tipo = $(this).attr('tipo');
	;
	var pk = $(this).attr('pk');
	;
	document.location.href = direccionVisualizarReporteXls + "/" + tipo + "/" + pk;
});

$(".excel2").live("click", function() {

	var url = $(this).attr('url');
	;

	document.location.href = url;
});
$('.sacos').live("keyup", function() {
	if($(this).val() != '') {
		$(this).val($(this).val().replace(/[^0-9\.]/g, ""));
		$(this).parent().parent().next().find('.toneladas').val($(this).val() * 0.025);
	}
});

$('.toneladas').live("keyup", function() {
	if($(this).val() != '') {
		$(this).val($(this).val().replace(/[^0-9\.]/g, ""));
		$(this).parent().parent().prev().find('.sacos').val($(this).val() * 40);
	}
});

$('.totalestoneladas').live("click", function() {
	var suma = 0;
	$.each($('.toneladas'), function(indice, valor) {
		if(isNumber($(valor).val()))
			suma += parseFloat($(valor).val());
	});
	$('.totalestoneladas').val(suma);
});

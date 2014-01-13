/**
 * @author Venechi
 */



$("#buscarinventario").live("click", function() {
	var unidad = $("#unidad").val();
	var tipo = $("#tipo").val();
	var fechaInicial = $("#fechainicial").val();
	var fechaFinal = $("#fechafinal").val();
	var data= 'fechainicial='+fechaInicial+'&fechafinal='+fechaFinal+'&unidad='+unidad+'&tipo='+tipo;
	
	if(unidad == '0') {
		jAlert('Debe seleccionar una determinada unidad', 'Error');
		return false;
	} 
	if(tipo == '0') {
		jAlert('Debe seleccionar un tipo de inventario', 'Error');
		return false;
	} 
	if(!validaCamposFecha($('.fecha')))return false;

	$(".loader").css('display', 'block');
	$(".Tabla-Aplicacion").remove();

	$.post(direccionBuscarInventario, data, function(respuesta) {

		//$('.formulario').empty();
		$('.loader').css('display','none');	
		$('#Region-Editable').append(respuesta.html);

	});	

});
$("#crearinventario").live("click", function() {
	$('#itp').css('display','block');
	$('#crearbotoninventario').css('display','none');	

});
$("#guardarinventario").live("click", function() {

	if(!validaCamposNumericos2($('.numero')))
		return false;
	
	$('.loader').css('display','block');
	$('#itp').css('display','none');


	var data = '';
	$.each($("input[type=text],textarea,select"), function(indice, valor) {
		
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		
		if( $(valor).hasClass('observacion') ) auxiliar = $(valor).parent().parent().parent().find('.Subtitulo-Normal').html()+' '+auxiliar+$(valor).attr('unidad');
		
		data += '&' + id + '=' + auxiliar;

	});
	console.log(data);

	$.post(direccionGuardarInventario, data, function(respuesta) {
		$(".loader").css('display', 'none');
		$('.formulario').append('</br></br></br><span class="Subtitulo-Normal">' + respuesta.mensaje + '</span>');
	});

});

$('.eliminarinventario').live("click", function() {

	var id = $(this).attr('id');
	var elemento = $(this);

	var data = 'id=' + id;
	
	$(this).css('display', 'none');
	$(this).next().css('display', 'block');
	
	$.post(direccionEliminarInventario, data, function(respuesta) {
		if(respuesta.resultado == '1') {
			elemento.parent().parent().remove();
		} else {
			jAlert('No se pudo eliminar correctamente', 'Error');
		}
	});
});

$('.visualizarinventario').live("click", function() {

	var id = $(this).attr('id');
	var tipo = $(this).attr('tipo');
	document.location.href = direccionVisualizarInventario + '/' + id+ '/' + tipo;
});




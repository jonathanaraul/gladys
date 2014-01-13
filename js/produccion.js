/**
 * @author Venechi
 */

$('#tx_turnos').live("change", function() {
	var seleccionado = $(this).val();
	$("#tx_adl_turnos option[value="+seleccionado+"]").attr("selected",true);
});

$('.visualizarreporte').live("click", function() {

	var id = $(this).attr('id');
	var tipo = $(this).attr('tipo');
	document.location.href = direccionVisualizarReporte + '/' + tipo + '/' + id;
});
$('.eliminarreporte').live("click", function() {

	var tipo = $(this).attr('tipo');
	var id = $(this).attr('id');
	var elemento = $(this);

	var data = 'tipoReporte=' + tipo + '&id=' + id;
	$(this).css('display', 'none');
	$(this).next().css('display', 'block');
	$.post(direccionEliminarReporte, data, function(respuesta) {
		if(respuesta.resultado == '1') {
			elemento.parent().parent().remove();
		} else {
			jAlert('No se pudo eliminar correctamente', 'Error');
		}
	});
});

$('#unidad').live("change", function() {
	var seleccionado = $(this).val();
	if(seleccionado == 'u3') {
		$("#tipo option[value=rp]").remove();
		if($("#tipo option[value=rp]").length == 0) {
			$('#tipo').append(new Option('Reporte de Paletizado', 'rp', false, false));
		}
	} else if(seleccionado == 'u4') {
		$("#tipo option[value=rp]").remove();
		if($("#tipo option[value=rp]").length == 0) {
			$('#tipo').append(new Option('Reporte Diario de Paradas', 'rp', false, false));
		}
	} else {
		if($("#tipo option[value=rp]").length != 0) {
			$("#tipo option[value=rp]").remove();
		}

	}

});

$("#guardarreporte").live("click", function() {
	
	var tipoReporte = $('[name=tipoReporte]').val();

	var pkReporte = $('[name=pkReporte]').val();

	//insertaId($("input[type=text],textarea,select"),tipoReporte);return false;

	if(!validaCamposLlenos($("input[type=text],textarea").not('.opcional')))
		return false;
	if(!validaCamposNumericos($('.numero')))
		return false;
	if(!validaCamposFecha($('.fecha')))
		return false;
	if(!validaCamposSelect($('select')))
		return false;
		
	$(this).attr('id','yaguardado');

	var data = 'tipoReporte=' + tipoReporte + '&pkReporte=' + pkReporte;
	$.each($("input[type=text],textarea,select"), function(indice, valor) {
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		data += '&' + id + '=' + auxiliar;

	});
	$('.formularioagregar').empty();
	$(".loader").css('display', 'block');
	console.log(data);

	$.post(direccionGuardarReporte, data, function(respuesta) {
		$(".loader").css('display', 'none');
		$('.formulario').append('</br></br></br><span class="Subtitulo-Normal">' + respuesta.mensaje + '</span>');
	});
});
$("#nuevoreporte").live("click", function() {

	var unidad = $("#unidad").val();
	var tipo = $("#tipo").val();
	if(unidad == '0' || tipo == '0') {
		jAlert('Debe seleccionar una unidad y un tipo de informe', 'Error');
	} else {
		document.location.href = direccionReportes + '/' + unidad + '/' + tipo;
		//jAlert('El campo unidad'+unidad+' el campo tipo'+tipo, 'Error');
	}

	return false;

});

$('.consulta').live("change", (function() {
	var tipo = $("input[name='consulta']:checked").val();
	if(tipo == "reporte") {

		$("#anio option[value=0]").attr("selected", true);
		$("#mes option[value=0]").attr("selected", true);

		$("#anio").attr("disabled", "disabled");
		$("#mes").attr("disabled", "disabled");

		$("#unidad").attr("disabled", false);
		$("#tipo").attr("disabled", false);
		$("#fechainicial").attr("disabled", false);
		$("#fechafinal").attr("disabled", false);
	} else if(tipo == "resumen") {

		$("#unidad option[value=0]").attr("selected", true);
		$("#tipo option[value=0]").attr("selected", true);
		$("#fechainicial").val('');
		$("#fechafinal").val('');

		$("#fechainicial option[value=0]").attr("selected", true);
		$("#fechafinal option[value=0]").attr("selected", true);

		$("#unidad").attr("disabled", "disabled");
		$("#tipo").attr("disabled", "disabled");
		$("#fechainicial").attr("disabled", "disabled");
		$("#fechafinal").attr("disabled", "disabled");

		$("#anio").attr("disabled", false);
		$("#mes").attr("disabled", false);

	}
}
));

$("#buscarreporte").live("click", function() {
	var tipo = $("input[name='consulta']:checked").val();

	if(tipo == "reporte") {

		var unidad = $("#unidad").val();
		var tipo = $("#tipo").val();
		var fechaInicial = $("#fechainicial").val();
		var fechaFinal = $("#fechafinal").val();
		var tipoReporte = unidad + '-' + tipo;

		if(unidad == '0') {
			jAlert('Debe seleccionar una determinada unidad', 'Error');
			return false;
		}
		if(tipo == '0') {
			jAlert('Debe seleccionar un tipo de informe', 'Error');
			return false;
		}

		////////////////////////////VALIDACIONES DE FECHA////////////////////////////
		if(!validaCamposFecha($('.fecha')))
			return false;

		var campoFechaInicial = ($("#fechainicial").val()).split("-");
		var campoFechaFinal = ($("#fechafinal").val()).split("-");

		var fechaInicial1 = new Date();
		fechaInicial1.setFullYear(campoFechaInicial[2], campoFechaInicial[1], campoFechaInicial[0]);
		var fechaFinal2 = new Date();
		fechaFinal2.setFullYear(campoFechaFinal[2], campoFechaFinal[1], campoFechaFinal[0]);

		if(fechaInicial1.getTime() > fechaFinal2.getTime()) {
			jAlert('La fecha inicial no puede ser mayor que la final.', 'Error');
			return false;
		} else if(fechaInicial1.getTime() == fechaFinal2.getTime()) {
			jAlert('Las fechas no pueden ser iguales', 'Error');
			return false;
		} else {
			$(".loader").css('display', 'block');
			$('.formulario2').empty();

			var data = 'tipoReporte=' + tipoReporte + '&fechaInicial=' + fechaInicial + '&fechaFinal=' + fechaFinal;

			$.post(direccionBuscarReporte, data, function(respuesta) {
				$('.formulario2').empty();
				$(".loader").css('display', 'none');
				$('.formulario2').append(respuesta.html);
			});
		}
	} else {
		var mes = $("#mes").val();
		var anio = $("#anio").val();
		
		var tipoReporte = 'resumenproduccion';

		if(mes == '0') {
			jAlert('Debe seleccionar un determinado mes', 'Error');
			return false;
		}
		if(anio == '0') {
			jAlert('Debe seleccionar un determinado año', 'Error');
			return false;
		}
		document.location.href = direccionResumenProduccion + '/' + anio + '/' + mes;

	}
	return false;

});

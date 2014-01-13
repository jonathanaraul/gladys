/**
 * @author Venechi
 */
 $("#filtrarBusqueda").live("click", function() {

	var rifCliente =  $("#rifCliente").val();
	var nombrecliente = $("#nombreCliente").val();

	if(rifCliente !='' || nombrecliente!=''){
		$('.Tabla-Fondo').remove();
		$('.loader').css('display','block');

		var data = "nombreCliente="+nombrecliente+"&rifCliente="+rifCliente;
        $.post(direccionBuscarCliente, data, function(respuesta) {
        	$('.loader').remove();
			$("#tabla-contenido").append(respuesta.html);
			console.log('deberia haber culminado');
	           	                                                  })
	}
	else return false;


	return false;
	
});
 $('#tx_dp_tipodeproducto').live("change", function() {
	var seleccionado = $(this).val();
	if(seleccionado==1){
		$('#nu_dp_sacos').attr('disabled','disabled');
	}
	else{
		$('#nu_dp_sacos').attr('disabled',false);
	}
	return false;
});
$('#nu_ndeorden,#nu_ndefactura').live("focusout", function() {
	var desactivar = $(this).next().next().next();
	var activar = $(this).next().next();
	var loader = $(this).next();
	var nombre = $(this).attr('id');
	var valor = $(this).val();
	var nombrelargo = $(this).attr('nombre');
		
	desactivar.css('display','none');
	activar.css('display','none');
	loader.css('display','block');


	
	
	if(!isNumber(valor) ){
		jAlert('El valor del campo '+nombrelargo+' debe ser numerico', 'Error');
			loader.css('display','none');	
			desactivar.css('display','block');
			return false;
		} 
	else {
			
		var data = 'validacion='+nombre+'&id=' + valor;

		$.post(direccionValidacionOrdenDespacho, data, function(respuesta) {
			
			loader.css('display','none');
			if(respuesta.estado == '1'){
				activar.css('display','block');
				$(this).attr('validacion','true');
											  } 
			else {
				desactivar.css('display','block');
				jAlert('El '+nombrelargo+' ya fue registrado', 'Error');
				 }
				                                                          })
		}
});
$(".modificarcliente").live("click", function() {
	var tipo = $(this).attr('tipo');
	var id = $(this).attr('id');
	var referencia = $(this);
	var nombrecliente = $("#nombrecliente_"+id).html();
	
	if(tipo =="editar"){
		document.location.href = direccionEditarCliente + "/"+id;
	}
	else if(tipo=="observar"){
		document.location.href = direccionVisualizarCliente + "/"+id;
	}
	else{
		//ELIMINAR CLIENTE
		jConfirm("Se borraran todas las guias y ordenes de dicho cliente","¿Esta seguro que desea eliminar el cliente "+nombrecliente+"?", function(r) {  
    	if(r) {  
        	referencia.parent().parent().remove();
        	var data = "id="+id;
        	$.post(direccionEliminarCliente, data, function(respuesta) {
				console.dir(respuesta);
	           	                                                       })
    	}
																										});  
		
		
		
	

		}	
});

//FUNCIONES DE AGREGADO DE PRODUCTOS
$("#agregareditarotroproducto").live("click", function() {

	if(!validaCamposLlenos($("input[type=text],textarea").not('.opcional')))
		return false;
	if(!validaCamposNumericos($('.numero')))
		return false;
	if(!validaCamposFecha($('.fecha')))
		return false;
	if(!validaCamposSelect($('select')))
		return false;
	
	var idorden = $('#idorden').val();
	var idproducto = $('#idproducto').val();

	var data ='idorden='+idorden+'&idproducto='+idproducto;
	$.each($("input[type=text],textarea,select"), function(indice, valor) {
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		data += '&'+id+'='+auxiliar;
		
	});

	$(".loader").css('display', 'block');

	$.post(direccionGuardarProducto, data, function(respuesta) {
		document.location.href = direccionAgregarProducto + "/"+idorden+ "/"+respuesta.codigo;
		
	});
	
});

$("#verordencompleta").live("click", function() {
	
	if(!validaCamposLlenos($("input[type=text],textarea").not('.opcional')))
		return false;
	if(!validaCamposNumericos($('.numero')))
		return false;
	if(!validaCamposFecha($('.fecha')))
		return false;
	if(!validaCamposSelect($('select')))
		return false;
	
	var idorden = $('#idorden').val();
	var idproducto = $('#idproducto').val();

	var data ='idorden='+idorden+'&idproducto='+idproducto;
	$.each($("input[type=text],textarea,select"), function(indice, valor) {
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		data += '&'+id+'='+auxiliar;
		
	});

	$(".loader").css('display', 'block');

	$.post(direccionGuardarProducto, data, function(respuesta) {
		document.location.href = direccionOrdenDespacho + "/"+idorden;
	});

});

$("#guardarventa").live("click", function() {
	
	
	
	
	if(!validaCamposLlenos($("input[type=text],textarea").not('.opcional')))
		return false;
	if(!validaCamposNumericos($('.numero')))
		return false;
	if(!validaCamposFecha($('.fecha')))
		return false;
	if(!validaCamposSelect($('select')))
		return false;

	
	
	
	var idOrden = $('#idorden').val();
	var tipoReporte = $('[name=tipoReporte]').val();
	//insertaId($("input[type=text],textarea,select"),tipoReporte);return false;
	var idclienteeditar = $('[name=idclienteeditar]').val();

	if(!validaCamposLlenos($("input[type=text],textarea")))return false;
	if(!validaCamposNumericos($('.numero')))return false;
	if(!validaCamposFecha($('.fecha')))return false;
	if(!validaCamposSelect($('select')))return false;
	
	var data ='tipoReporte='+tipoReporte+'&idclienteeditar='+idclienteeditar+'&idOrden='+idOrden;
	$.each($("input[type=text],textarea,select"), function(indice, valor) {
		var auxiliar = $(valor).val();
		var id = $(valor).attr('id');
		data += '&'+id+'='+auxiliar;
		
	});

	//$('.formulario').empty();
	$(".loader").css('display', 'block');
	$.post(direccionGuardarVenta, data, function(respuesta) {
		console.dir(respuesta);
		if(tipoReporte !='emitirorden'){
			$(".loader").css('display', 'none');
			$('.formulario').append('</br></br></br><span class="Subtitulo-Normal">' + respuesta.mensaje + '</span>');	
		}
		else{
				document.location.href = direccionAgregarProducto + "/"+respuesta.auxiliar+ "/"+respuesta.auxiliar2;
			
		}

		
		
	});
});
$("#buscarventa").live("click", function() {
	if(!validaCamposFecha($('.fecha')))return false;
	
	var fechaInicial = $("#fechainicial").val();
	var fechaFinal = $("#fechafinal").val();

	var data = 'fechaInicial='+fechaInicial+"&fechaFinal="+fechaFinal;
	
	var campoFechaInicial = fechaInicial.split("-");
	var campoFechaFinal = fechaFinal.split("-");
	
	if(campoFechaInicial.length != 3 || campoFechaFinal.length !=3){
	 jAlert('Las fechas deben estar escritas correctamente.', 'Error');
	 return false;
	}

	var fechaInicial = new Date();
	fechaInicial.setFullYear(campoFechaInicial[2],campoFechaInicial[1],campoFechaInicial[0]);
	var fechaFinal = new Date();
	fechaFinal.setFullYear(campoFechaFinal[2],campoFechaFinal[1],campoFechaFinal[0]);
	
	
	if (fechaInicial.getTime() > fechaFinal.getTime() ) {
    	jAlert('La fecha inicial no puede ser mayor que la final.', 'Error');
    	return false;
	}
	else if(fechaInicial.getTime() ==  fechaFinal.getTime() ){
		jAlert('Las fechas no pueden ser iguales', 'Error');
		return false;
	}
	else{
	$('.contenido').empty();
	$(".loader").css('display', 'block');
	
	
	$.post(direccionBuscarOrden, data, function(respuesta) {
		$(".loader").css('display', 'none');
		$('.contenido').append(respuesta.html);
	});

	return false;
          }
});


<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Proyecto\PrincipalBundle\Entity\D100tDesRepOrdendes;
use Proyecto\PrincipalBundle\Entity\D100tDesRepGuiades;

use Proyecto\PrincipalBundle\Entity\D100tDesRepDiario;
use Proyecto\PrincipalBundle\Entity\E100tUnidad;
use Proyecto\PrincipalBundle\Entity\E100tProducto;

use Ps\PdfBundle\Annotation\Pdf;

class DespachoController extends Controller
{
	public function visualizarOrdenAction($id, $formato) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this->get('request')->get('_format');
		
		$formato = strtolower($formato);
		if ($formato != 'html' && $formato != 'pdf' && $formato != 'excel') {
		throw $this->createNotFoundException();
													 }
		$format = $formato;
		$fecha = '';

		$estado = true;
		$ordenes = '';
		$reporte = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
		$productos = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden')->findByD100fkVenEmitirorden($id);
		
		if (!$reporte) $estado = false;	  
		else $fecha = date_format($reporte->getFeFecha(), 'd/m/Y');
				
			     
		if( $formato == 'excel'){

			$xls_service = $this -> get('xls.service_xls5');
			$titulo = "REPORTE DE ORDEN DE DESPACHO";
			$filename = $titulo . '.xls';
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(24);

			$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
			$i = 1;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'C'. $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'C'. $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'C'. $i) -> getFill() -> setFillType('solid');
			
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'SACOS');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'TONELADAS');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, 'DESCRIPCION');
			
			foreach ($productos as $elemento) {
				$i++;
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $elemento ->getNuDpSacos());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $elemento ->getNuDpTm());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $elemento ->getTxDpTipodeproducto());
			}
			

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:C' . $i) -> getAlignment() -> setVertical('center');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:C' . $i) -> getAlignment() -> setHorizontal('center');
			
			$xls_service -> excelObj -> getActiveSheet() -> setTitle($titulo);
			$xls_service -> excelObj -> setActiveSheetIndex(0);
			$response = $xls_service -> getResponse();
			$response -> headers -> set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
			$response -> headers -> set('Content-Disposition', 'attachment;filename=' . $titulo . '.xls');
			$response -> headers -> set('Content-Transfer-Encoding', 'application/octet-stream');

		return $response;
		}
			

			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-orden-venta-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'productos' => $productos,'fecha'=>$fecha,'estado' => $estado,'nombre' => 'REPORTE DE ORDEN DE DESPACHO'));	
				
		
	}
	public function buscarReporteAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		
		$tipo = $post -> get("tipo");
		$nombre = "";

		$fechaInicial = UtilidadesAPI::convertirFechaNormal($post -> get("fechaInicial"), $this);
		$fechaFinal = UtilidadesAPI::convertirFechaNormal($post -> get("fechaFinal"), $this);
		$fechaActual = new \DateTime("now");
	    $auxiliar = array();
		$arreglo = array();
	    $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		
		$fechas = array();
		$posicion = 0;
	    if($fechaActual<$fechaFinal)$fechaFinal = $fechaActual;
		
		$fechaAuxiliar = $fechaInicial;
		$periodo = '';
		
		if($tipo == 1){
			$nombre = "Reporte Diario";
			$periodo = 'P1D';
		}
		else if($tipo == 2){
			$nombre = "Reporte Mensual";
			
			$periodo = 'P1M';
		}
		else if($tipo == 3){
			$nombre = "Reporte de Guias ";
			
			//Ubicar las guias que correspondan con dicha fecha
			
			$conexion = $this -> get('database_connection');

			$consulta = "SELECT base.nu_ndeguia numero, base.fe_fecha fecha, base.d100pk_des_rep_guiades id

				FROM     d100t_des_rep_guiades base
				
				WHERE base.fe_fecha >= '" . UtilidadesAPI::convertirAFormatoSQL($post -> get("fechaInicial"),$this) . "' AND
					  base.fe_fecha < '" . date('Y-m-d',  $fechaFinal->getTimestamp() ) . "'  ";

			$arregloAuxiliar = $conexion -> fetchAll($consulta);	
			$arreglo = array();
			
			for ($i=0; $i < count($arregloAuxiliar); $i++) {
				$fechaAux = explode(" ", $arregloAuxiliar[$i]['fecha']);
				
				$arreglo[$i]['fecha'] = UtilidadesAPI::convertirAFormatoSQL3($fechaAux[0],$this);
				$arreglo[$i]['id'] = $arregloAuxiliar[$i]['id'];
				$arreglo[$i]['nombre'] = $nombre .' '.$arregloAuxiliar[$i]['numero'];
				
			}
			
		}
		

		if($tipo != 3){
	    	do{
	    		if($tipo != 2)$arreglo[$posicion]['fecha']  = date_format($fechaAuxiliar, 'd/m/Y');
				else $arreglo[$posicion]['fecha']  =  $meses[(date_format($fechaAuxiliar, 'm') -1)] .' '.date_format($fechaAuxiliar, 'Y');
			

				$arreglo[$posicion]['id'] = date_format($fechaAuxiliar, 'd-m-Y');
				
				$arreglo[$posicion]['nombre'] = $nombre;

				$fechaAuxiliar -> add(new \DateInterval($periodo)); 
				$posicion++;
			  }while($fechaAuxiliar <= $fechaFinal);			
			}

		

		$html = $this -> renderView('ProyectoPrincipalBundle:Despacho:reportesEncontrados.html.twig', array('tipo' => $tipo,'arreglo' => $arreglo,'nombre'=>$nombre));

		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		
	}
	public function crearGuiasAction(){
			
		$usuario = UtilidadesAPI::usuarioActual($this);
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		
		$estado = false;
		$idorden = $post -> get("orden");
		$observacion = $post -> get("observacion");
		$monto = $post -> get("monto");
		$numeroguia = $post -> get("numeroguia");
		$fecha = $post -> get("fecha");	
		$idproducto = $post -> get("producto");		
		
		// Realizar guardado del reporte
		$orden = $this->getDoctrine()
			          ->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')
			          ->find($idorden);
		$producto = $this->getDoctrine()
			          ->getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden')
			          ->find($idproducto);
		/////////////////////////////
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT SUM(  nu_monto )  suma
				 FROM  d100t_des_rep_guiades 
		         WHERE  d101fk_ven_emitirorden =  '".$idproducto."'";
		
		$resultado = $conexion->fetchAll($consulta);
		$acumulado = $resultado[0]['suma'];
		$actual = $acumulado + $monto;
		
	
		if($actual == $producto->getNuDpSacos()){
			$orden->setNuCerrado(1);
		}
		/////////////////////////////

		$reporte = new D100tDesRepGuiades();
		$reporte->setD101fkVenEmitirorden($producto);
		$reporte->setFeFecha(UtilidadesAPI::convertirFechaNormal($fecha, $this));
		if($observacion != '')$reporte->setTxObservacion($observacion, $this);
		$reporte->setI100fkUsuario($usuario);
		$reporte->setNuMonto($monto);
		$reporte->setNuNdeguia($numeroguia);
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($reporte);
		$em->flush();
		$estado = true;
		

		//Mostrar reporte en html, 

		$respuesta = new response(json_encode(array('estado' => $estado, 
		'id' =>$reporte->getD100pkDesRepGuiades())));

		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;		
	}
	public function recargarBandejaOrdenesAction(){
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$estado = false;
		$cantidad = intval($post -> get("cantidad"));
		$html = "";
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT count(d100pk_ven_emitirorden) cuenta
				 FROM   d100t_ven_emitirorden";
				
		$resultado = $conexion->fetchColumn($consulta);
		
		if($cantidad != $resultado) $estado = true;
		
		if($estado == true){
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_emitirorden id, 
						fe_fecha fecha,
						nu_aprobado aprobado,
						nu_despachado despachado, 
						nu_ndeorden numeroorden,
						
						tx_nombre rif, 
						d100pk_ven_infocliente idcliente
						
				 FROM   d100t_ven_emitirorden, 
				 		d100t_ven_infocliente

				 WHERE  d100pk_ven_infocliente = d100fk_ven_infocliente
				  
				        ORDER BY d100pk_ven_emitirorden DESC
	
				 ";
				
		$arreglo = $conexion->fetchAll($consulta);
		
		for($i=0;$i<count($arreglo);$i++){
			$auxiliar = explode(" ", $arreglo[$i]['fecha']);
			$arreglo[$i]['fecha'] = $auxiliar[0];
		}

		$html = $this -> renderView('ProyectoPrincipalBundle:Despacho:tablaBandejaOrdenes.html.twig', array('arreglo' => $arreglo));
		}

		$respuesta = new response(json_encode(array('html' => $html,'estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
				
	}
	public function bandejaOrdenesAction()
    {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_emitirorden id, 
						fe_fecha fecha,
						nu_aprobado aprobado,
						nu_ndeorden numeroorden,
						nu_despachado despachado, 
						
						tx_nombre rif, 
						d100pk_ven_infocliente idcliente
						
				 FROM   d100t_ven_emitirorden, 
				 		d100t_ven_infocliente

				 WHERE  d100pk_ven_infocliente = d100fk_ven_infocliente
				  
				        ORDER BY d100pk_ven_emitirorden DESC
				 ";
				
		$arreglo = $conexion->fetchAll($consulta);
		
		for($i=0;$i<count($arreglo);$i++){
			$auxiliar = explode(" ", $arreglo[$i]['fecha']);
			$arreglo[$i]['fecha'] = $auxiliar[0];
		}

        return $this->render('ProyectoPrincipalBundle:Despacho:bandejaOrdenes.html.twig', array('usuario' => $usuario,'arreglo'=> $arreglo));
    }
	public function agregarGuiasAction(){

		$usuario = UtilidadesAPI::usuarioActual($this);
		$fecha = UtilidadesAPI::obtenerFechaNormal2($this);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_infocliente id, tx_nombre rif
				FROM    d100t_ven_infocliente";
		
		
		$clientes = $conexion->fetchAll($consulta);
		
		
        return $this->render('ProyectoPrincipalBundle:Despacho:agregarGuias.html.twig', 
        array('usuario' => $usuario,'clientes'=> $clientes,'fecha'=>$fecha));
	}
	public function nuevoReporteAction()
    {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$fecha = UtilidadesAPI::obtenerFechaNormal2($this);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_infocliente id, tx_rif rif
				FROM    d100t_ven_infocliente";
		
		
		$clientes = $conexion->fetchAll($consulta);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT e100pk_unidad id, in_nombre nombre
				FROM    e100t_unidad";
		
		
		$unidades = $conexion->fetchAll($consulta);

		
		
        return $this->render('ProyectoPrincipalBundle:Despacho:nuevoReporte.html.twig', 
        array('usuario' => $usuario,'clientes'=> $clientes,'unidades'=>$unidades,'fecha'=>$fecha));
    }
	public function crearReporteAction(){
		
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		
		$usuario = UtilidadesAPI::usuarioActual($this);

		$tipo = $post -> get("tipo");
		$fecha = $post -> get("fecha");
		
		if($tipo == 1){
			
			$idcliente = $post -> get("nu_cliente");
			$cliente = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tVenInfocliente')
			->find($idcliente);

			$objeto = new D100tDesRepDiario();

			$objeto -> setFeFechadelreporte(UtilidadesAPI::convertirFechaNormal($post -> get("fecha"), $this));
			$objeto -> setNuUnidad($post -> get("nu_unidad"));
			$objeto -> setNuTipodeproducto($post -> get("nu_tipodeproducto"));
			$objeto -> setNuNdeguia($post -> get("nu_ndeguia"));
			$objeto -> setNuOrddesNdeorden($post -> get("nu_orddes_ndeorden"));
			$objeto -> setFeOrddesFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_orddes_fecha"), $this));
			$objeto -> setNuDestonSacos($post -> get("nu_deston_sacos"));
			$objeto -> setNuDestonReal($post -> get("nu_deston_real"));
			$objeto -> setNuDestonTeor($post -> get("nu_deston_teor"));
			$objeto -> setNuVarTon($post -> get("nu_var_ton"));
			$objeto -> setNuSacTeor($post -> get("nu_sac_teor"));
			$objeto -> setNuSacPromedio($post -> get("nu_sac_promedio"));
			$objeto -> setNuTdSacos($post -> get("nu_td_sacos"));
			$objeto -> setNuTdTon($post -> get("nu_td_ton"));
			$objeto -> setNuCliente($cliente);
			$objeto -> setI100fkUsuario($usuario);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($objeto);
			$em->flush();
			$estado = true;
			//Mostrar reporte en html, 
			
			$respuesta = new response(json_encode(array('estado' => $estado, 'id' =>$objeto->getD100pkDesRepDiario())));
			$respuesta -> headers -> set('content_type', 'aplication/json');
			return $respuesta;
		}
		else if($tipo == 2){
			$estado = false;
			$idcliente = $post -> get("cliente");
			$observacion = $post -> get("observacion");
			$monto = $post -> get("monto");

			// Realizar guardado del reporte
			$cliente = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tVenInfocliente')
			->find($idcliente);

			$reporte = new D100tDesRepOrdendes();
			$reporte->setD100fkVenInfocliente($cliente);
			$reporte->setFeFecha(UtilidadesAPI::convertirFechaNormal($fecha, $this));
			if($observacion != '')$reporte->setTxObservacion($observacion, $this);
			$reporte->setI100fkUsuario($usuario);
			$reporte->setNuMonto($monto);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($reporte);
			$em->flush();
			$estado = true;
			//Mostrar reporte en html, 
			
		$respuesta = new response(json_encode(array('estado' => $estado, 
		'id' =>$reporte->getD100pkDesRepOrdendes())));

		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		}
		else if($tipo == 3){
			$estado = false;
			$idorden = $post -> get("orden");
			$observacion = $post -> get("observacion");
			$monto = $post -> get("monto");

			// Realizar guardado del reporte
			$orden = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tDesRepOrdendes')
			->find($idorden);

			$reporte = new D100tDesRepGuiades();
			$reporte->setD100fkDesRepOrdendes($orden);
			$reporte->setFeFecha(UtilidadesAPI::convertirFechaNormal($fecha, $this));
			if($observacion != '')$reporte->setTxObservacion($observacion, $this);
			$reporte->setI100fkUsuario($usuario);
			$reporte->setNuMonto($monto);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($reporte);
			$em->flush();
			$estado = true;
			//Mostrar reporte en html, 
			
		$respuesta = new response(json_encode(array('estado' => $estado, 
		'id' =>$reporte->getD100pkDesRepGuiades())));

		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
		}

	}
/**
 * @Pdf()
 */	
	public function visualizarReporteAction($tipo, $id, $formato) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this->get('request')->get('_format');
		
		$formato = strtolower($formato);
		if ($formato != 'html' && $formato != 'pdf') {
		throw $this->createNotFoundException();
													 }
		$format = $formato;
		
		$fecha = '';

		if ($tipo == 1) {
			$estado = true;
			$ordenes = '';
			$reporte = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tDesRepDiario')
			->find($id);

			if (!$reporte) $estado = false;	  
			else {
				$fecha = date_format($reporte->getFeFechadelreporte(), 'd/m/Y');
				$fecha2 = date_format($reporte->getFeOrddesFecha(), 'd/m/Y');
				
			     }
			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-diario-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'fecha'=>$fecha,'fecha2'=>$fecha2, 'estado' => $estado));	
		}		
		
		else if($tipo == 2){
			$estado = true;
			$ordenes = '';
			$reporte = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tDesRepOrdendes')
			->find($id);

			if (!$reporte) $estado = false;	  
			else {
				$fecha = date_format($reporte->getFeFecha(), 'd/m/Y');
				$ordenes = $this->getDoctrine()
					->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')
					->findByD100fkVenInfocliente($reporte->getD100fkVenInfocliente()->getD100pkVenInfocliente());
				$auxiliar = array(0,0);

				for ($i=0; $i < count($ordenes); $i++) { 
					$auxiliar[0] += $ordenes[$i]->getNuDpSacos();
					$auxiliar[1] += $ordenes[$i]->getNuDpTm();
				}
				
			     }
			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-ordenes-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'fecha'=>$fecha, 'estado' => $estado,'ordenes' => $ordenes,'auxiliar'=>$auxiliar));	
		}
		else if($tipo == 3){
			$estado = true;
			$ordenes = '';
			$reporte = $this->getDoctrine()
			->getRepository('ProyectoPrincipalBundle:D100tDesRepGuiades')
			->find($id);

			if (!$reporte) $estado = false;	  
			else {
				$fecha = date_format($reporte->getFeFecha(), 'd/m/Y');
				$ordenes = $this->getDoctrine()
					->getRepository('ProyectoPrincipalBundle:D100tDesRepOrdendes')
					->findByD100fkVenInfocliente($reporte->getD100fkDesRepOrdendes()->getD100pkDesRepOrdendes());
				$auxiliar = array('cliente'=>$reporte->getD100fkDesRepOrdendes()->getD100fkVenInfocliente()->getTxRif(),
				                  'direccion'=>$reporte->getD100fkDesRepOrdendes()->getD100fkVenInfocliente()->getTxDireccionfiscal());

				
			     }
			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-guias-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'fecha'=>$fecha, 'estado' => $estado,'ordenes' => $ordenes,'auxiliar'=>$auxiliar));	
		}
	}
/**
 * @Pdf()
 */	
	public function visualizarControlSaldoAction($id, $formato) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this->get('request')->get('_format');
		
		$formato = strtolower($formato);
		if ($formato != 'html' && $formato != 'pdf' && $formato != 'excel') {
		throw $this->createNotFoundException();
													                        }
		$format = $formato;
		
		$fecha = '';

		$estado = true;
		/////////////////////////////////////////////////////////////////////////////////////////////////
		$orden = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
		
		$productos = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden')->findByD100fkVenEmitirorden($orden->getD100pkVenEmitirorden());
		
		$guias = array();
		$cliente = null;
		
		if (!$orden) $estado = false;	  
		else{
		$cliente = $orden->getD100fkVenInfocliente();
		//$guias= $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tDesRepGuiades')->findByD101fkVenEmitirorden($orden->getD100pkVenEmitirorden());
		
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT base.d100pk_des_rep_guiades,
						base.nu_ndeguia,
						base.d101fk_ven_emitirorden,
						base.fe_fecha,
						base.nu_monto,
						base.tx_observacion,
						base2.tx_dp_tipodeproducto
						
				 FROM   d100t_des_rep_guiades base, 
				 		d101t_ven_emitirorden base2,
				 		d100t_ven_emitirorden base3

				 WHERE  base.d101fk_ven_emitirorden = base2.d101pk_ven_emitirorden	AND
				 		base2.d100fk_ven_emitirorden = base3.d100pk_ven_emitirorden AND
				 		base3.d100pk_ven_emitirorden = '".$orden->getD100pkVenEmitirorden()."' ";
				
		$guias = $conexion->fetchAll($consulta);
		
	//	print_r($guias);
		
		
		
		
		
		$fecha = date_format($orden->getFeFecha(), 'd/m/Y');                                             
		}
		
		if($formato == 'excel'){

			$titulo = "CONTROL DE SALDO";

			$xls_service = $this -> get('xls.service_xls5');
			$filename = $titulo . '.xls';
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");
			
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(7);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(10);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('D') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('E') -> setWidth(20);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('F') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('G') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('H') -> setWidth(17);

			$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
			$j = 1;
			for ($i=0; $i < count($productos); $i++) {
				$saldo = $productos[$i]->getNuDpSacos();
				$imprimio = false;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $j .':'. 'G'. $j) -> getFill() -> getStartColor() -> setRGB('FF0000');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $j .':'. 'G'. $j) -> getFont() -> getColor() -> setRGB('FFFFFF');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $j .':'. 'G'. $j) -> getFill() -> setFillType('solid');	 			
				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $j . ':H' . $j);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $j, $productos[$i]->getTxDpTipodeproducto());
				
				$j++;
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $j, 'FECHA');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $j, 'O/D N');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $j, 'MONTO');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $j, 'GUIAS');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $j, 'FECHA');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $j, 'MONTO (SAC))');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $j, 'MONTO (TON))');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $j, 'SALDO');
				
				$j++;
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $j, $fecha);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $j, $productos[$i]->getD100fkVenEmitirorden()->getNuNdeorden());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $j, $productos[$i]->getNuDpSacos());
				
				$indice =0;
				
				foreach ($guias as $elemento) {
					if( $elemento['tx_dp_tipodeproducto'] == $productos[$i]->getTxDpTipodeproducto()){
						$saldo = $saldo - $elemento['nu_monto'];
						$imprimio = true;
						
						if($indice >0){
							$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $j . ':C' . $j);
						}
						
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $j, $elemento['nu_ndeguia']);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $j, $elemento['fe_fecha']);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $j, $elemento['nu_monto']);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $j, ($elemento['nu_monto']/25));
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $j, $saldo);
						$indice++;
						$j++;
					}
					
					
				}
				if($imprimio==false){
					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('D' . $j . ':H' . $j);
						$j++;
				}
				
			
		
			}
			

			/*
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'G'. $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'G'. $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'G'. $i) -> getFill() -> setFillType('solid');


			$i++;
			
			$saldo = $orden->getNuDpSacos();
			
			$indice = 0;
			foreach ($guias as $elemento) {
				$saldo -= $elemento->getNuMonto();
				
				if($indice==0){
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $fecha);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $orden->getNuNdeorden());
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $orden->getNuDpSacos());
					$indice++;
				}
				else {
					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':C' . $i);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, '');
				}
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $elemento->getNuNdeguia());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $elemento->getFeFechaString());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $elemento->getNuMonto());
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $saldo);
				$i++;
			}
			*/
			$i= $j;
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:H' . ($i-1)) -> getAlignment() -> setVertical('center');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:H' . ($i-1)) -> getAlignment() -> setHorizontal('center');
			
			$xls_service -> excelObj -> getActiveSheet() -> setTitle($titulo);
			$xls_service -> excelObj -> setActiveSheetIndex(0);
			$response = $xls_service -> getResponse();
			$response -> headers -> set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
			$response -> headers -> set('Content-Disposition', 'attachment;filename=' . $titulo . '.xls');
			$response -> headers -> set('Content-Transfer-Encoding', 'application/octet-stream');

			return $response;
		}
		
	
			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:visualizar-control-saldo.%s.twig', $format), array('usuario' => $usuario,
				'orden' => $orden,'fecha'=>$fecha, 'estado' => $estado,'guias' => $guias,'cliente'=>$cliente,'id'=>$id, 'productos'=>$productos));	
		
		
	}	
	
	public function ordenDespachoAction()
	{
		$usuario = UtilidadesAPI::usuarioActual($this);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_infocliente id, tx_rif rif
				FROM    d100t_ven_infocliente";
		
		
		$arreglo = $conexion->fetchAll($consulta);
		
		return $this->render('ProyectoPrincipalBundle:Despacho:reporte-ordenes-despacho.html.twig', array('usuario' => $usuario,'arreglo' => $arreglo));
	}

	public function controlSaldoAction()
	{
		$usuario = UtilidadesAPI::usuarioActual($this);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_infocliente id, tx_nombre rif
				FROM    d100t_ven_infocliente";
		
		
		$arreglo = $conexion->fetchAll($consulta);
		
		return $this->render('ProyectoPrincipalBundle:Despacho:controlSaldo.html.twig', array('usuario' => $usuario,'clientes' => $arreglo));
	}
	
	public function guiaDespachoAction()
	{
		$usuario = UtilidadesAPI::usuarioActual($this);
		return $this->render('ProyectoPrincipalBundle:Despacho:reporte-guias-despacho.html.twig', array('usuario' => $usuario));
	}
	
	public function tiposProductosAction()
	{
		$usuario = UtilidadesAPI::usuarioActual($this);
		return $this->render('ProyectoPrincipalBundle:Despacho:reporte-tipos-productos.html.twig', array('usuario' => $usuario));
	}
	public function despachoTerrestreAction()
	{
		$usuario = UtilidadesAPI::usuarioActual($this);
		return $this->render('ProyectoPrincipalBundle:Despacho:reporte-despacho-terrestre.html.twig', array('usuario' => $usuario));
	}


	public function consultarReporteAction()
    {
		$usuario = UtilidadesAPI::usuarioActual($this);

        return $this->render('ProyectoPrincipalBundle:Despacho:consultarReporte.html.twig', array('usuario' => $usuario));
    }
    
    public function modificarEstadoOrdenAction()
    {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$tipo = $post -> get("tipo");

		$id = $post -> get("id");

		if($tipo == 'aprobar'){			
				$em = $this->getDoctrine()->getEntityManager();
				$objeto = $em->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
				$objeto->setNuAprobado(1);
				$em->flush();
			} 
		else if($tipo == 'despachar'){
				$em = $this->getDoctrine()->getEntityManager();
				$objeto = $em->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
				$objeto->setNuDespachado(1);
				$em->flush();	
			}
		else if($tipo == 'noaprobar'){			
				$em = $this->getDoctrine()->getEntityManager();
				$objeto = $em->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
				$objeto->setNuAprobado(0);
				$em->flush();
			} 
		else if($tipo == 'nodespachar'){
				$em = $this->getDoctrine()->getEntityManager();
				$objeto = $em->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
				$objeto->setNuDespachado(0);
				$em->flush();	
			}

		$respuesta = new response(json_encode(array('tipo' => $tipo, 'estado' => true)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
    }
    
    public function determinarProductoAction(){
		
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$idunidad = $post -> get("unidad");
		$productos = array();

		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT e100pk_producto id, in_nombre nombre
				FROM    e100t_producto 
				WHERE e100fk_unidad	= '".$idunidad."'";
		
		$productos = $conexion->fetchAll($consulta);
		 
		
		$respuesta = new response(json_encode(array('productos' => $productos)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	
public function determinarProductoOrdenAction(){
		
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$idorden = $post -> get("orden");
		$productos = array();

		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT base1.d101pk_ven_emitirorden id, base1.tx_dp_tipodeproducto nombre
				 FROM   d101t_ven_emitirorden base1
				 WHERE  base1.d100fk_ven_emitirorden	= '".$idorden."' ";
		
		//if($filtro!='desactivado') $consulta .= " AND base1.nu_cerrado = '0' ";

		//$consulta .= "ORDER BY base1.fe_fecha DESC ";
		
		$ordenes = $conexion->fetchAll($consulta);
		
		$respuesta = new response(json_encode(array('ordenes' => $ordenes)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
    public function determinarOrdenAction(){
		
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$idcliente = $post -> get("clienteguia");
		$filtro = $post -> get("filtro");
		$productos = array();

		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT base1.d100pk_ven_emitirorden id, base1.nu_ndeorden orden, base1.fe_fecha fecha
				 FROM   d100t_ven_emitirorden base1
				 WHERE  base1.d100fk_ven_infocliente	= '".$idcliente."' ";
		
		if($filtro!='desactivado') $consulta .= " AND base1.nu_cerrado = '0' ";

		$consulta .= "ORDER BY base1.fe_fecha DESC ";
		
		$ordenes = $conexion->fetchAll($consulta);
		
		$respuesta = new response(json_encode(array('ordenes' => $ordenes)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
    
    public function validacionMontoDespachoAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$validacion = $post -> get("validacion");
		$id = $post -> get("id");
		
		

		$estado = false;
		$limite = 0;
		if($validacion=='nu_montoguia'){
		$idproducto = $post -> get("idproducto");
			
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT SUM(  nu_monto )  suma
				 FROM  d100t_des_rep_guiades 
		         WHERE  d101fk_ven_emitirorden =  '".$idproducto."'";
		
		$resultado = $conexion->fetchAll($consulta);
		$acumulado = $resultado[0]['suma'];
		
		$consulta = 
				"SELECT base1.nu_dp_sacos sacos
				 FROM   d101t_ven_emitirorden base1
				 WHERE  base1.d101pk_ven_emitirorden	= '".$idproducto."'";
		
		
	
		$resultado = $conexion->fetchAll($consulta);
		$actual = $resultado[0]['sacos'];
		

		$limite = $actual - $acumulado;

		if($limite >= $id )$estado = true;
		}
		else if($validacion=='nu_ndeguia'){
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT base1.d100pk_des_rep_guiades id
				 FROM   d100t_des_rep_guiades base1
				 WHERE  base1.nu_ndeguia	= '".$id."'";
		
		$resultado = $conexion->fetchAll($consulta);
		
		if($resultado == null)$estado = true;

		}
		
		$respuesta = new response(json_encode(array('estado' => $estado,'limite'=>$limite)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
 /**
 * @Pdf()
 */	
	public function visualizarInformeAction($tipo, $id, $formato) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this->get('request')->get('_format');
		
		$formato = strtolower($formato);
		if ($formato != 'html' && $formato != 'pdf' && $formato != 'excel') {
		throw $this->createNotFoundException();
													 }
		$format = $formato;
		$estado = true;
		$fecha = '';
        $nombre = "";
		if ($tipo == 1 || $tipo==2) {
				
			if($tipo == 1){
				$nombre = "REPORTE DIARIO DE DESPACHO TERRESTRE";
				$fechaInicial = UtilidadesAPI::convertirAFormatoSQL4($id,$this);
				$fechaFinal =  UtilidadesAPI::sumarTiempo($id,1,0,0,$this);
				$fecha = UtilidadesAPI::obtenerFechaCastellanizada2($id,$this);	
			}
			if($tipo == 2){
				$nombre = "REPORTE MENSUAL DE DESPACHO TERRESTRE";
				$fechaInicial = UtilidadesAPI::primerDiaMes($id,$this);
				$fechaFinal =  UtilidadesAPI::primerDiaMesSiguiente($id,$this);
				$fecha = UtilidadesAPI::obtenerFechaCastellanizada3($id,$this);	
		
			}

	
			$conexion = $this->get('database_connection');
			$consulta = 
				"SELECT base1.d100pk_des_rep_guiades pkguia, 
						base1.nu_ndeguia numeroguia, 
						base1.fe_fecha fechaguia, 
						base1.nu_monto monto ,
				        base2.d100pk_ven_emitirorden pkorden, 
				        base2.nu_ndeorden numeroorden ,
				        base2.fe_fecha fechaorden, 
				        base5.tx_dp_tipodeproducto tipoproducto,
				        base3.tx_nombre nombrecliente,
				        base4.e100fk_unidad unidad
				        
				 FROM   d100t_des_rep_guiades base1,
				        d100t_ven_emitirorden base2,
				        d100t_ven_infocliente base3,
				        e100t_producto base4,
				        d101t_ven_emitirorden base5
				        
				 WHERE  base1.fe_fecha	>= '".$fechaInicial."' AND
				        base1.fe_fecha	< '".$fechaFinal."' AND
				        base1.d101fk_ven_emitirorden = base5.d101pk_ven_emitirorden AND
				        base5.d100fk_ven_emitirorden = base2.d100pk_ven_emitirorden AND
				        base2.d100fk_ven_infocliente = base3.d100pk_ven_infocliente AND
				        base4.in_nombre LIKE  base5.tx_dp_tipodeproducto ";
		
			$reporte = $conexion->fetchAll($consulta);
			
			for ($i=0; $i <count($reporte) ; $i++) {
				$auxiliar =  explode(" ", $reporte[$i]['fechaguia'] );
				$reporte[$i]['fechaguia'] = UtilidadesAPI::convertirAFormatoSQL3($auxiliar[0],$this);
				
				$auxiliar =  explode(" ", $reporte[$i]['fechaorden'] );
				$reporte[$i]['fechaorden'] = UtilidadesAPI::convertirAFormatoSQL3($auxiliar[0],$this);				
				
			}
			
			if($formato == 'excel'){
			  if($tipo == 1){
				$titulo = "REPORTE DIARIO DE DESPACHO";
				}
				else{
					$titulo = "REPORTE MENSUAL DE DESPACHO";
				}
			$xls_service = $this -> get('xls.service_xls5');
			$filename = $titulo . '.xls';
			
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");
			
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(5);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('E') -> setWidth(6);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('F') -> setWidth(21);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('G') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('H') -> setWidth(17);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('I') -> setWidth(17);		
										
			$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
			$i = 1;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'I'. $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'I'. $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i .':'. 'I'. $i) -> getFill() -> setFillType('solid');
			
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('E' . ($i+1) .':'. 'I'. ($i+1) ) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('E' . ($i+1) .':'. 'I'. ($i+1) ) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('E' . ($i+1) .':'. 'I'. ($i+1) ) -> getFill() -> setFillType('solid');
			
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':A' . ($i+1));
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('B' . $i . ':B' . ($i+1));
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('C' . $i . ':C' . ($i+1));
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('D' . $i . ':D' . ($i+1));			
						
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TIPO DE SAL');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'U');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, 'CLIENTES');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, 'N GUIA');
			
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('E' . $i . ':F' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, 'O/DESP');

			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('G' . $i . ':I' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, 'O/DESPACHO');

			$i++;
			
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, 'N');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, 'FECHA');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, 'Kilos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, 'Toneladas');
			
			$sumaSacos = 0;
			$sumaKilos = 0;
			$sumaToneladas = 0;
			
			$i++;
			foreach ($reporte as $elemento) {
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $elemento['tipoproducto']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $elemento['unidad']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $elemento['nombrecliente']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $elemento['numeroguia']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $elemento['numeroorden']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $elemento['fechaorden']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $elemento['monto']);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, ($elemento['monto'] * 25));
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, (($elemento['monto'] * 25)/1000));
				
				$sumaSacos += $elemento['monto'];
				$sumaKilos += $elemento['monto'] * 25;
				$sumaToneladas +=  ($elemento['monto'] * 25)/1000;
				
				$i++;
			}
			
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':F' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTAL DESPACHADO');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $sumaSacos);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $sumaKilos);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, $sumaToneladas);						

			
			/*
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $reporte ->getNuDpSacos());
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $reporte ->getNuDpSacos() * 0.025);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $reporte ->getTxDpTipodeproducto());
			*/
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:I' . $i) -> getAlignment() -> setVertical('center');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:I' . $i) -> getAlignment() -> setHorizontal('center');
			
			$xls_service -> excelObj -> getActiveSheet() -> setTitle($titulo);
			$xls_service -> excelObj -> setActiveSheetIndex(0);
			$response = $xls_service -> getResponse();
			$response -> headers -> set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
			$response -> headers -> set('Content-Disposition', 'attachment;filename=' . $titulo . '.xls');
			$response -> headers -> set('Content-Transfer-Encoding', 'application/octet-stream');

			return $response;
			}
			
			if (!$reporte)$estado = false;	 	
			
			return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-diario-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'fecha'=>$fecha,'estado' => $estado, "nombre" =>$nombre, 'tipo'=> $tipo, 'id' =>$id));	
		}		
		else if($tipo == 3){
				
			if($tipo == 1){
				$nombre = "GUIA DE DESPACHO Y CIRCULACION";

				$fecha = UtilidadesAPI::obtenerFechaCastellanizada2($id,$this);	
			}

			$conexion = $this->get('database_connection');
			$consulta = 
				"SELECT base1.d100pk_des_rep_guiades pkguia, base1.nu_ndeguia numeroguia, base1.fe_fecha fechaguia, base1.nu_monto monto ,base1.tx_observacion observacion, 
				        base2.d100pk_ven_emitirorden pkorden, base2.nu_ndeorden numeroorden ,base2.fe_fecha fechaorden, base2.tx_dp_tipodeproducto tipoproducto,base2.tx_direccion direccion,
				        base3.tx_nombre nombrecliente,base3.tx_direccionfiscal direccionfiscal,
				        base4.e100fk_unidad unidad
				        
				 FROM   d100t_des_rep_guiades base1,
				        d100t_ven_emitirorden base2,
				        d100t_ven_infocliente base3,
				        e100t_producto base4
				        
				 WHERE  base1.d100pk_des_rep_guiades = '".$id."' AND
				        base1.d100fk_ven_emitirorden = base2.d100pk_ven_emitirorden AND
				        base2.d100fk_ven_infocliente = base3.d100pk_ven_infocliente AND
				        base4.in_nombre LIKE  base2.tx_dp_tipodeproducto ";
		
			$reporte = $conexion->fetchAll($consulta);
			
			for ($i=0; $i <count($reporte) ; $i++) {
				$auxiliar =  explode(" ", $reporte[$i]['fechaguia'] );
				$reporte[$i]['fechaguia'] = UtilidadesAPI::obtenerFechaCastellanizada4(UtilidadesAPI::convertirAFormatoSQL3($auxiliar[0],$this),$this);

				$auxiliar =  explode(" ", $reporte[$i]['fechaorden'] );
				$reporte[$i]['fechaorden'] = UtilidadesAPI::convertirAFormatoSQL3($auxiliar[0],$this);	

			}
			$reporte = $reporte[0];
			
			if (!$reporte)$estado = false;	 

	    	return $this -> render(sprintf('ProyectoPrincipalBundle:Despacho:reporte-guias-despacho.%s.twig', $format), array('usuario' => $usuario,
				'reporte' => $reporte,'fecha'=>$fecha, 'estado' => $estado, "nombre" =>$nombre));	
		}
	}
}

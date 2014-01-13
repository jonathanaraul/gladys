<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\ParameterBag;

use Proyecto\PrincipalBundle\Entity\D100tInventario;
class InventarioController extends Controller {

	public function nuevoInventarioAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);

		$conexion = $this -> get('database_connection');
		$fecha = UtilidadesAPI::obtenerFechaNormal2($this);
		$consulta = "SELECT base.in_nombre nombre, base2.nu_numero numero
								
					FROM   e100t_producto base, e100t_unidad base2
				
					WHERE base2.nu_numero >= '3' AND
					  	  base2.nu_numero  <= '4'  AND
					      base2.e100pk_unidad = base.e100fk_unidad ";

		$arreglo = $conexion -> fetchAll($consulta);

		for ($i = 0; $i < count($arreglo); $i++) {
			$auxiliar = $arreglo[$i]['nombre'];
			$auxiliar = str_replace("-", " ", $auxiliar);
			$auxiliar = explode(' ', $auxiliar);

			$inicial = '';
			for ($j = 0; $j < count($auxiliar); $j++) {
				$inicial = $inicial . '' . substr($auxiliar[$j], 0, 1);
			}

			$arreglo[$i]['inicial'] = strtolower($inicial);
		}
		//print_r($arreglo);

		return $this -> render('ProyectoPrincipalBundle:Almacenamiento:nuevoInventario.html.twig', array('usuario' => $usuario, 'arreglo' => $arreglo, 'fecha' => $fecha));
	}

	public function consultarInventarioAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);

		return $this -> render('ProyectoPrincipalBundle:Almacenamiento:consultarInventario.html.twig', array('usuario' => $usuario));
	}

	public function buscarInventarioAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		$tipo = $post -> get("tipo");
		;
		$fechaInicial = UtilidadesAPI::convertirFechaNormal($post -> get("fechainicial"), $this);
		$fechaFinal = UtilidadesAPI::convertirFechaNormal($post -> get("fechafinal"), $this);

		$valor = 0;
		$nombre = "";
		$fechaActual = new \DateTime("now");
		$auxiliar = array();
		$arreglo = array();
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

		$fechas = array();
		$posicion = 0;
		if ($fechaActual < $fechaFinal)
			$fechaFinal = $fechaActual;

		$fechaAuxiliar = $fechaInicial;
		$periodo = '';

		if ($tipo == 'idpt') {
			$nombre = "Inventario Diario de Productos Terminados";
			$valor = 1;
		} else if ($tipo == 'idptr') {
			$nombre = "Inventario Diario de Productos Terminados-Rechazados";
			$valor = 2;
		}

		$fechaA = UtilidadesAPI::convertirAFormatoSQL($post -> get("fechainicial"), $this);
		$fechaB = date('Y-m-d', $fechaFinal -> getTimestamp()) . ' 23:59:59';

		$conexion = $this -> get('database_connection');

		$consulta = "SELECT base.tx_nombre nombre, base.d100pk_inventario pk, base.fe_fecha fecha FROM     
								
						 d100t_inventario base
				
				WHERE base.fe_fecha >= '" . $fechaA . "' AND
					  base.fe_fecha < '" . $fechaB . "'  AND
					  
					  base.nu_tipodeinventario = '" . $valor . "'";

		$arreglo = $conexion -> fetchAll($consulta);

		$html = $this -> renderView('ProyectoPrincipalBundle:Almacenamiento:reportesEncontrados.html.twig', array('arreglo' => $arreglo));

		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

	}

	public function guardarInventarioAction() {

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$usuario = UtilidadesAPI::usuarioActual($this);

		$reporte = new D100tInventario();
		$reporte -> setI100fkUsuario($usuario);

		foreach ($post->all() as $clave => $valor) {

			$valor = trim($valor);
			if ($valor != '') {
				//setNuTipodeinventario
				$auxiliar = explode('_', $clave);
				$nombreFuncion = 'set';
				for ($i = 0; $i < count($auxiliar); $i++) {
					$nombreFuncion .= ucfirst($auxiliar[$i]);
				}
				if ($nombreFuncion != 'setFeFecha') {
					if ($nombreFuncion != 'setUndefined') 
					$reporte -> $nombreFuncion($valor);
				} else {
					$reporte -> $nombreFuncion(UtilidadesAPI::convertirFechaNormal($valor, $this));
				}
			}
		}
		$reporte -> setNuSrmInicial(0);
		$reporte -> setNuSrfInicial(0);
		$reporte -> setNuSrgInicial(0);
		$reporte -> setNuSreInicial(0);
		$reporte -> setNuSbbfInicial(0);
		$reporte -> setNuSbbeInicial(0);
		$reporte -> setNuSiggInicial(0);
		$reporte -> setNuSicInicial(0);
		$reporte -> setNuSrInicial(0);
		$reporte -> setNuBbggInicial(0);

		///DETERMINAR LOS INVENTARIOS INICIALES

		///////ENCONTRAR INVENTARIO ANTERIOR///
		$conexion = $this -> get('database_connection');
		$consulta = "SELECT *
					 FROM    d100t_inventario base";

		$inventarios = $conexion -> fetchAll($consulta);
		
		if ($inventarios != null) {
			$arreglo = $inventarios[count($inventarios) - 1];

			$datos = array();
			$j = 0;
			$i = 0;

			foreach ($arreglo as $key => $value) {
				if ($i >= 5) {
					
					$nombre = explode('_', $key);
					$tipo = $nombre[count($nombre) - 2];
					$nombre = $nombre[count($nombre) - 1];
					
					if ($nombre == 'inicial') {
						$datos[$j]['inicial'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'produccion') {
						$datos[$j]['produccion'] = $value == NULL ? 0 : $value;
						//$datos[$j]['neta'] += $datos[$j]['produccion'];
					} else if ($nombre == 'recuperado') {
						$datos[$j]['recuperado'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'despachado') {
						$datos[$j]['despachado'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'daniado') {
						$datos[$j]['daniado'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'donado') {
						$datos[$j]['donado'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'pdesp') {
						$datos[$j]['pdesp'] = $value == NULL ? 0 : $value;
					} else if ($nombre == 'observacion') {

						$netaAnterior = $datos[$j]['inicial'] + $datos[$j]['produccion'] + $datos[$j]['recuperado'] - $datos[$j]['despachado'] - $datos[$j]['daniado'] - $datos[$j]['donado'] - $datos[$j]['pdesp'];

						$nombreFuncion = 'setNu' . ucfirst($tipo) . 'Inicial';
						$reporte -> $nombreFuncion($netaAnterior);
						
						
						$j++;
					}
				}
				$i++;
			}

		} 
	
		//////////////////////////////////////

		///////////////////////////////////////

		$em = $this -> getDoctrine() -> getEntityManager();
		$em -> persist($reporte);
		$em -> flush();

		$mensaje = 'Inventario Guardado Exitosamente';
		$respuesta = new response(json_encode(array('mensaje' => $mensaje)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;

	}

	public function eliminarInventarioAction() {

		//OBTENER LOS DATOS DEL ELEMENTO A GUARDAR
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		$id = $post -> get("id");
		$conexion = $this -> get('database_connection');
		$resultado = $conexion -> executeUpdate("DELETE FROM d100t_inventario WHERE d100pk_inventario =?", array($id));

		$respuesta = new response(json_encode(array('resultado' => $resultado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function visualizarInventarioAction($id, $formato) {

		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this -> get('request') -> get('_format');
		$fecha = '';
		$arreglo = array();
		$nombreEstudio = '';

		$formato = strtolower($formato);
		//echo 'Llego con formato '.$formato;exit;
		if ($formato != 'html' && $formato != 'pdf' && $formato != 'excel') {
			throw $this -> createNotFoundException();
		}

		$conexion = $this -> get('database_connection');
		$consulta = "SELECT *
					 FROM    d100t_inventario base 
					 WHERE   base.d100pk_inventario =  '" . $id . "'";

		$arreglo = $conexion -> fetchAll($consulta);

		if ($arreglo == NULL) {
			$mensaje = 'Inventario no encontrado';
			return $this -> render('ProyectoPrincipalBundle:Produccion:errorinformecompleto.html.twig', array('usuario' => $usuario, 'fecha' => $fecha, 'mensaje' => $mensaje));
		}

		$arreglo = $arreglo[count($arreglo) - 1];

		$tipoEstudio = ($arreglo['nu_tipodeinventario'] == 1) ? 'Inventario Diario de Productos Terminados' : 'Inventario Diario de Productos Terminados-Rechazados';
		$nuTipoEstudio = $arreglo['nu_tipodeinventario'];
		$fecha = explode(' ', $arreglo['fe_fecha']);
		$fecha = explode('-', $fecha[0]);
		$fecha = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];
		$nombreEstudio = $arreglo['tx_nombre'];

		$datos = array();
		$j = 0;
		$i = 0;
		$nombre = '';
		//print_r($arreglo);

		foreach ($arreglo as $key => $value) {
			if ($i >= 5) {
				$nombre = explode('_', $key);
				$nombre = $nombre[count($nombre) - 1];

				if ($nombre == 'inicial') {
					$datos[$j]['inicial'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'produccion') {
					$datos[$j]['produccion'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'recuperado') {
					$datos[$j]['recuperado'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'despachado') {
					$datos[$j]['despachado'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'daniado') {
					$datos[$j]['daniado'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'donado') {
					$datos[$j]['donado'] = $value == NULL ? 0 : $value;
				} else if ($nombre == 'pdesp') {
					$datos[$j]['pdesp'] = $value == NULL ? 0 : $value;

				} else if ($nombre == 'observacion') {

					$datos[$j]['observacion'] = substr($value, 0, strlen($value) - 1);

					$datos[$j]['unidad'] = substr($value, -1);

					$j++;
				}
			}
			$i++;
		}
		//exit;
		$subtotales = array( array('inicial' => 0, 'produccion' => 0, 'recuperado' => 0, 'despachado' => 0, 'daniado' => 0, 'donado' => 0, 'pdesp' => 0, 'neta' => 0, 'exist' => 0, 'ton' => 0), array('inicial' => 0, 'produccion' => 0, 'recuperado' => 0, 'despachado' => 0, 'daniado' => 0, 'donado' => 0, 'pdesp' => 0, 'neta' => 0, 'exist' => 0, 'ton' => 0), array('inicial' => 0, 'produccion' => 0, 'recuperado' => 0, 'despachado' => 0, 'daniado' => 0, 'donado' => 0, 'pdesp' => 0, 'neta' => 0, 'exist' => 0, 'ton' => 0));
		$indice = 0;
		//print_r($datos);
		for ($i = 0; $i < count($datos); $i++) {
			$datos[$i]['neta'] = $datos[$i]['inicial'] + $datos[$i]['produccion'] + $datos[$i]['recuperado'] - $datos[$i]['despachado'] - $datos[$i]['daniado'] - $datos[$i]['donado'] - $datos[$i]['pdesp'];
			$datos[$i]['exist'] = $datos[$i]['neta'];
			$datos[$i]['ton'] = $datos[$i]['neta'] * 25;

			if ($datos[$i]['unidad'] == 4) {
				$indice = 1;
			}

			$subtotales[$indice]['inicial'] += $datos[$i]['inicial'];
			$subtotales[$indice]['produccion'] += $datos[$i]['produccion'];
			$subtotales[$indice]['recuperado'] += $datos[$i]['recuperado'];
			$subtotales[$indice]['despachado'] += $datos[$i]['despachado'];
			$subtotales[$indice]['daniado'] += $datos[$i]['daniado'];
			$subtotales[$indice]['donado'] += $datos[$i]['donado'];
			$subtotales[$indice]['pdesp'] += $datos[$i]['pdesp'];
			$subtotales[$indice]['neta'] += $datos[$i]['neta'];
			$subtotales[$indice]['exist'] += $datos[$i]['exist'];
			$subtotales[$indice]['ton'] += $datos[$i]['ton'];

			$subtotales[2]['inicial'] += $datos[$i]['inicial'];
			$subtotales[2]['produccion'] += $datos[$i]['produccion'];
			$subtotales[2]['recuperado'] += $datos[$i]['recuperado'];
			$subtotales[2]['despachado'] += $datos[$i]['despachado'];
			$subtotales[2]['daniado'] += $datos[$i]['daniado'];
			$subtotales[2]['donado'] += $datos[$i]['donado'];
			$subtotales[2]['pdesp'] += $datos[$i]['pdesp'];
			$subtotales[2]['neta'] += $datos[$i]['neta'];
			$subtotales[2]['exist'] += $datos[$i]['exist'];
			$subtotales[2]['ton'] += $datos[$i]['ton'];

		}

		if ($formato == 'html') {
			return $this -> render('ProyectoPrincipalBundle:Almacenamiento:verInventario.html.twig', array('usuario' => $usuario, 'nombreEstudio' => $nombreEstudio, 'tipoEstudio' => $tipoEstudio, 'datos' => $datos, 'fecha' => $fecha, 'nombre' => $nombre, 'subtotales' => $subtotales, 'id' => $id, 'nuTipoEstudio' => $nuTipoEstudio));
		} else if ($formato == 'excel') {

			$xls_service = $this -> get('xls.service_xls5');
			$titulo = "Inventario " . $fecha;
			$filename = $titulo . '.xls';

			$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");
			//$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(26);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('D') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('E') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('F') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('G') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('H') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('I') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('J') -> setWidth(12);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('K') -> setWidth(22);
			$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
			$i = 1;
			$x = 0;

			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':A' . ($i + 1));
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TIPO DE SAL');

			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('B' . $i . ':D' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'ENTRADA (SACOS)');

			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('E' . $i . ':H' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, 'SALIDA (SACOS)');

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, 'EXIST.');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, 'TOTAL');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('K' . $i . ':K' . ($i + 1));
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('K' . $i, 'TOTAL TON');

			$i++;
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'INV INICIAL');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, 'PRODUCC');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, 'RECUP');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, 'DESP');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, 'DAÑADO');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, 'DONAC');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, 'P/DESP');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, 'NETA');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, 'EXIST');
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFill() -> getStartColor() -> setRGB('C2A8A8');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'UNIDAD N 03');
			$i++;
			$prueba = true;
			//print_r($datos);

			//print_r($datos);
			for ($j = 0; $j < count($datos); $j++) {

				if ($datos[$j]['unidad'] == '4' && $prueba == true) {

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'SUBTOTAL');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $subtotales[0]['inicial']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $subtotales[0]['produccion']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $subtotales[0]['recuperado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $subtotales[0]['despachado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $subtotales[0]['daniado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $subtotales[0]['donado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $subtotales[0]['pdesp']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, $subtotales[0]['neta']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, $subtotales[0]['exist']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('K' . $i, $subtotales[0]['ton']);
					$i++;

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFill() -> getStartColor() -> setRGB('C2A8A8');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i . ':K' . $i) -> getFill() -> setFillType('solid');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'UNIDAD N 04');

					$prueba = false;

				} else {
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $datos[$j]['observacion']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $datos[$j]['inicial']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $datos[$j]['produccion']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $datos[$j]['recuperado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $datos[$j]['despachado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $datos[$j]['daniado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $datos[$j]['donado']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $datos[$j]['pdesp']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, $datos[$j]['neta']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, $datos[$j]['exist']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('K' . $i, $datos[$j]['ton']);

				}
				$i++;
			}
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'SUBTOTAL');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $subtotales[1]['inicial']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $subtotales[1]['produccion']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $subtotales[1]['recuperado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $subtotales[1]['despachado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $subtotales[1]['daniado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $subtotales[1]['donado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $subtotales[1]['pdesp']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, $subtotales[1]['neta']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, $subtotales[1]['exist']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('K' . $i, $subtotales[1]['ton']);
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTALES');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $subtotales[2]['inicial']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $subtotales[2]['produccion']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $subtotales[2]['recuperado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $subtotales[2]['despachado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $subtotales[2]['daniado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $subtotales[2]['donado']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $subtotales[2]['pdesp']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('I' . $i, $subtotales[2]['neta']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('J' . $i, $subtotales[2]['exist']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('K' . $i, $subtotales[2]['ton']);

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:K' . $i) -> getAlignment() -> setVertical('center');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:K' . $i) -> getAlignment() -> setHorizontal('center');

			$xls_service -> excelObj -> getActiveSheet() -> setTitle($titulo);
			$xls_service -> excelObj -> setActiveSheetIndex(0);
			$response = $xls_service -> getResponse();
			$response -> headers -> set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
			$response -> headers -> set('Content-Disposition', 'attachment;filename=' . $titulo . '.xls');
			$response -> headers -> set('Content-Transfer-Encoding', 'application/octet-stream');

			return $response;
		}

	}

}

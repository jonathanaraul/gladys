<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Proyecto\PrincipalBundle\Entity\D100tProdResumenproduccion;

use Proyecto\PrincipalBundle\Entity\D100tProdU1rd;
use Proyecto\PrincipalBundle\Entity\D100tProdU2rd;
use Proyecto\PrincipalBundle\Entity\D100tProdU3rd;
use Proyecto\PrincipalBundle\Entity\D100tProdU4rd;

use Proyecto\PrincipalBundle\Entity\D100tProdU1rgp;
use Proyecto\PrincipalBundle\Entity\D100tProdU2rgp;
use Proyecto\PrincipalBundle\Entity\D100tProdU3rgp;
use Proyecto\PrincipalBundle\Entity\D100tProdU4rgp;

use Proyecto\PrincipalBundle\Entity\D100tProdU1rpf;
use Proyecto\PrincipalBundle\Entity\D100tProdU2rpf;
use Proyecto\PrincipalBundle\Entity\D100tProdU3rpf;
use Proyecto\PrincipalBundle\Entity\D100tProdU4rpf;

use Proyecto\PrincipalBundle\Entity\D100tProdU3rp;
use Proyecto\PrincipalBundle\Entity\D100tProdU4rp;

use Proyecto\PrincipalBundle\Entity\D101tProdU1rd;
use Proyecto\PrincipalBundle\Entity\D101tProdU3rd;
use Proyecto\PrincipalBundle\Entity\D101tProdU4rd;

use Proyecto\PrincipalBundle\Entity\D101tProdU1rgp;
use Proyecto\PrincipalBundle\Entity\D101tProdU2rgp;
use Proyecto\PrincipalBundle\Entity\D101tProdU3rgp;
use Proyecto\PrincipalBundle\Entity\D101tProdU4rgp;

use Proyecto\PrincipalBundle\Entity\D101tProdU1rpf;
use Proyecto\PrincipalBundle\Entity\D101tProdU2rpf;
use Proyecto\PrincipalBundle\Entity\D101tProdU3rpf;
use Proyecto\PrincipalBundle\Entity\D101tProdU4rpf;

use Proyecto\PrincipalBundle\Entity\D101tProdU3rp;
use Proyecto\PrincipalBundle\Entity\D101tProdU4rp;

use Proyecto\PrincipalBundle\Entity\D102tProdU1rd;

use Proyecto\PrincipalBundle\Entity\E100tTurno;
use Proyecto\PrincipalBundle\Entity\I100tUsuario;

class ProduccionController extends Controller {

	public function nuevoReporteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		return $this -> render('ProyectoPrincipalBundle:Produccion:nuevoReporte.html.twig', array('usuario' => $usuario));
	}

	public function gestionAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		return $this -> render('ProyectoPrincipalBundle:Produccion:nuevoReporte.html.twig', array('usuario' => $usuario));
	}

	public function consultarReporteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$anioActual = date('Y');
		$primerAnio = 2013;

		$arregloAnio = array();
		if ($primerAnio < $anioActual) {
			$j = 0;
			for ($i = $primerAnio; $i <= $anioActual; $i++) {
				$arregloAnio[$j] = $i;
				$j++;
			}
		} else {
			$arregloAnio = array($primerAnio);
		}
		$arregloFecha = array($meses, $arregloAnio);

		return $this -> render('ProyectoPrincipalBundle:Produccion:consultarReporte.html.twig', array('usuario' => $usuario, 'arregloFecha' => $arregloFecha));

	}

	public function resumenProduccionAction($anio, $mes) {

		//throw $this -> createNotFoundException('Ningún reporte encontrado con id ' . $pkReporte);
		$actual = UtilidadesAPI::obtenerMesYAnio($this);
		$fecha = UtilidadesAPI::obtenerFechaNormal3($this);
		$usuario = UtilidadesAPI::usuarioActual($this);
		$arreglo = array();
		$arregloSuma = array();
		$arregloFechas = UtilidadesAPI::obtenerFechasFormatoSQL($anio, $mes, $this);
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$nombreTipo = 'Resumen de Producción y Despachos en el Complejo Salinero. ' . $meses[($mes - 1)] . ' ' . $anio;
		$validacion = false;
		if (!(($anio == $actual[0] && $actual[1] < $mes) || $anio > $actual[0])) {
		$validacion = true;

		


		//////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////////////////////

		$arregloFecha = UtilidadesAPI::obtenerFechasFormatoSQL($anio, $mes, $this);
		$arregloAuxiliar = array();
		$elementos = array('nu_salbajadaallavadero', 'nu_sallavada', 'nu_salnetalavada');
		$arregloAuxiliar[0] = UtilidadesAPI::extraerDatosProduccion(1, $elementos, '', $arregloFecha, $this);

		$elementos = array('nu_cpo_sacos', 'nu_cpo_toneladas', 'nu_cpt_sacos', 'nu_cpt_toneladas');
		$arregloAuxiliar[1] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Mesa', $arregloFecha, $this);
		$arregloAuxiliar[2] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Fina', $arregloFecha, $this);
		$arregloAuxiliar[3] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Gruesa', $arregloFecha, $this);
		$arregloAuxiliar[4] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Extrafina', $arregloFecha, $this);
		$arregloAuxiliar[5] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Big-Bag Fina', $arregloFecha, $this);
		$arregloAuxiliar[6] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Big-Bag Extrafina', $arregloFecha, $this);

		$elementos = array('nu_cpo_sacos', 'nu_cpo_toneladas', 'nu_cpt_sacos', 'nu_cpt_toneladas');
		$arregloAuxiliar[7] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Indust. Grano Grueso', $arregloFecha, $this);
		$arregloAuxiliar[8] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Indust. Comun', $arregloFecha, $this);
		$arregloAuxiliar[9] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Roja', $arregloFecha, $this);
		$arregloAuxiliar[10] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Big-Bag Grano Grueso', $arregloFecha, $this);

		$arreglo = $arregloAuxiliar;
		for ($i = 0; $i < 1; $i++) {
			if ($arreglo[$i]['nu_salbajadaallavadero'] == '')
				$arreglo[$i]['nu_salbajadaallavadero'] = 0;
			if ($arreglo[$i]['nu_sallavada'] == '')
				$arreglo[$i]['nu_sallavada'] = 0;
			if ($arreglo[$i]['nu_salnetalavada'] == '')
				$arreglo[$i]['nu_salnetalavada'] = 0;
		}

		for ($i = 1; $i <= 10; $i++) {
			if ($arreglo[$i]['nu_cpo_sacos'] == '')
				$arreglo[$i]['nu_cpo_sacos'] = 0;
			if ($arreglo[$i]['nu_cpo_toneladas'] == '')
				$arreglo[$i]['nu_cpo_toneladas'] = 0;
			if ($arreglo[$i]['nu_cpt_sacos'] == '')
				$arreglo[$i]['nu_cpt_sacos'] = 0;
			if ($arreglo[$i]['nu_cpt_toneladas'] == '')
				$arreglo[$i]['nu_cpt_toneladas'] = 0;
		}

		$elementos = array('nu_cpo_toneladas', 'nu_cpt_toneladas');
		$arregloSuma[0] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, '', $arregloFecha, $this);
		for ($i = 0; $i < 1; $i++) {
			if ($arregloSuma[$i]['nu_cpo_toneladas'] == '')
				$arregloSuma[$i]['nu_cpo_toneladas'] = 0;
			if ($arregloSuma[$i]['nu_cpt_toneladas'] == '')
				$arregloSuma[$i]['nu_cpt_toneladas'] = 0;
		}
		$elementos = array('nu_cpo_toneladas', 'nu_cpt_toneladas');
		$arregloSuma[1] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, '', $arregloFecha, $this);
		for ($i = 1; $i < 2; $i++) {
			if ($arregloSuma[$i]['nu_cpo_toneladas'] == '')
				$arregloSuma[$i]['nu_cpo_toneladas'] = 0;
			if ($arregloSuma[$i]['nu_cpt_toneladas'] == '')
				$arregloSuma[$i]['nu_cpt_toneladas'] = 0;
		}
		/////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////
		}

		return $this -> render('ProyectoPrincipalBundle:Produccion:ver_resumenproduccion.html.twig', array('usuario' => $usuario, 
		'nombreTipo' => $nombreTipo, 'tipo' => 'resumenproduccion', 'pk' => ($anio . '-' . $mes), 
		'arreglo' => $arreglo, 'arregloSuma' => $arregloSuma, 'fecha' => $fecha,'validacion'=>$validacion));
	}

	public function reporteAction($unidad, $tipo) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$fecha = UtilidadesAPI::obtenerFechaNormal2($this);
		$fechaBusqueda = UtilidadesAPI::convertirAFormatoSQL2($fecha, $this);
		$turnos = UtilidadesAPI::extraerTurnos($this);
		$ruta = $unidad . '-' . $tipo;
		$arreglo = null;

		if ($ruta == 'u1-rd') {
			$conexion = $this -> get('database_connection');

			$consulta = "SELECT base.d100pk_prod_u1rd pk, 
						base.nu_existenciainiciallavada,
						base.nu_existenciainicialnolavada,
						base.nu_existenciainicialapiladaenlaguna,
						base.tx_observacion,
						base1.e100fk_turno pkturno

				FROM    d100t_prod_u1rd base,
				        d101t_prod_u1rd base1
				
				WHERE base.fe_fecha >= '" . date('Y-m-d') . "' AND
					  base.fe_fecha < '" . date('Y-m-d', strtotime('+1 day')) . "' AND
				      base1.d100fk_prod_u1rd = base.d100pk_prod_u1rd
				      
				      ";

			$arreglo = $conexion -> fetchAll($consulta);

			if ($arreglo != null) {
				$arreglo = $arreglo[count($arreglo) - 1];

				if ($arreglo['pkturno'] == 3) {
					$mensaje = 'El Informe del dia ' . $fecha . ' ya fue completado.';
					return $this -> render('ProyectoPrincipalBundle:Produccion:errorinformecompleto.html.twig', array('usuario' => $usuario, 'fecha' => $fecha, 'mensaje' => $mensaje));

				}
			} else {
				$arreglo = null;
			}

		} else if ($ruta == 'u3-rd' || $ruta == 'u4-rd' || $ruta == 'u3-rp' || $ruta == 'u4-rp' || $ruta == 'u1-rpf' || $ruta == 'u2-rpf' || $ruta == 'u3-rpf' || $ruta == 'u4-rpf' || $ruta == 'u1-rgp' || $ruta == 'u2-rgp' || $ruta == 'u3-rgp' || $ruta == 'u4-rgp') {

			$conexion = $this -> get('database_connection');
			$base = $unidad . $tipo;

			$consulta = "SELECT base.d100pk_prod_" . $base . " pk

				FROM    d100t_prod_" . $base . "  base
				
				WHERE base.fe_fecha >= '" . date('Y-m-d') . "' AND
					  base.fe_fecha < '" . date('Y-m-d', strtotime('+1 day')) . "'";

			$arreglo = $conexion -> fetchAll($consulta);

			if ($arreglo != null) {
				$arreglo = $arreglo[count($arreglo) - 1];
			} else {
				$arreglo = null;
			}

		}

		return $this -> render('ProyectoPrincipalBundle:Produccion:' . $unidad . '-' . $tipo . '.html.twig', array('usuario' => $usuario, 'nombre' => ($unidad . '-' . $tipo), 'fecha' => $fecha, 'turnos' => $turnos, 'arreglo' => $arreglo));
	}

	public function guardarReporteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		//OBTENER LOS DATOS DEL ELEMENTO A GUARDAR
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$tipoReporte = $post -> get("tipoReporte");
		$pkReporte = $post -> get("pkReporte");

		$nombreTipo = '';
		$mensaje = '';
		$em = $this -> getDoctrine() -> getEntityManager();
		// Suspender el auto-commit
		$em -> getConnection() -> beginTransaction();
		// Intentar hacer la transaccion
		try {
			//$objeto = new D100tProdResumenproduccion();

			if ($tipoReporte == 'resumenproduccion') {

				$nombreTipo = 'Resumen de Produccion';
				$objeto = new D100tProdResumenproduccion();

				$objeto -> setFeU1Mesyanio(UtilidadesAPI::convertirFechaNormal($post -> get("fe_u1_mesyanio"), $this));
				$objeto -> setNuU1Cantsalbajadapuntilla($post -> get("nu_u1_cantsalbajadapuntilla"));
				$objeto -> setNuU1Cantsallavada($post -> get("nu_u1_cantsallavada"));
				$objeto -> setNuU1Cantsalnetalavada($post -> get("nu_u1_cantsalnetalavada"));
				$objeto -> setNuU1Cantdespachosclientes($post -> get("nu_u1_cantdespachosclientes"));
				$objeto -> setNuU1Canttrasladadosunidades($post -> get("nu_u1_canttrasladadosunidades"));
				$objeto -> setFeU2Mesyanio(UtilidadesAPI::convertirFechaNormal($post -> get("fe_u2_mesyanio"), $this));
				$objeto -> setNuU2Cantsalbajadapuntilla($post -> get("nu_u2_cantsalbajadapuntilla"));
				$objeto -> setNuU2Cantsalnolavadaenpatio($post -> get("nu_u2_cantsalnolavadaenpatio"));
				$objeto -> setNuU2Totaldesalnolavada($post -> get("nu_u2_totaldesalnolavada"));
				$objeto -> setFeU3Mesyanio(UtilidadesAPI::convertirFechaNormal($post -> get("fe_u3_mesyanio"), $this));
				$objeto -> setNuU3srmesaSacos($post -> get("nu_u3srmesa_sacos"));
				$objeto -> setNuU3srmesaToneladas($post -> get("nu_u3srmesa_toneladas"));
				$objeto -> setNuU3srextrafinaSacos($post -> get("nu_u3srextrafina_sacos"));
				$objeto -> setNuU3srextrafinaToneladas($post -> get("nu_u3srextrafina_toneladas"));
				$objeto -> setNuU3srfinaSacos($post -> get("nu_u3srfina_sacos"));
				$objeto -> setNuU3srfinaToneladas($post -> get("nu_u3srfina_toneladas"));
				$objeto -> setNuU3bbfinaSacos($post -> get("nu_u3bbfina_sacos"));
				$objeto -> setNuU3bbfinaToneladas($post -> get("nu_u3bbfina_toneladas"));
				$objeto -> setNuU3srgruesaSacos($post -> get("nu_u3srgruesa_sacos"));
				$objeto -> setNuU3srgruesaToneladas($post -> get("nu_u3srgruesa_toneladas"));
				$objeto -> setNuU3bbextrafinaSacos($post -> get("nu_u3bbextrafina_sacos"));
				$objeto -> setNuU3bbextrafinaToneladas($post -> get("nu_u3bbextrafina_toneladas"));
				$objeto -> setNuU3Totalsalesrefinadastm($post -> get("nu_u3_totalsalesrefinadastm"));
				$objeto -> setFeU4Mesyanio(UtilidadesAPI::convertirFechaNormal($post -> get("fe_u4_mesyanio"), $this));
				$objeto -> setNuU4srSacos($post -> get("nu_u4sr_sacos"));
				$objeto -> setNuU4srToneladas($post -> get("nu_u4sr_toneladas"));
				$objeto -> setNuU4siggSacos($post -> get("nu_u4sigg_sacos"));
				$objeto -> setNuU4siggToneladas($post -> get("nu_u4sigg_toneladas"));
				$objeto -> setNuU4bbggSacos($post -> get("nu_u4bbgg_sacos"));
				$objeto -> setNuU4bbggToneladas($post -> get("nu_u4bbgg_toneladas"));
				$objeto -> setNuU4sicSacos($post -> get("nu_u4sic_sacos"));
				$objeto -> setNuU4sicToneladas($post -> get("nu_u4sic_toneladas"));
				$objeto -> setNuU4Totalsalesindustrialestm($post -> get("nu_u4_totalsalesindustrialestm"));

				$objeto -> setI100fkUsuario($usuario);

				$em -> persist($objeto);
				$em -> flush();
				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} else if ($tipoReporte == 'u1-rd') {

				$nombreTipo = 'Reporte Diario';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU1rd();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setNuExistenciainiciallavada($post -> get("nu_existenciainiciallavada"));
					$objeto -> setNuExistenciainicialnolavada($post -> get("nu_existenciainicialnolavada"));
					$objeto -> setNuExistenciainicialapiladaenlaguna($post -> get("nu_existenciainicialapiladaenlaguna"));
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$objeto -> setI100fkUsuario($usuario);
					$em -> persist($objeto);
					$em -> flush();
				} else {// SE DEBE ACTUALIZAR EL REPORTE

					$objeto = $em -> getRepository('ProyectoPrincipalBundle:D100tProdU1rd') -> find($pkReporte);
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con id ' . $pkReporte);
					}
					$objeto -> setNuExistenciainiciallavada($post -> get("nu_existenciainiciallavada"));
					$objeto -> setNuExistenciainicialnolavada($post -> get("nu_existenciainicialnolavada"));
					$objeto -> setNuExistenciainicialapiladaenlaguna($post -> get("nu_existenciainicialapiladaenlaguna"));
					$objeto -> setTxObservacion($post -> get("tx_observacion"));

					$em -> flush();

				}
				///BUSCAR EL TURNO CORRESPONDIENTE////////////////////
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				///////////GUARDAR PARTE UNO/////////////////////////

				$objeto1 = new D101tProdU1rd();
				$objeto1 -> setD100fkProdU1rd($objeto);
				$objeto1 -> setE100fkTurno($turno);
				$objeto1 -> setNuSalapiladaenlaguna($post -> get("nu_salapiladaenlaguna"));
				$objeto1 -> setNuSalbajadaallavadero($post -> get("nu_salbajadaallavadero"));
				$objeto1 -> setNuSallavada($post -> get("nu_sallavada"));
				$objeto1 -> setNuSaldepositadaenpatiolavadero($post -> get("nu_saldepositadaenpatiolavadero"));
				$objeto1 -> setNuSallavadadelpatio($post -> get("nu_sallavadadelpatio"));
				$objeto1 -> setNuSalnetalavada($post -> get("nu_salnetalavada"));
				$objeto1 -> setNuAcumuladaenpatiolavada($post -> get("nu_acumuladaenpatiolavada"));
				$objeto1 -> setNuAcumuladaenpationolavada($post -> get("nu_acumuladaenpationolavada"));
				$objeto1 -> setTxUnidades($post -> get("tx_unidades"));
				$objeto1 -> setTxClientes($post -> get("tx_clientes"));

				$em -> persist($objeto1);
				$em -> flush();

				///BUSCAR EL TURNO CORRESPONDIENTE////////////////////
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_adl_turnos"));

				///////////GUARDAR PARTE DOS/////////////////////////
				if ($post -> get("tx_adl_horainiciodetrabajo") != '' || $post -> get("tx_adl_horainicialdelaparada") != '' || $post -> get("tx_adl_arranco") != '' || $post -> get("tx_adl_horafinaldelaparada") != '' || $post -> get("tx_adl_horasefectivas") != '' || $post -> get("tx_adl_totalhorasparada") != '' || $post -> get("tx_adl_causasdelaparada") != '') {

					$objeto2 = new D102tProdU1rd();
					$objeto2 -> setD100fkProdU1rd($objeto);
					$objeto2 -> setE100fkTurno($turno);
					$objeto2 -> setTxAdlHorainiciodetrabajo($post -> get("tx_adl_horainiciodetrabajo"));
					$objeto2 -> setTxAdlHorainicialdelaparada($post -> get("tx_adl_horainicialdelaparada"));
					$objeto2 -> setTxAdlArranco($post -> get("tx_adl_arranco"));
					$objeto2 -> setTxAdlHorafinaldelaparada($post -> get("tx_adl_horafinaldelaparada"));
					$objeto2 -> setTxAdlHorasefectivas($post -> get("tx_adl_horasefectivas"));
					$objeto2 -> setTxAdlTotalhorasparada($post -> get("tx_adl_totalhorasparada"));
					$objeto2 -> setTxAdlCausasdelaparada($post -> get("tx_adl_causasdelaparada"));

					$em -> persist($objeto2);
					$em -> flush();
				}

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u2-rd') {

				$nombreTipo = 'Reporte Diario';
				$objeto = new D100tProdU2rd();

				$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
				$objeto -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto -> setTxPresentacion($post -> get("tx_presentacion"));
				$objeto -> setTxUso($post -> get("tx_uso"));
				$objeto -> setNuCantsalnolavadaenpatio($post -> get("nu_cantsalnolavadaenpatio"));
				$objeto -> setNuTotaldesalnolavada($post -> get("nu_totaldesalnolavada"));
				$objeto -> setTxObservacion($post -> get("tx_observacion"));
				$objeto -> setI100fkUsuario($usuario);

				$em -> persist($objeto);
				$em -> flush();
				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} else if ($tipoReporte == 'u3-rd') {

				$nombreTipo = 'Reporte Diario';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU3rd();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU3rd') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
				

					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU3rd();
				$objeto1 -> setD100fkProdU3rd($objeto);
				$objeto1 -> setE100fkTurno($turno);
				$objeto1 -> setTxTipodeproducto($post -> get("tx_tipodeproducto"));
				$objeto1 -> setNuCpoSacos($post -> get("nu_cpo_sacos"));
				$objeto1 -> setNuCpoToneladas($post -> get("nu_cpo_toneladas"));
				$objeto1 -> setNuCprSacos($post -> get("nu_cpr_sacos"));
				$objeto1 -> setNuCprToneladas($post -> get("nu_cpr_toneladas"));
				$objeto1 -> setNuCptSacos($post -> get("nu_cpt_sacos"));
				$objeto1 -> setNuCptToneladas($post -> get("nu_cpt_toneladas"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} else if ($tipoReporte == 'u4-rd') {

				$nombreTipo = 'Reporte Diario';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU4rd();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU4rd') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU4rd();
				$objeto1 -> setD100fkProdU4rd($objeto);
				$objeto1 -> setE100fkTurno($turno);

				$objeto1 -> setTxTipodeproducto($post -> get("tx_tipodeproducto"));
				$objeto1 -> setNuCpoSacos($post -> get("nu_cpo_sacos"));
				$objeto1 -> setNuCpoToneladas($post -> get("nu_cpo_toneladas"));
				$objeto1 -> setNuCprSacos($post -> get("nu_cpr_sacos"));
				$objeto1 -> setNuCprToneladas($post -> get("nu_cpr_toneladas"));
				$objeto1 -> setNuCptSacos($post -> get("nu_cpt_sacos"));
				$objeto1 -> setNuCptToneladas($post -> get("nu_cpt_toneladas"));
				$objeto1 -> setNuTotalsalesindustrialestm($post -> get("nu_totalsalesindustrialestm"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u1-rpf') {

				$nombreTipo = 'Reporte de Par&aacute;metros Fisicoqu&iacute;micos';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU1rpf();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU1rpf') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU1rpf();
				$objeto1 -> setD100fkProdU1rpf($objeto);

				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuPmCa($post -> get("nu_pm_ca"));
				$objeto1 -> setNuPmMg($post -> get("nu_pm_mg"));
				$objeto1 -> setNuPmCo($post -> get("nu_pm_co"));
				$objeto1 -> setNuPmSo($post -> get("nu_pm_so"));
				$objeto1 -> setNuPmNaci($post -> get("nu_pm_naci"));
				$objeto1 -> setNuPmInsolubles($post -> get("nu_pm_insolubles"));
				$objeto1 -> setNuPmHumedad($post -> get("nu_pm_humedad"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u2-rpf') {

				$nombreTipo = 'Reporte de Par&aacute;metros Fisicoqu&iacute;micos';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU2rpf();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU2rpf') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU2rpf();
				$objeto1 -> setD100fkProdU2rpf($objeto);

				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuPmCa($post -> get("nu_pm_ca"));
				$objeto1 -> setNuPmMg($post -> get("nu_pm_mg"));
				$objeto1 -> setNuPmCo($post -> get("nu_pm_co"));
				$objeto1 -> setNuPmSo($post -> get("nu_pm_so"));
				$objeto1 -> setNuPmNaci($post -> get("nu_pm_naci"));
				$objeto1 -> setNuPmInsolubles($post -> get("nu_pm_insolubles"));
				$objeto1 -> setNuPmHumedad($post -> get("nu_pm_humedad"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();
			} elseif ($tipoReporte == 'u3-rpf') {

				$nombreTipo = 'Reporte de Par&aacute;metros Fisicoqu&iacute;micos';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU3rpf();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU3rpf') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU3rpf();
				$objeto1 -> setD100fkProdU3rpf($objeto);

				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuPmCa($post -> get("nu_pm_ca"));
				$objeto1 -> setNuPmMg($post -> get("nu_pm_mg"));
				$objeto1 -> setNuPmCo($post -> get("nu_pm_co"));
				$objeto1 -> setNuPmSo($post -> get("nu_pm_so"));
				$objeto1 -> setNuPmNaci($post -> get("nu_pm_naci"));
				$objeto1 -> setNuPmInsolubles($post -> get("nu_pm_insolubles"));
				$objeto1 -> setNuPmHumedad($post -> get("nu_pm_humedad"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u4-rpf') {

				$nombreTipo = 'Reporte de Par&aacute;metros Fisicoqu&iacute;micos';

				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU4rpf();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU4rpf') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turnos"));
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU4rpf();
				$objeto1 -> setD100fkProdU4rpf($objeto);

				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuPmCa($post -> get("nu_pm_ca"));
				$objeto1 -> setNuPmMg($post -> get("nu_pm_mg"));
				$objeto1 -> setNuPmCo($post -> get("nu_pm_co"));
				$objeto1 -> setNuPmSo($post -> get("nu_pm_so"));
				$objeto1 -> setNuPmNaci($post -> get("nu_pm_naci"));
				$objeto1 -> setNuPmInsolubles($post -> get("nu_pm_insolubles"));
				$objeto1 -> setNuPmHumedad($post -> get("nu_pm_humedad"));
				

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u1-rgp') {

				$nombreTipo = 'Reporte de Granulometr&iacute;a Promedio';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU1rgp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU1rgp') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU1rgp();

				$objeto1 -> setD100fkProdU1rgp($objeto);
				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuNdematiz($post -> get("nu_ndematiz"));
				$objeto1 -> setNuPorcentaje($post -> get("nu_porcentaje"));
				$objeto1 -> setNuPan($post -> get("nu_pan"));
				$objeto1 -> setNuTotal($post -> get("nu_total"));
				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

				/////////////////////////////////////////////////

			} elseif ($tipoReporte == 'u2-rgp') {

				$nombreTipo = 'Reporte de Granulometr&iacute;a Promedio';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU2rgp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU2rgp') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU2rgp();

				$objeto1 -> setD100fkProdU2rgp($objeto);
				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuNdematiz($post -> get("nu_ndematiz"));
				$objeto1 -> setNuPorcentaje($post -> get("nu_porcentaje"));
				$objeto1 -> setNuPan($post -> get("nu_pan"));
				$objeto1 -> setNuTotal($post -> get("nu_total"));
				
				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

				/////////////////////////////////////////////////

			} elseif ($tipoReporte == 'u3-rgp') {

				$nombreTipo = 'Reporte de Granulometr&iacute;a Promedio';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU3rgp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU3rgp') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU3rgp();

				$objeto1 -> setD100fkProdU3rgp($objeto);
				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuNdematiz($post -> get("nu_ndematiz"));
				$objeto1 -> setNuPorcentaje($post -> get("nu_porcentaje"));
				$objeto1 -> setNuPan($post -> get("nu_pan"));
				$objeto1 -> setNuTotal($post -> get("nu_total"));
				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

				/////////////////////////////////////////////////
			} elseif ($tipoReporte == 'u4-rgp') {

				$nombreTipo = 'Reporte de Granulometr&iacute;a Promedio';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU4rgp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU4rgp') -> find($pkReporte);
					$objeto -> setTxObservacion($post -> get("tx_observacion"));
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU4rgp();

				$objeto1 -> setD100fkProdU4rgp($objeto);
				$objeto1 -> setTxTipodesal($post -> get("tx_tipodesal"));
				$objeto1 -> setNuNdematiz($post -> get("nu_ndematiz"));
				$objeto1 -> setNuPorcentaje($post -> get("nu_porcentaje"));
				$objeto1 -> setNuPan($post -> get("nu_pan"));
				$objeto1 -> setNuTotal($post -> get("nu_total"));
				
				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();

			} elseif ($tipoReporte == 'u3-rp') {

				$nombreTipo = 'Reporte Diario de Paletizado';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU3rp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
				
					$em -> persist($objeto);
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU3rp') -> find($pkReporte);
			
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU3rp();

				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turno"));
				$objeto1 -> setE100fkTurno($turno);
				$objeto1 -> setD100fkProdU3rp($objeto);

				$objeto1 -> setNuSalrefgruesakg($post -> get("nu_salrefgruesakg"));
				$objeto1 -> setNuSalextrafinakg($post -> get("nu_salextrafinakg"));
				$objeto1 -> setNuSalrefmesakg($post -> get("nu_salrefmesakg"));
				$objeto1 -> setNuSalreffinakg($post -> get("nu_salreffinakg"));
				$objeto1 -> setTxObservaciones($post -> get("tx_observaciones"));

				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();
				/////////////////////////////777

			} elseif ($tipoReporte == 'u4-rp') {

				$nombreTipo = 'Reporte Diario de Paradas';

				//////////////////////////////////////////////////
				if ($pkReporte == 0) {// SE DEBE CREAR UN NUEVO REPORTE
					$objeto = new D100tProdU4rp();
					$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
					$objeto -> setI100fkUsuario($usuario);
				
				
					$em -> flush();
				} else {
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tProdU4rp') -> find($pkReporte);
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con ' . $pkReporte);
					}
				}
				//////CREAR EL MINIREPORTE CORRESPONDIENTE
				$objeto1 = new D101tProdU4rp();
				$turno = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:E100tTurno') -> find($post -> get("tx_turno"));
				$objeto1 -> setD100fkProdU4rp($objeto);
				$objeto1 -> setE100fkTurno($turno);

				$objeto1 -> setTxInicio($post -> get("tx_inicio"));
				$objeto1 -> setTxFin($post -> get("tx_fin"));
				$objeto1 -> setTxDescripcion($post -> get("tx_descripcion"));
				$objeto1 -> setTxInsumos($post -> get("tx_insumos"));
				$objeto1 -> setNuCantdeinsumos($post -> get("nu_cantdeinsumos"));
				$objeto1 -> setTxObservaciones($post -> get("tx_observaciones"));
				$em -> persist($objeto1);
				$em -> flush();

				$mensaje = 'El ' . $nombreTipo . ' se guardo exitosamente...';
				$em -> getConnection() -> commit();
				////////////////////////////////////////////7
			}

		} catch (\Exception $e) {
			throw $e;
			$mensaje = 'El ' . $nombreTipo . ' no se pudo guardar, por favor intente nuevamente siendo cuidadoso con los tipos de datos...';
			// Rollback the failed transaction attempt
			$em -> getConnection() -> rollback();
			$em -> close();
		}

		$respuesta = new response(json_encode(array('mensaje' => $mensaje)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function buscarReporteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		//OBTENER LOS DATOS DEL ELEMENTO A GUARDAR
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$tipoReporte = $post -> get("tipoReporte");

		if ($tipoReporte != 'resumenproduccion') {

			$fechaInicialNormal = $post -> get("fechaInicial");
			$fechaFinalNormal = $post -> get("fechaFinal");

			$fechaI = UtilidadesAPI::convertirAFormatoSQL($fechaInicialNormal, $this);
			$fechaF = UtilidadesAPI::convertirAFormatoSQL($fechaFinalNormal, $this);

			$fechaInicial = UtilidadesAPI::convertirFechaNormal($fechaInicialNormal, $this);
			$fechaFinal = UtilidadesAPI::convertirFechaNormal($fechaFinalNormal, $this);

		}

		$nombreTipo = '';
		$mensaje = '';
		$arreglo = array();
		$html = '';
		$em = $this -> getDoctrine() -> getEntityManager();

		//$objeto = new D100tProdResumenproduccion();

		if ($tipoReporte == 'u1-rd') {

			$nombreTipo = 'Reporte Diario Unidad I';
			//$objeto = new D100tProdU1rd();

		} elseif ($tipoReporte == 'u1-rgp') {

			$nombreTipo = 'Reporte de Granulometría Promedio Unidad I';
			//$objeto = new D100tProdU1rgp();

		} elseif ($tipoReporte == 'u1-rpf') {

			$nombreTipo = 'Reporte de Parámetros Fisicoquímicos Unidad I';
			//$objeto = new D100tProdU1rpf();

		} elseif ($tipoReporte == 'u2-rd') {

			$nombreTipo = 'Reporte Diario Unidad II';
			//$objeto = new D100tProdU2rd();

		} elseif ($tipoReporte == 'u2-rgp') {

			$nombreTipo = 'Reporte de Granulometría Promedio Unidad II';
			//$objeto = new D100tProdU2rgp();

		} elseif ($tipoReporte == 'u2-rpf') {

			$nombreTipo = 'Reporte de Parámetros Fisicoquímicos Unidad II';
			//$objeto = new D100tProdU2rpf();

		} elseif ($tipoReporte == 'u3-rd') {

			$nombreTipo = 'Reporte Diario Unidad III';
			//$objeto = new D100tProdU3rd();

		} elseif ($tipoReporte == 'u3-rgp') {

			$nombreTipo = 'Reporte de Granulometría Promedio Unidad III';
			//$objeto = new D100tProdU3rgp();

		} elseif ($tipoReporte == 'u3-rpf') {

			$nombreTipo = 'Reporte de Parámetros Fisicoquímicos Unidad III';
			//$objeto = new D100tProdU3rpf();

		} elseif ($tipoReporte == 'u3-rp') {

			$nombreTipo = 'Reporte Diario de Paletizado Unidad III';
			//$objeto = new D100tProdU3rp();

		} elseif ($tipoReporte == 'u4-rd') {

			$nombreTipo = 'Reporte Diario Unidad Cuatro IV ';
			//$objeto = new D100tProdU4rd();

		} elseif ($tipoReporte == 'u4-rgp') {

			$nombreTipo = 'Reporte de Granulometría Promedio Unidad IV ';
			//$objeto = new D100tProdU4rgp();

		} elseif ($tipoReporte == 'u4-rpf') {

			$nombreTipo = 'Reporte de Parámetros Fisicoquímicos Unidad IV ';
			//$objeto = new D100tProdU4rpf();

		} elseif ($tipoReporte == 'u4-rp') {

			$nombreTipo = 'Reporte Diario de Paradas Unidad IV ';
			//$objeto = new D100tProdU4rp();

		}

		if ($tipoReporte != 'resumenproduccion') {

			$conexion = $this -> get('database_connection');
			$clave = preg_replace('/-/', '', $tipoReporte);
			$consulta = "SELECT elemento.d100pk_prod_" . $clave . " pk, 
						elemento.fe_fecha fecha, 
						usuario.nombre, 
						usuario.apellido

				FROM    d100t_prod_" . $clave . " elemento, 
				        i100t_usuario usuario
						 
				WHERE   fe_fecha >=  '" . $fechaI . "'
					    AND fe_fecha <=  '" . $fechaF . "'
					    AND i100fk_usuario = i100pk_usuario";

			$arreglo = $conexion -> fetchAll($consulta);

			$nombre = $nombreTipo . ' del ' . $fechaInicialNormal . ' al ' . $fechaFinalNormal;

			$html = $this -> renderView('ProyectoPrincipalBundle:Produccion:tablaconsultas.html.twig', array('nombre' => $nombre, 'arreglo' => $arreglo, 'clave' => $clave));
		}

		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function eliminarReporteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		//OBTENER LOS DATOS DEL ELEMENTO A GUARDAR
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$tipoReporte = $post -> get("tipoReporte");
		$id = $post -> get("id");

		$conexion = $this -> get('database_connection');
		//if($tipoReporte 'u1rd')
		if($tipoReporte != 'u2rd')$resultado = $conexion -> executeUpdate("DELETE FROM d101t_prod_" . $tipoReporte . " WHERE d100fk_prod_" . $tipoReporte . " =?", array($id));
		if($tipoReporte == 'u1rd')$resultado = $conexion -> executeUpdate("DELETE FROM d102t_prod_" . $tipoReporte . " WHERE d100fk_prod_" . $tipoReporte . " =?", array($id));
		$resultado = $conexion -> executeUpdate("DELETE FROM d100t_prod_" . $tipoReporte . " WHERE d100pk_prod_" . $tipoReporte . " =?", array($id));

		$respuesta = new response(json_encode(array('resultado' => $resultado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

	public function visualizarReporteXlsAction($base, $id) {
		//echo 'Entro en visualizar XLS con'.$base.' y ID'.$id;

		$usuario = UtilidadesAPI::usuarioActual($this);
		$xls_service = $this -> get('xls.service_xls5');
		$arreglo = array();
		if ($base == 'resumenproduccion') {

			$arregloFecha = explode("-", $id);
			$arregloFecha = UtilidadesAPI::obtenerFechasFormatoSQL($arregloFecha[0], $arregloFecha[1], $this);

			$titulo = "Resumen de Produccion";
			$filename = $titulo . '.xls';

			$arregloAuxiliar = array();
			$elementos = array('nu_salbajadaallavadero', 'nu_sallavada', 'nu_salnetalavada');
			$arregloAuxiliar[0] = UtilidadesAPI::extraerDatosProduccion(1, $elementos, '', $arregloFecha, $this);

			$elementos = array('nu_cpo_sacos', 'nu_cpo_toneladas', 'nu_cpt_sacos', 'nu_cpt_toneladas');
			$arregloAuxiliar[1] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Mesa', $arregloFecha, $this);
			$arregloAuxiliar[2] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Fina', $arregloFecha, $this);
			$arregloAuxiliar[3] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Gruesa', $arregloFecha, $this);
			$arregloAuxiliar[4] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Ref. Extrafina', $arregloFecha, $this);
			$arregloAuxiliar[5] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Big-Bag Fina', $arregloFecha, $this);
			$arregloAuxiliar[6] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, 'Sal Big-Bag Extrafina', $arregloFecha, $this);

			$elementos = array('nu_cpo_sacos', 'nu_cpo_toneladas', 'nu_cpt_sacos', 'nu_cpt_toneladas');
			$arregloAuxiliar[7] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Indust. Grano Grueso', $arregloFecha, $this);
			$arregloAuxiliar[8] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Indust. Comun', $arregloFecha, $this);
			$arregloAuxiliar[9] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Sal Roja', $arregloFecha, $this);
			$arregloAuxiliar[10] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, 'Big-Bag Grano Grueso', $arregloFecha, $this);

			$arreglo = $arregloAuxiliar;

			for ($i = 0; $i < 1; $i++) {
				if ($arreglo[$i]['nu_salbajadaallavadero'] == '')
					$arreglo[$i]['nu_salbajadaallavadero'] = 0;
				if ($arreglo[$i]['nu_sallavada'] == '')
					$arreglo[$i]['nu_sallavada'] = 0;
				if ($arreglo[$i]['nu_salnetalavada'] == '')
					$arreglo[$i]['nu_salnetalavada'] = 0;
			}
			for ($i = 1; $i <= 10; $i++) {
				if ($arreglo[$i]['nu_cpo_sacos'] == '')
					$arreglo[$i]['nu_cpo_sacos'] = 0;
				if ($arreglo[$i]['nu_cpo_toneladas'] == '')
					$arreglo[$i]['nu_cpo_toneladas'] = 0;
				if ($arreglo[$i]['nu_cpt_sacos'] == '')
					$arreglo[$i]['nu_cpt_sacos'] = 0;
				if ($arreglo[$i]['nu_cpt_toneladas'] == '')
					$arreglo[$i]['nu_cpt_toneladas'] = 0;
			}

			$elementos = array('nu_cpo_toneladas', 'nu_cpt_toneladas');
			$arregloSuma[0] = UtilidadesAPI::extraerDatosProduccion(3, $elementos, '', $arregloFecha, $this);
			for ($i = 0; $i < 1; $i++) {
				if ($arregloSuma[$i]['nu_cpo_toneladas'] == '')
					$arregloSuma[$i]['nu_cpo_toneladas'] = 0;
				if ($arregloSuma[$i]['nu_cpt_toneladas'] == '')
					$arregloSuma[$i]['nu_cpt_toneladas'] = 0;
			}
			$elementos = array('nu_cpo_toneladas', 'nu_cpt_toneladas');
			$arregloSuma[1] = UtilidadesAPI::extraerDatosProduccion(4, $elementos, '', $arregloFecha, $this);
			for ($i = 1; $i < 2; $i++) {
				if ($arregloSuma[$i]['nu_cpo_toneladas'] == '')
					$arregloSuma[$i]['nu_cpo_toneladas'] = 0;
				if ($arregloSuma[$i]['nu_cpt_toneladas'] == '')
					$arregloSuma[$i]['nu_cpt_toneladas'] = 0;
			}

			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(24);
			$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(24);

			$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
			$i = 1;
			$x = 0;

			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'PRODUCCIÓN UNIDAD #I TM');
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sal Bajada (Puntilla)');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_salbajadaallavadero']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sal Lavada');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_sallavada']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Neta Lavada');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_salnetalavada']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Despachos (Clientes)');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, '');
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Traslados Unidades');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, '');
			$i++;

			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'PRODUCCIÓN UNIDAD #III TM (SACOS/TONELADAS)');
			$i++;
			$x++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Mesa');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Fina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Gruesa');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Extrafina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag. Fina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag. ExtraFina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTALES SALES REFINADAS (TM) : ' . $arregloSuma[0]['nu_cpo_toneladas'] . ' TM');
			$i++;

			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'DESPACHO UNIDAD #III TM (SACOS/TONELADAS)');
			$i++;
			$x = 1;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Mesa');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Fina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Gruesa');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ref. Extrafina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag. Fina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag. ExtraFina');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTALES SALES REFINADAS (TM) : ' . $arregloSuma[0]['nu_cpt_toneladas'] . ' TM');
			$i++;

			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'PRODUCCIÓN UNIDAD #IV TM (SACOS/TONELADAS)');
			$i++;
			$x++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ind. Grano Grueso');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Industrial Común');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sal Roja');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag Grano Grueso');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpo_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpo_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTALES SALES REFINADAS (TM) : ' . $arregloSuma[1]['nu_cpo_toneladas'] . ' TM');
			$i++;
			////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'DESPACHO UNIDAD #IV TM (SACOS/TONELADAS)');
			$i++;
			$x = 7;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Ind. Grano Grueso');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Industrial Común');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sal Roja');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Big Bag Grano Grueso');
			$i++;
			$x++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Sacos');
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, 'Toneladas');
			$i++;

			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $arreglo[$x]['nu_cpt_sacos']);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $arreglo[$x]['nu_cpt_toneladas']);
			$i++;

			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> getStartColor() -> setRGB('FFFFFF');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFont() -> getColor() -> setRGB('FF0000');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $i) -> getFill() -> setFillType('solid');
			$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':B' . $i);
			$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'TOTALES SALES REFINADAS (TM) : ' . $arregloSuma[1]['nu_cpt_toneladas'] . ' TM');
			$i++;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			$i--;
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $i) -> getAlignment() -> setVertical('center');
			$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $i) -> getAlignment() -> setHorizontal('center');
		} else {

			$turnos = UtilidadesAPI::extraerTurnos($this);

			$conexion = $this -> get('database_connection');
			$consulta = "SELECT *
				FROM    d100t_prod_" . $base . " elemento, 
				        i100t_usuario usuario
						 
				WHERE   elemento.d100pk_prod_" . $base . " =  '" . $id . "'
					    AND i100fk_usuario = i100pk_usuario";
			$arreglo = $conexion -> fetchAll($consulta);
			$arreglo = $arreglo[count($arreglo) - 1];
			///////////////////////////////////////////////////////
			$titulo = "Archivo";
			$filename = $titulo . '.xls';
			$fecha = explode(" ", $arreglo['fe_fecha']);

			if ($base == 'u1rd') {

				$titulo = 'Reporte Diario UI -' . $fecha[0];

				///////////////////////////////////////////////////////////////////
				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u1rd =  '" . $arreglo['d100pk_prod_u1rd'] . "'";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);
				$arregloAuxiliar2 = array();
				$consulta = "SELECT *

				FROM    d102t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u1rd =  '" . $arreglo['d100pk_prod_u1rd'] . "'";

				$arregloAuxiliar2 = $conexion -> fetchAll($consulta);
				$arreglo = array($arreglo, $arregloAuxiliar1, $arregloAuxiliar2);

				$auxiliar = array();
				foreach ($turnos as $key => $value) {
					$auxiliar[$value['pk']] = $value['turno'];
				}
				$turnos = $auxiliar;
			
				////////////////////////////////////////////////////////////7
				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(12);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(22);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(24);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('D') -> setWidth(21);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('E') -> setWidth(23);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('F') -> setWidth(14);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('G') -> setWidth(20);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('H') -> setWidth(18);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:H20') -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:H20') -> getAlignment() -> setHorizontal('center');

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:A3') -> getFill() -> getStartColor() -> setRGB('FF0000');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:A3') -> getFont() -> getColor() -> setRGB('FFFFFF');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:A3') -> getFill() -> setFillType('solid');

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A5:A15') -> getFill() -> getStartColor() -> setRGB('FF0000');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A5:A15') -> getFont() -> getColor() -> setRGB('FFFFFF');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A5:A15') -> getFill() -> setFillType('solid');

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A17:H17') -> getFill() -> getStartColor() -> setRGB('FF0000');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A17:H17') -> getFont() -> getColor() -> setRGB('FFFFFF');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A17:H17') -> getFill() -> setFillType('solid');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A1:G1');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A1', 'EXISTENCIA INICIAL LAVADA (Ton)');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H1', $arreglo[0]['nu_existenciainiciallavada'] . ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A2:G2');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A2', 'EXISTENCIA INICIAL NO LAVADA (Ton)');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H2', $arreglo[0]['nu_existenciainicialnolavada'] . ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A3:G3');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A3', 'EXISTENCIA INICIAL APILADA EN LAGUNA (APROXIMADO)');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H3', $arreglo[0]['nu_existenciainicialapiladaenlaguna'] . ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A5:E5');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A5', 'Turnos');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F5', '6am a 12m');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G5', '12m a 6pm');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H5', '6pm a 12pm');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A6:E6');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A6', 'Sal apilada en la laguna');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F6', isset($arreglo[1][0]['nu_salapiladaenlaguna']) ? $arreglo[1][0]['nu_salapiladaenlaguna'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G6', isset($arreglo[1][1]['nu_salapiladaenlaguna']) ? $arreglo[1][1]['nu_salapiladaenlaguna'].' TM' : '0 TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H6', isset($arreglo[1][2]['nu_salapiladaenlaguna']) ? $arreglo[1][2]['nu_salapiladaenlaguna'].' TM' : '0 TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A7:E7');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A7', 'Sal bajada al lavadero');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F7', isset($arreglo[1][0]['nu_salbajadaallavadero']) ? $arreglo[1][0]['nu_salbajadaallavadero'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G7', isset($arreglo[1][1]['nu_salbajadaallavadero']) ? $arreglo[1][1]['nu_salbajadaallavadero'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H7', isset($arreglo[1][2]['nu_salbajadaallavadero']) ? $arreglo[1][2]['nu_salbajadaallavadero'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A8:E8');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A8', 'Sal depositada en patio (lavadero)');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F8', isset($arreglo[1][0]['nu_saldepositadaenpatiolavadero']) ? $arreglo[1][0]['nu_saldepositadaenpatiolavadero'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G8', isset($arreglo[1][1]['nu_saldepositadaenpatiolavadero']) ? $arreglo[1][1]['nu_saldepositadaenpatiolavadero'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H8', isset($arreglo[1][2]['nu_saldepositadaenpatiolavadero']) ? $arreglo[1][2]['nu_saldepositadaenpatiolavadero'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A9:E9');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A9', 'Sal lavada del patio');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F9', isset($arreglo[1][0]['nu_sallavadadelpatio']) ? $arreglo[1][0]['nu_sallavadadelpatio'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G9', isset($arreglo[1][1]['nu_sallavadadelpatio']) ? $arreglo[1][1]['nu_sallavadadelpatio'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H9', isset($arreglo[1][2]['nu_sallavadadelpatio']) ? $arreglo[1][2]['nu_sallavadadelpatio'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A10:E10');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A10', 'Sal neta lavada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F10', isset($arreglo[1][0]['nu_salnetalavada']) ? $arreglo[1][0]['nu_salnetalavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G10', isset($arreglo[1][1]['nu_salnetalavada']) ? $arreglo[1][1]['nu_salnetalavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H10', isset($arreglo[1][2]['nu_salnetalavada']) ? $arreglo[1][2]['nu_salnetalavada'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A11:E11');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A11', 'Salidas');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A12:E12');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A12', 'Unidades');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F12', isset($arreglo[1][0]['tx_unidades']) ? $arreglo[1][0]['tx_unidades'].'' : '');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G12', isset($arreglo[1][1]['tx_unidades']) ? $arreglo[1][1]['tx_unidades'].'' : '');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H12', isset($arreglo[1][2]['tx_unidades']) ? $arreglo[1][2]['tx_unidades'].'' : '');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A13:E13');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A13', 'Clientes');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F13', isset($arreglo[1][0]['tx_clientes']) ? $arreglo[1][0]['tx_clientes'].'' : '');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G13', isset($arreglo[1][1]['tx_clientes']) ? $arreglo[1][1]['tx_clientes'].'' : '');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H13', isset($arreglo[1][2]['tx_clientes']) ? $arreglo[1][2]['tx_clientes'].'' : '');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A14:E14');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A14', 'Acumulada en patio lavada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F14', isset($arreglo[1][0]['nu_acumuladaenpatiolavada']) ? $arreglo[1][0]['nu_acumuladaenpatiolavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G14', isset($arreglo[1][1]['nu_acumuladaenpatiolavada']) ? $arreglo[1][1]['nu_acumuladaenpatiolavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H14', isset($arreglo[1][2]['nu_acumuladaenpatiolavada']) ? $arreglo[1][2]['nu_acumuladaenpatiolavada'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A15:E15');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A15', 'Acumulada en patio no lavada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F15', isset($arreglo[1][0]['nu_acumuladaenpationolavada']) ? $arreglo[1][0]['nu_acumuladaenpationolavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G15', isset($arreglo[1][1]['nu_acumuladaenpationolavada']) ? $arreglo[1][1]['nu_acumuladaenpationolavada'].' TM' : ' TM');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H15', isset($arreglo[1][2]['nu_acumuladaenpationolavada']) ? $arreglo[1][2]['nu_acumuladaenpationolavada'].' TM' : ' TM');

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A16:H16');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A16', 'Actividades del Lavadero');

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A17', 'Turnos');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B17', 'Hora Inicio de Trabajo');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C17', 'Hora Inicial de la parada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D17', 'Causas de las paradas');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E17', 'Hora final de la parada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F17', 'Arranco');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G17', 'Total horas parada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H17', 'Horas efectivas');

				//$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A20:F20');
				//$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A20', 'Actividades del Lavadero');

				$totalHorasParada = 0;
				$totalHorasEfectiva = 0;
				$i = 18;

				foreach ($arreglo[2] as $key => $value) {
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, $turnos[$value['e100fk_turno']]);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $i, $value['tx_adl_horainiciodetrabajo']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $i, $value['tx_adl_horainiciodetrabajo']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $i, $value['tx_adl_causasdelaparada']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $i, $value['tx_adl_horafinaldelaparada']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('F' . $i, $value['tx_adl_arranco']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $value['tx_adl_totalhorasparada']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $value['tx_adl_horasefectivas']);
					$totalHorasParada = $totalHorasParada + $value['tx_adl_totalhorasparada'];
					$totalHorasEfectiva = $totalHorasEfectiva + $value['tx_adl_horasefectivas'];
					$i++;
				}

				$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $i . ':F' . $i);
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $i, 'Total horas');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('G' . $i, $totalHorasParada + ' h');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('H' . $i, $totalHorasEfectiva + ' h');

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('G' . $i . ':H' . $i) -> getFill() -> getStartColor() -> setRGB('FF0000');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('G' . $i . ':H' . $i) -> getFont() -> getColor() -> setRGB('FFFFFF');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('G' . $i . ':H' . $i) -> getFill() -> setFillType('solid');

				//////////////////////////////////////////////////////////////
			} else if ($base == 'u2rd') {

				$titulo = 'Reporte Dario UII ';

				$titulo = $titulo . '- ' . $fecha[0];

				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(35);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(22);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B5') -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B5') -> getAlignment() -> setHorizontal('center');

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A1', 'Tipo de sal');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B1', $arreglo['tx_tipodesal']);

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A2', 'Presentación');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B2', $arreglo['tx_presentacion']);

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A3', 'Uso');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B3', $arreglo['tx_uso']);

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A4', 'Cant. Sal No Lavada en Patio');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B4', $arreglo['nu_cantsalnolavadaenpatio']);

				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A5', 'Total de Sal no Lavada');
				$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B5', $arreglo['nu_totaldesalnolavada']);

			} else if ($base == 'u3rd') {

				$titulo = 'Reporte Dario UIII ';

				$titulo = $titulo . '- ' . $fecha[0];

				///////////////////////////////////////////////////////////////////
				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u3rd =  '" . $arreglo['d100pk_prod_u3rd'] . "'
				
				ORDER BY  base.e100fk_turno ";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				$auxiliar = array();
				foreach ($turnos as $key => $value) {
					$auxiliar[$value['pk']] = $value['turno'];
				}
				$turnos = $auxiliar;

				////////////////////////////////////////////////////////////7

				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(35);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indiceAux = -1;
				$indice = 1;
				foreach ($arreglo[1] as $elemento) {
					//echo ' </br> ';
					//print_r($elemento);
					if ($indiceAux != $elemento['e100fk_turno']) {
						$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'TURNO: ' . $turnos[$elemento['e100fk_turno']]);
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFill() -> setFillType('solid');

						$indiceAux = $elemento['e100fk_turno'];
						$indice++;

					}

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFont() -> getColor() -> setRGB('FF0000');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> setFillType('solid');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Tipo de Producto');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['tx_tipodeproducto']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Obtenido');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpo_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpo_toneladas']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Retenido');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpr_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpr_toneladas']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Trasladado a Almacen de Productos Terminados');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpt_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpt_sacos']);

					$indice++;
				}

				$indice--;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . ($indice)) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setHorizontal('center');

			} else if ($base == 'u4rd') {

				$titulo = 'Reporte Dario UIV ';

				$titulo = $titulo . '- ' . $fecha[0];

				///////////////////////////////////////////////////////////////////
				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u4rd =  '" . $arreglo['d100pk_prod_u4rd'] . "'
				
				ORDER BY  base.e100fk_turno ";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				$auxiliar = array();
				foreach ($turnos as $key => $value) {
					$auxiliar[$value['pk']] = $value['turno'];
				}
				$turnos = $auxiliar;

				////////////////////////////////////////////////////////////7

				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(35);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(35);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indiceAux = -1;
				$indice = 1;
				foreach ($arreglo[1] as $elemento) {
					//echo ' </br> ';
					//print_r($elemento);
					if ($indiceAux != $elemento['e100fk_turno']) {
						$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'TURNO: ' . $turnos[$elemento['e100fk_turno']]);
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice) -> getFill() -> setFillType('solid');

						$indiceAux = $elemento['e100fk_turno'];
						$indice++;

					}

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFont() -> getColor() -> setRGB('FF0000');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> setFillType('solid');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Tipo de Producto');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['tx_tipodeproducto']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Obtenido');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpo_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpo_toneladas']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Retenido');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpr_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpr_toneladas']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Cantidad de Producto Trasladado a Almacen de Productos Terminados');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sacos');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpt_sacos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Toneladas');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_cpt_sacos']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Total Sales Industriales (TM) : ' . $elemento['nu_totalsalesindustrialestm']);

				}

				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . ($indice)) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setHorizontal('center');

			} else if ($base == 'u1rpf' || $base == 'u2rpf' || $base == 'u3rpf' || $base == 'u4rpf') {

				$arregloLetras = array('UI', 'UII', 'UIII', 'UIV');
				$auxNum = substr($base, 1, 1);
				$numero = $auxNum - 1;

				$pk = $arreglo[('d100pk_prod_' . $base)];
				$titulo = 'Reporte de PFQ ' . $arregloLetras[$numero] . ' ' . $fecha[0];

				/////////////////////////////////////////////
				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				/////////////////////////////////

				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(22);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(26);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indice = 1;
				foreach ($arreglo[1] as $elemento) {

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> setFillType('solid');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Tipo de sal');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['tx_tipodesal']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Parámetros Medidos (%)');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Ca+2');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_ca']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Mg+2');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_mg']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'CO3-2');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_co']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'SO4-2');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_so']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'NaCi');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_naci']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Insolubles');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_insolubles']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Humedad');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pm_humedad']);
				}

				////////////////////////////////////////////////////////////
				$indice--;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setHorizontal('center');

			} else if ($base == 'u1rgp' || $base == 'u2rgp' || $base == 'u3rgp' || $base == 'u4rgp') {

				$arregloLetras = array('UI', 'UII', 'UIII', 'UIV');
				$auxNum = substr($base, 1, 1);
				$numero = $auxNum - 1;

				$pk = $arreglo[('d100pk_prod_' . $base)];
				$titulo = 'Reporte de GP ' . $arregloLetras[$numero] . ' ' . $fecha[0];

				/////////////////////////////////////////////
				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				/////////////////////////////////

				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(22);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(26);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indice = 1;
				foreach ($arreglo[1] as $elemento) {

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> setFillType('solid');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Tipo de sal');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['tx_tipodesal']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'N° de Matíz');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_ndematiz']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Porcentaje %');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_porcentaje']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'PAN(%)');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_pan']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Total');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_total']);

				}

				////////////////////////////////////////////////////////////
				$indice--;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setHorizontal('center');

			} else if ($base == 'u3rp') {

				$pk = $arreglo[('d100pk_prod_' . $base)];
				$titulo = 'Reporte de Pal. U3 ' . $fecha[0];

				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				$auxiliar = array();

				foreach ($turnos as $key => $value) {
					$auxiliar[$value['pk']] = $value['turno'];
				}
				$turnos = $auxiliar;
				////////////////////////////////////
				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('A') -> setWidth(33);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('B') -> setWidth(26);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indice = 1;
				foreach ($arreglo[1] as $elemento) {

					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
					$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':B' . $indice) -> getFill() -> setFillType('solid');

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Turno');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $turnos[$elemento['e100fk_turno']]);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sal Ref. Fina (25Kg)');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_salreffinakg']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sal Ref. Gruesa (25Kg)');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_salrefgruesakg']);

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Sal Extrafina (25Kg)');
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice++, $elemento['nu_salextrafinakg']);

					$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':B' . $indice);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'Observaciones: ' . $elemento['tx_observaciones']);

				}

				////////////////////////////////////////////////////////////
				$indice--;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:B' . $indice) -> getAlignment() -> setHorizontal('center');
			} else if ($base == 'u4rp') {
				$pk = $arreglo[('d100pk_prod_' . $base)];
				$titulo = 'Reporte de Pal. U3 ' . $fecha[0];

				$arregloAuxiliar1 = array();
				$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . " =  '" . $pk . "'
				
				ORDER BY base.e100fk_turno";

				$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

				$arreglo = array($arreglo, $arregloAuxiliar1);
				$auxiliar = array();

				foreach ($turnos as $key => $value) {
					$auxiliar[$value['pk']] = $value['turno'];
				}
				$turnos = $auxiliar;
				////////////////////////////////////
				$filename = $titulo . '.xls';
				$xls_service -> excelObj -> getProperties() -> setCreator("ENASAL") -> setLastModifiedBy("ENASAL") -> setTitle($titulo) -> setSubject("Reporte") -> setDescription("Reporte en excel generado desde Enasal") -> setKeywords("office 2005 enasal") -> setCategory("Reporte");

				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('C') -> setWidth(33);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('D') -> setWidth(26);
				$xls_service -> excelObj -> getActiveSheet() -> getColumnDimension('D') -> setWidth(20);

				$xls_service -> excelObj -> getActiveSheet() -> getRowDimension('1') -> setRowHeight(20);

				$indice = 1;
				$anterior = -1;
				foreach ($arreglo[1] as $elemento) {

					if ($anterior != $elemento['e100fk_turno']) {
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':E' . $indice) -> getFill() -> getStartColor() -> setRGB('FF0000');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':E' . $indice) -> getFont() -> getColor() -> setRGB('FFFFFF');
						$xls_service -> excelObj -> getActiveSheet() -> getStyle('A' . $indice . ':E' . $indice) -> getFill() -> setFillType('solid');

						$xls_service -> excelObj -> getActiveSheet() -> mergeCells('A' . $indice . ':E' . $indice);
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice++, 'TURNO: ' . $turnos[$elemento['e100fk_turno']]);

						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, 'Inicio');
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice, 'Fin');
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $indice, 'Descripcion');
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $indice, 'Insumos');
						$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $indice++, 'Cantidad');

					}
					$anterior = $elemento['e100fk_turno'];

					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('A' . $indice, $elemento['tx_inicio']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('B' . $indice, $elemento['tx_fin']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('C' . $indice, $elemento['tx_descripcion']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('D' . $indice, $elemento['tx_insumos']);
					$xls_service -> excelObj -> setActiveSheetIndex(0) -> setCellValue('E' . $indice, $elemento['nu_cantdeinsumos']);

					$indice++;
				}

				////////////////////////////////////////////////////////////
				$indice--;
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:E' . $indice) -> getAlignment() -> setVertical('center');
				$xls_service -> excelObj -> getActiveSheet() -> getStyle('A1:E' . $indice) -> getAlignment() -> setHorizontal('center');

			}
		}
		///PREPARAR LA HOJA DE CALCULOS

		$xls_service -> excelObj -> getActiveSheet() -> setTitle($titulo);
		$xls_service -> excelObj -> setActiveSheetIndex(0);
		$response = $xls_service -> getResponse();
		$response -> headers -> set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
		$response -> headers -> set('Content-Disposition', 'attachment;filename=' . $titulo . '.xls');
		$response -> headers -> set('Content-Transfer-Encoding', 'application/octet-stream');

		return $response;
	}

	public function visualizarReporteAction($base, $id) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$arreglo = array();
		$turnos = UtilidadesAPI::extraerTurnos($this);
		$pk = 0;
		$fecha ='';
		$conexion = $this -> get('database_connection');
		$consulta = "SELECT *

				FROM    d100t_prod_" . $base . " elemento, 
				        i100t_usuario usuario
						 
				WHERE   elemento.d100pk_prod_" . $base . " =  '" . $id . "'
					    AND i100fk_usuario = i100pk_usuario";
		$arreglo = $conexion -> fetchAll($consulta);
		$arreglo = $arreglo[count($arreglo) - 1];
		$fecha = explode(" ", $arreglo['fe_fecha']);
		$fecha = $fecha[0];

		if ($arreglo == NULL) {
			$mensaje = 'Informe no encontrado';
			return $this -> render('ProyectoPrincipalBundle:Produccion:errorinformecompleto.html.twig', array('usuario' => $usuario, 'fecha' => $fecha, 'mensaje' => $mensaje));
		}

		if ($base == 'u1rd') {
			$nombreTipo = 'Reporte Dario UI';
			$pk = $arreglo['d100pk_prod_u1rd'];

			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u1rd =  '" . $arreglo['d100pk_prod_u1rd'] . "'";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);
			$arregloAuxiliar2 = array();
			$consulta = "SELECT *

				FROM    d102t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u1rd =  '" . $arreglo['d100pk_prod_u1rd'] . "'";

			$arregloAuxiliar2 = $conexion -> fetchAll($consulta);
			$arreglo = array($arreglo, $arregloAuxiliar1, $arregloAuxiliar2);
			$auxiliar = array();
			foreach ($turnos as $key => $value) {
				$auxiliar[$value['pk']] = $value['turno'];
			}
			$turnos = $auxiliar;
		} else if ($base == 'u2rd') {
			$nombreTipo = 'Reporte Dario UII';
			$pk = $arreglo['d100pk_prod_u2rd'];

		} else if ($base == 'u3rd') {
			$nombreTipo = 'Reporte Dario UIII';
			$pk = $arreglo['d100pk_prod_u3rd'];

			/////////////////////////////////
			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u3rd =  '" . $arreglo['d100pk_prod_u3rd'] . "'
				
				ORDER BY  base.e100fk_turno ";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			$auxiliar = array();
			foreach ($turnos as $key => $value) {
				$auxiliar[$value['pk']] = $value['turno'];
			}
			$turnos = $auxiliar;

			/////////////////////////////////
		} else if ($base == 'u4rd') {
			$nombreTipo = 'Reporte Dario UIV';
			$pk = $arreglo['d100pk_prod_u4rd'];
			/////////////////////////////////////////////
			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_u4rd =  '" . $arreglo['d100pk_prod_u4rd'] . "'
				
				ORDER BY  base.e100fk_turno ";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			$auxiliar = array();
			foreach ($turnos as $key => $value) {
				$auxiliar[$value['pk']] = $value['turno'];
			}
			$turnos = $auxiliar;

			/////////////////////////////////

		} else if ($base == 'u1rpf' || $base == 'u2rpf' || $base == 'u3rpf' || $base == 'u4rpf') {

			$arregloLetras = array('UI', 'UII', 'UIII', 'UIV');
			$auxNum = substr($base, 1, 1);
			$numero = $auxNum - 1;

			$pk = $arreglo[('d100pk_prod_' . $base)];
			$nombreTipo = 'Reporte de Parámetros Fisicoquímicos ' . $arregloLetras[$numero];
			/////////////////////////////////////////////
			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			/////////////////////////////////

		} else if ($base == 'u1rgp' || $base == 'u2rgp' || $base == 'u3rgp' || $base == 'u4rgp') {

			$arregloLetras = array('UI', 'UII', 'UIII', 'UIV');
			$auxNum = substr($base, 1, 1);
			$numero = $auxNum - 1;

			$pk = $arreglo[('d100pk_prod_' . $base)];
			$nombreTipo = 'Reporte de Granulometría Promedio ' . $arregloLetras[$numero];
			/////////////////////////////////////////////
			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			/////////////////////////////////

		} else if ($base == 'u3rp') {
			$pk = $arreglo['d100pk_prod_u3rp'];
			$nombreTipo = 'Reporte Diario de Paletizado U3';

			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . "=  '" . $pk . "'";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			$auxiliar = array();

			foreach ($turnos as $key => $value) {
				$auxiliar[$value['pk']] = $value['turno'];
			}
			$turnos = $auxiliar;

		} else if ($base == 'u4rp') {
			$pk = $arreglo['d100pk_prod_u4rp'];
			$nombreTipo = 'Reporte Diario de Paradas U4';

			$arregloAuxiliar1 = array();
			$consulta = "SELECT *

				FROM    d101t_prod_" . $base . " base
						 
				WHERE   base.d100fk_prod_" . $base . " =  '" . $pk . "'
				
				ORDER BY base.e100fk_turno";

			$arregloAuxiliar1 = $conexion -> fetchAll($consulta);

			$arreglo = array($arreglo, $arregloAuxiliar1);
			$auxiliar = array();

			foreach ($turnos as $key => $value) {
				$auxiliar[$value['pk']] = $value['turno'];
			}
			$turnos = $auxiliar;

		}

		//exit;

		return $this -> render('ProyectoPrincipalBundle:Produccion:ver_' . $base . '.html.twig', array('usuario' => $usuario, 'arreglo' => $arreglo, 'turnos' => $turnos, 'fecha' => $fecha, 'base' => $base, 'pk' => $pk, 'nombreTipo' => $nombreTipo));
	}

}

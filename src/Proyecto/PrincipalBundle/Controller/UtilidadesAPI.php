<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Proyecto\PrincipalBundle\Entity\I100tUsuario;

class UtilidadesAPI extends Controller {

	public static function extraerDatosProduccion($unidad,$elementos,$producto,$arregloFecha,$class){
		$conexion = $class -> get('database_connection');
			
		$consulta = "SELECT ";
		
		for ($i=0; $i < count($elementos) ; $i++) {
			
			$consulta .= "SUM(  base1.".$elementos[$i]." ) ".$elementos[$i]; 
			
			if(!($i == (count($elementos) -1))) $consulta .= ",";
			
		}
		$consulta .= " FROM d100t_prod_u".$unidad."rd base0, d101t_prod_u".$unidad."rd base1 
						 
					  WHERE base0.d100pk_prod_u".$unidad."rd = base1.d100fk_prod_u".$unidad."rd AND
						    base0.fe_fecha >=  '".$arregloFecha[0]."' AND
						 	base0.fe_fecha <=  '".$arregloFecha[1]."' ";
							
		if($producto != ''){
			$consulta .= " AND base1.tx_tipodeproducto = '".$producto."'";
		}
				
		$arreglo = $conexion -> fetchAll($consulta);  
		
		
		return $arreglo[count($arreglo) - 1];
		
	}

	public static function extraerTurnos($class){
		$conexion = $class->get('database_connection');

		$consulta = 
				"SELECT base.e100pk_turno pk, 
						base.in_turno turno
				FROM    e100t_turno base";

		$arreglo = $conexion->fetchAll($consulta);
		return $arreglo;
		
	}
	public static function usuarioActual($class){
		$usuario = $class -> get('security.context') -> getToken() -> getUser();
		if (false === $class -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}
		return $usuario;
	}
	public static function crearUsuario($cedula, $nombre, $apellido, $nombredeusuario, $contrasenia, $rol, $class) {
		$factory = $class -> get('security.encoder_factory');
		$user = new I100tUsuario();
		$encoder = $factory -> getEncoder($user);
		$pase = $encoder -> encodePassword($contrasenia, $user -> getSalt());
		$user -> setCedula($cedula);
		$user -> setActivo(true);
		$user -> setPassword($pase);
		$user -> setNombre($nombre);
		$user -> setApellido($apellido);
		$user -> setUsername($nombredeusuario);
		$user -> setRol($rol);
		$em = $class -> getDoctrine() -> getEntityManager();
		$em -> persist($user);
		$em -> flush();
	}

	public static function modificarUsuarioConContrasenia($id, $cedula, $nombre, $apellido, $nombredeusuario, $contrasenia, $class) {

		$em = $class -> getDoctrine() -> getEntityManager();
		$user = $em -> getRepository('ProyectoPrincipalBundle:I100tUsuario') -> findOneByI100pkUsuario($id);
		$factory = $class -> get('security.encoder_factory');
		$encoder = $factory -> getEncoder($user);
		$pase = $encoder -> encodePassword($contrasenia, $user -> getSalt());
		$user -> setCedula($cedula);
		$user -> setActivo(true);
		$user -> setPassword($pase);
		$user -> setNombre($nombre);
		$user -> setApellido($apellido);
		$user -> setUsername($nombredeusuario);
		$em -> flush();
	}

	public static function modificarUsuario($id, $cedula, $nombre, $apellido, $nombredeusuario, $class) {

		$em = $class -> getDoctrine() -> getEntityManager();
		$user = $em -> getRepository('ProyectoPrincipalBundle:I100tUsuario') -> findOneByI100pkUsuario($id);
		$user -> setCedula($cedula);
		$user -> setNombre($nombre);
		$user -> setApellido($apellido);
		$user -> setUsername($nombredeusuario);
		$em -> flush();
	}

	public static function obtenerUsusariosActivos($class) {

		$repositorio = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:I100tUsuario');

		//$consulta = $repositorio -> createQueryBuilder('p') -> where('p.activo = 1') -> orderBy('p.cedula', 'ASC') -> getQuery();
		
		$consulta = $repositorio -> findAll();
		//$usuarios = $consulta -> getResult();
		$usuarios = $consulta;
		return $usuarios;
	}
	public static function obtenerFechaSistema($class) {
		$hoy = getdate();
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$anio = $hoy['year'];
		$mes = intval($hoy['mon']) - 1;
		$dia = $hoy['mday'];
		$hora = $hoy['hours'];
		$minuto = $hoy['minutes'];
		
		$dias = array('Domingo','Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado' );
		$dsemana = $hoy['wday'];
		
		$fecha = $dias[$dsemana]. ", " .$dia . " de " . $meses[$mes] . ' de ' . $anio;
		//.' - '.$hora.':'.$minuto;
		return $fecha;
	}
	public static function obtenerFechaCastellanizada($class) {
		$hoy = getdate();
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$anio = $hoy['year'];
		$mes = intval($hoy['mon']) - 1;
		$dia = $hoy['mday'];
		$hora = $hoy['hours'];
		$minuto = $hoy['minutes'];
		$fecha = $dia . " de " . $meses[$mes] . ' del ' . $anio;
		//.' - '.$hora.':'.$minuto;
		return $fecha;
	}
	public static function obtenerFechaCastellanizada2($fechaOriginal,$class) {
		
		$arreglo = explode("-", $fechaOriginal);
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$mes = intval($arreglo[1]) - 1;
		$fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2] ;

		return $fecha;
	}
	public static function obtenerFechaCastellanizada3($fechaOriginal,$class) {
		
		$arreglo = explode("-", $fechaOriginal);
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$mes = intval($arreglo[1]) - 1;
		$fecha =  $meses[$mes] . ' del ' . $arreglo[2] ;

		return $fecha;
	}
	public static function obtenerFechaCastellanizada4($fechaOriginal,$class) {
		
		$arreglo = explode("/", $fechaOriginal);
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$mes = intval($arreglo[1]) - 1;
		$fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2] ;

		return $fecha;
	}
	public static function obtenerNombreMes($fecha,$class) {
		$hoy = getdate();
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

		$mes = intval($fecha['mon']) - 1;
		return $mes;
	}

	public static function obtenerFechaNormal($class) {
		$hoy = getdate();
		$anio = $hoy['year'];
		$mes = $hoy['mon'];
		$dia = $hoy['mday'];
		$fecha = $dia . "/" . $mes . '/' . $anio;
		//.' - '.$hora.':'.$minuto;
		return $fecha;
	}

	public static function obtenerFechaNormal2($class) {
		$hoy = getdate();
		$anio = $hoy['year'];
		$mes = $hoy['mon'];
		$dia = $hoy['mday'];
		$fecha = $dia . "-" . $mes . '-' . $anio;
		//.' - '.$hora.':'.$minuto;
		return $fecha;
	}
	public static function obtenerFechaNormal3($class) {
		$hoy = getdate();
		$anio = $hoy['year'];
		$mes = $hoy['mon'];
		$dia = $hoy['mday'];
		$fecha =  $anio. "-" . $mes . '-' .  $dia;
		//.' - '.$hora.':'.$minuto;
		return $fecha;
	}
	public static function obtenerMesYAnio($class) {
		$hoy = getdate();
		return array( $hoy['year'], $hoy['mon']);
	}
	public static function convertirFechaNormal($fechaOriginal, $class) {
	
		$arreglo = explode("-", $fechaOriginal);
		$fecha = new \DateTime();
		$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
		return $fecha;
	}
	public static function convertirFechaNormal3($fechaOriginal, $class) {
		$arreglo = explode("/", $fechaOriginal);
		$fecha = new \DateTime();
		$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
		return $fecha;
	}

	public static function convertirFechaNormal2($fechaOriginal, $class) {
		$fechaOriginal = trim($fechaOriginal);
		$arreglo1 = explode(" ", $fechaOriginal);
		$arreglo = explode("-", $arreglo1[0]);
		$fecha = new \DateTime();
		$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
		return $fecha;
	}
	public static function convertirAFechaNormal($fechaOriginal,$class){
		
		$fechaOriginal = new \DateTime($fechaOriginal);
		return date_format($fechaOriginal, 'd/m/Y');;
	}
	public static function convertirAFormatoSQL($fechaOriginal,$class){
		
		$arreglo = explode("-", $fechaOriginal);
		if($arreglo[1] < 10) $arreglo[1] = '0'.$arreglo[1];
		if($arreglo[0] < 10) $arreglo[0] = '0'.$arreglo[0];		
		$fecha = $arreglo[2] .'-'.$arreglo[1].'-'. $arreglo[0] .' 00:00:00';
		
		return $fecha;
		
	}
	public static function obtenerFechasFormatoSQL($anio,$mes,$class){
		
		if($mes < 10)$mes = '0'.$mes;
		$dia = '01';
		
		$fechaInicial = $anio . '-'. $mes . '-' . $dia . ' 00:00:00';
		$dia = '31';
		$fechaFinal = $anio . '-'. $mes . '-' . $dia . ' 00:00:00';
	
		$arreglo = array($fechaInicial,$fechaFinal);
		
		return $arreglo;
		
	}
	public static function convertirAFormatoSQL2($fechaOriginal,$class){
		
		$arreglo = explode("-", $fechaOriginal);
		if($arreglo[1] < 10) $arreglo[1] = '0'.$arreglo[1];
		if($arreglo[0] < 10) $arreglo[0] = '0'.$arreglo[0];		
		$fecha = $arreglo[2] .'-'.$arreglo[1].'-'. $arreglo[0];
		
		return $fecha;
		
	}
	public static function convertirAFormatoSQL3($fechaOriginal,$class){
		
		$arreglo = explode("-", $fechaOriginal);

		$fecha = $arreglo[2] .'/'.$arreglo[1].'/'. $arreglo[0];
		
		return $fecha;
		
	}
	
	public static function convertirAFormatoSQL4($fechaOriginal,$class){

		$arreglo = explode("-", $fechaOriginal);
		$fecha = $arreglo[2] .'-'.$arreglo[1].'-'. $arreglo[0] .' 00:00:00';
		
		return $fecha;
		
	}
	
	public static function primerDiaMes($fechaOriginal,$class){

		$arreglo = explode("-", $fechaOriginal);
		$fecha = $arreglo[2] .'-'.$arreglo[1].'-01 00:00:00';
		
		return $fecha;
		
	}
	public static function primerDiaMesSiguiente($fechaOriginal,$class){

		$arreglo = explode("-", $fechaOriginal);
		$mes = intval($arreglo[1]);
		$anio = intval($arreglo[2]);
	
		if($mes==12){
			 $mes = "01";
			 $anio++;
		}
		else{
			$mes++;
			if($mes < 9)$mes = "0".$mes;		
		}
		
		$fecha = $anio.'-'.$mes.'-01 00:00:00';
		
		return $fecha;
		
	}
	public static function sumarTiempo($fechaOriginal,$dia,$mes,$anio,$class){

		$arreglo = explode("-", $fechaOriginal);

		$fecha = new \DateTime();
		$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
		$fecha -> setTime(0,0,0);
		$periodo = 'P'.$anio.'Y'.$mes.'M'.$dia.'D';
		$fecha->add(new \DateInterval($periodo));
		
		$fecha = date_format($fecha, 'Y-m-d H:i:s');;
		return $fecha;
		
	}
}

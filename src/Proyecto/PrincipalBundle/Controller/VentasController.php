<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Proyecto\PrincipalBundle\Entity\D100tVenEmitirorden;
use Proyecto\PrincipalBundle\Entity\D100tVenInfocliente;
use Proyecto\PrincipalBundle\Entity\I100tUsuario;
use Proyecto\PrincipalBundle\Entity\E100tProducto;
use Proyecto\PrincipalBundle\Entity\D101tVenEmitirorden;
use Proyecto\PrincipalBundle\Entity\D100tDesRepGuiades;

class VentasController extends Controller {

	public function agregarProductoAction($id,$producto) {

		$usuario = UtilidadesAPI::usuarioActual($this);
		$productos = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:E100tProducto')->findAll();
		$objeto = null;
		$idp ='';
		if($producto > 0){
			$objeto = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden') -> find($producto);
			$aux = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:E100tProducto') -> findOneByInNombre($objeto->getTxDpTipodeproducto());  

			$idp = $aux->getE100pkProducto();    

		}
	
		return $this -> render('ProyectoPrincipalBundle:Ventas:agregarProducto.html.twig', array('usuario' => $usuario, 
		'id'=>$id,'productos'=>$productos,'producto'=>$producto,'objeto'=>$objeto,'idp'=>$idp));
	}

	public function guardarProductoAction()
	{
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$idorden = $post -> get("idorden");
		$idproducto = $post -> get("idproducto");
		
		$estado = true;
		$codigo = '0';
		
		$orden = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden') -> find($idorden);
				
		//$cliente = $em -> getRepository('ProyectoPrincipalBundle:D100tVenInfocliente') -> find($idcliente);
		if($idproducto == 0) $objeto = new D101tVenEmitirorden();
		else $objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden') -> find($idproducto);
		
		$tipo = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:E100tProducto')->find(intval($post -> get("tx_dp_tipodeproducto")));
		
		$objeto -> setTxDpTipodeproducto($tipo->getInNombre());
		$objeto -> setNuDpSacos($post -> get("nu_dp_sacos"));
		$objeto -> setNuDpTm($post -> get("nu_dp_tm"));
		$objeto -> setD100fkVenEmitirorden($orden);	
			
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($objeto);
		$em->flush();
		
		if($idproducto!= 0){
			$arreglo = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden') -> findByD100fkVenEmitirorden($orden->getD100pkVenEmitirorden());
			$prueba = false;
			for ($i=0; $i < count($arreglo); $i++) {
 				if($prueba == true){
					$codigo = $arreglo[$i] ->getD101pkVenEmitirorden();
					break;
				}
				if($arreglo[$i] ->getD101pkVenEmitirorden()== $idproducto ){
					$prueba = true;
				}
			}
		}
		
		$respuesta = new response(json_encode(array('estado' => $estado,'codigo'=>$codigo)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;		
	}
	public function eliminarOrdenDespachoAction()
	{
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$id = $post -> get("id");
		$estado = true;
		
		
		$em = $this -> getDoctrine() -> getEntityManager();
		$orden = $em -> getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden') -> find($id);
		$productosOrden =  $em -> getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden') -> findByD100fkVenEmitirorden($orden->getD100pkVenEmitirorden());
		
		for ($i=0; $i < count($productosOrden) ; $i++) {
			$guias = $em -> getRepository('ProyectoPrincipalBundle:D100tDesRepGuiades') -> findByD101fkVenEmitirorden($productosOrden[$i]->getD101pkVenEmitirorden());
			for ($j=0; $j < count($guias); $j++) {
				$em->remove($guias[$j]);
				$em->flush(); 
				
			}
			$em->remove($productosOrden[$i]);
			$em->flush(); 
		}
		$em->remove($orden);
		$em->flush(); 
		
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;		
	}
	public function informacionClienteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);

		return $this -> render('ProyectoPrincipalBundle:Ventas:informacionCliente.html.twig', array('usuario' => $usuario));
	}
	public function visualizarClienteAction($id, $formato) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$format = $this->get('request')->get('_format');
		
		$formato = strtolower($formato);
		if ($formato != 'html' && $formato != 'pdf') {
		throw $this->createNotFoundException();
													 }
		$format = $formato;
		$fecha = '';

		$estado = true;
		$ordenes = '';
		$cliente = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenInfocliente')->find($id);

		if (!$cliente) $estado = false;	  
	

			return $this -> render(sprintf('ProyectoPrincipalBundle:Ventas:ver-cliente.%s.twig', $format), array('usuario' => $usuario,
				'cliente' => $cliente,'estado' => $estado,'nombre' => 'VER CLIENTE'));	
				
		
	}

	public function emitirOrdenAction($id) {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$objeto = null;
		if($id > 0)
			$objeto = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->find($id);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_infocliente id, tx_nombre rif
				 FROM    d100t_ven_infocliente";
				
		$arreglo = $conexion->fetchAll($consulta);
		
		$fecha = UtilidadesAPI::obtenerFechaNormal2($this);

		$numeroOrden = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden')->findAll();
		if($numeroOrden != null){
			$numeroOrden = ($numeroOrden[count($numeroOrden)-1]->getNuNdeorden())+1;
		}
		else{
			$numeroOrden = 1;
		}

		
		return $this -> render('ProyectoPrincipalBundle:Ventas:emitirOrden.html.twig', array('usuario' => $usuario, 
		'arreglo'=>$arreglo,'fecha'=>$fecha,'objeto'=>$objeto,'numeroOrden'=>$numeroOrden));
	}

	public function consultarOrdenAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
       return $this -> render('ProyectoPrincipalBundle:Ventas:consultarOrden.html.twig', array('usuario' => $usuario));
	}
	public function consultarClienteAction() {
		$usuario = UtilidadesAPI::usuarioActual($this);
		$estado = false;
		$repositorio = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:D100tVenInfocliente');
		
		$em = $this->getDoctrine()->getEntityManager();
		$consulta = $em->createQuery(
			'SELECT p FROM ProyectoPrincipalBundle:D100tVenInfocliente p ORDER BY p.d100pkVenInfocliente DESC'
									);
			$arreglo = $consulta->getResult();
		
		if(count($arreglo)> 0)$estado = true;

       return $this -> render('ProyectoPrincipalBundle:Ventas:consultarCliente.html.twig', array('usuario' => $usuario,
       		'arreglo' => $arreglo,'estado' => $estado));
	}
	public function buscarClienteAction(){

		$usuario = UtilidadesAPI::usuarioActual($this);
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$nombreCliente = $post -> get("nombreCliente");
		$rifCliente = $post -> get("rifCliente");
		$em = $this->getDoctrine()->getEntityManager();	
		$dql = '';
		if($nombreCliente!= '' && $rifCliente!= ''){
			$dql = "SELECT n
			        FROM ProyectoPrincipalBundle:D100tVenInfocliente n 
			        WHERE n.txNombre like :nombreCliente 
					   or n.txRif like :rifCliente
			        ORDER by n.d100pkVenInfocliente DESC ";

			$query = $em -> createQuery($dql);
			$query -> setParameter('nombreCliente', '%'.$nombreCliente.'%');
			$query -> setParameter('rifCliente', '%'.$rifCliente.'%');
		}
		else if($nombreCliente!= ''){
			$dql = "SELECT n
			        FROM ProyectoPrincipalBundle:D100tVenInfocliente n 
			        WHERE n.txNombre like :nombreCliente 
			        ORDER by n.d100pkVenInfocliente DESC ";

			$query = $em -> createQuery($dql);
			$query -> setParameter('nombreCliente', '%'.$nombreCliente.'%');
		}
		else{
			$dql = "SELECT n
			        FROM ProyectoPrincipalBundle:D100tVenInfocliente n 
			        WHERE n.txRif like :rifCliente
			        ORDER by n.d100pkVenInfocliente DESC ";

			$query = $em -> createQuery($dql);
			$query -> setParameter('rifCliente', '%'.$rifCliente.'%');
		}
		$arreglo = $query -> getResult();

		$html = $this -> renderView('ProyectoPrincipalBundle:Ventas:tablaClientes.html.twig', array('arreglo'=> $arreglo));

		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function editarClienteAction($id){
		$usuario = UtilidadesAPI::usuarioActual($this);
		
		$objeto = $this->getDoctrine()
			          ->getRepository('ProyectoPrincipalBundle:D100tVenInfocliente')
			          ->find($id);
					  
        return $this -> render('ProyectoPrincipalBundle:Ventas:informacionCliente.html.twig', array('usuario' => $usuario,'objeto'=>$objeto));

	}
	public function eliminarClienteAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$id = $post -> get("id");
		$estado = true;
		//echo 'Id =>'.$id;
		$conexion = $this->get('database_connection');

		$resultado = $conexion -> executeUpdate("DELETE FROM d100t_des_rep_guiades
				WHERE d100t_des_rep_guiades.d100fk_ven_emitirorden = ANY 
			    (SELECT d100pk_ven_emitirorden FROM d100t_ven_emitirorden 
				WHERE d100t_ven_emitirorden.d100fk_ven_infocliente =? )", array($id));

		$resultado = $conexion -> executeUpdate("DELETE FROM d100t_ven_emitirorden WHERE d100t_ven_emitirorden.d100fk_ven_infocliente =?", array($id));

		$resultado = $conexion -> executeUpdate("DELETE FROM d100t_ven_infocliente WHERE d100t_ven_infocliente.d100pk_ven_infocliente =?", array($id));				

		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function validacionOrdenDespachoAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$validacion = $post -> get("validacion");
		$id = $post -> get("id");
		$estado = false;
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT *
				FROM d100t_ven_emitirorden
				WHERE ".$validacion." = '".$id."'";
				
		$arreglo = $conexion->fetchAll($consulta);
		if($arreglo == null)$estado = true;
		
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function buscarOrdenAction(){

		$usuario = UtilidadesAPI::usuarioActual($this);
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$fechaInicial = $post -> get("fechaInicial");
		$fechaFinal = $post -> get("fechaFinal");
		
		$fechaI = UtilidadesAPI::convertirAFormatoSQL($fechaInicial,$this);
		$fechaF = UtilidadesAPI::convertirAFormatoSQL($fechaFinal,$this);
		
		$conexion = $this->get('database_connection');
		$consulta = 
				"SELECT d100pk_ven_emitirorden id, 
				        nu_ndeorden	numeroorden,
						fe_fecha fecha,
						nu_aprobado aprobado,
						nu_despachado despachado, 
						
						tx_nombre rif, 
						d100pk_ven_infocliente idcliente
						
				 FROM   d100t_ven_emitirorden, 
				 		d100t_ven_infocliente

				 WHERE  d100pk_ven_infocliente = d100fk_ven_infocliente AND
				        fe_fecha >=  '".$fechaI."' AND
				        fe_fecha <=  '".$fechaF."' 
				        ORDER BY d100pk_ven_emitirorden DESC
				        LIMIT 0, 100";
				
		$arreglo = $conexion->fetchAll($consulta);
		
		$html = '<span class="Titulo-Aplicacion"> No se han encontrado órdenes en este periodo de tiempo</span>';
		
		if(count($arreglo) > 0){
			
		for($i=0;$i<count($arreglo);$i++){
			$auxiliar = explode(" ", $arreglo[$i]['fecha']);
			$arreglo[$i]['fecha'] = $auxiliar[0];
		}
		
		$html = $this -> renderView('ProyectoPrincipalBundle:Ventas:contenedorBandejaOrdenes.html.twig', array('usuario' => $usuario,'arreglo'=> $arreglo));
		
			
		}

		$respuesta = new response(json_encode(array('html' => $html)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function guardarVentaAction() {
		
		$usuario = UtilidadesAPI::usuarioActual($this);
		//OBTENER LOS DATOS DEL ELEMENTO A GUARDAR
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		
		$tipoReporte = $post -> get("tipoReporte");
		$nombreTipo = '';
		$auxiliar = '';
		$auxiliar2 = '0';
		$mensaje = '';
		$idclienteeditar = 0;
		$em = $this -> getDoctrine() -> getEntityManager();
		// Suspender el auto-commit
		$em -> getConnection() -> beginTransaction();
		// Intentar hacer la transaccion
		try {
			//$objeto = new D100tProdResumenproduccion();

			if ($tipoReporte == 'infocliente') {
				$idclienteeditar = $post -> get("idclienteeditar");
				if($idclienteeditar != '0'){
					$objeto = $em -> getRepository('ProyectoPrincipalBundle:D100tVenInfocliente') -> find($idclienteeditar);
					if (!$objeto) {
						throw $this -> createNotFoundException('Ningún reporte encontrado con id ' . $pkReporte);
					}
				}
				else{
				$objeto = new D100tVenInfocliente();
				}
				$objeto ->setTxNombre($post -> get("tx_nombre"));
				$objeto -> setTxRepresentantelegaldelaempresa($post -> get("tx_representantelegaldelaempresa"));
				$objeto -> setTxRif($post -> get("tx_rif"));
				$objeto -> setTxDireccionfiscal($post -> get("tx_direccionfiscal"));
				$objeto -> setTxTelefono($post -> get("tx_telefono"));
				$objeto -> setTxCodigosada($post -> get("tx_codigosada"));

			} 
			else if ($tipoReporte == 'emitirorden') {
				$idorden = $post -> get("idOrden");	
				$idcliente = $post -> get("tx_cliente");
				$cliente = $em -> getRepository('ProyectoPrincipalBundle:D100tVenInfocliente') -> find($idcliente);
				if($idorden == 0){
					$objeto = new D100tVenEmitirorden();
					$objeto -> setNuAprobado(0);
					$objeto -> setNuDespachado(0);
					$objeto -> setNuCerrado(0);
				}
				 else {
				 	
					$objeto = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D100tVenEmitirorden') -> find($idorden);
					$objeto2 = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:D101tVenEmitirorden') -> findByD100fkVenEmitirorden($objeto->getD100pkVenEmitirorden());
					$auxiliar2 = $objeto2[0]->getD101pkVenEmitirorden();
					
					
				}
				
				$objeto -> setNuNdeorden($post -> get("nu_ndeorden"));
				//$objeto -> setNuNdefactura($post -> get("nu_ndefactura"));
				$objeto -> setFeFecha(UtilidadesAPI::convertirFechaNormal($post -> get("fe_fecha"), $this));
				$objeto -> setD100fkVenInfocliente($cliente);
				$objeto -> setTxDpObservacion($post -> get("tx_dp_observacion"));	
		
				$objeto -> setTxDireccion($post -> get("tx_direccion"));

			}

			$objeto -> setI100fkUsuario($usuario);
			$em = $this -> getDoctrine() -> getEntityManager();
			
			if(!($idclienteeditar > 0)){
					$em -> persist($objeto);
			}
		
			$em -> flush();
			if ($tipoReporte == 'emitirorden'){
				$auxiliar = $objeto -> getD100pkVenEmitirorden();
			}
			
			
			if ($tipoReporte == 'infocliente') $mensaje = 'La informacion del cliente fue guardada exitosamente...';
			else if ($tipoReporte == 'emitirorden') $mensaje = 'La orden fue registrada exitosamente..';
			
			$em -> getConnection() -> commit();
		} catch (\Exception $e) {
			throw $e;
			
			if ($tipoReporte == 'infocliente') $mensaje = 'La informacion del cliente no se pudo guardar, por favor intente nuevamente siendo cuidadoso con los tipos de datos...';
			else if ($tipoReporte == 'emitirorden') $mensaje = 'La orden no pudo ser emitida correctamente, por favor intente nuevamente siendo cuidadoso con los tipos de datos...';

			// Rollback the failed transaction attempt
			$em -> getConnection() -> rollback();
			$em -> close();
		}

		$respuesta = new response(json_encode(array('mensaje' => $mensaje,'auxiliar' => $auxiliar,'auxiliar2'=>$auxiliar2)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}

}

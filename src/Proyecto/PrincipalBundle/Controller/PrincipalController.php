<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Proyecto\PrincipalBundle\Entity\I100tUsuario;

class PrincipalController extends Controller
{
	public function indexAction()
    {

	$usuario = UtilidadesAPI::usuarioActual($this);

	if($usuario != null && $usuario->getActivo() == false){
		$usuario = null;
		return $this->render('ProyectoPrincipalBundle:Usuarios:cuentadesactivada.html.twig', array('usuario' => $usuario));
	} 

     	return $this->render('ProyectoPrincipalBundle:Principal:index.html.twig', array('usuario' => $usuario));
	}
	
	public function objetivosAction()
    {
		$usuario = UtilidadesAPI::usuarioActual($this);

        return $this->render('ProyectoPrincipalBundle:Principal:objetivos.html.twig', array('usuario' => $usuario));
    }

	public function accesoAction()
    {
    	//if (true === $this->get('security.context')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
		//throw new AccessDeniedException();
		//	}
		
    	$peticion = $this->getRequest();
		$sesion = $peticion->getSession();
		// obtiene el error de inicio de sesión si lo hay
		if ($peticion->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $peticion->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
				} 
	else {
		$error = $sesion->get(SecurityContext::AUTHENTICATION_ERROR);
		 }
        return $this->render('ProyectoPrincipalBundle:Principal:acceso.html.twig', array(
        	'ultimo_nombreusuario' => $sesion->get(SecurityContext::LAST_USERNAME),
        	'error'=> $error,'usuario' => false));
    }
		public function fechaAction()
    {
		$fecha = UtilidadesAPI::obtenerFechaSistema($this);
		
        return $this->render('ProyectoPrincipalBundle:Principal:fecha.html.twig', array('fecha' => $fecha));
    }
	
}

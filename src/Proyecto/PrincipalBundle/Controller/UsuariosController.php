<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Proyecto\PrincipalBundle\Entity\I100tUsuario;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UsuariosController extends Controller {
		public function modificarEstadoUsuarioAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$id = $post -> get("id");
		$tipo = $post -> get("tipo");
		$estado = true;
		//echo 'Id =>'.$id;
		
		$em = $this -> getDoctrine() -> getEntityManager();
		$usuario= $em->getRepository('ProyectoPrincipalBundle:I100tUsuario')->find($id);
		
		if($tipo == 'activar'){
			$usuario -> setActivo(1);
		}
		else{
			$usuario -> setActivo(0);
		}
		
		
		
		$em->flush();
		
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
		public function eliminarUsuarioAction(){

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$id = $post -> get("id");
		$estado = true;
		//echo 'Id =>'.$id;
		
		$em = $this -> getDoctrine() -> getEntityManager();
		$usuario= $em->getRepository('ProyectoPrincipalBundle:I100tUsuario')->find($id);
		
		$em->remove($usuario);
		$em->flush();
		
		$respuesta = new response(json_encode(array('estado' => $estado)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function usuarioNuevoAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}
		return $this -> render('ProyectoPrincipalBundle:Usuarios:usuarioNuevo.html.twig', array('usuario' => $usuario));
	}

	public function guardarUsuarioAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$nombre = strtolower($post -> get("nombre"));
		$apellido = strtolower($post -> get("apellido"));
		$cedula = $post -> get("cedula");
		$nombredeusuario = strtolower($post -> get("nombredeusuario"));
		$contrasenia = $post -> get("nuevacontrasenia");
		$contrasenia2 = $post -> get("nuevacontrasenia2");
		$area = strtolower($post -> get("area"));
		$titulo = "Usuario no creado";
		$mensaje1 = "";
		$mensaje2 = "Por favor, intente nuevamente.";

		if (empty($nombre) || empty($apellido) || empty($cedula) || empty($nombredeusuario) || empty($contrasenia) || empty($contrasenia2) || empty($area)) {
			$mensaje1 = "Debe llenar todos los campos";
		} else {
			if ($contrasenia != $contrasenia2) {

				$mensaje1 = "Las contraseñas deben ser identicas";

			} else {
				if (is_nan(intval($cedula))) {
					$mensaje1 = "La cedula solo debe contener caracteres numericos";
				} else {

					UtilidadesAPI::crearUsuario($cedula, $nombre, $apellido, $nombredeusuario, $contrasenia, $area, $this);
					//CREAR USUARIO
					$titulo = "Usuario creado exitosamente";
					$mensaje1 = ucfirst($nombre) . ' ' . ucfirst($apellido) . ' ya puede ingresar al sistema.';
					$mensaje2 = "Nombre de usuario: " . $nombredeusuario . " - Contraseña: " . $contrasenia;
				}
			}

		}

		return $this -> render('ProyectoPrincipalBundle:Principal:mensajeGenerico.html.twig', array('usuario' => $usuario, 'titulo' => $titulo, 'mensaje1' => $mensaje1, 'mensaje2' => $mensaje2));
	}

	public function gestionarUsuariosAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}
		$usuarios = UtilidadesAPI::obtenerUsusariosActivos($this);
		return $this -> render('ProyectoPrincipalBundle:Usuarios:gestionarUsuarios.html.twig', array('usuario' => $usuario, 'usuarios' => $usuarios));
	}

	public function deshabilitarUsuarioAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$titulo = "";
		$mensaje1 = "";
		$mensaje2 = "";

		$usuarios = UtilidadesAPI::obtenerUsusariosActivos($this);

		$i = 0;
		foreach ($usuarios as $user) {
			$variable = $post -> get("checkbox" . $user -> getCedula());
			if (!empty($variable)) {
				if ($i >= 1)
					$mensaje2 .= ' - ';
				$em = $this -> getDoctrine() -> getEntityManager();
				$producto -> setActivo(0);
				$em -> flush();
				$mensaje2 .= ucfirst($user -> getNombre()) . " " . ucfirst($user -> getApellido()) . "";
				$i++;
			}

		}

		if ($i > 1) {
			$titulo = "Usuarios deshabilitados correctamente";
			$mensaje1 = "Los siguientes no podran acceder al sistema:";
			$mensaje2 .= '.';
		} else if ($i == 1) {
			$titulo = "Usuario deshabilitado correctamente";
			$mensaje1 = "El siguiente no podra acceder al sistema:";
			$mensaje2 .= '.';
		} else {
			$titulo = "Usuarios no seleccionados";
			$mensaje1 = "Para deshabilitar debe seleccionar";
			$mensaje2 = 'Intente nuevamente';
		}

		return $this -> render('ProyectoPrincipalBundle:Principal:mensajeGenerico.html.twig', array('usuario' => $usuario, 'titulo' => $titulo, 'mensaje1' => $mensaje1, 'mensaje2' => $mensaje2));
	}
	public function editarUsuarioAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}

		return $this -> render('ProyectoPrincipalBundle:Usuarios:editarUsuario.html.twig', array('usuario' => $usuario));
	}

	public function editarCuentaAction() {
		$usuario = $this -> get('security.context') -> getToken() -> getUser();
		if (false === $this -> get('security.context') -> isGranted('IS_AUTHENTICATED_FULLY')) {
			$usuario = null;
		}

		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$nombre = strtolower($post -> get("nombre"));
		$apellido = strtolower($post -> get("apellido"));
		$cedula = $post -> get("cedula");
		$nombredeusuario = strtolower($post -> get("nombredeusuario"));
		$contrasenia = $post -> get("nuevacontrasenia");
		$contrasenia2 = $post -> get("nuevacontrasenia2");
		$idusuario = $post -> get("idusuario");

		$titulo = "Cambios no efectuados";
		$mensaje1 = "";
		$mensaje2 = "Por favor, intente nuevamente.";

		if (!empty($cedula) && is_nan(intval($cedula))) {
			$titulo = "Error al modificar cedula.";
			$mensaje1 = "La cedula s&oacute;lo debe contener caracteres n&uacute;mericos";
			return $this -> render('ProyectoPrincipalBundle:Principal:mensajeGenerico.html.twig', array('usuario' => $usuario, 'titulo' => $titulo, 'mensaje1' => $mensaje1, 'mensaje2' => $mensaje2));

		}

		///////////// CAMBIOS EN DATOS BASICOS //////////////
		if (!empty($nombre) && !empty($apellido) && !empty($cedula) && !empty($nombredeusuario)) {

			///////////// CAMBIOS EN CONTRASEÑAS//////////////
			if (!empty($contrasenia) && !empty($contrasenia2)) {
				if ($contrasenia != $contrasenia2) {
					$mensaje1 = "Las contraseñas deben ser id&eacute;nticas";
					return $this -> render('ProyectoPrincipalBundle:Principal:mensajeGenerico.html.twig', array('usuario' => $usuario, 'titulo' => $titulo, 'mensaje1' => $mensaje1, 'mensaje2' => $mensaje2));
				} else {
					//GUARDAR CONTRASEÑA NUEVA
					UtilidadesAPI::modificarUsuarioConContrasenia($idusuario, $cedula, $nombre, $apellido, $nombredeusuario, $contrasenia,$this);
					$titulo = "Los datos basicos del usuario han sido modificados correctamente.";
					$mensaje1 = ucfirst($nombre) . ' ' . ucfirst($apellido) . ' recuerde sus nuevos cambios.';
					$mensaje2 = "Por favor recuerde su nueva contraseña " . $contrasenia;
				}
			                                                   } 
			else {
				UtilidadesAPI::modificarUsuario($idusuario, $cedula, $nombre, $apellido, $nombredeusuario, $this);
				$titulo = "Los datos basicos del usuario han sido modificados correctamente.";
				$mensaje1 = ucfirst($nombre) . ' ' . ucfirst($apellido) . ' recuerde sus nuevos cambios.';
				$mensaje2 = "Nota: No fue modificada la contraseña. ";
			}

		}
		else{
		$mensaje1 = "Debe llenar los datos basicos";
		}

		return $this -> render('ProyectoPrincipalBundle:Principal:mensajeGenerico.html.twig', array('usuario' => $usuario, 'titulo' => $titulo, 'mensaje1' => $mensaje1, 'mensaje2' => $mensaje2));
	}

}

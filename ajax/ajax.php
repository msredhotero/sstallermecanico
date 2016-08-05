<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesReferencias.php');


$serviciosUsuarios  		= new ServiciosUsuarios();
$serviciosFunciones 		= new Servicios();
$serviciosHTML				= new ServiciosHTML();
$serviciosReferencias		= new ServiciosReferencias();


$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;


/* PARA Marca */
case 'insertarMarca':
insertarMarca($serviciosReferencias);
break;
case 'modificarMarca':
modificarMarca($serviciosReferencias);
break;
case 'eliminarMarca':
eliminarMarca($serviciosReferencias);
break;

/* Fin */


/* PARA Modelo */
case 'insertarModelo':
insertarModelo($serviciosReferencias);
break;
case 'modificarModelo':
modificarModelo($serviciosReferencias);
break;
case 'eliminarModelo':
eliminarModelo($serviciosReferencias);
break;

/* Fin */


/* PARA Clientes */
case 'insertarClientes':
insertarClientes($serviciosReferencias);
break;
case 'modificarClientes':
modificarClientes($serviciosReferencias);
break;
case 'eliminarClientes':
eliminarClientes($serviciosReferencias);
break;

/* Fin */


/* PARA Vehiculos */
case 'insertarVehiculos':
insertarVehiculos($serviciosReferencias);
break;
case 'modificarVehiculos':
modificarVehiculos($serviciosReferencias);
break;
case 'eliminarVehiculos':
eliminarVehiculos($serviciosReferencias);
break;

/* Fin */

/* PARA Ordenes */
case 'insertarOrdenes':
insertarOrdenes($serviciosReferencias);
break;
case 'modificarOrdenes':
modificarOrdenes($serviciosReferencias);
break;
case 'eliminarOrdenes':
eliminarOrdenes($serviciosReferencias);
break;

/* Fin */

}

//////////////////////////Traer datos */////////////////////////////////////////////////////////////

/* PARA Marca */
function insertarMarca($serviciosReferencias) {
$marca = $_POST['marca'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarMarca($marca,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarMarca($serviciosReferencias) {
$id = $_POST['id'];
$marca = $_POST['marca'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarMarca($id,$marca,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarMarca($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarMarca($id);
echo $res;
}

/* Fin */ 


/* PARA Modelo */
function insertarModelo($serviciosReferencias) {
$modelo = $_POST['modelo'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->insertarModelo($modelo,$activo);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarModelo($serviciosReferencias) {
$id = $_POST['id'];
$modelo = $_POST['modelo'];
if (isset($_POST['activo'])) {
$activo = 1;
} else {
$activo = 0;
}
$res = $serviciosReferencias->modificarModelo($id,$modelo,$activo);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarModelo($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarModelo($id);
echo $res;
}

/* Fin */ 


/* PARA Clientes */
function insertarClientes($serviciosReferencias) {
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$nrodocumento = $_POST['nrodocumento'];
$fechanacimiento = $_POST['fechanacimiento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$res = $serviciosReferencias->insertarClientes($apellido,$nombre,$nrodocumento,$fechanacimiento,$direccion,$telefono,$email);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarClientes($serviciosReferencias) {
$id = $_POST['id'];
$apellido = $_POST['apellido'];
$nombre = $_POST['nombre'];
$nrodocumento = $_POST['nrodocumento'];
$fechanacimiento = $_POST['fechanacimiento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$res = $serviciosReferencias->modificarClientes($id,$apellido,$nombre,$nrodocumento,$fechanacimiento,$direccion,$telefono,$email);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarClientes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarClientes($id);
echo $res;
}

/* Fin */ 


/* PARA Vehiculos */
function insertarVehiculos($serviciosReferencias) {
$patente = $_POST['patente'];
$refmarca = $_POST['refmarca'];
$refmodelo = $_POST['refmodelo'];
$anio = $_POST['anio'];
$res = $serviciosReferencias->insertarVehiculos($patente,$refmarca,$refmodelo,$anio);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarVehiculos($serviciosReferencias) {
$id = $_POST['id'];
$patente = $_POST['patente'];
$refmarca = $_POST['refmarca'];
$refmodelo = $_POST['refmodelo'];
$anio = $_POST['anio'];
$res = $serviciosReferencias->modificarVehiculos($id,$patente,$refmarca,$refmodelo,$anio);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarVehiculos($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarVehiculos($id);
echo $res;
}

/* Fin */ 



/* PARA Ordenes */
function insertarOrdenes($serviciosReferencias) {
$numero = $_POST['numero'];
$refclientevehiculo = $_POST['refclientevehiculo'];
$fechacrea = $_POST['fechacrea'];
$fechamodi = $_POST['fechamodi'];
$usuacrea = $_POST['usuacrea'];
$usuamodi = $_POST['usuamodi'];
$detallereparacion = $_POST['detallereparacion'];
$res = $serviciosReferencias->insertarOrdenes($numero,$refclientevehiculo,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos';
}
}
function modificarOrdenes($serviciosReferencias) {
$id = $_POST['id'];
$numero = $_POST['numero'];
$refclientevehiculo = $_POST['refclientevehiculo'];
$fechacrea = $_POST['fechacrea'];
$fechamodi = $_POST['fechamodi'];
$usuacrea = $_POST['usuacrea'];
$usuamodi = $_POST['usuamodi'];
$detallereparacion = $_POST['detallereparacion'];
$res = $serviciosReferencias->modificarOrdenes($id,$numero,$refclientevehiculo,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarOrdenes($serviciosReferencias) {
$id = $_POST['id'];
$res = $serviciosReferencias->eliminarOrdenes($id);
echo $res;
}

/* Fin */ 

////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	$res = $serviciosUsuarios->insertarUsuario($usuario,$password,$refroll,$email,$nombre);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$usuario			=	$_POST['usuario'];
	$password			=	$_POST['password'];
	$refroll			=	$_POST['refroll'];
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombrecompleto'];
	
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,$refroll,$email,$nombre);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	//$idempresa  =	$_POST['idempresa'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>
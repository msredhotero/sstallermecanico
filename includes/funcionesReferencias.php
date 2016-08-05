<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosReferencias {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}



/* PARA Marca */

function insertarMarca($marca,$activo) {
$sql = "insert into tbmarca(idmarca,marca,activo)
values ('','".utf8_decode($marca)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarMarca($id,$marca,$activo) {
$sql = "update tbmarca
set
marca = '".utf8_decode($marca)."',activo = ".$activo."
where idmarca =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarMarca($id) {
$sql = "delete from tbmarca where idmarca =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerMarca() {
$sql = "select idmarca,marca,(case when activo = 1 then 'Si' else 'No' end) as activo from tbmarca order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerMarcaPorId($id) {
$sql = "select idmarca,marca,activo from tbmarca where idmarca =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA Modelo */

function insertarModelo($modelo,$refmarca,$activo) {
$sql = "insert into tbmodelo(idmodelo,modelo,refmarca,activo)
values ('','".utf8_decode($modelo)."',".$refmarca.",".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarModelo($id,$modelo,$refmarca,$activo) {
$sql = "update tbmodelo
set
modelo = '".utf8_decode($modelo)."',refmarca = ".$refmarca.",activo = ".$activo."
where idmodelo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarModelo($id) {
$sql = "delete from tbmodelo where idmodelo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerModelo() {
$sql = "select idmodelo,modelo,m.marca,o.activo,m.idmarca from tbmodelo o inner join tbmarca m on m.idmarca = o.refmarca order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerModeloPorId($id) {
$sql = "select idmodelo,modelo,refmarca,activo from tbmodelo where idmodelo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */


/* PARA Clientes */

function insertarClientes($apellido,$nombre,$nrodocumento,$fechanacimiento,$direccion,$telefono,$email) {
$sql = "insert into dbclientes(idcliente,apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email)
values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."',".$nrodocumento.",'".utf8_decode($fechanacimiento)."','".utf8_decode($direccion)."','".utf8_decode($telefono)."','".utf8_decode($email)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarClientes($id,$apellido,$nombre,$nrodocumento,$fechanacimiento,$direccion,$telefono,$email) {
$sql = "update dbclientes
set
apellido = '".utf8_decode($apellido)."',nombre = '".utf8_decode($nombre)."',nrodocumento = ".$nrodocumento.",fechanacimiento = '".utf8_decode($fechanacimiento)."',direccion = '".utf8_decode($direccion)."',telefono = '".utf8_decode($telefono)."',email = '".utf8_decode($email)."'
where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientes($id) {
$sql = "delete from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientes() {
$sql = "select idcliente,apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email from dbclientes order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */


/* PARA Vehiculos */

function insertarVehiculos($patente,$refmarca,$refmodelo,$anio) {
$sql = "insert into dbvehiculos(idvehiculo,patente,refmarca,refmodelo,anio)
values ('','".utf8_decode($patente)."',".$refmarca.",".$refmodelo.",".$anio.")";
$res = $this->query($sql,1);
return $res;
}


function modificarVehiculos($id,$patente,$refmarca,$refmodelo,$anio) {
$sql = "update dbvehiculos
set
patente = '".utf8_decode($patente)."',refmarca = ".$refmarca.",refmodelo = ".$refmodelo.",anio = ".$anio."
where idvehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarVehiculos($id) {
$sql = "delete from dbvehiculos where idvehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerVehiculos() {
$sql = "select idvehiculo,patente,refmarca,refmodelo,anio from dbvehiculos order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVehiculosPorId($id) {
$sql = "select idvehiculo,patente,refmarca,refmodelo,anio from dbvehiculos where idvehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA ClienteVehiculos */

function insertarClienteVehiculos($refcliente,$refvehiculo,$activo) {
$sql = "insert into dbclientevehiculos(idclientevehiculo,refcliente,refvehiculo,activo)
values ('',".$refcliente.",".$refvehiculo.",".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarClienteVehiculos($id,$refcliente,$refvehiculo,$activo) {
$sql = "update dbclientevehiculos
set
refcliente = ".$refcliente.",refvehiculo = ".$refvehiculo.",activo = ".$activo."
where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClienteVehiculos($id) {
$sql = "delete from dbclientevehiculos where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClienteVehiculos() {
$sql = "select idclientevehiculo,refcliente,refvehiculo,activo from dbclientevehiculos order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClienteVehiculosPorId($id) {
$sql = "select idclientevehiculo,refcliente,refvehiculo,activo from dbclientevehiculos where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */



/* PARA Ordenes */

function insertarOrdenes($numero,$refclientevehiculo,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion) {
$sql = "insert into dbordenes(idorden,numero,refclientevehiculo,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion)
values ('','".utf8_decode($numero)."',".$refclientevehiculo.",'".utf8_decode($fechacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."','".utf8_decode($detallereparacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenes($id,$numero,$refclientevehiculo,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion) {
$sql = "update dbordenes
set
numero = '".utf8_decode($numero)."',refclientevehiculo = ".$refclientevehiculo.",fechacrea = '".utf8_decode($fechacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuacrea = '".utf8_decode($usuacrea)."',usuamodi = '".utf8_decode($usuamodi)."',detallereparacion = '".utf8_decode($detallereparacion)."'
where idorden =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarOrdenes($id) {
$sql = "delete from dbordenes where idorden =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerOrdenes() {
$sql = "select idorden,numero,refclientevehiculo,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion from dbordenes order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesPorId($id) {
$sql = "select idorden,numero,refclientevehiculo,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion from dbordenes where idorden =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */


/* Fin */

function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>
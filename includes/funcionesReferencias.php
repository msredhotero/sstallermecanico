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
$sql = "select
c.idcliente,
c.apellido,
c.nombre,
c.nrodocumento,
c.fechanacimiento,
c.direccion,
c.telefono,
c.email
from dbclientes c
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientesPorId($id) {
$sql = "select idcliente,apellido,nombre,nrodocumento,fechanacimiento,direccion,telefono,email from dbclientes where idcliente =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientes*/


/* PARA Clientevehiculos */

function insertarClientevehiculos($refcliente,$refclientes,$refvehiculos,$activo) {
$sql = "insert into dbclientevehiculos(idclientevehiculo,refcliente,refclientes,refvehiculos,activo)
values ('',".$refcliente.",".$refclientes.",".$refvehiculos.",".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarClientevehiculos($id,$refcliente,$refclientes,$refvehiculos,$activo) {
$sql = "update dbclientevehiculos
set
refcliente = ".$refcliente.",refclientes = ".$refclientes.",refvehiculos = ".$refvehiculos.",activo = ".$activo."
where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarClientevehiculos($id) {
$sql = "delete from dbclientevehiculos where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerClientevehiculos() {
$sql = "select
c.idclientevehiculo,
c.refcliente,
c.refclientes,
c.refvehiculos,
c.activo
from dbclientevehiculos c
inner join dbclientes cli ON cli.idcliente = c.refclientes
inner join dbvehiculos veh ON veh.idvehiculo = c.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = veh.refmodelo
inner join tbtipovehiculo ti ON ti.idtipovehiculo = veh.reftipovehiculo
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientevehiculosPorId($id) {
$sql = "select idclientevehiculo,refcliente,refclientes,refvehiculos,activo from dbclientevehiculos where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientevehiculos*/


/* PARA Ordenes */

function insertarOrdenes($numero,$refclientevehiculos,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion,$refestados) {
$sql = "insert into dbordenes(idorden,numero,refclientevehiculos,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion,refestados)
values ('','".utf8_decode($numero)."',".$refclientevehiculos.",'".utf8_decode($fechacrea)."','".utf8_decode($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."','".utf8_decode($detallereparacion)."',".$refestados.")";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenes($id,$numero,$refclientevehiculos,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion,$refestados) {
$sql = "update dbordenes
set
numero = '".utf8_decode($numero)."',refclientevehiculos = ".$refclientevehiculos.",fechacrea = '".utf8_decode($fechacrea)."',fechamodi = '".utf8_decode($fechamodi)."',usuacrea = '".utf8_decode($usuacrea)."',usuamodi = '".utf8_decode($usuamodi)."',detallereparacion = '".utf8_decode($detallereparacion)."',refestados = ".$refestados."
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
$sql = "select
o.idorden,
o.numero,
o.refclientevehiculos,
o.fechacrea,
o.fechamodi,
o.usuacrea,
o.usuamodi,
o.detallereparacion,
o.refestados
from dbordenes o
inner join dbclientevehiculos cli ON cli.idclientevehiculo = o.refclientevehiculos
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbestados est ON est.idestado = o.refestados
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesPorId($id) {
$sql = "select idorden,numero,refclientevehiculos,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion,refestados from dbordenes where idorden =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbordenes*/


/* PARA Usuarios */

function insertarUsuarios($usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "insert into dbusuarios(idusuario,usuario,password,refroles,email,nombrecompleto)
values ('','".utf8_decode($usuario)."','".utf8_decode($password)."',".$refroles.",'".utf8_decode($email)."','".utf8_decode($nombrecompleto)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarUsuarios($id,$usuario,$password,$refroles,$email,$nombrecompleto) {
$sql = "update dbusuarios
set
usuario = '".utf8_decode($usuario)."',password = '".utf8_decode($password)."',refroles = ".$refroles.",email = '".utf8_decode($email)."',nombrecompleto = '".utf8_decode($nombrecompleto)."'
where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarUsuarios($id) {
$sql = "delete from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerUsuarios() {
$sql = "select
u.idusuario,
u.usuario,
u.password,
u.refroles,
u.email,
u.nombrecompleto
from dbusuarios u
inner join tbroles rol ON rol.idrol = u.refroles
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerUsuariosPorId($id) {
$sql = "select idusuario,usuario,password,refroles,email,nombrecompleto from dbusuarios where idusuario =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbusuarios*/


/* PARA Vehiculos */

function insertarVehiculos($patente,$refmodelo,$reftipovehiculo,$anio) {
$sql = "insert into dbvehiculos(idvehiculo,patente,refmodelo,reftipovehiculo,anio)
values ('','".utf8_decode($patente)."',".$refmodelo.",".$reftipovehiculo.",".$anio.")";
$res = $this->query($sql,1);
return $res;
}


function modificarVehiculos($id,$patente,$refmodelo,$reftipovehiculo,$anio) {
$sql = "update dbvehiculos
set
patente = '".utf8_decode($patente)."',refmodelo = ".$refmodelo.",reftipovehiculo = ".$reftipovehiculo.",anio = ".$anio."
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
$sql = "select
v.idvehiculo,
v.patente,
v.refmodelo,
v.reftipovehiculo,
v.anio
from dbvehiculos v
inner join tbmodelo mod ON mod.idmodelo = v.refmodelo
inner join tbmarca ma ON ma.idmarca = mod.refmarca
inner join tbtipovehiculo tip ON tip.idtipovehiculo = v.reftipovehiculo
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVehiculosPorId($id) {
$sql = "select idvehiculo,patente,refmodelo,reftipovehiculo,anio from dbvehiculos where idvehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbvehiculos*/


/* PARA Predio_menu */

function insertarPredio_menu($url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "insert into predio_menu(idmenu,url,icono,nombre,Orden,hover,permiso)
values ('','".utf8_decode($url)."','".utf8_decode($icono)."','".utf8_decode($nombre)."',".$Orden.",'".utf8_decode($hover)."','".utf8_decode($permiso)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarPredio_menu($id,$url,$icono,$nombre,$Orden,$hover,$permiso) {
$sql = "update predio_menu
set
url = '".utf8_decode($url)."',icono = '".utf8_decode($icono)."',nombre = '".utf8_decode($nombre)."',Orden = ".$Orden.",hover = '".utf8_decode($hover)."',permiso = '".utf8_decode($permiso)."'
where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarPredio_menu($id) {
$sql = "delete from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menu() {
$sql = "select
p.idmenu,
p.url,
p.icono,
p.nombre,
p.Orden,
p.hover,
p.permiso
from predio_menu p
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerPredio_menuPorId($id) {
$sql = "select idmenu,url,icono,nombre,Orden,hover,permiso from predio_menu where idmenu =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: predio_menu*/


/* PARA Estados */

function insertarEstados($estado) {
$sql = "insert into tbestados(idestado,estado)
values ('','".utf8_decode($estado)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarEstados($id,$estado) {
$sql = "update tbestados
set
estado = '".utf8_decode($estado)."'
where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEstados($id) {
$sql = "delete from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEstados() {
$sql = "select
e.idestado,
e.estado
from tbestados e
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerEstadosPorId($id) {
$sql = "select idestado,estado from tbestados where idestado =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbestados*/


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
$sql = "select
m.idmarca,
m.marca,
m.activo
from tbmarca m
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerMarcaPorId($id) {
$sql = "select idmarca,marca,activo from tbmarca where idmarca =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbmarca*/


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
$sql = "select
m.idmodelo,
m.modelo,
m.refmarca,
m.activo
from tbmodelo m
inner join tbmarca mar ON mar.idmarca = m.refmarca
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerModeloPorId($id) {
$sql = "select idmodelo,modelo,refmarca,activo from tbmodelo where idmodelo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbmodelo*/


/* PARA Roles */

function insertarRoles($descripcion,$activo) {
$sql = "insert into tbroles(idrol,descripcion,activo)
values ('','".utf8_decode($descripcion)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarRoles($id,$descripcion,$activo) {
$sql = "update tbroles
set
descripcion = '".utf8_decode($descripcion)."',activo = ".$activo."
where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarRoles($id) {
$sql = "delete from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerRoles() {
$sql = "select
r.idrol,
r.descripcion,
r.activo
from tbroles r
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerRolesPorId($id) {
$sql = "select idrol,descripcion,activo from tbroles where idrol =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbroles*/


/* PARA Tipovehiculo */

function insertarTipovehiculo($tipovehiculo,$activo) {
$sql = "insert into tbtipovehiculo(idtipovehiculo,tipovehiculo,activo)
values ('','".utf8_decode($tipovehiculo)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarTipovehiculo($id,$tipovehiculo,$activo) {
$sql = "update tbtipovehiculo
set
tipovehiculo = '".utf8_decode($tipovehiculo)."',activo = ".$activo."
where idtipovehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarTipovehiculo($id) {
$sql = "delete from tbtipovehiculo where idtipovehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerTipovehiculo() {
$sql = "select
t.idtipovehiculo,
t.tipovehiculo,
t.activo
from tbtipovehiculo t
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerTipovehiculoPorId($id) {
$sql = "select idtipovehiculo,tipovehiculo,activo from tbtipovehiculo where idtipovehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbtipovehiculo*/


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
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

function existencia($id,$tabla,$campo,$busquedas,$esCadena) {
	if ($esCadena == 1) {
		$sql = "select ".$id." from ".$tabla." where ".$campo." = '".str_replace(' ','',trim($busquedas))."'";	
	} else {
		$sql = "select ".$id." from ".$tabla." where ".$campo." = ".$busquedas;	
	}
	
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		return true;	
	}
	return false;
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
order by concat(c.apellido,' ',c.nombre)";
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

function insertarClientevehiculos($refclientes,$refvehiculos,$activo) {
$sql = "insert into dbclientevehiculos(idclientevehiculo,refclientes,refvehiculos,activo)
values ('',".$refclientes.",".$refvehiculos.",".$activo.")";
$res = $this->query($sql,1);
return $res;

}


function modificarClientevehiculos($id,$refclientes,$refvehiculos,$activo) {
$sql = "update dbclientevehiculos
set
refclientes = ".$refclientes.",refvehiculos = ".$refvehiculos.",activo = ".$activo."
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
concat(cli.apellido,' ',cli.nombre,', Dni: ',cast(cli.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',veh.patente) as vehiculo,
veh.anio,
c.activo
from dbclientevehiculos c
inner join dbclientes cli ON cli.idcliente = c.refclientes
inner join dbvehiculos veh ON veh.idvehiculo = c.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = veh.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
inner join tbtipovehiculo ti ON ti.idtipovehiculo = veh.reftipovehiculo
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerClientevehiculosPorId($id) {
$sql = "select idclientevehiculo,refclientes,refvehiculos,activo from dbclientevehiculos where idclientevehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

function traerClientevehiculosPorClienteVehiculo($idCliente,$idVehiculo) {
$sql = "select idclientevehiculo,refclientes,refvehiculos,activo from dbclientevehiculos where refclientes =".$idCliente." and refvehiculos =".$idVehiculo;
$res = $this->query($sql,0);
return $res;
}


function traerClientevehiculosPorVehiculo($idVehiculo) {
$sql = "select idclientevehiculo,refclientes,refvehiculos,activo from dbclientevehiculos where refvehiculos =".$idVehiculo;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbclientevehiculos*/


/* PARA Ordenes */

function insertarOrdenes($numero,$refclientevehiculos,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion,$refestados,$precio,$anticipo) {
$sql = "insert into dbordenes(idorden,numero,refclientevehiculos,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion,refestados,precio,anticipo)
values ('','".utf8_decode($numero)."',".$refclientevehiculos.",'".date('Y-m-d')."','".($fechamodi)."','".utf8_decode($usuacrea)."','".utf8_decode($usuamodi)."','".utf8_decode($detallereparacion)."',".$refestados.",".$precio.",".$anticipo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenes($id,$numero,$refclientevehiculos,$fechacrea,$fechamodi,$usuacrea,$usuamodi,$detallereparacion,$refestados,$precio,$anticipo) {
$sql = "update dbordenes
set
numero = '".utf8_decode($numero)."',refclientevehiculos = ".$refclientevehiculos.",fechacrea = '".($fechacrea)."',fechamodi = '".($fechamodi)."',usuacrea = '".utf8_decode($usuacrea)."',usuamodi = '".utf8_decode($usuamodi)."',detallereparacion = '".utf8_decode($detallereparacion)."',refestados = ".$refestados.",precio = ".$precio.",anticipo = ".$anticipo."
where idorden =".$id;
$res = $this->query($sql,0);
return $res;
} 


function eliminarOrdenes($id) {
	// elimino los responsables
	$this->eliminarOrdenesresponsablesPorOrden($id);
	//elimino los pagos	
	$this->eliminarPagosPorOrden($id);
	
	//elimino la orden	
	$sql = "delete from dbordenes where idorden =".$id;
	$res = $this->query($sql,0);
	return $res;
}

function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}

function generarNroOrden() {
	$sql = "select idorden from dbordenes order by idorden desc limit 1";
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		$c = $this->zerofill(mysql_result($res,0,0)+1,6);
		return "ORD".$c;
	}
	return "ORD000001";
}

function finalizarOrden($idOrden,$usuario) {
	$sql = "update dbordenes set refestados = 1,fechamodi = '".date('Y-m-d')."',usuamodi = '".utf8_decode($usuario)."' where idorden =".$idOrden;
	$res = $this->query($sql,0);	
	return $res;
}

function traerOrdenes() {
$sql = "select
o.idorden,
o.numero,
concat(cl.apellido,' ',cl.nombre,', Dni:',cast(cl.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',ve.patente) as vehiculo,
ve.anio,
DATE_FORMAT(o.fechacrea,'%Y-%m-%d'),
o.detallereparacion,
o.precio,
o.anticipo,
est.estado,
o.fechamodi,
o.usuacrea,
o.usuamodi,
o.refclientevehiculos,
o.refestados
from dbordenes o
inner join dbclientevehiculos cli ON cli.idclientevehiculo = o.refclientevehiculos
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = ve.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
inner join tbestados est ON est.idestado = o.refestados
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesActivos() {
$sql = "select
o.idorden,
o.numero,
concat(cl.apellido,' ',cl.nombre,', Dni:',cast(cl.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',ve.patente) as vehiculo,
DATE_FORMAT(o.fechacrea,'%Y-%m-%d') as fecha,
o.detallereparacion,
o.precio,
(o.precio - coalesce(pp.monto,0) - coalesce(o.anticipo,0)) as saldo,
est.estado,
o.fechamodi,
o.usuacrea,
o.usuamodi,
o.refclientevehiculos,
o.refestados
from dbordenes o
inner join dbclientevehiculos cli ON cli.idclientevehiculo = o.refclientevehiculos
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = ve.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
inner join tbestados est ON est.idestado = o.refestados
left join (select sum(pago) as monto,refordenes from dbpagos group by refordenes) pp ON pp.refordenes = o.idorden
where	est.estado != 'Finalizado'
order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesMora() {
$sql = "select
o.idorden,
o.numero,
concat(cl.apellido,' ',cl.nombre,', Dni:',cast(cl.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',ve.patente) as vehiculo,
DATE_FORMAT(o.fechacrea,'%Y-%m-%d') as fecha,
o.detallereparacion,
o.precio,
(o.precio - coalesce(pp.monto,0) - coalesce(o.anticipo,0)) as saldo,
est.estado,
o.fechamodi,
o.usuacrea,
o.usuamodi,
o.refclientevehiculos,
o.refestados
from dbordenes o
inner join dbclientevehiculos cli ON cli.idclientevehiculo = o.refclientevehiculos
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = ve.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
inner join tbestados est ON est.idestado = o.refestados
left join (select sum(pago) as monto,refordenes from dbpagos group by refordenes) pp ON pp.refordenes = o.idorden
where	est.estado = 'Finalizado' and coalesce(pp.monto,0) < o.precio
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesPorId($id) {
$sql = "select idorden,numero,refclientevehiculos,fechacrea,fechamodi,usuacrea,usuamodi,detallereparacion,refestados,precio from dbordenes where idorden =".$id;
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
values ('','".utf8_decode(strtoupper($patente))."',".$refmodelo.",".$reftipovehiculo.",".$anio.")";
$res = $this->query($sql,1);
return $res;
}


function modificarVehiculos($id,$patente,$refmodelo,$reftipovehiculo,$anio) {
$sql = "update dbvehiculos
set
patente = '".utf8_decode(strtoupper($patente))."',refmodelo = ".$refmodelo.",reftipovehiculo = ".$reftipovehiculo.",anio = ".$anio."
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


function traerVehiculosClientes() {
$sql = "select
v.idvehiculo,
v.patente,
concat(cc.apellido,' ',cc.nombre) as titular,
ma.marca,
mo.modelo,
tip.tipovehiculo,
v.anio
from dbvehiculos v
inner join tbmodelo mo ON mo.idmodelo = v.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
inner join tbtipovehiculo tip ON tip.idtipovehiculo = v.reftipovehiculo
inner join dbclientevehiculos cv on cv.refvehiculos = v.idvehiculo
inner join dbclientes cc on cv.refclientes = cc.idcliente
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerVehiculosPorId($id) {
$sql = "select idvehiculo,patente,refmodelo,reftipovehiculo,anio from dbvehiculos where idvehiculo =".$id;
$res = $this->query($sql,0);
return $res;
}

function existePatente($patente) {
	$sql = "select idvehiculo from dbvehiculos where patente = '".str_replace(' ','',trim($patente))."'";	
	$res = $this->query($sql,0);
	if (mysql_num_rows($res)>0) {
		return true;	
	}
	return false;
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

function insertarMarca($marca) {
$sql = "insert into tbmarca(idmarca,marca)
values ('','".utf8_decode($marca)."',".$activo.")";
$res = $this->query($sql,1);
return $res;
}


function modificarMarca($id,$marca) {
$sql = "update tbmarca
set
marca = '".utf8_decode($marca)."'
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
m.marca
from tbmarca m
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerMarcaPorId($id) {
$sql = "select idmarca,marca from tbmarca where idmarca =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: tbmarca*/


/* PARA Modelo */

function insertarModelo($modelo,$refmarca) {
$sql = "insert into tbmodelo(idmodelo,modelo,refmarca)
values ('','".utf8_decode($modelo)."',".$refmarca.")";
$res = $this->query($sql,1);
return $res;
}


function modificarModelo($id,$modelo,$refmarca) {
$sql = "update tbmodelo
set
modelo = '".utf8_decode($modelo)."',refmarca = ".$refmarca."
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
mar.marca
from tbmodelo m
inner join tbmarca mar ON mar.idmarca = m.refmarca
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerModeloPorId($id) {
$sql = "select idmodelo,modelo,refmarca from tbmodelo where idmodelo =".$id;
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


/* PARA Empleados */

function insertarEmpleados($apellido,$nombre,$nrodocumento,$fechanacimiento,$cuil,$telefono,$telefonofijo,$direccion,$email) {
$sql = "insert into dbempleados(idempleado,apellido,nombre,nrodocumento,fechanacimiento,cuil,telefono,telefonofijo,direccion,email)
values ('','".utf8_decode($apellido)."','".utf8_decode($nombre)."','".utf8_decode($nrodocumento)."','".utf8_decode($fechanacimiento)."','".utf8_decode($cuil)."','".utf8_decode($telefono)."','".utf8_decode($telefonofijo)."','".utf8_decode($direccion)."','".utf8_decode($email)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarEmpleados($id,$apellido,$nombre,$nrodocumento,$fechanacimiento,$cuil,$telefono,$telefonofijo,$direccion,$email) {
$sql = "update dbempleados
set
apellido = '".utf8_decode($apellido)."',nombre = '".utf8_decode($nombre)."',nrodocumento = '".utf8_decode($nrodocumento)."',fechanacimiento = '".utf8_decode($fechanacimiento)."',cuil = '".utf8_decode($cuil)."',telefono = '".utf8_decode($telefono)."',telefonofijo = '".utf8_decode($telefonofijo)."',direccion = '".utf8_decode($direccion)."',email = '".utf8_decode($email)."'
where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarEmpleados($id) {
$sql = "delete from dbempleados where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}


function traerEmpleados() {
$sql = "select
e.idempleado,
e.apellido,
e.nombre,
e.nrodocumento,
e.fechanacimiento,
e.cuil,
e.telefono,
e.telefonofijo,
e.direccion,
e.email
from dbempleados e
order by 1";
$res = $this->query($sql,0);
return $res;
}


function traerEmpleadosPorId($id) {
$sql = "select idempleado,apellido,nombre,nrodocumento,fechanacimiento,cuil,telefono,telefonofijo,direccion,email from dbempleados where idempleado =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbempleados*/


/* PARA Ordenesresponsables */

function insertarOrdenesresponsables($refordenes) {
$sql = "insert into dbordenesresponsables(idordenresponsables,refordenes)
values ('',".$refordenes.")";
$res = $this->query($sql,1);
return $res;
}


function modificarOrdenesresponsables($id,$refordenes) {
$sql = "update dbordenesresponsables
set
refordenes = ".$refordenes."
where idordenresponsables =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarOrdenesresponsables($id) {
$sql = "delete from dbordenesresponsables where idordenresponsables =".$id;
$res = $this->query($sql,0);
return $res;
}

function eliminarOrdenesresponsablesPorOrden($orden) {
$sql = "delete from dbordenesresponsables where refordenes =".$orden;
$res = $this->query($sql,0);
return $res;
}


function traerOrdenesresponsables() {
$sql = "select
o.idordenresponsables,
o.refordenes
from dbordenesresponsables o
inner join dbordenes ord ON ord.idorden = o.refordenes
inner join dbclientevehiculos cl ON cl.idclientevehiculo = ord.refclientevehiculos
inner join tbestados es ON es.idestado = ord.refestados
order by 1";
$res = $this->query($sql,0);
return $res;
}



function traerOrdenesresponsablesPorId($id) {
$sql = "select idordenresponsables,refordenes from dbordenesresponsables where idordenresponsables =".$id;
$res = $this->query($sql,0);
return $res;
}

/* Fin */
/* /* Fin de la Tabla: dbordenesresponsables*/


/* PARA Pagos */

function insertarPagos($refordenes,$pago,$fechapago) { 
$sql = "insert into dbpagos(idpago,refordenes,pago,fechapago) 
values ('',".$refordenes.",".$pago.",'".utf8_decode($fechapago)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarPagos($id,$refordenes,$pago,$fechapago) { 
$sql = "update dbpagos 
set 
refordenes = ".$refordenes.",pago = ".$pago.",fechapago = '".utf8_decode($fechapago)."' 
where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarPagos($id) { 
$sql = "delete from dbpagos where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
}


function eliminarPagosPorOrden($orden) { 
$sql = "delete from dbpagos where refordenes =".$orden; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerPagos() { 
$sql = "select 
p.idpago,
concat(cl.apellido,' ',cl.nombre,', Dni:',cast(cl.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',ve.patente) as vehiculo,
ord.numero,
p.pago,
p.fechapago,
es.estado,
p.refordenes
from dbpagos p 
inner join dbordenes ord ON ord.idorden = p.refordenes 
inner join dbclientevehiculos cli ON cli.idclientevehiculo = ord.refclientevehiculos 
inner join tbestados es ON es.idestado = ord.refestados 
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = ve.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 



function traerPagosPorOrden($idOrden) {
$sql = "select 
p.idpago,
concat(cl.apellido,' ',cl.nombre,', Dni:',cast(cl.nrodocumento as char)) as cliente,
concat(ma.marca,' ',mo.modelo,' - ',ve.patente) as vehiculo,
ord.numero,
p.pago,
p.fechapago,
es.estado,
p.refordenes
from dbpagos p 
inner join dbordenes ord ON ord.idorden = p.refordenes 
inner join dbclientevehiculos cli ON cli.idclientevehiculo = ord.refclientevehiculos 
inner join tbestados es ON es.idestado = ord.refestados 
inner join dbclientes cl ON cl.idcliente = cli.refclientes
inner join dbvehiculos ve ON ve.idvehiculo = cli.refvehiculos
inner join tbmodelo mo ON mo.idmodelo = ve.refmodelo
inner join tbmarca ma ON ma.idmarca = mo.refmarca
where	ord.idorden = ".$idOrden."
order by 1"; 
$res = $this->query($sql,0); 
return $res;

}


function traerPagosPorId($id) { 
$sql = "select idpago,refordenes,pago,fechapago from dbpagos where idpago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: dbpagos*/

/* PARA Configuracion */

function insertarConfiguracion($reftipoidentificaciontributaria,$numero,$razonsocial,$direccion,$ciudad,$telefono,$codigopostal) { 
$sql = "insert into tbconfiguracion(idconfiguracion,reftipoidentificaciontributaria,numero,razonsocial,direccion,ciudad,telefono,codigopostal) 
values ('',".$reftipoidentificaciontributaria.",'".utf8_decode($numero)."','".utf8_decode($razonsocial)."','".utf8_decode($direccion)."','".utf8_decode($ciudad)."','".utf8_decode($telefono)."','".utf8_decode($codigopostal)."')";
$res = $this->query($sql,1); 
return $res; 
} 


function modificarConfiguracion($id,$reftipoidentificaciontributaria,$numero,$razonsocial,$direccion,$ciudad,$telefono,$codigopostal) { 
$sql = "update tbconfiguracion 
set 
reftipoidentificaciontributaria = ".$reftipoidentificaciontributaria.",numero = '".utf8_decode($numero)."',razonsocial = '".utf8_decode($razonsocial)."',direccion = '".utf8_decode($direccion)."',ciudad = '".utf8_decode($ciudad)."',telefono = '".utf8_decode($telefono)."',codigopostal = '".utf8_decode($codigopostal)."' 
where idconfiguracion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarConfiguracion($id) { 
$sql = "delete from tbconfiguracion where idconfiguracion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerConfiguracion() { 
$sql = "select 
c.idconfiguracion,
tip.tipoidentificaciontributaria,
c.numero,
c.razonsocial,
c.direccion,
c.ciudad,
c.telefono,
c.codigopostal
from tbconfiguracion c 
inner join tbtipoidentificaciontributaria tip ON tip.idtipoidentificaciontributaria = c.reftipoidentificaciontributaria 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerConfiguracionPorId($id) { 
$sql = "select idconfiguracion,reftipoidentificaciontributaria,numero,razonsocial,direccion,ciudad,telefono,codigopostal from tbconfiguracion where idconfiguracion =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbconfiguracion*/
    
    
/* PARA Tipoidentificaciontributaria */

function insertarTipoidentificaciontributaria($tipoidentificaciontributaria) { 
$sql = "insert into tbtipoidentificaciontributaria(idtipoidentificaciontributaria,tipoidentificaciontributaria) 
values ('','".utf8_decode($tipoidentificaciontributaria)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoidentificaciontributaria($id,$tipoidentificaciontributaria) { 
$sql = "update tbtipoidentificaciontributaria 
set 
tipoidentificaciontributaria = '".utf8_decode($tipoidentificaciontributaria)."' 
where idtipoidentificaciontributaria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoidentificaciontributaria($id) { 
$sql = "delete from tbtipoidentificaciontributaria where idtipoidentificaciontributaria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoidentificaciontributaria() { 
$sql = "select 
t.idtipoidentificaciontributaria,
t.tipoidentificaciontributaria
from tbtipoidentificaciontributaria t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoidentificaciontributariaPorId($id) { 
$sql = "select idtipoidentificaciontributaria,tipoidentificaciontributaria from tbtipoidentificaciontributaria where idtipoidentificaciontributaria =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipoidentificaciontributaria*/


/* PARA Tipopago */

function insertarTipopago($tipopago) { 
$sql = "insert into tbtipopago(idtipopago,tipopago) 
values ('','".utf8_decode($tipopago)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipopago($id,$tipopago) { 
$sql = "update tbtipopago 
set 
tipopago = '".utf8_decode($tipopago)."' 
where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipopago($id) { 
$sql = "delete from tbtipopago where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipopago() { 
$sql = "select 
t.idtipopago,
t.tipopago
from tbtipopago t 
order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipopagoPorId($id) { 
$sql = "select idtipopago,tipopago from tbtipopago where idtipopago =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

/* Fin */
/* /* Fin de la Tabla: tbtipopago*/

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
<?php 
$BD = new BD();
//Creacion de clientes
function ModCrearCliente($docu,$nomape,$dir,$tel1,$tel2)
{
	global $BD;	
	$BD->conectar(); 
	$docu = trim($docu);
	$nombres =  trim(strtoupper($nomape));
	$dir = trim(strtoupper($dir));
	$tel1 = trim($tel1);
	$tel2 = trim($tel2);


	$sql = "INSERT INTO 
				clientes(
							documento,
							nombres,
							direccion,
							tel1,
							tel2,
							registro
						) 
				VALUES (
							'$docu',
							'$nombres',
							'$dir',
							'$tel1',
							'$tel2',
							NOW()
						)";
	$crearcliente = $BD->consultar($sql);	
	return $crearcliente;
}

//Ceacion de vehiculos
function ModCrearVehiculo($placa,$docu,$modelo,$tipo,$color,$motor)
{
	global $BD;	
	$BD->conectar(); 
	$placa = trim(strtoupper($placa));
	$modelo =  trim(strtoupper($modelo));
	$tipo =  trim(strtoupper($tipo));
	$color =  trim(strtoupper($color));
	$motor =  trim(strtoupper($motor));
	$docu = trim($docu);


	 $sql = "INSERT INTO 
				vehiculos(
							documento,
							placa,
							modelo,
							color,
							motor,
							tipo,
							registro
						) 
				VALUES (
							'$docu',
							'$placa',
							'$modelo',
							'$color',
							'$motor',
							'$tipo',
							NOW()
						)";
	$crearvehiculo = $BD->consultar($sql);	
	return $crearvehiculo;
}

function ModEditacliente($docu,$nomape,$dir,$tel1,$tel2,$id)
{
	global $BD;	
	$BD->conectar(); 
	$docu = trim($docu);
	$nomape =  trim(strtoupper($nomape));
	$dir = trim(strtoupper($dir));
	$tel1 = trim($tel1);
	$tel2 = trim($tel2);

	$sql =
	"UPDATE clientes
		SET 
			documento='$docu',
			nombres='$nomape',
			direccion='$dir',
			tel1='$tel1',
			tel2='$tel2'
	WHERE id='$id'";
	$modificacliente = $BD->consultar($sql);

	return $modificacliente;
}


function ModEditavehiculo($placa,$modelo,$tipo,$color,$motor,$id)
{
	global $BD;	
	$BD->conectar(); 
	$modelo =  trim(strtoupper($modelo));
	$placa =  trim(strtoupper($placa));
	$tipo = trim(strtoupper($tipo));
	$color = trim(strtoupper($color));
	$motor = trim(strtoupper($motor));

	$sql =
	"UPDATE vehiculos
		SET 
			placa='$placa',
			modelo='$modelo',
			color='$color',
			tipo='$tipo',
			motor='$motor'
	WHERE id='$id'";
	$modifivh = $BD->consultar($sql);

	return $modifivh;
}

//Validar si el cliente ya se encuentra registrado
function ModValidarCliente($docu)
{
	global $BD;	
	$BD->conectar(); 
	$docu = trim($docu);
	$sql="SELECT COUNT(*) AS total FROM clientes WHERE documento='$docu'";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}
//Validar si la placa ya esta registrada
function ModValidoPlacas($placa)
{
	global $BD;	
	$BD->conectar(); 
	$placa = trim($placa);
	$sql="SELECT COUNT(*) AS total FROM vehiculos WHERE placa='$placa'";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}
//Consulta los vehiculos registrados a documento
function ModVehiculoCliente($docu)
{
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT * FROM vehiculos WHERE documento='$docu'  ORDER BY registro ASC";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

//Consulta los vehiculos registrados a documento
function ModConsultaCliente($opcion,$valor)
{
	global $BD;	
	$BD->conectar(); 

	switch ($opcion) {
		case 'docu':
			$datosql = "documento='$valor'";
		break;
		
		case 'placa':
			$datosql = "documento IN (SELECT documento FROM vehiculos WHERE placa='$valor')";
		break;
	}

	$sql="SELECT * FROM clientes WHERE $datosql  ORDER BY registro ASC";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

//Consulta los vehiculos registrados a documento
function ModConsultaVehiculo($placa,$id)
{
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT * FROM vehiculos WHERE placa='$placa'";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

//Elimina la placa
function EliminarPlaca($id)
{
	global $BD;	
	$BD->conectar(); 
	$sql="DELETE FROM vehiculos WHERE id='$id'";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

?>
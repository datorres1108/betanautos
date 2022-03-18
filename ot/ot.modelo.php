<?php 
// function Listadocitas()
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$fecha =  date("Y-m-d");
// 	$time1 = date("H:i");
// 	$sql="SELECT * FROM config_citas WHERE id NOT IN (SELECT id_confcita FROM asig_citas WHERE fecha='$fecha' and tipo='Dia') and descri >'$time1'";
// 	$clientes = $BD->consultar($sql);	
// 	return $clientes;
// }

// function Listadohoras($fecha)
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	//$fecha =  date("Y-m-d");
// 	$sql="SELECT id,descri FROM config_citas WHERE id NOT IN (SELECT id_confcita FROM asig_citas WHERE fecha='$fecha' and tipo='Pro')";
// 	$clientes = $BD->consultar($sql);	
// 	return $clientes;
// }

function Consultar_cliente($documento)
{
	global $BD;	
	$BD->conectar(); 
	$documento = trim($documento);
	$sql="SELECT * FROM clientes WHERE documento='$documento'";
	$clientes = $BD->consultar($sql);	
	return $clientes;
}

function ToatalVehiculos($documento)
{
	global $BD;	
	$BD->conectar(); 
	$placa = trim($placa);
	$sql="SELECT COUNT(*) AS total FROM vehiculos WHERE documento='$documento'";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

function ConsuVhdocu($documento)
{
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT * FROM vehiculos WHERE documento='$documento'";
	$vehiculo = $BD->consultar($sql);	
	return $vehiculo;
}

function Consultar_vehiculos($placa)
{
	global $BD;	
	$BD->conectar(); 
	$placa =  trim(strtoupper($placa));
	$sql="SELECT * FROM vehiculos WHERE placa='$placa'";
	$vehiculos = $BD->consultar($sql);	
	return $vehiculos;
}


function comprobante()
{
	global $BD;	
	$BD->conectar(); 
	$sql="SELECT ultimo FROM comprobantes WHERE comprobante = 'OR'";
	$clientes = $BD->consultar($sql);	
	while(!$clientes->EOF)
	{
			$ultimo = (intval($clientes->fields["ultimo"]) + 1);

			$modif =
			"UPDATE comprobantes
				SET 
				ultimo='$ultimo'
			WHERE comprobante='OR'";
			$modificacliente = $BD->consultar($modif);
		$clientes->MoveNext();   
	}

	return "OR-".$ultimo;
}

function CrearOrden($compro,$placa,$kilometros,$gasolina,$consentimiento,$json_arrayinve)
{
	global $BD;	
	$BD->conectar(); 
	$compro = trim($compro);
	$compro = explode('-',$compro);
	$comprobate = $compro[0];
	$nrocompro = $compro[1];

	$placa =  trim(strtoupper($placa));
	$kilometros = trim($kilometros);
	$gasolina = trim($gasolina);


	 $sql = "INSERT INTO 
				movimientos(
							comprobante,
							numero,
							placa,
							kilometros,
							combustible,
							nota,
							conserva_pieza,
							inventario,
							fecha,
							estado
						) 
				VALUES (
							'$comprobate',
							'$nrocompro',
							'$placa',
							'$kilometros',
							'$gasolina',
							'',
							'$consentimiento',
							'$json_arrayinve',
							NOW(),
							'1'
						)";
	$movimientos = $BD->consultar($sql);	
	return $movimientos;
}

function CrearTPtrabajo($comprobate,$nrocompro,$tipotrabajo,$codigotrabajo,$partevehiculo)
{
	global $BD;	
	$BD->conectar(); 


	$tipotrabajo =  trim(strtoupper($tipotrabajo));
	$codigotrabajo = trim($codigotrabajo);
	$partevehiculo =  trim(strtoupper($partevehiculo));

	 $sql = "INSERT INTO 
				tipotra_movi(
							comprobante,
							numero,
							tipo_trabajo,
							parte,
							descri_trabajo
						) 
				VALUES (
							'$comprobate',
							'$nrocompro',
							'$tipotrabajo',
							'$codigotrabajo',
							'$partevehiculo'
						)";
	$movimientos = $BD->consultar($sql);	
	return $movimientos;
}

function ConsultarTrabajos($orden)
{
	global $BD;	
	$BD->conectar(); 
	$orden =  trim($orden);
	$sql="SELECT * FROM tipotra_movi WHERE comprobante='OR' AND numero='$orden'";
	$vehiculos = $BD->consultar($sql);	
	return $vehiculos;
}

// function asigna_citapro($celular,$nomape,$fechacita,$hora)
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$celular = trim($celular);
// 	$nomape =  trim(strtoupper($nomape));
// 	$fechacita = trim($fechacita);
// 	$hora = trim($hora);

// 	$inset_sql = "INSERT INTO asig_citas(id_confcita,celular,nombre,fecha,tipo) 
// 				VALUES ('$hora','$celular','$nomape','$fechacita','Pro')";
// 	$res_isert = $BD->consultar($inset_sql);

// 	return $res_isert;
// }

// function citasdeldia()
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$fecha =  date("Y-m-d");
// 	$sql="
// 	SELECT a.id,a.id_confcita,a.nombre,c.descri as hora FROM asig_citas as a 
// 	INNER JOIN config_citas c On (c.id=a.id_confcita)
// 	WHERE a.fecha='$fecha' and a.tipo='Dia'";
// 	$res = $BD->consultar($sql);	
// 	return $res;
// }

// function CitasPro()
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$fecha =  date("Y-m-d");
// 	$sql="
// 	SELECT a.id,a.id_confcita,a.nombre,c.descri as hora,a.fecha FROM asig_citas as a 
// 	INNER JOIN config_citas c On (c.id=a.id_confcita)
// 	WHERE a.fecha>='$fecha' and a.tipo='Pro'";
// 	$res = $BD->consultar($sql);	
// 	return $res;
// }

// function Cancela_CitaDia($id)
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$sql="DELETE FROM asig_citas WHERE id = '$id' and tipo='Dia'";
// 	$res = $BD->consultar($sql);	
// 	return $res;
// }

// function Cancela_CitaPro($id)
// {
// 	global $BD;	
// 	$BD->conectar(); 
// 	$sql="DELETE FROM asig_citas WHERE id = '$id' and tipo='Pro'";
// 	$res = $BD->consultar($sql);	
// 	return $res;
// }

?>
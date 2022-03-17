<?php
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();
//funcion ppal que carga el programa inicial formulario de registros de ordenes de reparacion
function Form_Or()
{

	 global $objResponse;	
     global $BD;    

	 $comprobate = comprobante();

	 $data=' 
			<form class="form-inline" name="crear_or" id="crear_or">
				<div class="form-group">
					<h4><i class="fa-solid fa-user"></i> <b>Informaci&oacute;n del cliente</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Documento del Cliente:</b><br>
					<input type="text" name="docu" id="docu" style="border: 2px solid #ff6666;"  size="30%" class="form-control" onKeyPress="return SoloNumeros(event)"; onchange="xajax_buscacliente(this.value)">
				</div>
				<div class="form-group">
					<b>Nombres y Apellidos:</b><br>
					<input type="text" name="nomape" id="nomape"   size="30%" style="border: 2px solid #ff6666;" class="form-control" >
				</div>
				<br>
				<div class="form-group">
					<b>Direcci&oacute;n:</b><br>
					<input type="text" name="dir" id="dir"  size="40%" class="form-control">
				</div>
				<div class="form-group">
					<b>Tel. Fijo o Celular1:</b><br>
					<input type="text" name="tel1" id="tel1"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);">
				</div>
				<div class="form-group">
					<b>Tel. Fijo o Celular2:</b><br>
					<input type="text" name="tel2" id="tel2"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);">
				</div>
				<hr>
				<div class="form-group">
					<h4><i class="fa-solid fa-car-side"></i> <b>Informaci&oacute;n del Veh&iacute;culo</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Placa:</b><br>
					<input type="text" name="placa" id="placa" style="border: 2px solid #ff6666;"  size="10%" class="form-control" onkeyup="mayus(this);" onchange="xajax_buscaplaca(this.value)">
				</div>
				<div class="form-group">
					<b>Modelo:</b><br>
					<input type="text" name="modelo" id="modelo" size="40%"  class="form-control" >
				</div>
				<div class="form-group">
					<b>Tipo:</b><br>
					<input type="text" name="tipo" id="tipo"   size="30%"  class="form-control" >
				</div>
				<br>
				<div class="form-group">
				<b>Color:</b><br>
					<input type="text" name="color" id="color" size="10%" class="form-control">
				</div>
				<div class="form-group">
					<b>Nro Motor:</b><br>
					<input type="text" name="motor" id="motor"  size="40%"  class="form-control" >
				</div>
				<div class="form-group">
					<b>Kilometraje:</b><br>
					<input type="text" name="kilometros" id="kilometros"   size="30%"  class="form-control" >
				</div>
				<div class="form-group">
					<b>Combustible:</b><br>
					<select name="gasolina" id="gasolina" class="form-control">
						<option value=""> Seleccione</option>
						<option value="1/4"> 1/4 Un cuarto de galon</option>
						<option value="1/2"> 1/2 Medio galon</option>
						<option value="3/4"> 3/4 Tres cuartos de galon</option>
					</select>
				</div>
				<br>
				<div class="form-group">
					<b>Desea el cliente (Excepto las piezas de garant&iacute;a) conservar las piezas cambiadas?</b><br>
					SI <input type="radio" id="si" name="consentimiento" value="si">  
					NO <input type="radio" id="no" name="consentimiento" value="no">
				</div><h5>
				<hr>
				<div class="form-group">
					<h4><i class="fa-solid fa-car-side"></i> <b>Inventario del vehiculo</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Todo Ok</b> <input type="checkbox" id="todos" name="todos" value="ok">
					<br>
					Reloj <input type="checkbox" id="reloj" name="reloj" value="reloj">
					Radio Caratula <input type="checkbox" id="radio" name="radio" value="radio">
					CDs-Cassettes <input type="checkbox" id="cds"  name="cds" value="cds">
					Encendedor <input type="checkbox" id="encendedor" name="encendedor" value="encendedor">
					Cenicero <input type="checkbox" id="cenicero" name="cenicero" value="cenicero">
					Forros <input type="checkbox" id="forros" name="forros" value="forros">
					Tapetes <input type="checkbox" id="tapetes" name="tapetes" value="tapetes">
					Parasoles <input type="checkbox" id="parasoles" name="parasoles" value="parasoles">
					Manijas <input type="checkbox" id="manijas" name="manijas" value="manijas">
					Cinturones Seg <input type="checkbox" id="cinturones" name="cinturones" value="cinturones">
					Copas Ruedas <input type="checkbox" id="copas" name="copas" value="copas">
					Extinguidor <input type="checkbox" id="extinguidor" name="extinguidor" value="extinguidor">
					Farolas <input type="checkbox" id="farolas" name="farolas" value="farolas">
					Espejos <input type="checkbox" id="espejos" name="espejos" value="espejos">
					Antenas <input type="checkbox" id="antenas" name="antenas" values="antenas">
					Exploradoras <input type="checkbox" id="exploradoras" name="exploradoras" value="exploradoras">
					Emblemas <input type="checkbox" id="emblemas" name="emblemas" values="emblemas">
					Cuchillas Limpia <input type="checkbox" id="cuchillas" name="cuchillas" value="cuchillas">
					Llavero <input type="checkbox" id="llaveros" name="llaveros" values="llaveros">
					Gato Palanca <input type="checkbox" id="gato" name="gato" value="gato">
					Herramienta <input type="checkbox" id="herramienta" name="herramienta" value="herramienta">
					Rueda Repuesto <input type="checkbox" id="ruedar" name="ruedar" value="ruedar">
					Tercer Stop <input type="checkbox" id="tstop" name="tstop" value="tstop">
					Equipo Carretera <input type="checkbox" id="equipoc" name="equipoc" value="equipoc">
					Stops <input type="checkbox" id="stops" name="stops" value="stops">
				</div>
				<hr>
				<div class="form-group">
					<h4> <i class="fa-solid fa-list"></i> <b> Descripci&oacute;n de los trabajos</b> </h4>
				</div>
				<br>
				<div class="form-group">
					Golpe <input type="radio" id="golpe" name="tipotrabajo" value="golpe">  
					Raya  	<input type="radio" id="raya" name="tipotrabajo" value="raya">
				</div>
				<br>
				<div class="form-group">
					<img src="img/partes.JPG" alt="Partes vehiculo" width="50%" height="70%">
				</div>
				<br>
				<div class="form-group">
					<select name="codigotrabajo" id="codigotrabajo" class="form-control">
						<option value="1">Parte Vehiculo 1</option>
						<option value="2">Parte Vehiculo 2</option>
						<option value="3">Parte Vehiculo 3</option>
						<option value="4">Parte Vehiculo 4</option>
						<option value="5">Parte Vehiculo 5</option>
						<option value="6">Parte Vehiculo 6</option>
						<option value="7">Parte Vehiculo 7</option>
						<option value="8">Parte Vehiculo 8</option>
						<option value="9">Parte Vehiculo 9</option>
						<option value="10">Parte Vehiculo 10</option>
						<option value="11">Parte Vehiculo 11</option>
						<option value="12">Parte Vehiculo 12</option>
						<option value="13">Parte Vehiculo 13</option>
						<option value="14">Parte Vehiculo 14</option>
						<option value="15">Parte Vehiculo 15</option>
						<option value="16">Parte Vehiculo 16</option>
						<option value="17">Parte Vehiculo 17</option>
						<option value="18">Parte Vehiculo 18</option>
						<option value="19">Parte Vehiculo 19</option>
						<option value="20">Parte Vehiculo 20</option>
						<option value="0">Otro</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" name="partevehiculo" id="partevehiculo"   size="70%"  class="form-control" >
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-info"><i class="fa-solid fa-circle-down"></i> Agregar</button>
				</div>
			</form>
			<br><br>  
			<div class="form-group">
				<span class="btn btn-success" id="btn-crear" onClick="BtnGuardarOR(\''.$comprobate.'\')" >
					<i class="glyphicon glyphicon-floppy-disk" ></i><strong> Guardar Orden</strong>
				</span>                    
			</div>

	';

	 $objResponse->Assign("form_or", "innerHTML", utf8_decode($data));
 return $objResponse;

}
$xajax->registerFunction('Form_Or');

function buscacliente($documento)
{
    global $objResponse;
    global $BD; 

    $consultar = Consultar_cliente($documento);
        if($BD->numreg($consultar)>0)
        {   
			//consultamos los vehiculos asociados al docuemnto.
			$vehiculos = ToatalVehiculos($documento);
			while(!$vehiculos->EOF)
			{
				 $totalregistros = trim($vehiculos->fields["total"]);          
				 if($totalregistros>1)
				 {
					  $objResponse->Script("alerta('<strong>El cliente con numero de documento $documento tiene mas de dos vehiculos registrados, por favor digita la placa de alguno de los vehiculos</strong>')");
				 }else
				 {
					//Datos del vehiculo
					$ConsultaVehiculo = ConsuVhdocu($documento);
					while(!$ConsultaVehiculo->EOF)
					{
							$placa = trim($ConsultaVehiculo->fields["placa"]);
							$motor = trim($ConsultaVehiculo->fields["motor"]);
							$tipo = trim($ConsultaVehiculo->fields["tipo"]);
							$modelo = trim($ConsultaVehiculo->fields["modelo"]);
							$color = trim($ConsultaVehiculo->fields["color"]);
							$objResponse->Assign("placa","value",$placa);
							$objResponse->Assign("modelo","value",$modelo);
							$objResponse->Assign("tipo","value",$tipo);
							$objResponse->Assign("motor","value",$motor);
							$objResponse->Assign("color","value",$color);
						$ConsultaVehiculo->MoveNext(); 
					}
				 }		
			$vehiculos->MoveNext();   
			}	 
			//Datos del cliente
			while(!$consultar->EOF)
			{
					$nombres = trim($consultar->fields["nombres"]);
					$direccion = trim($consultar->fields["direccion"]);
					$tel1 = trim($consultar->fields["tel1"]);
					$tel2 = trim($consultar->fields["tel2"]);
					$objResponse->Assign("nomape","value",$nombres);
					$objResponse->Assign("dir","value",$direccion);
					$objResponse->Assign("tel1","value",$tel1);
					$objResponse->Assign("tel2","value",$tel2);
				$consultar->MoveNext();   
			}
        }
		else
		{
			$objResponse->Assign("nomape","value","");
			$objResponse->Assign("dir","value","");
			$objResponse->Assign("tel1","value","");
			$objResponse->Assign("tel2","value","");
        }

 	return $objResponse;

}
$xajax->registerFunction('buscacliente');

function buscaplaca($placa)
{
    global $objResponse;
    global $BD; 

    	$consultar = Consultar_vehiculos($placa);
        if($BD->numreg($consultar)>0)
        {   
			//Datos del cliente
			while(!$consultar->EOF)
			{
					$placa = trim($consultar->fields["placa"]);
					$tipo = trim($consultar->fields["tipo"]);
					$modelo = trim($consultar->fields["modelo"]);
					$color = trim($consultar->fields["color"]);
					$motor = trim($consultar->fields["motor"]);
					$objResponse->Assign("placa","value",$placa);
					$objResponse->Assign("modelo","value",$modelo);
					$objResponse->Assign("tipo","value",$tipo);
					$objResponse->Assign("motor","value",$motor);
					$objResponse->Assign("color","value",$color);
				$consultar->MoveNext();   
			}
        }
		else
		{
			$objResponse->Assign("placa","value","");
			$objResponse->Assign("modelo","value","");
			$objResponse->Assign("tipo","value","");
			$objResponse->Assign("motor","value","");
			$objResponse->Assign("color","value","");
        }


 	return $objResponse;

}
$xajax->registerFunction('buscaplaca');


function GuardarOr($form,$compro)
{
    global $objResponse;
    global $BD; 
	include_once("clientes/clientes.modelo.php");
	//print_r($form);
    $docu   =   trim($form['docu']);
    $nomape =   trim($form['nomape']);
    $dir    =   trim($form['dir']);
    $tel1   =   trim($form['tel1']);
    $tel2   =   trim($form['tel2']);

	$placa   =   trim($form['placa']);
    $modelo =   trim($form['modelo']);
    $tipo    =   trim($form['tipo']);
    $color   =   trim($form['color']);
    $motor   =   trim($form['motor']);

	$gasolina   =   trim($form['gasolina']);
	$kilometros   =   trim($form['kilometros']);
    $consentimiento =   trim($form['consentimiento']);
    $todos    =   trim($form['todos']);
    $reloj   =   trim($form['reloj']);
    $radio   =   trim($form['radio']);
	$cds   =   trim($form['cds']);
    $encendedor =   trim($form['encendedor']);
    $cenicero    =   trim($form['cenicero']);
    $forros   =   trim($form['forros']);
    $tapetes   =   trim($form['tapetes']);
	$parasoles   =   trim($form['parasoles']);
    $manijas =   trim($form['manijas']);
    $cinturones    =   trim($form['cinturones']);
    $copas   =   trim($form['copas']);
	$extinguidor   =   trim($form['extinguidor']);
	$farolas   =   trim($form['farolas']);
	$espejos   =   trim($form['espejos']);
	$antenas   =   trim($form['antenas']);
	$exploradoras   =   trim($form['exploradoras']);
	$emblemas   =   trim($form['emblemas']);
	$cuchillas   =   trim($form['cuchillas']);
	$llaveros   =   trim($form['llaveros']);
	$gato   =   trim($form['gato']);
	$ruedar   =   trim($form['ruedar']);
	$tstop   =   trim($form['tstop']);
	$equipoc   =   trim($form['equipoc']);
	$stops   =   trim($form['stops']);
	$tipotrabajo   =   trim($form['tipotrabajo']);
	$herramienta   =   trim($form['herramienta']);
	$codigotrabajo   =   trim($form['codigotrabajo']);
	$partevehiculo   =   trim($form['partevehiculo']);
	
	$consultar = Consultar_cliente($docu);
	if($BD->numreg($consultar)>0)
	{   
		//Modificaciones de clientes
		while(!$consultar->EOF)
		{
				$id = trim($consultar->fields["id"]);
				$edita_cliente = ModEditacliente($docu,$nomape,$dir,$tel1,$tel2,$id); //Funcion modulo clientes
			$consultar->MoveNext();   
		}
		
		$vehiculos = Consultar_vehiculos($placa);
		if($BD->numreg($vehiculos)>0)
		{  
			//Modificaciones vehiculos
			while(!$vehiculos->EOF)
			{
					$id = trim($vehiculos->fields["id"]);
					$ModificamosVehiculo = ModEditavehiculo($placa,$modelo,$tipo,$color,$motor,$id); //Funcion modulo clientes
				$vehiculos->MoveNext();   
			}
			
		}
		else
		{
			//Inserta Vehiculos
			$insertovehiculo = ModCrearVehiculo($placa,$docu,$modelo,$tipo,$color,$motor);//Funcion modulo clientes
		}
	}
	else
	{
		//Inserta clientes
		$crear_cliente = ModCrearCliente($docu,$nomape,$dir,$tel1,$tel2);//Funcion modulo clientes
		$vehiculos = Consultar_vehiculos($placa);
		if($BD->numreg($vehiculos)>0)
		{  
			//Modificaciones vehiculos
			while(!$vehiculos->EOF)
			{
					$id = trim($vehiculos->fields["id"]);
					$ModificamosVehiculo = ModEditavehiculo($placa,$modelo,$tipo,$color,$motor,$id); //Funcion modulo clientes
				$vehiculos->MoveNext();   
			}
			
		}
		else
		{
			//Inserta Vehiculos
			$insertovehiculo = ModCrearVehiculo($placa,$docu,$modelo,$tipo,$color,$motor);//Funcion modulo clientes
		}
	}


	$CrearOR = CrearOrden($compro,$placa,$kilometros,$gasolina);
	if(is_iterable($CrearOR))
	{
		$objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente la orden de trabajo</strong></h5>')");
		$objResponse->Script("xajax_EditarVehiculo('$placa','$id');"); 
	}
	else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	}

 	return $objResponse;
}
$xajax->registerFunction('GuardarOr');

function Traenom2($cel)
{
    global $objResponse;
    global $BD; 
    $consultar = Consultar_cliente($cel);
        if($BD->numreg($consultar)>0)
        {   
            while(!$consultar->EOF)
            {
                $nombres = trim($consultar->fields["nombres"]);
                $objResponse->Assign("nomape","value",$nombres);
            $consultar->MoveNext();   
            }
        }else{
        	$objResponse->Assign("nomape","value","");
        }

 return $objResponse;
}
$xajax->registerFunction('Traenom2');

function hora($fecha)
{
    global $objResponse;
    global $BD; 
    $consultar = Listadohoras($fecha);
    $option='';
    while(!$consultar->EOF)
    {
            $hora = trim($consultar->fields["descri"]);
            $idhora = trim($consultar->fields["id"]);
           	$option .= '<option value="'.$idhora.'">'.$hora.'</option>';	
       $consultar->MoveNext();   
    }
    $objResponse->Assign("hora","innerHTML",$option);
 return $objResponse;
}
$xajax->registerFunction('hora');

function consulcitas()
{

	global $objResponse;	
	global $BD;    
	$tabla='
	

	<div class="container-fluid">	
		<div class="row">
		<!-- Panel citas dia **********************************************-->
			<div class="col-md-6">
				<div class="btn-group"> 
		            <span class="btn btn-success pull-left" id="regremenu" onclick="xajax_citasDia()">
		            	<i class="glyphicon glyphicon-resize-full" ></i>  <b>Citas Dia</b>
		            </span>
			    </div>
				<div class="panel panel-success">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Asignadas en el Dia</strong></h3></div>
					<div class="panel-body">
						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
							      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe1" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>HORA</th>
								<th>ESTADO</th>
							</tr>     
							</thead>
						<tbody>';
						$CitasDelDia = citasdeldia();
						$time1 = date("H:i");
						while(!$CitasDelDia->EOF)
					    {
						    $cliente1 = trim($CitasDelDia->fields["nombre"]);
						    $hora1 = trim($CitasDelDia->fields["hora"]);
						    if($hora1>trim($time1))
						    {
						    	$estado1 = "<b>Cita Pendiente</b>";
						    	$tr1='bgcolor="#ECA1A7"';
						    }else{
						    	$estado1 = "<b>Cita ok!</b>";
						    	$tr1='bgcolor="#99E7BA"';
						    }
							$tabla.='
								<tr '.$tr1.'>
									<td>'.$cliente1.'</td>
									<td>'.$hora1.'</td>
									<td>'.$estado1.'</td>
								</tr> 
							';
							$CitasDelDia->MoveNext();   
						}	
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>	
					</div>
				</div>
			</div>';

			$tabla.='
			<!-- Panel citas programdas **********************************************-->
			<div class="col-md-6">
				<div class="btn-group"> 
		            <span class="btn btn-info pull-left" id="regremenu" onclick="xajax_citaPrograma()">
		            	<i class="glyphicon glyphicon-resize-full" ></i><b>Citas Programadas</b>
		            </span>
			    </div>
				<div class="panel panel-info">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Programadas en otra fecha</strong></h3></div>
					<div class="panel-body">

						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
							      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe2" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>HORA</th>
								<th>FECHA</th>
								<th>ESTADO</th>
							</tr>     
							</thead>
						<tbody>
						';
						$CitasPro = CitasPro();
						$time2 = date("H:i");
						while(!$CitasPro->EOF)
					    {
						    $client2 = trim($CitasPro->fields["nombre"]);
						    $hora2 = trim($CitasPro->fields["hora"]);
						    $fecha = trim($CitasPro->fields["fecha"]);
						   	$sistemfecha = date("Y-m-d");


						   	if($sistemfecha==$fecha)
						   	{
						   		if($hora2>trim($time2))
							    {
							    	$estado2 = "<b>Cita Pendiente</b>";
							    	$tr2='bgcolor="#ECA1A7"';
							    }else{
							    	$estado2 = "<b>Cita ok!</b>";
							    	$tr2='bgcolor="#99E7BA"';
							    }
						   	}else{
						   		$estado2 = "<b>Cita Pendiente</b>";
							    $tr2='bgcolor="#ECA1A7"';
						   	}	
	

							$tabla.='
								<tr '.$tr2.'>
									<td>'.$client2.'</td>
									<td>'.$hora2.'</td>
									<td>'.$fecha.'</td>
									<td>'.$estado2.'</td>
								</tr> 
							';
							$CitasPro->MoveNext();   
						}	
						
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>
					                <td></td>
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>
					</div>
				</div>
			</div>
		</div>	
	</div>';
	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe1',[],false,'Bfrtilp');"); 
	 $objResponse->Script("renderizatablaAyudas('tabla_informe2',[],false,'Bfrtilp');"); 			
	
 return $objResponse;

}
$xajax->registerFunction('consulcitas');

function citasDia()
{
	global $objResponse;	
	global $BD;    
	$tabla='
		<div class="btn-group"> 
            <span class="btn btn-success pull-left" id="regremenu" onclick="xajax_consulcitas()">
            	<i class="glyphicon glyphicon-resize-small" ></i> <b>Citas Dia</b>
            </span>
		 </div>
		<div class="panel panel-success">
			<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Asignadas en el Dia</strong></h3></div>
			<div class="panel-body">
				<table class="table table-dark">
					  <thead>
					    <tr>
					      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
					      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
					    </tr>
					  </thead>
				 </table> 
				<table id="tabla_informe1" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
					<thead>
					<tr>
						<th>CLIENTE</th>
						<th>HORA</th>
						<th>ESTADO</th>
						<th></th>
					</tr>     
					</thead>
				<tbody>';
				$CitasDelDia = citasdeldia();
				$time1 = date("H:i");
				while(!$CitasDelDia->EOF)
			    {
			    	$id = trim($CitasDelDia->fields["id"]);
				    $cliente1 = trim($CitasDelDia->fields["nombre"]);
				    $hora1 = trim($CitasDelDia->fields["hora"]);
				   
				    if($hora1>trim($time1))
				    {
				    	$estado1 = "<b>Cita Pendiente</b>";
				    	$tr1='bgcolor="#ECA1A7"';
				    	$buton = '
						<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitDia('.$id.')">
							<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
						</span>
				    	';
				    }else{
				    	$estado1 = "<b>Cita ok!</b>";
				    	$tr1='bgcolor="#99E7BA"';
				    	$buton = '
						<span class="btn btn-primary pull-left" disabled="disable">
							<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
						</span>
				    	';
				    }
					$tabla.='
						<tr >
							<td '.$tr1.'>'.$cliente1.'</td>
							<td '.$tr1.'>'.$hora1.'</td>
							<td '.$tr1.'>'.$estado1.'</td>
							<td>'.$buton.'</td>
						</tr> 
					';
					$CitasDelDia->MoveNext();   
				}	
				$tabla.='
			        </body>
			        <tfoot>
			            <tr>
			                <td></td>
			                <td></td>
			                <td></td>
			                <td></td>
			            </tr>
			        </tfoot>
			    </table>	
			</div>
		</div>';


	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe3',[],false,'Bfrtilp');"); 

 return $objResponse;

}
$xajax->registerFunction('citasDia');

function CancelCitaDia($id)
{
	global $objResponse;	
	global $BD;    
	$CanceCitaDia = Cancela_CitaDia($id);
	if(count($CanceCitaDia)>0)
	{ 
		$objResponse->Script("msjcancelacita()");      
	}else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	} 

	return $objResponse;
}
$xajax->registerFunction('CancelCitaDia');

function citaPrograma()
{
	global $objResponse;	
	global $BD;    
	$tabla='
				<div class="btn-group"> 
		            <span class="btn btn-info pull-left" id="regremenu" onclick="xajax_consulcitas()">
		            	<i class="glyphicon glyphicon-resize-small" ></i><b>Citas Programadas</b>
		            </span>
			    </div>
				<div class="panel panel-info">
					<div class="panel-heading"><h3><strong><li class="glyphicon glyphicon-calendar"></li> Citas Programadas en otra fecha</strong></h3></div>
					<div class="panel-body">

						<table class="table table-dark">
							  <thead>
							    <tr>
							      <th scope="col" bgcolor="#99E7BA">CITAS OK!</th>
							      <th scope="col" bgcolor="#ECA1A7">CITAS PENDIENTES!</th>
							    </tr>
							  </thead>
						 </table> 
						<table id="tabla_informe2" class="table table-sm table-inverse table-hover responsive" style="font-size: 10px;" width="100%" align="center" border="1" bordercolor="#CCCCCC" cellpadding="4" cellspacing="1">
							<thead>
							<tr>
								<th>CLIENTE</th>
								<th>HORA</th>
								<th>FECHA</th>
								<th>ESTADO</th>
								<th></th>
							</tr>     
							</thead>
						<tbody>
						';
						$CitasPro = CitasPro();
						$time2 = date("H:i");
						while(!$CitasPro->EOF)
					    {
					    	$id = trim($CitasPro->fields["id"]);
						    $client2 = trim($CitasPro->fields["nombre"]);
						    $hora2 = trim($CitasPro->fields["hora"]);
						    $fecha = trim($CitasPro->fields["fecha"]);
						   	$sistemfecha = date("Y-m-d");

						   	if($sistemfecha==$fecha)
						   	{
						   		if($hora2>trim($time2))
							    {
							    	$estado2 = "<b>Cita Pendiente</b>";
							    	$tr2='bgcolor="#ECA1A7"';
							    	$buton = '
									<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitPro('.$id.')">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
							    }else{
							    	$estado2 = "<b>Cita ok!</b>";
							    	$tr2='bgcolor="#99E7BA"';
							    	$buton = '
									<span class="btn btn-primary pull-left" disabled="disabled">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
							    }
						   	}else{
						   		$estado2 = "<b>Cita Pendiente</b>";
							    $tr2='bgcolor="#ECA1A7"';
							    $buton = '
									<span class="btn btn-primary pull-left" id="regremenu" onclick="ConfirCancelCitPro('.$id.')">
										<i class="glyphicon glyphicon-remove-sign" ></i> <b>Cancelar Cita</b>
									</span>
							    	';
						   	}

							$tabla.='
								<tr >
									<td '.$tr2.'>'.$client2.'</td>
									<td '.$tr2.'>'.$hora2.'</td>
									<td '.$tr2.'>'.$fecha.'</td>
									<td '.$tr2.'>'.$estado2.'</td>
									<td>'.$buton.'</td>
								</tr> 
							';
							$CitasPro->MoveNext();   
						}	
						
						$tabla.='
					        </body>
					        <tfoot>
					            <tr>
					                <td></td>
					                <td></td>
					                <td></td>
					                <td></td>
					                <td></td>
					            </tr>
					        </tfoot>
					    </table>
					</div>
				</div>
			</div>';


	 $objResponse->Assign("citas", "innerHTML", utf8_decode($tabla));
	 $objResponse->Script("renderizatablaAyudas('tabla_informe3',[],false,'Bfrtilp');"); 

 return $objResponse;

}
$xajax->registerFunction('citaPrograma');

function CancelCitaPro($id)
{
	global $objResponse;	
	global $BD;    
	$CanceCitaPro = Cancela_CitaPro($id);
	if(count($CanceCitaPro)>0)
	{ 
		$objResponse->Script("msjcancelacita()");      
	}else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	} 

	return $objResponse;
}
$xajax->registerFunction('CancelCitaPro');

?>
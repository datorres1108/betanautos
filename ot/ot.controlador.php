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
					<b>Desea el cliente (Excepto las piezas de garant&iacute;a)<br>Conservar las piezas cambiadas?</b><br> 
					<select name="consentimiento" id="consentimiento" class="form-control">
						<option value=""> Seleccione opcion</option>
						<option value="S"> Si</option>
						<option value="N"> No</option>
					</select>

				</div><h5>
				<hr>
				<div class="form-group">
					<h4><i class="fa-solid fa-car-side"></i> <b>Inventario del vehiculo</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Todo Ok</b> <input type="checkbox" id="todos" name="todos" value="ok" onclick="checbox()">
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
					Rueda Repuesto <input type="checkbox" id="ruedar" name="ruedar" value="rueda_repuesto">
					Tercer Stop <input type="checkbox" id="tstop" name="tstop" value="tercer_stop">
					Equipo Carretera <input type="checkbox" id="equipoc" name="equipoc" value="equipo_carretera">
					Stops <input type="checkbox" id="stops" name="stops" value="stops">
				</div>
				<hr>
				<div class="form-group">
					<h4> <i class="fa-solid fa-list"></i> <b> Descripci&oacute;n de los trabajos</b> </h4>
				</div>
				<br>
				<div class="form-group">
					<select name="tipotrabajo" id="tipotrabajo" class="form-control">
						<option value=""> Seleccione tipo de trabajo</option>
						<option value="G"> Golpe</option>
						<option value="R"> Raya</option>
					</select>
				</div>
				<br>
				<div class="form-group">
					<img src="img/partes.JPG" alt="Partes vehiculo" width="50%" height="70%">
				</div>
				<br>
				<div class="form-group">
					<select name="codigotrabajo" id="codigotrabajo" class="form-control">
						<option value="">Seleccione Parte Vehiculo</option>
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
					<input type="text" name="partevehiculo" id="partevehiculo" placeholder="Descripcion del trabajo a realizar"  size="70%"  class="form-control" >
				</div>
				<div class="form-group">
					<span class="btn btn-info" onClick="BtnCrearTrabajo(\''.$comprobate.'\')">
						<strong><i class="fa-solid fa-circle-down" ></i> Agregar</strong>
					</span>
				</div>
				<br>
				<div class="form-group">
					<div id="Trabajosrealiza"></div>
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
	//dtaa cliente
    $docu   =   trim($form['docu']);
    $nomape =   trim($form['nomape']);
    $dir    =   trim($form['dir']);
    $tel1   =   trim($form['tel1']);
    $tel2   =   trim($form['tel2']);
	//data vehiculo
	$placa   =   trim($form['placa']);
    $modelo =   trim($form['modelo']);
    $tipo    =   trim($form['tipo']);
    $color   =   trim($form['color']);
    $motor   =   trim($form['motor']);

	$gasolina   	=   trim($form['gasolina']);
	$kilometros   	=   trim($form['kilometros']);
    $consentimiento =   trim($form['consentimiento']);
	//Inventario vehiculo
    $todos    		=   trim($form['todos']);
    $reloj   		=   trim($form['reloj']);
    $radio   		=   trim($form['radio']);
	$cds   			=   trim($form['cds']);
    $encendedor 	=   trim($form['encendedor']);
    $cenicero    	=   trim($form['cenicero']);
    $forros   		=   trim($form['forros']);
    $tapetes   		=   trim($form['tapetes']);
	$parasoles   	=   trim($form['parasoles']);
    $manijas 		=   trim($form['manijas']);
    $cinturones    	=   trim($form['cinturones']);
    $copas   		=   trim($form['copas']);
	$extinguidor   	=   trim($form['extinguidor']);
	$farolas   		=   trim($form['farolas']);
	$espejos   		=   trim($form['espejos']);
	$antenas   		=   trim($form['antenas']);
	$exploradoras   =   trim($form['exploradoras']);
	$emblemas   	=   trim($form['emblemas']);
	$cuchillas   	=   trim($form['cuchillas']);
	$llaveros   	=   trim($form['llaveros']);
	$gato   		=   trim($form['gato']);
	$ruedar   		=   trim($form['ruedar']);
	$tstop   		=   trim($form['tstop']);
	$equipoc   		=   trim($form['equipoc']);
	$stops   		=   trim($form['stops']);
	//Descripcion trabajos
	$tipotrabajo   	=   trim($form['tipotrabajo']);
	$herramienta   	=   trim($form['herramienta']);
	$codigotrabajo  =   trim($form['codigotrabajo']);
	$partevehiculo  =   trim($form['partevehiculo']);

	$arrayInve= array(
						$reloj,
						$radio,
						$cds,
						$encendedor,
						$cenicero,
						$forros,
						$tapetes,   		
						$parasoles,   
						$manijas, 		 
						$cinturones,  
						$copas,   		 
						$extinguidor, 
						$farolas,   		
						$espejos,   		
						$antenas,  		
						$exploradoras,
						$emblemas,   	
						$cuchillas,   
						$llaveros,   	
						$gato,   		  
						$ruedar,   		
						$tstop,   		
						$equipoc,   		
						$stops
					);
		$json_arrayinve = json_encode($arrayInve);


	
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


	$CrearOR = CrearOrden($compro,$placa,$kilometros,$gasolina,$consentimiento,$json_arrayinve);
	if(is_iterable($CrearOR))
	{
		$objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente la orden de trabajo</strong></h5>')");
		$objResponse->Script("regresarmenu('');"); //debera redireccionar al impresor en blanco
	} 
	else
	{
		$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
	}

 	return $objResponse;
}
$xajax->registerFunction('GuardarOr');

function GuardarTipoTra($compro,$tipotrabajo,$codigotrabajo,$partevehiculo)
{
    global $objResponse;
    global $BD; 

	$compro = trim($compro);
	$compro = explode('-',$compro);
	$comprobate = $compro[0];
	$nrocompro = $compro[1];

	$error ="";
    if(trim($tipotrabajo)==""){
        $error .= "<li>Debe ingresar tipo  de trabajo a realizar</li>";
    }
    if(trim($codigotrabajo)==""){
        $error .= "<li>Debe ingresar una parte del vehiculo segun la grafica</li>";
    }
    if(trim($partevehiculo)==""){
        $error .= "<li>Debe ingresar una descripcion del trabajo a realizar en la parte seleccionada</li>";
    }

	
    if($error =="")
    {
		$CrearTipotra = CrearTPtrabajo($comprobate,$nrocompro,$tipotrabajo,$codigotrabajo,$partevehiculo);

		if(is_iterable($CrearTipotra))
		{
			$objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente el trabajo a realizar</strong></h5>')");
			$objResponse->Assign("tipotrabajo","value","");               
			$objResponse->Assign("codigotrabajo","value","");             
			$objResponse->Assign("partevehiculo","value","");
			$objResponse->Script("xajax_VertiposTra($nrocompro);");               
		}
		else
		{
			$objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
		}

	}else
	{
		$objResponse->Script("alerta('Espera un momento hay campos vacios<br> $error')");  
	}

	return $objResponse;
}
$xajax->registerFunction('GuardarTipoTra');

//Consulta los trabajo que va realizando
function VertiposTra($orden)
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
    $Vertrabajos = ConsultarTrabajos($orden);
    $tabla ='
    <div class="table-responsive">
        <hr>
        <table class="table">
        <thead>
            <tr>
                <th>Nro Orden</th>
                <th>DescripcionTrabajo</th>
                <th>Parte Vehiculo</th>
                <th>Trabajo a Realizar</th>
            </tr>     
        </thead>
        <tbody>';
        while(!$Vertrabajos->EOF)
        {
            $numero  = trim($Vertrabajos->fields["numero"]);
            $tipo_trabajo = trim($Vertrabajos->fields["tipo_trabajo"]);
            $parte  = trim($Vertrabajos->fields["parte"]);
            $descri_trabajo  = trim($Vertrabajos->fields["descri_trabajo"]);

			switch ($tipo_trabajo) {
				case 'G':
					$tex_tipo_trabajo = "GOLPE";
				break;
				
				case 'R':
					$tex_tipo_trabajo = "RAYA";
				break;
			}


            $tabla .='
            <tr>
                <td>'.$numero.'</td>
               <td>'.$tex_tipo_trabajo.'</td>
               <td>'.$parte.'</td>
               <td>'.$descri_trabajo.'</td>
            </tr>
             ';
      
            $Vertrabajos->MoveNext();   
        }
  
        $tabla .='
            </body>
        </table>
    </div>
    ';
    $objResponse->Assign("Trabajosrealiza","innerHTML",utf8_decode($tabla));
   
    return $objResponse;
}
$xajax->registerFunction('VertiposTra');

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



?>
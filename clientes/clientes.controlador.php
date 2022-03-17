<?php
# declaracion del objeto global que responde (objResponse)
$objResponse = new xajaxResponse();
$BD = new BD();

/*-------------------------------------------------------------------------------------------------------
FUNCIONES PARA CREAR CLIENTES Y VEHICULOS
---------------------------------------------------------------------------------------------------------*/
//funcion ppal que carga el programa inicial 
function Cliente()
{

	 global $objResponse;	
     global $BD;    
	$tabla='
	        <form class="form-inline" name="crear_cliente" id="crear_cliente">
				<div class="form-group">
					<h4><i class="fa-solid fa-user"></i> <b>Informaci&oacute;n del cliente</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Documento del Cliente:</b><br>
					<input type="number" name="docu" id="docu" style="border: 2px solid #ff6666;"  size="30%" class="form-control" onKeyPress="return SoloNumeros(event);">
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
					<input type="number" name="tel1" id="tel1" style="border: 2px solid #ff6666;"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);">
				</div>
				<div class="form-group">
					<b>Tel. Fijo o Celular2:</b><br>
					<input type="number" name="tel2" id="tel2"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);">
				</div>
				<hr>
				<div class="form-group">
					<h4><i class="fa-solid fa-car-side"></i> <b>Informaci&oacute;n del Veh&iacute;culo</b></h4>
				</div>
				<br>
				<div class="form-group">
					<b>Placa:</b><br>
					<input type="text" name="placa" id="placa" style="border: 2px solid #ff6666;"  size="10%" class="form-control" onkeyup="mayus(this);" onchange="xajax_CtrValidoplacas(this.value)">
				</div>
				<div class="form-group">
					<b>Modelo Marca:</b><br>
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
                    <br>
                    <span class="btn btn-info" id="btn-crearvehiculo" onClick="AgregarVehiculo()" >
                        <i class="glyphicon glyphicon-plus" ></i><strong> AgregarVehiculo</strong>
                    </span> 
                </div>
                <br>
                <div id="VehiculosCliente"></div>

			</form>

                    <br><br>  
                    <div class="form-group">
                        <span class="btn btn-success" id="btn-crear" onClick="BtnGuardarCli()" >
                        	<i class="glyphicon glyphicon-floppy-disk" ></i><strong> Guardar Cliente</strong>
                        </span>                    
                    </div>
                    <div class="form-group">
                        <font color="red"><strong> (*)Los campos resaltados de color rojo son obligatorios para la creaci&oacute;n del cliente</strong></font>
                    </div>

				</div>
		</div>
        
	</div>';

	 $objResponse->Assign("form_crearcleinte", "innerHTML", utf8_decode($tabla));
 return $objResponse;

}
$xajax->registerFunction('Cliente');

//Guardar cliente
function CtrGuardaCliente($form)
{
    global $objResponse;
    global $BD; 
    $docu   =   trim($form['docu']);
    $nomape =   trim($form['nomape']);
    $dir    =   trim($form['dir']);
    $tel1   =   trim($form['tel1']);
    $tel2   =   trim($form['tel2']);

	///print_r($frm);
    $error ="";
    if(trim($docu)==""){
        $error .= "<li>Debe ingresar un documento para el cliente</li>";
    }
    if(trim($nomape)==""){
        $error .= "<li>Debe ingresar un nombre y apellido del cliente</li>";
    }
    if(trim($tel1)==""){
        $error .= "<li>Debe ingresar un numero fijo o celular del cliente</li>";
    }


    if($error =="")
    {
        //Consultamos si el documento ingresado ya no se encuentra registrado en el sistema
        $ConsuCliente = ModValidarCliente($docu);
        while(!$ConsuCliente->EOF)
        {
             $totalregistros = trim($ConsuCliente->fields["total"]);          
             if($totalregistros>0)
             {
                  $objResponse->Script("alerta('<h5 class=text-danger><strong>El cliente con numero de documento $docu ya se encuentra registrado en el sistema</strong></h5>')");
             }
             else
             {
                $CrearCliente = ModCrearCliente($docu,$nomape,$dir,$tel1,$tel2);

                if(is_iterable($CrearCliente))
                {
                    $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente el cliente</strong></h5>')");
                    $objResponse->Assign("docu","value","");               
                    $objResponse->Assign("nomape","value","");             
                    $objResponse->Assign("dir","value","");             
                    $objResponse->Assign("tel1","value","");
                    $objResponse->Assign("tel2","value","");  
                    $objResponse->Assign("VehiculosCliente","innerHTML",""); //Div de vehiculos registrados
                }
                else
                {
                    $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
                }


             }
      
            $ConsuCliente->MoveNext();   
        }


    }
    else
    {
        $objResponse->Script("alerta('Espera un momento hay campos vacios<br> $error')");  
    }

    return $objResponse;
}
$xajax->registerFunction('CtrGuardaCliente');

//Guardo el vehiculo
function CtrGuardaVehiculo($placa,$docu,$modelo,$tipo,$color,$motor)
{
    global $objResponse;
    global $BD; 
    //Validar datos no nullos
     $error ="";
    if(trim($placa)==""){
        $error .= "<li>Debe ingresar una placa para el vehiculo</li>";
    }
    if(trim($docu)==""){
        $error .= "<li>Debe ingresar un numero de documento para el cliente</li>";
    }

    if($error =="")
    {
        $insertovehiculo = ModCrearVehiculo($placa,$docu,$modelo,$tipo,$color,$motor);
        if(is_iterable($insertovehiculo))
        { 
            $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se crea correctamente el vehiculo</strong></h5>')");
            $objResponse->Assign("modelo","value","");               
            $objResponse->Assign("tipo","value","");             
            $objResponse->Assign("color","value","");             
            $objResponse->Assign("motor","value","");
            $objResponse->Assign("placa","value","");     
            $objResponse->Script("xajax_CtrVehiculoCliente($docu);");     

        }else
        {
          $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
        } 

    }else
    {
            $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo el siguiente error:</strong><br>$error</h5>')");
    }
    return $objResponse;  
}
$xajax->registerFunction('CtrGuardaVehiculo');

//Consulta los vehiculos asociados al documento
function CtrVehiculoCliente($documento)
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
    $VehiculoCliente = ModVehiculoCliente($documento);
    $tabla ='
    <div class="table-responsive">
        <hr>
        <table class="table">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Modelo Marca</th>
                <th>Color</th>
                <th>Motor</th>
                <th>Tipo</th>
            </tr>     
        </thead>
        <tbody>';
        while(!$VehiculoCliente->EOF)
        {
            $placa  = trim($VehiculoCliente->fields["placa"]);
            $modelo = trim($VehiculoCliente->fields["modelo"]);
            $color  = trim($VehiculoCliente->fields["color"]);
            $motor  = trim($VehiculoCliente->fields["motor"]);
            $tipo   = trim($VehiculoCliente->fields["tipo"]);

            $tabla .='
            <tr>
                <td>'.$placa.'</td>
               <td>'.$modelo.'</td>
               <td>'.$color.'</td>
               <td>'.$motor.'</td>
               <td>'.$tipo.'</td>
            </tr>
             ';
      
            $VehiculoCliente->MoveNext();   
        }
  
        $tabla .='
            </body>
        </table>
    </div>
    ';
    $objResponse->Assign("VehiculosCliente","innerHTML",utf8_decode($tabla));
   
    return $objResponse;
}
$xajax->registerFunction('CtrVehiculoCliente');

//Validar vehiculos registrados
function CtrValidoplacas($placa)
{
    global $objResponse;
    global $BD; 
    $ValidoPlacas = ModValidoPlacas($placa);
    while(!$ValidoPlacas->EOF)
    {
         $totalregistros = trim($ValidoPlacas->fields["total"]);          
         if($totalregistros>0)
         {
              $objResponse->Script("alerta('<h5 class=text-danger><strong>La placa de vehiculo $placa ya se encuentra registrado en el sistema</strong></h5>')");
              $objResponse->Assign("placa","value","");   
         }
  
        $ValidoPlacas->MoveNext();   
    }
  
    return $objResponse;
}
$xajax->registerFunction('CtrValidoplacas');

/*-------------------------------------------------------------------------------------------------------
FUNCIONES PARA EDITAR Y MODIFICAR CLIENTES Y VEHICULOS
---------------------------------------------------------------------------------------------------------*/
//Consultar para editar cliente
function CtrEditaConsultaCliente($opcion,$valor)
{
    global $objResponse;
    global $BD; 
    //Consulto todos los clientes
   $error ="";
    if(trim($opcion)=="")
    {
        $error .= "<li>Debe ingresar una opcion para la consulta</li>";
    }

    if(trim($valor)=="")
    {
        $error .= "<li>Debe ingresar un valor para consultar</li>";
    }

    $tabla ='
    <section>
    <div class="container col-md-12 col-lg-12 col-xs-12">
    <hr>';
    if($error =="")
    {
        $Consultoclie = ModConsultaCliente($opcion,$valor);
        if($BD->numreg($Consultoclie)>0)
        {     
            while(!$Consultoclie->EOF)
            {
                $id = trim($Consultoclie->fields["id"]);
                $documento = trim($Consultoclie->fields["documento"]);
                $nombres = trim($Consultoclie->fields["nombres"]);
                $direccion = trim($Consultoclie->fields["direccion"]);
                $tel1 = trim($Consultoclie->fields["tel1"]);
                $tel2 = trim($Consultoclie->fields["tel2"]);


                $tabla .='
                <form class="form-inline" name="editar_cliente" id="editar_cliente">
                    <div class="form-group">
                        <h4><i class="fa-solid fa-user"></i> <b>Informaci&oacute;n del cliente</b></h4>
                    </div>
                    <br>
                    <div class="form-group">
                        <b>Documento del Cliente:</b><br>
                        <input type="number" name="docu" id="docu" style="border: 2px solid #ff6666;"  size="30%" class="form-control" onKeyPress="return SoloNumeros(event);" value="'.$documento.'">
                    </div>
                    <div class="form-group">
                        <b>Nombres y Apellidos:</b><br>
                        <input type="text" name="nomape" id="nomape"   size="30%" style="border: 2px solid #ff6666;" class="form-control" value="'.$nombres.'">
                    </div>
                    <br>
                    <div class="form-group">
                        <b>Direcci&oacute;n:</b><br>
                        <input type="text" name="dir" id="dir"  size="40%" class="form-control" value="'.$direccion.'">
                    </div>
                    <div class="form-group">
                        <b>Tel. Fijo o Celular1:</b><br>
                        <input type="number" name="tel1" id="tel1" style="border: 2px solid #ff6666;"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);" value="'.$tel1.'">
                    </div>
                    <div class="form-group">
                        <b>Tel. Fijo o Celular2:</b><br>
                        <input type="number" name="tel2" id="tel2"  size="20%" class="form-control" onKeyPress="return SoloNumeros(event);" value="'.$tel2.'">
                    </div>
                    <div class="form-group">
                        <br>
                        <span class="btn btn-info" id="btn-editarcliente" onClick="GuardarEdicionClie('.$id.',\''.$opcion.'\',\''.$valor.'\')" >
                            <i class="glyphicon glyphicon-floppy-disk" ></i><strong> Guardar</strong>
                        </span> 
                    </div>
                </form>';
                //Espacio para consultar vehiculos
                $VehiculoCliente = ModVehiculoCliente($documento);
                $tabla .='
                <hr>
                <div class="form-group">
                    <h4><i class="fa-solid fa-car-side"></i> <b>Veh&iacute;culos de '.$nombres.'</b></h4>
                </div>
                <br>
                <div class="table-responsive">
                <table class="table" >
                    <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Editar</th>
                        <th>Borrar</th>
                    </tr>     
                    </thead>
                    <tbody>
                ';
                    while(!$VehiculoCliente->EOF)
                    {
                        $placa  = trim($VehiculoCliente->fields["placa"]);
                        $id = trim($VehiculoCliente->fields["id"]);              

                        $tabla.='                  
                            <tr>
                                <td>'.$placa.'</td>
                                <td>
                                    <span class="btn btn-info" id="btn-editarvehiculo" onClick="xajax_EditarVehiculo(\''.$placa.'\','.$id.')" >
                                        <i class="fa-solid fa-pencil"></i>
                                    </span> 
                                </td>
                                <td>
                                    <span class="btn btn-danger" id="btn-eliminarvehiculo" onClick="EliminaVehiculo(\''.$placa.'\','.$id.',\''.$opcion.'\',\''.$valor.'\')" >
                                        <i class="fa-regular fa-trash-can"></i>
                                    </span> 
                                </td>
                            </tr>
                        ';
                        $VehiculoCliente->MoveNext();   
                    }

                $tabla.='  
                    </tbody>
                </table>
                </div>
                <div id="edit_vehiculos"></div>
                ';
          
            $Consultoclie->MoveNext();   
            }

        }else{
             $tabla .="
             <div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span><span class='sr-only'>Error:</span><strong> El valor ingresado $docu no se encuentra registrado por favor valida e intenta de nuevo</strong></div>";
        }    
      
       
    }else
    {
           $objResponse->Script("alerta('Espera un momento hay campos vacios<br>$error')");
    } 
     $tabla .='
        </div>
    </section>';  
    $objResponse->Assign("edit_clientes","innerHTML",utf8_decode($tabla));      
    return $objResponse;
}
$xajax->registerFunction('CtrEditaConsultaCliente');

//Edicion de vehiculo formulario
function EditarVehiculo($placa,$id)
{    
    global $objResponse;
    global $BD; 
    $Consultovehi = ModConsultaVehiculo($placa,$id);
        while(!$Consultovehi->EOF)
        {
            $id = trim($Consultovehi->fields["id"]);
            $documento = trim($Consultovehi->fields["documento"]);
            $placavh = trim($Consultovehi->fields["placa"]);
            $modelo = trim($Consultovehi->fields["modelo"]);
            $color = trim($Consultovehi->fields["color"]);
            $motor = trim($Consultovehi->fields["motor"]);
            $tipo = trim($Consultovehi->fields["tipo"]);

            $tabla .='
            <form class="form-inline" name="editar_vehiculo" id="editar_vehiculo">
                <div class="form-group">
                    <b>Placa:</b><br>
                    <input type="text" name="placa" id="placa" style="border: 2px solid #ff6666;"  size="10%" class="form-control" onkeyup="mayus(this);" onchange="xajax_CtrValidoplacas(this.value)" value="'.$placavh.'">
                </div>
                <div class="form-group">
                    <b>Modelo Marca:</b><br>
                    <input type="text" name="modelo" id="modelo" size="40%"  class="form-control" value="'.$modelo.'">
                </div>
                <div class="form-group">
                    <b>Tipo:</b><br>
                    <input type="text" name="tipo" id="tipo"   size="30%"  class="form-control" value="'.$tipo.'">
                </div>
                <br>
                <div class="form-group">
                <b>Color:</b><br>
                    <input type="text" name="color" id="color" size="10%" class="form-control" value="'.$color.'">
                </div>
                <div class="form-group">
                    <b>Nro Motor:</b><br>
                    <input type="text" name="motor" id="motor"  size="40%"  class="form-control" value="'.$motor.'">
                </div>
                <div class="form-group">
                    <br>
                    <span class="btn btn-info" id="btn-crearvehiculo" onClick="GuardarEdicionVeh(\''.$placa.'\','.$id.')" >
                        <i class="glyphicon glyphicon-floppy-disk" ></i><strong> Guardar</strong>
                    </span> 
                </div>
                <div class="form-group">
                    <br>
                    <span class="btn btn-default" id="btn-crearvehiculo" onClick="xajax_cancelar()" >
                        <i class="fa-solid fa-x"></i><strong> Cancelar</strong>
                    </span> 
                </div>
            </form>';
            $Consultovehi->MoveNext();   
        }

    $objResponse->Assign("edit_vehiculos","innerHTML",utf8_decode($tabla));      
    return $objResponse;
}
$xajax->registerFunction('EditarVehiculo');

//Guardar la edicion del cliente 
function CtrGuardaEdiCliente($form,$opcion,$valor,$id)
{
    global $objResponse;
    global $BD; 
    $docu   =   trim($form['docu']);
    $nomape =   trim($form['nomape']);
    $dir    =   trim($form['dir']);
    $tel1   =   trim($form['tel1']);
    $tel2   =   trim($form['tel2']);

	///print_r($frm);
    $error ="";
    if(trim($docu)==""){
        $error .= "<li>Debe ingresar un documento para el cliente</li>";
    }
    if(trim($nomape)==""){
        $error .= "<li>Debe ingresar un nombre y apellido del cliente</li>";
    }
    if(trim($tel1)==""){
        $error .= "<li>Debe ingresar un numero fijo o celular del cliente</li>";
    }


    if($error =="")
    {
        $ModificamosCliente = ModEditacliente($docu,$nomape,$dir,$tel1,$tel2,$id);
        if(is_iterable($ModificamosCliente))
        {
            $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se modifica correctamente el cliente</strong></h5>')");
            $objResponse->Script("xajax_CtrEditaConsultaCliente('$opcion','$valor');"); 
        }
        else
        {
            $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
        }
    }
    else
    {
        $objResponse->Script("alerta('Espera un momento hay campos vacios<br> $error')");  
    }

    return $objResponse;
}
$xajax->registerFunction('CtrGuardaEdiCliente');

//Guardo edicion del vehiculo
function CtrGuardaEdivVehiculo($form,$placa,$id)
{
    global $objResponse;
    global $BD; 
    $placa   =   trim($form['placa']);
    $modelo =   trim($form['modelo']);
    $tipo    =   trim($form['tipo']);
    $color   =   trim($form['color']);
    $motor   =   trim($form['motor']);

	///print_r($frm);
    $error ="";
    if(trim($placa)==""){
        $error .= "<li>Debe ingresar una placa del vehiculo</li>";
    }

    if($error =="")
    {
        $ModificamosVehiculo = ModEditavehiculo($placa,$modelo,$tipo,$color,$motor,$id);
        if(is_iterable($ModificamosVehiculo))
        {
            $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se modifica correctamente el vehiculo</strong></h5>')");
            $objResponse->Script("xajax_EditarVehiculo('$placa','$id');"); 
        }
        else
        {
            $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
        }
    }
    else
    {
        $objResponse->Script("alerta('Espera un momento hay campos vacios<br> $error')");  
    }

    return $objResponse;
}
$xajax->registerFunction('CtrGuardaEdivVehiculo');

//boton cancelar
function cancelar()
{
    global $objResponse;
    $objResponse->Assign("edit_vehiculos","innerHTML","");      
    return $objResponse;
}
$xajax->registerFunction('cancelar');

//eliminar placa de vehiculo
function EliminaPlaca($id,$placa,$opcion,$valor)
{
    global $objResponse;
    $deleteplacavh = EliminarPlaca($id);
    if(is_iterable($deleteplacavh))
    {
        $objResponse->Script("alerta('<h5 class=text-info><strong>Muy Bien! Se Elimina la placa $placa correctamente</strong></h5>')");
        $objResponse->Script("xajax_CtrEditaConsultaCliente('$opcion','$valor');"); 
    }
    else
    {
        $objResponse->Script("alerta('<h5 class=text-danger><strong>Atencion! Hubo un error al guardar</strong></h5>')");
    }    
    return $objResponse;
}
$xajax->registerFunction('EliminaPlaca');

?>
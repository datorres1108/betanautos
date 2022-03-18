<!DOCTYPE html>
<html> 
  <head>
  	<?php
		$xajax->printJavascript('funciones/');
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>.::BetanAutos-OR-Dia::.</title>
    <script language="JavaScript" type="text/javascript" src="ot/ot.js"></script>
    <script type="text/javascript" src="javascript/jquery.min.js"></script> 
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.css" type="text/css" media="screen">
    <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap_dialog.css" type="text/css" media="screen">
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="estilos/bootstrap/js/bootstrap_dialog.js"></script>
	<script src="https://kit.fontawesome.com/2f89e68d00.js" crossorigin="anonymous"></script>

    </head>
    <body onload="xajax_cargando();xajax_Form_Or();" >

	<section>
		<div class="col-md-12 col-xs-12 col-lg-12" >
			<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>
						<i class="fa-solid fa-car"></i> <strong>Registro de Orden de Reparacion Vehiculos</strong>  
			         </h2>
				</div>
				<div class="panel-body form-inline">
					<div id="form_or"></div>
 
				</div>
				<div class="panel-footer">
			          <div class="btn-group"> 
			            <span class="btn btn-default pull-left" id="regremenu" onclick="regresarmenu()">
			            	<i class="glyphicon glyphicon-home" ></i> Regresar al Menu
			            </span>
			          </div>
	     		</div>
			</div>
		</div>

	</section>	
	</body>
</html>
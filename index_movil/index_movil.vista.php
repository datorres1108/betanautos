<?php
/*
  @author    David Torres <datorres08@hotmail.com>
  @version   [1]
  @category  menu ppal
  @copyright David Torres [2020-07]
 */

?>
<html>
    <head>
    <?php
       $xajax->printJavascript('funciones/');
    ?>
        <title>.::BetanAutos V1.0 Menu</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <title>.::BetanAutos::.</title>
      <script type="text/javascript" language="JavaScript" src="index_movil/index_movil.js"></script>
      <script type="text/javascript" src="javascript/jquery.min.js"></script> 
      <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap.css" type="text/css" media="screen">
      <link rel="stylesheet" href="estilos/bootstrap/css/bootstrap_dialog.css" type="text/css" media="screen">
      <script type="text/javascript" src="estilos/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="estilos/bootstrap/js/bootstrap_dialog.js"></script>
      <script src="https://kit.fontawesome.com/2f89e68d00.js" crossorigin="anonymous"></script>

        <style>
            input {
                width: 100%;
                height: 40px;
                font-size: 16px;
                padding: 4px;
            }

        </style>
        <script>



        </script>
    </head>
    <body onload="xajax_cargando();">
      <br>
     <section>
        <div class="col-md-12 col-xs-12 col-lg-12" >
            <div class="list-group">
                  <button type="button" class="list-group-item list-group-item-action disabled">
                     <h2><strong>BetanAutos V1.0</strong></h2>
                     <strong>Servicio Especializado.
                  </button>
                  


                  <!--Modulo de citas-->
                  <a href="javascript:citas(1)" class="list-group-item list-group-item-action" id="desplegarcita" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-calendar"></li><strong> OR (Ordenes de Reperacion)</strong> </h3></a>

                  <a href="javascript:citas(2)" class="list-group-item list-group-item-action" id="replegarcita" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-calendar"></li><strong> OR (Ordenes de Reperacion) </strong></h3></a>
                  <div id="detallecita" style="display:none">

                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='ot.php'">
                         <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-calendar"></li> Registrar OR</h4>
                      </button>

                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='ot.php?accion=consulta'">
                         <h4><li class="glyphicon glyphicon-search"></li> <li class="glyphicon glyphicon-calendar"></li> Consultar OR</h4>
                      </button>

                  </div>

                  <!--Modulo de clientes-->
                  <a href="javascript:clientes(1)" class="list-group-item list-group-item-action" id="desplegarcliente" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-user"></li><strong> Clientes</strong> </h3></a>
                  <a href="javascript:clientes(2)" class="list-group-item list-group-item-action" id="replegarcliente" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-user"></li><strong> Clientes </strong></h3></a>
                  <div id="detallecliente" style="display:none">
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='clientes.php?accion=crear'">
                         <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-user"></li> RegistrarCliente</h4>
                      </button>
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='clientes.php?accion=consul'">
                         <h4><li class="glyphicon glyphicon-search"></li> <li class="glyphicon glyphicon-user"></li> ConsultarCliente</h4>
                      </button>
                  </div>  
                  <!--Fin modulo de Registros-->


                   <!--Fin modulo de citas-->

                  <!-- Modulo de visitas-->
                    <!--                   <a href="javascript:visitas(1)" class="list-group-item list-group-item-action" id="desplegarconfig" style="cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-down"> </i> <li class="glyphicon glyphicon-pencil"></li><strong> Visitas </strong></h3></a>
                                      <a href="javascript:visitas(2)" class="list-group-item list-group-item-action" id="replegarconfig" style="display:none;cursor:pointer;text-decoration:none;"> <h3> <i class="glyphicon glyphicon-chevron-up"> </i> <li class="glyphicon glyphicon-pencil"></li><strong> Visitas</strong> </h3></a>
                                     <div id="detalleconfig" style="display:none">
                                        <button type="button" class="list-group-item list-group-item-action" onclick="document.location='visitas.php'">
                                           <h4><li class="glyphicon glyphicon-pencil"></li> <li class="glyphicon glyphicon-book"></li> Registrar Visitas(Clientes registrados)</h4>
                                        </button> -->
                    <!--
                      <button type="button" class="list-group-item list-group-item-action" onclick="document.location='regi_visitas.php'">
                         <h4><li class="glyphicon glyphicon-cog"></li> <li class="glyphicon glyphicon-book"></li> Configurar Nro Visitas</h4>
                      </button>
                    -->  
                 </div> 
                 <!--Fin modulo de visitas--> 

            </div>
                <hr>
<!--                 <br>
                  <div id="citas"></div>
                  <br>
                  <div id="datos"></div>
                <br> -->
                <hr>
                  &nbsp;&nbsp;<i>Developed By <a href="mailto:datorres08@hotmail.com">@Datorres</a> &copy; BetanAutos 2022</a></i>
                <hr>  
         </div>          
     </section>     
    </body>
</html>

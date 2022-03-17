<?php
function progress($tipo)
{
if(trim($tipo) == 'mostrar')
{
?>
	<style type="text/css">
	#Progress_bkgnd {
		position:absolute;
		left:0px;
		top:0px;
		width:100%;
		height:100%;
		z-index:1000;
		background-color:#000000;
		opacity: 0.4;
	}
	#Progress_bar {
		position:absolute;
		left:50%;
		top:50%;
		margin-top:-84px;
		margin-left: -64px;
		width:128px;
		height:168px;
		z-index:1001;
		background-color: none;
		border: none;
		font-family: 'Trebuchet MS', Verdana;
		font-size: 16px;
		text-align: center;
	}
	#Progress_bar img {
		border:0px;
		vertical-align: middle;
		padding: 6px;
	}
	#Progress_bar span {
		border:0px;
		vertical-align: middle;
		padding: 6px;
	}
	</style>
	<div id="Progress_bkgnd"></div>
	<div id="Progress_bar"><img src="funciones/xajax_core/cargando2.gif" /><span>Cargando, espera ...</span>
	</div>
	<?php
	}
	elseif($tipo == 'ocultar')
	{
	?>
		<script>
			document.getElementById('Progress_bkgnd').style.display = 'none';
			document.getElementById('Progress_bar').style.display = 'none';
		</script>
	<?php
	}
}
?>
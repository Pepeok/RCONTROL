<div class="clearfix"></div>
<div class="row-fluid">	
	<div class="box blue span12">
		<div class="box-header">
			<h2><i class="halflings-icon hand-top"></i><span class="break"></span>MANTENEDOR SISTEMA CONTROL HORAS EXTERNOS</h2>
		</div>
		<div class="box-content center" >
			<a class="quick-button span2" onclick="consultar();"><i class="icon-group"></i><p>Ver Profesionales Externos</p></a>
			<a class="quick-button span2" onclick="ingresar_externo();"><i class="icon-user"></i><p>INGRESAR NUEVO</p></a>
			<a class="quick-button span2" ><i class="icon-plus" disabled="disabled"></i><p>INGRESAR PROYECTO</p></a>
			<?   if ((($_SESSION["id_perfil"])==1) or (($_SESSION["id_perfil"])==3) )
 				{  ?>
					<a class="quick-button span2" onclick="asignaciones();"><i class="icon-pushpin"></i><p>ASIGNACIONES VIGENTES</p></a>
					<a class="quick-button span2" onclick="Asignaciones_hist();"><i class="icon-th-list"></i><p>ASIGNACIONES HISTORICAS</p></a>
					<a class="quick-button span2" onclick="ingresar_horas();"><i class="icon-time"></i><p>INGRESAR HORAS</p></a>
					
				<? } ?> 
			
			<div class="clearfix"></div>
		</div>	
	</div><!--/span-->
</div><!--/row-->
<div class="row-fluid">	
	<div class="box  span12" id="asignaciones" style='display:none;'>
		<div class="box-header"> Asignaciones Vigentes</div>
		<div class="box-content">
			Ver Asignaciones 
			<? include("asignaciones.php");?>
		<div class="clearfix"></div>
	</div>	
</div>
</div>
<div class="row-fluid">	
	<div class="box  span12" id="asignaciones_hist" style='display:none;'>
		<div class="box-header">Asignaciones Historicas</div>
		<div class="box-content">
			Ver Asignaciones Historicas
			<? include("asignaciones_hist.php");?>
		<div class="clearfix"></div>
	</div>	
</div>
</div>
<div class="row-fluid">	
<div class="box  span12" id="insertar" style='display:none;'>
	<div class="box-header"></div>
		<div class="box-content">
			INGRESAR PROFESIONALES 
			<div class="clearfix"></div>
		</div>	
	</div>
</div>

<script type="text/javascript">	
function consultar(){	
			document.getElementById('mantenedor').style.display = 'none';
			document.getElementById('nomina').style.display = 'block';
			}

function asignaciones(){
			document.getElementById('asignaciones').style.display = 'block';									
			document.getElementById('asignaciones_hist').style.display = 'none';									
			}
function Asignaciones_hist(){
			document.getElementById('asignaciones').style.display = 'none';									
			document.getElementById('asignaciones_hist').style.display = 'block';									
			}
</script>
<!--/row-->
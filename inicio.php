<div class="clearfix"></div>
	<div class="row-fluid">	
		<div class="box blue span12">
			<div class="box-header">
			<h2><i class="halflings-icon hand-top"></i><span class="break"></span>Inicio rapido</h2>
			</div>
			<div class="box-content" >				
			<a class="quick-button span3" onclick="ext_act();">
				<i class="icon-group"></i>
				<p>Profesionales Externos</p>
				<!--<span class="notification blue"><? echo $num_filas ?></span>-->
			</a>
			<a class="quick-button span3" onclick="informes();">
			<i class="icon-time"></i>
			<p>Horas</p>
			<? /*  mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");
						$queryh = "SELECT SUM(  `cant_hh_ldserv` ) AS total FROM  `ldserv`;";
						$resulth=mysql_query($queryh)or die("error =".mysql_error());
						$numh=mysql_num_rows($resulth);
						$num_filash=$numh;
						while($filah=mysql_fetch_array($resulth))
						{$horas=$filah["total"];}	*/
			?>						
			<!--<span class="notification green"><? echo  number_format($horas, 0) ?> </span>-->
			</a>
			<a class="quick-button span3"onclick="solicitudes();" >
				<i class="icon-shopping-cart"></i>
				<p>Solicitar-Devolver (Profesional)</p>
			</a>
			<a class="quick-button span3" onclick="msjes();">
				<i class="icon-envelope"></i>
				<p>Comentario</p>
			</a>
				<div class="clearfix"></div>
			</div>	
		</div>
<!--/span-->
	</div>
<!--/row-->
			
	<div class="row-fluid">	
		<div class="box  span12" id="ext_act" style='display:none;'>
			<div class="box-header">
			Profesionales externos que tiene a su cargo   <? echo $nombrep."  ".$apellido;  ?>
			</div>
		<div class="box-content">
	    <?  if ((($_SESSION["id_perfil"])==1) or (($_SESSION["id_perfil"])==3) ){
    			include("listado_externos.php");}
	   		if (($_SESSION["id_perfil"])==4){
		    	include("externos_por_perfil_jdpto.php"); }
	   		if (($_SESSION["id_perfil"])==2){
    			include("externos_por_perfil.php");}     
		?>
		<div class="clearfix"></div>
	</div>	
</div>
</div>
<!--fin  modulo Profesionales Externos-->

<div class="row-fluid">	
	<div class="box  span12" id="horas" style='display:none;'>
		<div class="box-content">
		<? // include("horas.php");?>
		<div class="clearfix"></div>
		</div>	
	</div>
</div>
<!--fin  modulo Horas-->

<div class="row-fluid">	
	<div class="box  span12" id="solicitudes" style='display:none;'>
		<div class="box-header"></div>
		<div class="box-content">
		MODULO EN CONSTRUCCIÓN 
		<div class="clearfix"></div>
		</div>	
	</div>
</div>
<!--fin  modulo Solicitar-Devolver (Profesional)-->

<div class="row-fluid">	
	<div class="box  span12" id="msjes" style='display:none;'>
		<div class="box-header"></div>
		<div class="box-content">
		MODULO EN CONSTRUCCIÓN 
		<div class="clearfix"></div>
		</div>	
	</div>
</div>
<!--fin  modulo Comentario-->

<script type="text/javascript">	
function ext_act(){
	document.getElementById('ext_act').style.display = 'block';
	document.getElementById('horas').style.display = 'none';
	document.getElementById('solicitudes').style.display = 'none';
	document.getElementById('msjes').style.display = 'none'; }
function horas(){
	document.getElementById('ext_act').style.display = 'none';
	document.getElementById('horas').style.display = 'block';
	document.getElementById('solicitudes').style.display = 'none';
	document.getElementById('msjes').style.display = 'none'; }
function solicitudes(){
	document.getElementById('ext_act').style.display = 'none';
	document.getElementById('horas').style.display = 'none';
	document.getElementById('solicitudes').style.display = 'block';
	document.getElementById('msjes').style.display = 'none'; }
function msjes(){
	document.getElementById('ext_act').style.display = 'none';
	document.getElementById('horas').style.display = 'none';
	document.getElementById('solicitudes').style.display = 'none';
	document.getElementById('msjes').style.display = 'block'; }
</script>
<!--/row-->

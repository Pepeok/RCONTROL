<? include("validacion.php");?>


<!DOCTYPE html>
<html lang="es">
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Departamento de Gestion</title>
	<meta name="description" content="">
	<meta name="author" content="Jose Zamora">
	<meta name="keyword" content="">
	<!-- end: Meta -->

	<!-- start: Mobile Specific  no scalable-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- end: Mobile Specific -->

	<link href="css/jquery.circliful.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link id="bootstrap" href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->


	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
		<![endif]-->

	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
		<![endif]-->
		
	
		
	</head>

	<? 
	$id_marca=$_GET['id_marca'];

	$dia_act=strftime("%d");
	$mes_act=strftime("%m");
	$ano_act=strftime("%Y");
	$hora_act=strftime("%H");
	$minutos_act=strftime("%M");
	$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
	$hora_actual=$hora_act.":".$minutos_act;

	$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;
 	
 	function invertirFecha($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }
 
     mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");


	$query="SELECT * ";
	$query.=" FROM funcionario f,  marcaciones m ";
	$query.=" WHERE  m.rut_marca=f.rut_func and m.id_marca=".$id_marca.";";	


 	//echo $query;


 $result=mysql_query($query)or die("error =".mysql_error());
                    $num=mysql_num_rows($result);
                    $num_filas=$num;



                  //    echo "<h3>Se Encontrarón= " . $num_filas. " Registros </h3>" ;

     
     
      while($fila=mysql_fetch_array($result))
                    {
     $fecha_marca=$fila["fecha_marca"];
     $fecha_muestra=invertirFecha($fecha_marca);
     $nombre=$fila["nombre_func"];
     $ape1=$fila["ape1_func"];
     $ape2=$fila["ape2_func"];
   	 $rut=$fila["rut_func"];
     $dv=$fila["dv_func"];	 
     $horain=$fila["hora_in_marca"];
     $horaout=$fila["hora_out_marca"];
     $id_marca=$fila["id_marca"];
     $rut_marca=$fila["rut_marca"];
     $cod_marca=$fila["cod-marca"];
     $in_marca=$fila["in_marca"];
     $out_marca=$fila["out_marca"];
     $estado_marca=$fila["estado_marca"];
     $control_marca=$fila["control_marca"];
     $cod_marca=$fila["cod_marca"];
     $comen_marca=$fila["comen_marca"];
     $hora_col=$fila["hora_colacion_func"];
     $hora_col_inserta="01:00:00";



}	
	?> 
<body>
 <div class="container-fluid">
	<div class="row-fluid">
		<div class="col-md-6">
			<h1 class="text-primary text-center">
				Control Horas Externos
			</h1>
			

			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Modificación Marca</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  name="form2" method="post" action="completar_marca.php">

							<input name="id_marca" type="hidden" value="<? echo $id_marca ?>" />
							<input name="fecha_marca" type="hidden" value="<? echo $fecha_marca ?>" />
							<input name="rut_marca" type="hidden" value="<? echo $rut_marca ?>" />
							<input name="cod_marca" type="hidden" value="<? echo $cod_marca ?>" />
							<input name="in_marca" type="hidden" value="<? echo $in_marca ?>" />
							<input name="hora_col" type="hidden" value="<? echo $hora_col ?>" />
							<input name="out_marca" type="hidden" value="<? echo $out_marca ?>" />
							<input name="nombre" type="hidden" value="<? echo $nombre ?>" />
							<input name="ape1" type="hidden" value="<? echo $ape1 ?>" />
							<input name="ape2" type="hidden" value="<? echo $ape2 ?>" />


							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Fecha:</label>
								<div class="controls">
								  <input class="input-xlarge focused uneditable-input" id="focusedInput" name="fecha_muestra" type="text" value="<? echo $fecha_muestra ?>">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Nombre</label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><? echo $nombre ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Apellidos </label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><? echo $ape1 ." ". $ape2 ?></span>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Rut </label>
								<div class="controls">
								  <span class="input-xlarge uneditable-input"><? echo $rut ."-". $dv; ?></span>
								</div>
							  </div>
		
   							  <div class="control-group">
								<label class="control-label">Seleccione</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="opcion" id="option" value="E" required>
									Entrada
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="opcion" id="option" value="S" required>
									Salida
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="opcion" id="option" value="ambas" required>
									Entrada y Salida
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="opcion" id="option" value="j" required>
									Ausencia Justificada
								  </label>
								  <div style="clear:both"></div>
								</div>
							  </div>
                             

                                <div class="control-group">
								<label class="control-label" for="focusedInput">Hora Ingreso</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="horain" name="horain" type="text" value=" <? echo $horain?>"required>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label" for="focusedInput">Hora Salida</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="horaout" name="horaout" type="text" value=" <? echo $horaout?>"required>
								</div>
								</div>
								<div class="control-group">
								<label class="control-label">Comentario </label>
								<div class="controls">
								<textarea class="input-xlarge" id="comentario" name ="comentario" required <? echo $comen_marca ?> ></textarea >
								</div>
							  </div>
							  
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" name="boton1" id="boton1">Completar</button>
									
								<button type="button" class="btn" name="boton2"  id="boton2"onclick="javascript:window.close();">Cancelar</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			
			<div class="alert alert-warning alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			  <strong>AVISO!</strong>  Este cambio se vera reflejado la semana siguiente</div>
</div><!--/row-->
</div>

  		<script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
	    <script src="js/jquery-1.9.1.min.js"></script>
	    <script src="js/jquery-migrate-1.0.0.min.js"></script>
	    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
		<script src="js/jquery.ui.touch-punch.js"></script>
		<script src="js/modernizr.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src='js/fullcalendar.min.js'></script>
		<script src='js/jquery.dataTables.min.js'></script>
		<script src="js/excanvas.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.pie.js"></script>
		<script src="js/jquery.flot.stack.js"></script>
		<script src="js/jquery.flot.resize.min.js"></script>
		<script src="js/jquery.chosen.min.js"></script>
		<script src="js/jquery.uniform.min.js"></script>
		<script src="js/jquery.cleditor.min.js"></script>
		<script src="js/jquery.noty.js"></script>
		<script src="js/jquery.elfinder.min.js"></script>
		<script src="js/jquery.raty.min.js"></script>
		<script src="js/jquery.uploadify-3.1.min.js"></script>
		<script src="js/jquery.gritter.min.js"></script>
		<script src="js/jquery.imagesloaded.js"></script>
		<script src="js/jquery.masonry.min.js"></script>
		<script src="js/jquery.knob.modified.js"></script>
		<script src="js/jquery.sparkline.min.js"></script>
		<script src="js/counter.js"></script>
		<script src="js/retina.js"></script>
		<script src="js/custom.js"></script>	
			
			
			
			
	<!-- start:  pie de pagina -->
				
	

    <? include("footer.php");?>
	</body>
	</html>
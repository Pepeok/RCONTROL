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

	

    mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");
?>

<body>
 <div class="container-fluid">
	<div class="row-fluid">
		<div class="col-md-6">
			<h1 class="text-primary text-center">
			Formulario Ingreso dias/horas		
			</h1>
			

			
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Ingrese Rut, dia y horas faltantes en Sistema.</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  name="form2" method="post" action="ingresar_hora.php">

							<input name="id_marca" type="hidden" value="" />
							
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Rut:</label>
								<div class="controls">
								  <input class="input-small focused " id="rut_func" name="rut_func" type="text"required >
								
								  <input class="input-mini focused " id="dv_func" name="dv_func" type="text"required >
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Fecha </label>
								<div class="controls">
								  <input class="input-large focused" id="fecha" name="fecha" type="date" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Horas Entrada </label>
								<div class="controls">
								  <input class="input-large focused" id="hora_in" name="hora_in" type="time" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Hora Colación </label>
								<div class="controls">
								  <input class="input-large focused" id="hora_col" name="hora_col" type="time" required>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Hora Salida </label>
								<div class="controls">
								  <input class="input-large focused" id="hora_out" name="hora_out" type="time" required>
								</div>
							</div>
						
				
							  <div class="form-actions">
								<button type="submit" class="btn btn-primary" name="boton1" id="boton1">Ingresar</button>
								<button type="button" class="btn" name="boton2"  id="boton2"onclick="javascript:window.close();">Cancelar</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
		
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
			
			
			
			

	</body>
	</html>
<!DOCTYPE html>
<html lang="es">

<?  $mes=$_GET['mes'];
    $anio=$_GET['anio'];

echo $fec_inicial="'".$anio."-".$mes."-01'";
echo "</br>";
echo  $fec_final="'".$anio."-".$mes."-31'";



?>
<head>

	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Departamento de Informática Gestión</title>
	<meta name="description" content="Departamento de apoyo transversal en la SDI">
	<meta name="author" content="José Zamora">
	<meta name="keyword" content="Sistema , Control, Horas">
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
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">

		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
		
	
		
	</head>

<body>
 <div class="container-fluid">
	 <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break">	</span>Marcas x mes</h2>
						
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">

	<tr>
    <th scope="col">Num</th>
    <th scope="col">FECHA</th>
    <th scope="col">EMPRESA</th>
    <th scope="col">PERFIL/LS</th>
    <th scope="col">DPTO</th>
    <th scope="col">RUT</th>
    <th scope="col">DV</th>
    <th scope="col">NOMBRE</th>
    <th scope="col">APELLIDO</th>
    <th scope="col">FECHA INGRESO</th>
    <th scope="col">FECHA SALIDA</th>
    <th scope="col">HORA ENTRADA</th>
    <th scope="col">HORA SALIDA</th>
    <th scope="col">COLACION</th>
    <th scope="col">COMENTARIO</th>
    <th scope="col">MODIFICACION</th>

  </tr>
  
						  	 <? $id_usuario=$_SESSION["id_usuario"]; 
						  		$perfil=$_SESSION["id_perfil"];
								$nombre=$_SESSION["nombre"];
								$apellido=$_SESSION["apellido"];
								$email=$_SESSION["email"];
								
						  	
						  		include("../conectabd/conexion_bd.php");
						        mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");
    							
    							/*$query="SELECT DISTINCT m.fecha_marca, e.nombre_empresa, l.perfil_ldserv, l.sigla_ldserv,  ";
    							$query.=" f.rut_func, f.dv_func, f.nombre_func, f.ape1_func, f.fech_ing_func, f.fech_out_func, ";
    							$query.=" m.hora_in_marca, m.hora_out_marca, m.hora_colacion_func, m.comen_marca, m.log_marca , d.nombre_dpto " ;
    							$query.=" FROM funcionario f, marcaciones m, empresa e, ldserv l , dpto d , asignado a";
    							$query.=" WHERE f.rut_func = m.rut_marca ";
    							$query.= "AND f.id_func=a.id_funcionario_asignado ";
    							$query.= "AND a.id_dpto_asignado=d.id_dpto ";
    							$query.=" AND f.id_ldserv_func = l.id_ldserv ";
    							$query.=" AND f.id_emp_func = e.id_empresa ";
    							$query.=" AND m.cod_marca =0 ";
    							$query.=" AND (m.control_marca <=2 OR m.control_marca =5) ";
    							$query.=" AND m.fecha_marca >=".$fec_inicial." ";
    							$query.=" ORDER BY m.fecha_marca, m.rut_marca DESC ";
    							*/

    							$query=" SELECT f.nombre_func, f.ape1_func, f.rut_func, f.dv_func, f.fech_ing_func, f.fech_out_func, m.fecha_marca, m.hora_in_marca, m.hora_out_marca, m.hora_colacion_func, l.perfil_ldserv, e.nombre_empresa, m.comen_marca, d. * 
FROM funcionario f, marcaciones m, empresa e, ldserv l, dpto d
WHERE f.estado_func =1
AND f.rut_func = m.rut_marca
AND m.fecha_marca >=2015 -09 -01
AND m.fecha_marca >= f.fech_ing_func
AND m.fecha_marca <= f.fech_out_func
AND d.id_dpto = f.id_dpto_func
AND m.cod_marca =0
AND (
m.control_marca <=2
OR m.control_marca =5
)
AND f.id_ldserv_func = l.id_ldserv
AND f.id_emp_func = e.id_empresa
ORDER BY m.rut_marca, m.fecha_marca";

    						   //echo $query;

                                        $result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;

										$hora_perfil=0;
								
    									$reg=1;										
										while($fila=mysql_fetch_array($result))
										{	

											$fecha_marca=$fila["fecha_marca"];
											$nombre_empresa=$fila["nombre_empresa"];
											$perfil_ldserv=$fila["perfil_ldserv"];
                      						$sigla_ldserv=$fila["sigla_ldserv"];
                      						$rut_func=$fila["rut_func"];
											$dv_func=$fila["dv_func"];
											$nombre_func=$fila["nombre_func"];
                      						$ape1_func=$fila["ape1_func"];
											$fecha_ing_func=$fila["fech_ing_func"];
                      						$fecha_out_func=$fila["fech_out_func"];
                      						$hora_in_marca=$fila["hora_in_marca"];
                      						$hora_out_marca=$fila["hora_out_marca"];
                      						$hora_colacion=$fila["hora_colacion_func"];
                      						$comen_marca=$fila["comen_marca"];
                      						$log_marca=$fila["log_marca"];
                      						$nombre_dpto=$fila["nombre_dpto"];
										
				                     ?>
										 <tr>
   											 <td>&nbsp;<? echo $reg ?></td>
   											 <td>&nbsp;<? echo $fecha_marca ?></td>
   											 <td>&nbsp;<? echo $nombre_empresa ?></td>
   											 <td>&nbsp;<? echo $perfil_ldserv ?></td>
   											 <td>&nbsp;<? echo $nombre_dpto ?></td>
   											 <td>&nbsp;<? echo $rut_func ?></td>
   											 <td>&nbsp;<? echo $dv_func?></td>
   											 <td>&nbsp;<? echo $nombre_func ?></td>
   											 <td>&nbsp;<? echo $ape1_func ?></td>
   											 <td>&nbsp;<? echo $fecha_ing_func ?></td>
   											 <td>&nbsp;<? echo $fecha_out_func ?></td>
   											 <td>&nbsp;<? echo $hora_in_marca ?></td>
   											 <td>&nbsp;<? echo $hora_out_marca ?></td>
   											 <td>&nbsp;<? echo $hora_colacion ?></td>
   											 <td>&nbsp;<? echo $comen_marca ?></td>
   											 <td>&nbsp;<? echo $log_marca ?></td>
   										  </tr>

								     <?

								      $reg++;

								     
								 }

								 

?>
								     	
</table>
    
					</div>
				</div><!--/span-->
			</div><!--/row-->
  







 

 </div>
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
		<script src="js/jquery.iphone.toggle.js"></script>
		<script src="js/jquery.uploadify-3.1.min.js"></script>
		<script src="js/jquery.gritter.min.js"></script>
		<script src="js/jquery.imagesloaded.js"></script>
		<script src="js/jquery.masonry.min.js"></script>
		<script src="js/jquery.knob.modified.js"></script>
		<script src="js/jquery.sparkline.min.js"></script>
		<script src="js/counter.js"></script>
		<script src="js/retina.js"></script>
		<script src="js/custom.js"></script>
		

		 <script language="javascript">

     function validar_formulario(formulario)
     {
       if(formulario.dateArrival.value=="")
         {
           alert("Ingrese Fecha hasta cuando debe estar publicada la Noticia !!");
           formulario.dateArrival.focus();
           return false;
         }
       if(formulario.resumen_noticia.value=="")
         {
           alert("Ingrese Titulo !!");
           formulario.resumen_noticia.focus();
           return false;
         }else{
           if(formulario.resumen_noticia.value.length>800)
             {
               alert("El Texto del Titulo no puede contener m\341s de 200 caracteres !!");
               formulario.resumen_noticia.focus();
               return false;
             }
		 }
       if(formulario.texto_noticia.value=="")
         {
           alert("Ingrese Texto de La noticia !!");
           formulario.texto_noticia.focus();
           return false;
         }
       else
         {
           if(formulario.texto_noticia.value.length>800)
             {
               alert("El Texto de la noticia no puede contener m\341s de 800 caracteres !!");
               formulario.texto_noticia.focus();
               return false;
             }
         }

       formulario.submit();

     }

   </script>
			
			
			
			
	<!-- start:  pie de pagina -->
				
	
 </div>
    <? include("footer.php");?>

	</body>
	</html>
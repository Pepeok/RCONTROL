<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informe Mensual</title>
<style type="text/css">
.tabla_bordes {
  border-top-style: none;
  border-right-style: none;
  border-bottom-style: none;
  border-left-style: none;
}
</style>
</head>
  
<? 	include("../conectabd/conexion_bd.php"); 
   	include("libreria.php");
   	include("js.php");
 
// Datos que recibo de la Consulta //    
  	$anio=$_POST['anio'];
  	$mes=$_POST['mes'];
  	$empresa=$_POST['empresa'];
  	$pgc=$_POST['pgc']; 
//echo $pro_gc="'".$pro_gc."'";
	if ($mes<10){
		$mes="0".$mes;
		}
// Datos de fecha y hora actual en el servidor //
  	$dia_act=strftime("%d");
  	$ano_act=strftime("%Y");
  	$hora_act=strftime("%H");
  	$minutos_act=strftime("%M");
  	$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
  	$hora_actual=$hora_act.":".$minutos_act;
//++++++FIN_ fecha del Servidor*****//
 
	$fecha_ini_consulta="'".$anio."-".$mes."-01'";
	$fecha_fin_consulta="'".$anio."-".$mes."-31'";
	$fecha_exel=$anio."".$mes;
// Geenero el nombre del mes 
	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	$numero_nombre_mes=($mes-1);
	$nombre_mes=$meses[$numero_nombre_mes];
// Fin del nombre del mes

	mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");
	$querycont= " SELECT * from contrato where id_empresa_contrato=".$empresa."  and id_pgc_contrato=".$pgc." ;";
	//echo $querycont;

   	$resultcont=mysql_query($querycont)or die("error =".mysql_error());
	$num=mysql_num_rows($resultcont);
	$num_filas=$num;
	while($fila=mysql_fetch_array($resultcont))
		{
		$nombre_contrato=$fila["nombre_contrato"];
		$pro_gc_contrato=$fila["pro_gc_contrato"];
		$oc_contrato=$fila["oc_contrato"];
		$fecha_oc_contrato=$fila["fecha_oc_contrato"];
		$fecha_oc_contrato=invertirFecha($fecha_oc_contrato);
		$valoruf_oc_contrato=$fila["valoruf_oc_contrato"];
		$txt=" al ". $fecha_oc_contrato." Fecha O/C";
		if ($valoruf_oc_contrato=="0.00"){
			$valoruf_oc_contrato="al D&iacutea de Emis&oacuten Factura";
			$fecha_oc_contrato="";
			$txt="";
		}

        } ?>


<body>

<div id="inf_mensual">
<table align="center" width="90%" border="1" cellspacing="1" cellpadding="0">
	<tr bgcolor="#999999">
		<th>INFORME MENSUAL DE HORAS PARA FACTURACIÓN</th>
	</tr>
</table>
	<p align="center">Mes de <? echo $nombre_mes ?> del <? echo $anio ?><br />
	Valor UF $ <? echo $valoruf_oc_contrato ?> <? echo $txt; ?> 
	</p>
	</br>
	
	<div id="parte1">
		<? include("parte1_mes.php"); ?>
	</div> 
	</br>
	 
	<div id="parte2">
		<? include("parte2_mes.php"); ?>
	</div>  
	</br>
	  
	<div id="parte3">
		<? include("parte3_mes.php"); ?>
	</div>  
	</br>
	
	<div id="parte4">
		<? include("parte4_mes.php"); ?>
	</div>  
</div>
</body>
</html>

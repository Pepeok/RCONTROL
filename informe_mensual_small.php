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
		//	include("libreria.php");
		include("js.php");
		error_reporting(0);

		// Datos que recibo de la Consulta //    
		$anio=$_POST['anio'];
		$mes=$_POST['mes'];
		$empresa=$_POST['empresa'];
		$pgc=$_POST['pgc']; 
		$ldserv=$_POST['ldserv']; 
		$ldservn=$_POST['ldserv']; 

		if ($mes<10){
			$mes="0".$mes;
		}
		// Datos de fecha y hora actual en el servidor //
		$dia_act=strftime("%d");
		$ano_act=strftime("%Y");
		$hora_act=strftime("%H");
		$minutos_act=strftime("%M");
			//$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
		$hora_actual=$hora_act.":".$minutos_act;
		$fecha_ini_consulta="'".$anio."-".$mes."-01'";
		$fecha_fin_consulta="'".$anio."-".$mes."-31'";

		// Geenero el nombre del mes 
		$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$numero_nombre_mes=($mes-1);
		$nombre_mes=$meses[$numero_nombre_mes];
		// Fin del nombre del mes

		mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");
		$querycont= "  SELECT * FROM contrato c, empresa e, empco em, pgcompras pg , inter1 i, ldserv l";
		$querycont .=" WHERE e.id_empresa =".$empresa."  ";
		$querycont.= " AND e.id_empresa = em.id_empresa_empco ";
		$querycont.= " AND em.id_contrato_empco = c.id_contrato";
		$querycont.= " AND em.pro_gc_empco = pg.id_pgcompras ";
		$querycont.= " AND pg.id_pgcompras= ".$pgc." ";
		$querycont.= " AND e.id_empresa = i.id_empresa_inter1 ";
		$querycont.= " AND i.id_ldserv_inter1 = l.id_ldserv  ";
		$querycont.= " AND l.id_ldserv =".$ldserv." ; ";


		//echo $querycont;

		$resultcont=mysql_query($querycont)or die("error =".mysql_error());
		$num=mysql_num_rows($resultcont);

		$num_filas=$num;

		if($num_filas>0 ){

			while($fila=mysql_fetch_array($resultcont))
			{
				$nombre_contrato=$fila["nombre_contrato"];
				$nombre_empresa=$fila["nombre_empresa"];
				$pro_gc_contrato=$fila["pro_gc_contrato"];
				$oc_contrato=$fila["oc_contrato"];
				$fecha_oc_contrato=$fila["fecha_oc_contrato"];
				$valoruf_oc_contrato=$fila["valoruf_oc_contrato"];	
				$ldserv=$fila["perfil_ldserv"];	
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
							<th>INFORME MENSUAL DE HORAS RESUMIDO</th>
						</tr>
					</table>
					<p align="center">Mes de <? echo $nombre_mes ?> del <? echo $anio ?><br />
						Valor UF $ <? echo $valoruf_oc_contrato ?> <? echo $txt; ?> 
					</p>
				</br>

				<div id="parte1">
					<table  align="center"width="90%" border="1" cellspacing="1" cellpadding="0">
						<tr>
							<th width="8%" bgcolor="#999999" scope="col">Proceso Grandes Compras</th>
							<th width="12%" bgcolor="#999999" scope="col">Empresa</th>
							<th width="10%"  bgcolor="#999999" scope="col">Contrato</th>
							<th width="30%" bgcolor="#999999" scope="col">OC</th>
							<th width="30%" bgcolor="#999999" scope="col">LdServ</th>
						</tr>
						<tr align="center">
							<td><? echo $pro_gc_contrato ?></td>
							<td><? echo $nombre_empresa ?></td>
							<td><? echo $nombre_contrato ?></td>
							<td><? echo $oc_contrato ?></td>
							<td><? echo $ldserv ?></td>
						</tr>
					</table>


				</div> 

				<br><br><br>

				<table  id="Exportar_a_Excel" align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
					<tr bgcolor="#999999">
						<th colspan="10" scope="col">DETALLE</th>
					</tr>
					<tr  bgcolor="#999999">

						<th scope="col">RUT</th>
						<th scope="col">NOMBRE y APELLIDO</th>
						<th scope="col">LINEA DE SERVICIO </th>
						<th scope="col">TOTAL HH / MES </th>
					</tr>
					<?
					$reg = 1;
					mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
					$query4 = " SELECT f.id_func, f.nombre_func, f.ape1_func, f.rut_func, f.dv_func, l.perfil_ldserv ";
					$query4.= " FROM funcionario f, empresa e, ldserv l, empco ec, contrato c ";
					$query4.= " WHERE f.id_ldserv_func = l.id_ldserv ";
					$query4.= " AND f.id_ldserv_func =".$ldservn." ";
					$query4.= " AND f.estado_func =".$pgc. " " ;
					$query4.= " AND f.id_emp_func = e.id_empresa ";
					$query4.= " AND e.id_empresa =".$empresa." ";
					$query4.= " GROUP BY f.rut_func ; ";

		    //echo $query4;
					$result4=mysql_query($query4)or die("error = ".mysql_error());
					$num4=mysql_num_rows($result4);
					$num_filas4=$num4;
					while($fila4=mysql_fetch_array($result4))
					{
						$nombre_func=$fila4["nombre_func"];
						$ape1_func=$fila4["ape1_func"];
						$rut_func=$fila4["rut_func"];
						$dv_func=$fila4["dv_func"];
						$perfil_ldserv=$fila4["perfil_ldserv"];
						$pro_gc_contrato=$fila4["pro_gc_contrato"];
						?>		
						<tr align="center">			  
							<td><button onclick="traer_marcas( <?php echo $rut_func ."," . $fecha_ini_consulta .", ".$fecha_fin_consulta?>);return false;"> <? echo $rut_func."-".$dv_func; ?></button></td>
							<td> <? echo $nombre_func." ".$ape1_func ?></td>
							<td><? echo $perfil_ldserv ?> </td>

							<?
							mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

							$query1 = "  SELECT m.*";
							$query1.= "  FROM  marcaciones m ";
							$query1.= "  WHERE m.rut_marca =".$rut_func." ";
							$query1.= "  AND (m.control_marca <=2 OR m.control_marca =5) ";
							$query1.= "  AND m.fecha_marca >=".$fecha_ini_consulta." ";
							$query1.= "  AND m.fecha_marca <=".$fecha_fin_consulta." ;";

		    //echo $query1;

							$resultado2=mysql_query($query1)or die("error =".mysql_error());
							$num1=mysql_num_rows($resultado2);
							$num_filas1=$num1;


							$horatotal1='00:00:00';
							$hhfacturable1='00:00:00';
							$reg1 = 1;


							while($fila1=mysql_fetch_array($resultado2))
							{

								$fecha_mostrar1=$fila1["fecha_marca"];
								$hora_in_marca1=$fila1["hora_in_marca"];
								$hora_out_marca1=$fila1["hora_out_marca"];
								$hora_colacion_func1=$fila1["hora_colacion_func"];
								$diferencia =  date("H:i:s", strtotime("00:00:00") + strtotime($hora_out_marca1) - strtotime($hora_in_marca1)); 
								$almuerzo = date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($hora_colacion_func1));
								$dias1 = $num_filas1;
								$horatotal1 = sumahoras($horatotal1, $almuerzo);
	
							}


							?>

							<td><? echo $horatotal1 ?> </td>

						</tr> 	
						<?	$reg++; 
					} ?>
				</tbody>
			</table>            


			<div  id="Detalle">

				<h3 align="center">Seleccion un rut Para ver el detalle </h3>
			</div>

		</div>


		<?




	}else{ ?>

	<script type="text/javascript">
	sin_datos();
	</script>
	<?php } 



	function invertirFecha($Fecha) {
		$Fecha = explode("-", $Fecha);
		$fec = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];
		return $fec; 
	}

	function sumahoras($hora1, $hora2) {
		$hora1 = explode(":", $hora1);
		$hora2 = explode(":", $hora2);
		$horas = (int) $hora1[0] + (int) $hora2[0];
		$minutos = (int) $hora1[1] + (int) $hora2[1];
		$segundos = (int) $hora1[2] + (int) $hora2[2];
		$horas+=(int) ($minutos / 60);
		$minutos = (int) ($minutos % 60) + (int) ($segundos / 60);
		$segundos = (int) ($segundos % 60);
		return (intval($horas) < 10 ? '0' . intval($horas) : intval($horas)) . ':' . ($minutos < 10 ? '0' . $minutos : $minutos) . ':' . ($segundos < 10 ? '0' . $segundos : $segundos);
	}

	?>





	</body>
	</html>


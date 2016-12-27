<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//Es" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Control HH externos</title>
  

  <link rel="stylesheet" type="text/css" href="./css/style_sdi.css" />
   </head>
<body>
<h2 align="left"> Enviar Mail con las Marcas Pendientes.</h2>

<?php

 date_default_timezone_set('America/Santiago');

include("js.php"); 
	
	$dia_act=strftime("%d");
	$mes_act=strftime("%m");
	$ano_act=strftime("%Y");
	$hora_act=strftime("%H");
	$minutos_act=strftime("%M");
	
	$fecha_actual=$dia_act."-".$mes_act."-".$ano_act;
	$hora_actual=$hora_act.":".$minutos_act;
	
	//$fecha_consulta=$ano_act."-".$mes_act."-".$dia_act;
 //  $mes_act=9;
	
	$fecha_consulta_act="'".$ano_act."-".$mes_act."-".$dia_act."'";
	$fecha_consulta="'".$ano_act."-".$mes_act."-01'";
	$fecha_consulta_inicio="'".$ano_act."-".$mes_act."-01'";
	$fecha_consulta_fin="'".$ano_act."-".$mes_act."-31'";


	

  include("../conectabd/conexion_bd.php");

    $para = "inf_gestion.externos@sii.cl , coordinacion_gc5748@sii.cl, ";
    $para .=" jacrojas@sii.cl , catherine.figueroa@sii.cl,  ";
    $para .=" sandra.cifuentes@sii.cl ";
    $asunto = "Marcas Pendientes de Regularizar.";

    	   $mensaje  = "<html>\n";
           $mensaje .= "<body>\n";
           $mensaje .="Estimad@s jef@s de Proyecto:\n";
           $mensaje .="</br>";
           $mensaje .= "<b><font color='red'>Existen las siguientes marcas pendientes por Regularizar</font></b><br>\n";
           $mensaje .="<br>";
           $mensaje .= "<center>\n";
           $mensaje .= "<table border=1 width=80%>\n";
           $mensaje .= "<thead>\n";
           $mensaje .= "<tr>\n";
		   $mensaje .= "<th>#</th>\n";
		   $mensaje .= "<th>JEFE PROYECTO</th>\n";
		   $mensaje .= "<th>RUT</th>\n";
		   $mensaje .= "<th>NOMBRE</th>\n";
		   $mensaje .= "<th>APELLIDO</th>\n";
		   $mensaje .= "<th>FECHA</th>\n";
		   $mensaje .= "<th>ENTRADA</th>\n";
		   $mensaje .= "<th>COLACION</th>\n";
	       $mensaje .= "<th>SALIDA</th>\n";
		   $mensaje .= "</tr>\n";
		   $mensaje .= "</thead>\n";
		   $mensaje .= "<tbody>\n";


	 						 $reg=1;
	 						 
					  		 mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");

						        $query=" SELECT u.nombre, u.apellido, u.email_usuario, f.id_func, f.nombre_func, f.ape1_func, "; 
						        $query.=" f.rut_func, f.dv_func, f.fech_ing_func, f.fech_out_func, m. * ";
						        $query.=" FROM funcionario f, marcaciones m, usuario u, asignado a ";
						        $query.=" WHERE id_usuario = a.id_jefepro_asignado ";
						        $query.=" AND m.cod_marca=0 ";
						        $query.=" AND a.id_funcionario_asignado = f.id_func ";
						        $query.=" AND f.estado_func >0 ";
						        $query.=" AND f.rut_func = m.rut_marca ";
						        $query.=" AND m.fecha_marca>=f.fech_ing_func ";
						        $query.=" AND m.fecha_marca<=f.fech_out_func ";
						        $query.=" AND m.fecha_marca>=".$fecha_consulta." ";
						        $query.=" AND ( m.control_marca<=2 ) ";
						        $query.=" AND a.estado_asignado>0 ";
						        $query.=" AND (m.hora_in_marca='00:00:00' or m.hora_out_marca='00:00:00') ";
						        $query.=" ORDER BY m.rut_marca, m.fecha_marca ;";

						    	// echo $query;

										$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;
    					
    						
									while($fila=mysql_fetch_array($result))
										{

																						
											
											$nombre_func=$fila["nombre_func"];
											$ape1_func=$fila["ape1_func"];
											$rut_func=$fila["rut_func"];
											$dv_func=$fila["dv_func"];
											$id_marca=$fila["id_marca"];
											$fecha_marca=$fila["fecha_marca"];
											$hora_in_marca=$fila["hora_in_marca"];
											$hora_colacion_func=$fila["hora_colacion_func"];
											$hora_out_marca=$fila["hora_out_marca"];
											$comen_marca=$fila["comen_marca"];
											$nombre=$fila["nombre"];
											$apellido=$fila["apellido"];
											$email_usuario=$fila["email_usuario"];
											$jefepro=$nombre." ".$apellido;
											$fecha_marca_mostrar=invertirFecha($fecha_marca);
											$control_marca=$fila["control_marca"];

											//resto las horas
											 $diferencia=resta5($hora_in_marca,$hora_out_marca);
											// le resto la hora de colacion
											 $hhfacturable=almuerzo5($diferencia,$hora_colacion_func);
												
			
							$mensaje .= "   <tr align='center'>\n";	
							$mensaje .= "	<td>  $reg </td>\n";
							$mensaje .= "	<td>  $jefepro </td>\n";
							$mensaje .= "	<td>  $rut_func-$dv_func</td>\n";
							$mensaje .= "	<td>  $nombre_func </td>\n";
							$mensaje .= "	<td>  $ape1_func</td>\n";
							$mensaje .= "	<td>  $fecha_marca_mostrar </td>\n";
							$mensaje .= "	<td>  $hora_in_marca </td>\n";
							$mensaje .= "	<td>  $hora_colacion_func</td> \n";
							$mensaje .= "	<td>  $hora_out_marca </td>\n";
							
												 							
							$reg++; 
							} // fin de while
					    

					$mensaje .= "	</tr>\n";
			        $mensaje .= "	</tbody>\n";		
                    $mensaje .= "	</table>\n";   
                    $mensaje .= " </center>\n";
					$mensaje .= " </br>";                    
                    $mensaje .= " Debe Ingresar al sitio  <a href='http://lime/rcontrol'>http://lime/rcontrol</a> y realizar la regularizacion de estas Marcas.\n";
					$mensaje .= "</br>";	
					$mensaje .=" Cualquier consulta o dudas relacionados con este correo escribanos a <a href='mailto:inf_gestion.externos@sii.cl'>inf_gestion.externos@sii.cl</a>. \n";
		           	$mensaje .= "</br>";
		           	$mensaje .=" Si usted ya regularizo esta marca no considerar este mensaje.\n";
		           	$mensaje .= "</br>";
		           	$mensaje .=" Departamento de Informática Gestión.";
		           	$mensaje .= "	<html>\n";
	  				$mensaje .= "	<body>\n";
	
	 				$cabeceras  = 'From: inf_gestion.externos@sii.cl' . "\r\n";
  					$cabeceras .= 'Reply-To: inf_gestion.externos@sii.cl' . "\r\n";
  					$cabeceras .= "MIME-Version: 1.0\r\n";
  					$cabeceras .= "Content-Type: text/html; charset=UTF-8\r\n";
 echo $mensaje;
 
 echo "</br>". $para;

 if(mail($para, $asunto, $mensaje, $cabeceras))
    {

           
      ?>
         <script language="javascript">
             alert("Se ha enviado el Mail  Correctamente !!");
             window.close();
           </script>
      <?

    }else{
		
		?>
         <script language="javascript">
             alert("No se pudo Enviar el Mail!!");
             window.close();
           </script>
      <?
		
		
		
		
	}
	
	
function resta5($inicio, $fin)
  	{
  	  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  	  return $dif;
    }
function almuerzo5($diferencia, $horal)
    {
  	  $alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
  	  return $alm;
  	}
function invertirFecha($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }

function Fecha_mysql($Fecha){
    $Fecha=explode("-",$Fecha);
    $femysql=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $femysql;
     }  
?>
</body>
</html>

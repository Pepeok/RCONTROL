
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script language="javascript">

  function modifica_marca(id)
  {
    window.open('mod_marca.php?id_marca=+'+id+'+', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');


  }
   function falta_marca(id)
  {
    window.open('completa_marca.php?id_marca=+'+id+'+', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');

  }

</script>


<?php
    
include("../conectabd/conexion_bd.php");
     $id_usuario=$_SESSION["id_usuario"];
     $perfil=$_SESSION["id_perfil"];
?>

 

<table class="table table-striped table-bordered bootstrap-datatable datatable" >


						  <thead>
							  <tr>
							  	  <th>#</th>
							  	  <th>EMPRESA</th>
								  <th>PERFIL</th>
								  <th>RUT</th>
								  <th>NOMBRE</th>
								  <th>APELLIDO</th>
								  <th>FECHA</th>
								  <th>ENTRADA</th>
								  <th>COLACION</th>
								  <th>SALIDA</th>
								  <th>HH FACTURABLE</th>
								  <th>ACCIÓN</th>
							  </tr>
						  </thead>   
						  <tbody>

						  <? $reg=1;
					

					mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");

								
    							$query=" SELECT DISTINCT e.nombre_empresa, m. * , f. *,  l.perfil_ldserv ";
    							$query.=" FROM funcionario f, empresa e, marcaciones m, asignado a, usuario u , ldserv l";
    							$query.=" WHERE a.id_jefepro_asignado =".$id_usuario." ";
    							$query.=" AND a.id_funcionario_asignado = f.id_func ";
    							$query.=" AND f.id_ldserv_func = l.id_ldserv ";
    							$query.=" AND f.estado_func >0 ";
    							$query.=" AND m.cod_marca =0 ";
    							$query.=" AND ( m.control_marca<=2 or m.control_marca =5 )";
    							$query.=" AND m.fecha_marca>=".$fecha_consulta." ";
    							$query.=" AND m.fecha_marca >= f.fech_ing_func ";
    							$query.=" AND m.fecha_marca<=f.fech_out_func ";
    							$query.=" AND m.fecha_marca<=a.fecha_fin_asignado ";
    							$query.=" AND f.rut_func = m.rut_marca ";
    							$query.=" AND f.id_emp_func = e.id_empresa ";
    							$query .=" AND a.fecha_fin_asignado >= ".$fecha_consulta_user." ";
    							$query.=" ORDER BY m.rut_marca, m.fecha_marca ;";

    						//echo $query;
										
    									$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;

									    echo "<h3>Se Encontrarón= " . $num_filas. " Registros </h3>" ;

									    $reg=1;
									while($fila=mysql_fetch_array($result))
										{

																						
											
											$id_marca=$fila["id_marca"];
											$nombre_func=$fila["nombre_func"];
											$ape1_func=$fila["ape1_func"];
											$rut_func=$fila["rut_func"];
											$dv_func=$fila["dv_func"];
											$fecha_marca=$fila["fecha_marca"];
											$hora_in_marca=$fila["hora_in_marca"];
											$hora_colacion_func=$fila["hora_colacion_func"];
											$hora_out_marca=$fila["hora_out_marca"];
											$comen_marca=$fila["comen_marca"];
											$nombre_empresa=$fila["nombre_empresa"];
											$perfil_ldserv=$fila["perfil_ldserv"];
											$fecha_marca_mostrar=invertirFecha($fecha_marca);
										  	$control_marca=$fila["control_marca"];

											//resto las horas
											 $diferencia=resta($hora_in_marca,$hora_out_marca);
											// le resto la hora de colacion
											 $hhfacturable=almuerzo($diferencia,$hora_colacion_func);

											?>		



							
							<tr> 
								

								<td><? echo $reg ?></td>
								<td><? echo $nombre_empresa ?> </td>
								<td><? echo $perfil_ldserv ?> </td>
								<td> <? echo $rut_func."-".$dv_func; ?></td>
								<td> <? echo $nombre_func ?></td>
								<td> <? echo $ape1_func ?></td>
								<td> <? echo $fecha_marca_mostrar ?></td>
								<td> <? echo $hora_in_marca ?></td>
								<td> <? echo $hora_colacion_func; ?></td> 
								<td> <? echo $hora_out_marca ?></td>


								<!-- aca empiezo a controlar las marcas -->
								
								<!-- si la marca es 0 y el control es muestra por que falto-->
						<? if ($hora_in_marca=="00:00:00" and $hora_out_marca=="00:00:00")
						{ 
							  if ($control_marca==5)
							  	{ ?>
								<td width="15%;"><? echo $comen_marca ?></td>
								<td> <a  href="javascript:falta_marca('<? echo $id_marca; ?>') " title="Modificar" class="btn btn-mini btn-success"  title="Modificar">
									<i class="halflings-icon edit white"></i></a>
								</td><!--fin ausencia justificada-->
								
								<? } 
						}
						
						// aca muestro error cuando falta una marca y lo mando a modificar con el falta marca
						if ($hora_in_marca=="00:00:00" or $hora_out_marca=="00:00:00")
							{ 
							    if ($control_marca==0 or $control_marca==1 )
							    	{ ?>
								<td class="alert alert-danger">Falta Marca </td>
								<td> <a  href="javascript:falta_marca('<? echo $id_marca; ?>') " title="Modificar" class="btn btn-mini btn-success"  title="Modificar">
									<i class="halflings-icon edit white"></i></a>
								</td>
								<?  } 

							}	// fin al falta marca

							   
							    if ($control_marca==2)
							    	{ ?>
							    <td> <? echo $hhfacturable ?> </td>
								<td class="alert alert-info">OK </td>
							
								<?  }
						if ($hora_in_marca>"00:00:00" and $hora_out_marca>"00:00:00")
							{ 
							    if ($control_marca<2)
							    	{ ?>
								<td> <? echo $hhfacturable ?> </td>
								<td> <a  href="javascript:modifica_marca('<? echo $id_marca; ?>') " title="Modificar" class="btn btn-mini btn-success"  title="Modificar">
									<i class="halflings-icon edit white"></i></a>
								</td>
								<?  } 

							}	

				$reg++;
					}	?> 
					</tr> 

					<?	 ?>


						

						

						
						 	

						  </tbody>

						  
</table>            


							<? function resta($inicio, $fin)
  									{
  										

  									 	$dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  										
  										return $dif;
  									 }

							function almuerzo($diferencia, $horal)
 									{
  										

  									 	$alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
  										
  										return $alm;
  									 }

  							function redondear_hora($hora){
                                  $sep = explode(':', $hora);
                                  $minutos=$sep[1];
                                  $hora=$sep[0];
                                  if($minutos>30){
                                      $hora=$hora+1;
                                  }
                                  return "$hora:00";   // sin minutos
				}

  					?>	

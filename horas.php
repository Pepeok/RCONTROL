<table class="table table-striped table-bordered bootstrap-datatable ">
						  <thead>
							  <tr>
							  	  <th>#
							  	  <th>Linea De Servicio</th>
								  <th>Empresa.</th>
								  <th>Cant. Horas</th>
								  <th>Precio Unitario (UF)</th>
								  <th>Precio Total (UF=24.963)</th>
								  <th>Precio Total ($)</th>
								   </tr>
						  </thead>   
						  <tbody>

						  	<? $reg=1;
						              mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");


						              	$query = " Select * from ldserv  where id_ldserv>0 order by id_ldserv"; 
	 									
										//echo $query;

										$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;

										while($fila=mysql_fetch_array($result))
										{
											$id_ldserv=$fila["id_ldserv"];
											$perfil_ldserv=$fila["perfil_ldserv"];
											$cant_hh_ldserv=$fila["cant_hh_ldserv"];
											$precio_uf_ldserv=$fila["precio_uf_ldserv"];

											$dv_func=$fila["dv_func"];
											$fech_ing_func=$fila["fech_ing_func"];
											$fech_out_func=$fila["fech_out_func"];
											$id_emp_func=$fila["id_emp_func"];
											$nombre_func=$fila["nombre_func"];
											$nombre_empresa=$fila["nombre_empresa"];
											$perfil_ldserv=$fila["perfil_ldserv"];
							?>		



							
							<tr> 
								<td><? echo $reg ?></td>
								<td><? echo $perfil_ldserv ?></td>
								<td> <? echo $nombre_empresa ?></td>
								<td> <? echo number_format($cant_hh_ldserv, 0); ?></td>
								<td> <? echo $precio_uf_ldserv ?></td>
								<?  $uf_a_dec=(100*$precio_uf_ldserv);
									$totaluf=($uf_a_dec*$cant_hh_ldserv)/100;
									$uf=24963;
									$totalpesos=$totaluf*$uf;
								?>


								<td class="center"><? echo number_format($totaluf, 0) ;?></td>
								<td><? echo number_format($totalpesos, 0)   ?></td>
								</tr>
							<? 
							 $reg++;

							} ?>
						  </tbody>
</table>   



         
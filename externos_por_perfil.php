
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>


 


<table class="table table-striped table-bordered bootstrap-datatable datatable" >
						  <thead>
							  <tr>
							  	  <th>#
							  	  <th>Nombre</th>
								  <th>Apellido P.</th>
								  <th>Rut</th>
								  <th>Empresa</th>
								  <th>LS/Perfil</th>
								  <th>Inicio</th>
								  <th>Termino</th>
								  <!--<th>Modificar</th>-->
								   </tr>
						  </thead>   
						  <tbody>

						  	<? $id_usuario=$_SESSION["id_usuario"]; 
						  		$perfil=$_SESSION["id_perfil"];
								$nombre=$_SESSION["nombre"];
								$apellido=$_SESSION["apellido"];
								$email=$_SESSION["email"];
						  	$reg=1;
						  				 include("../conectabd/conexion_bd.php");
						              mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");

								
   								if ($perfil==2){ //Jefe de proyecto

    							/*$query= "SELECT DISTINCT e.nombre_empresa, f.* , l.perfil_ldserv ";
    							$query.=" FROM funcionario f, empresa e, asignado a, usuario u, ldserv l";
    							$query.=" WHERE a.id_jefepro_asignado =".$id_usuario."";
    							$query.=" AND a.id_funcionario_asignado = f.id_func ";
    							$query.=" AND f.id_ldserv_func = l.id_ldserv ";
    							$query.=" AND f.id_emp_func = e.id_empresa ";
    							$query.=" AND f.estado_func =1 ; ";
    							*/

   							$query ="SELECT DISTINCT f.id_func, u.nombre, u.apellido, d.nombre_dpto, a.estado_asignado , ";
							$query.=" p.nombre_proyectos , f.nombre_func, f.ape1_func, f.rut_func,f.dv_func,f.fech_ing_func,f.fech_out_func, ";
							$query .=" l.perfil_ldserv, e.nombre_empresa , c.* ";
							$query .=" FROM usuario u, dpto d, proyectos p, asignado a , funcionario f, ldserv l , empresa e , contrato c ";
							$query .=" WHERE a.id_funcionario_asignado=f.id_func ";
							$query .=" AND f.fech_out_func>=".$fecha_consulta_act." ";
							$query .=" AND a.fecha_fin_asignado >= ".$fecha_consulta_user." ";
							$query .=" AND a.id_dpto_asignado=d.id_dpto ";
							$query .=" AND a.id_jefepro_asignado =".$id_usuario." ";
							$query .=" AND a.id_jefepro_asignado=u.id_usuario ";
							$query .=" AND f.id_emp_func=e.id_empresa";
							$query .=" AND f.id_ldserv_func=l.id_ldserv ";
							$query .=" AND a.estado_asignado>0 ";
							$query .=" group by f.id_func ;";
    							
					           //echo $query;	
										$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;

										

    									}
										
    																			
										while($fila=mysql_fetch_array($result))
										{
											$nombre_func=$fila["nombre_func"];
											$ape1_func=$fila["ape1_func"];
											$perfil_ldserv=$fila["perfil_ldserv"];
											$rut_func=$fila["rut_func"];
											$dv_func=$fila["dv_func"];
											$fech_ing_func=$fila["fech_ing_func"];
											$fech_out_func=$fila["fech_out_func"];
											$id_emp_func=$fila["id_emp_func"];
											$nombre_func=$fila["nombre_func"];
											$nombre_empresa=$fila["nombre_empresa"];
											$perfil_ldserv=$fila["perfil_ldserv"];


											$fecha_marca_in=invertirFecha($fech_ing_func);
											$fecha_marca_out=invertirFecha($fech_out_func);

																				
											
							?>		



							
							<tr > 
								<td style="backgroun:blue;"><? echo $reg ?></td>
								<td><? echo $nombre_func ?></td>
								<td> <? echo $ape1_func?></td>
								<td><? echo $rut_func."-".$dv_func ?></td>
								<td> <? echo $nombre_empresa ?></td>
								<td> <? echo $perfil_ldserv ?></td>
								<td> <? echo $fecha_marca_in ?></td>
								<td> <? echo $fecha_marca_out ?></td>
								<!--<td style="text-align:center; width:5%" >
								<a  href="mensaje.php?id_marca=<? echo $id_marca; ?>" target="_blank"role="button" class="btn btn-mini btn-info" data-toggle="modal" title="Mensaje">
															<i class="halflings-icon edit white"></i></a>
									</td>-->

								</tr>
							<? 
							 $reg++;

							} 
						?>
						  </tbody>
</table>            
<!--<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p>Exportar a Excel  <img src="annoicon.gif" class="botonExcel" /></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>





<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>

Aquí lo que estamos indicando es que al hacer click en el elemento con class=”botonExcel”
 vamos a coger el contenido del elemento que tiene como id=”datos_a_enviar” 
 añadiéndolo a los datos que transporta el formulario.-->

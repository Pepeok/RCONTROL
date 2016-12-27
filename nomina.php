<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<?
    function invertirFecha2($Fecha){
    $Fecha=explode("-",$Fecha);
    $fec=$Fecha[2]."-".$Fecha[1]."-".$Fecha[0];
    return $fec;
     }
   ?>


<table class="table table-striped table-bordered bootstrap-datatable datatable" >
						  <thead>
							  <tr>
							  	  <th>#
							  	  <th>Nombre</th>
								  <th>Apellido P.</th>
								  <th>Apellido M.</th>
								  <th>Rut</th>
								  <th>Departamento</th>
								  <th>Empresa</th>
								  <th>Linea</th>
								  <th>Inicio</th>
								  <th>Termino</th>
								   </tr>
						  </thead>   
						  <tbody>

						  	<? $reg=1;
						  			 $id_usuario=$_SESSION["id_usuario"];

						              mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");


						        $id_usuario=$_SESSION["id_usuario"]; 
						  		$perfil=$_SESSION["id_perfil"];
								$nombre=$_SESSION["nombre"];
								$apellido=$_SESSION["apellido"];
								$email=$_SESSION["email"];
						  	$reg=1;
						              mysql_select_db("rcontrol")or die("No se pudo conectar a BD rcontrol");

										if ($perfil==1 or $perfil==3){

   										$query =" SELECT DISTINCT f.id_func, f.rut_func, f.dv_func, f.nombre_func, ";
   										$query.=" f.nombre2_func, f.ape1_func, f.ape2_func, e.nombre_empresa, l.perfil_ldserv, ";
   										$query.="  f.estado_func ";
   										$query.=" FROM funcionario f, empresa e, asignado a, ldserv l, inter1 i ";
   										$query.=" WHERE f.id_emp_func = e.id_empresa ";
   										$query.=" AND e.id_empresa = i.id_empresa_inter1 ";
   										$query.=" AND i.id_ldserv_inter1 = l.id_ldserv ";
   										$query.=" AND f.estado_func =1 ";
   										$query.=" GROUP BY f.rut_func ";
   										$query.=" ORDER BY  `f`.`id_func` ASC ;";
									
										

										$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;
   									 	}

   									 	if ($perfil==4){ //Jefe de Departamento

    									$query =" SELECT DISTINCT e.nombre_empresa, f. * ";
										$query .="FROM funcionario f, empresa e, asignado a, usuario u ";
										$query .=" WHERE a.id_jefedpto_asignado = ".$id_usuario." ";
										$query .=" AND a.id_funcionario_asignado = f.id_func ";
										$query .=" AND f.id_emp_func = e.id_empresa ;";
										

										$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;


    									}

    									if ($perfil==2){ //Jefe de proyecto

    									$query =" SELECT DISTINCT e.nombre_empresa, f. * ";
    									$query .="FROM funcionario f, empresa e, asignado a, usuario u ";
    									$query .="WHERE a.id_jefepro_asignado = ".$id_usuario." ";
    									$query .=" AND a.id_funcionario_asignado = f.id_func ";
    									$query .=" AND f.id_emp_func = e.id_empresa ;";

    									$result=mysql_query($query)or die("error =".mysql_error());
										$num=mysql_num_rows($result);
										$num_filas=$num;


    									}

										echo $query;


										while($fila=mysql_fetch_array($result))
										{
											$nombre_func=$fila["nombre_func"];
											$ape1_func=$fila["ape1_func"];
											$ape2_func=$fila["ape2_func"];
											$rut_func=$fila["rut_func"];
											$dv_func=$fila["dv_func"];
											$fech_ing_func=$fila["fech_ing_func"];
											$fech_out_func=$fila["fech_out_func"];
											$id_emp_func=$fila["id_emp_func"];
											$nombre_func=$fila["nombre_func"];
											$nombre_empresa=$fila["nombre_empresa"];
											$perfil_ldserv=$fila["id_ldserv_func"];
											$id_dpto_func=$fila["id_dpto_func"];

											$fechain=invertirFecha2($fech_ing_func);


							?>		



							
							<tr> 
								<td><? echo $reg ?></td>
								<td><? echo $nombre_func ?></td>
								<td> <? echo $ape1_func?></td>
								<td> <? echo $ape2_func ?></td>
								<td><? echo $rut_func."-".$dv_func ?></td>
								<td> <? echo $id_dpto_func ?></td>
								<td> <? echo $nombre_empresa ?></td>
								<td> <? echo $perfil_ldserv ?></td>
								<td > <? echo $fechain ?></td>
								<td> <? echo $fech_out_func ?></td>
								</tr>
							<? 
							 $reg++;

							} ?>
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

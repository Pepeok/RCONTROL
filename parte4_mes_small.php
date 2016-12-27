<script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>
<script language="javascript">
    $(document).ready(function() {
        $(".botonExcel").click(function(event) {
            $("#datos_a_enviar").val($("<div>").append($("#Exportar_a_Excel").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
        });
    });
</script>

<? //echo  "la fecha fin termina".$fecha_consulta_fin; 
echo $id_usuario;
?>
<table  id="Exportar_a_Excel" align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#999999">
        <th colspan="10" scope="col">DETALLE</th>
    </tr>
    <tr  bgcolor="#999999">
        <th width="14%" scope="col">LDSERV</th>
        <th width="7%"scope="col">RUT</th>
        <th width="10%" scope="col">NOMBRE y APELLIDO</th>
        <th width="10%"scope="col">DPTO</th>
        <th width="7%"scope="col">FECHA</th>
        <th width="8%"scope="col">ENTRADA</th>
        <th width="8%"scope="col">COLACION</th>
        <th width="6%"scope="col">SALIDA</th>
        <th width="10%"scope="col">HH FACTURABLE</th>
        <th width="10%"scope="col">OBSERVACION</th>
    </tr>
    <?
    $reg = 1;
    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
    $query4 = "  SELECT f.id_func, f.nombre_func, f.ape1_func, f.rut_func, f.dv_func, m.log_marca, m. * , l.perfil_ldserv, d.nombre_dpto ";
    $query4.=" FROM funcionario f, marcaciones m, empresa e, ldserv l, empco ec, contrato c, asignado a, dpto d ";
    $query4.=" WHERE f.id_func = a.id_funcionario_asignado ";
    $query4.="  AND f.id_ldserv_func = l.id_ldserv ";
    $query4.=" AND a.id_dpto_asignado = d.id_dpto ";
    $query4.=" AND f.estado_func  =" . $pgc . " ";
    $query4.=" AND a.estado_asignado =" . $pgc . " ";   
    $query4.=" AND f.id_emp_func = e.id_empresa ";
    $query4.=" AND e.id_empresa  =" . $empresa . " ";
    $query4.=" AND e.id_empresa = ec.id_empresa_empco ";
    $query4.=" AND ec.id_contrato_empco = c.id_contrato ";
    $query4.=" AND c.pro_gc_contrato =" . "'" . $pro_gc_contrato . "'" . "";
    $query4.=" AND f.rut_func = m.rut_marca ";
    $query4.=" AND m.fecha_marca >= a.fecha_asignado ";
    $query4.=" AND m.fecha_marca <= a.fecha_fin_asignado ";
    $query4.=" AND m.cod_marca =0 ";
    $query4.=" AND m.fecha_marca >=" . $fecha_ini_consulta . " ";
    $query4.=" AND m.fecha_marca <=" . $fecha_fin_consulta . " ";
    $query4.=" AND ( m.control_marca <=2 OR m.control_marca =5 ) ";
    $query4.=" GROUP BY m.rut_marca, m.fecha_marca ;";
    
   
	echo $query4; 


	
	<tr align="center">			  
		<td><? echo $perfil_ldserv ?> </td>
		<td> <? echo $rut_func."-".$dv_func; ?></td>
		<td> <? echo $nombre_func." ".$ape1_func ?></td>
		<td> <? echo $dpto_func; ?></td> <!--nueva-->
		<td> <? echo $fecha_mostrar?></td>
		<td> <? echo $hora_in_marca ?></td>
		<td> <? echo $hora_colacion_func ?></td>
		<td> <? echo $hora_out_marca; ?></td> 
		
</tbody>
</table>            
<? 	function resta($inicio, $fin)
	{	$dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
	  	return $dif;
	   }
	function almuerzo($diferencia, $horal)
	{	$alm=date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal) );
		return $alm;
	   }
?>	
<!--<table  align="center"width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><form action="pdf_sem.php" method="post" >
<button   type="submit" formtarget="_blank">PDF</button>
<input type="hidden" id="empresa" name="empresa" value="<? //echo $empresa 
    ?>" />
    <input type="hidden" id="nomempresa" name="nomempresa" value="<? //echo $nom_empresa  ?>" />
    <input type="hidden" id="fecha" name="fecha_ini" value="<? //echo $fecha_ini  ?>" />
    <input type="hidden" id="fecha" name="fecha_fin" value="<? //echo $fecha_fin ?>" />
    <input type="hidden" id="id_user" name="id_user" value="<? //echo $id_user;  ?>" />
    <input type="hidden" id="fechapdf" name="fechapdf" value="<? //echo $fecha_exel  ?>" />
    <input type="hidden" id="pgc" name="pgc" value="<? //echo $pro_gc_contrato;  ?>" />
</form></td>
<td>
    <form action="fichero_excel_mes.php" method="post" target="_blank" id="FormularioExportacion">
        <p align="center" style="cursor:hand"> <img src="./img/export_to_excel.gif" class="botonExcel" /></p>
        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
        <input type="hidden" id="empresa" name="empresa" value="<? //echo $nombre_empresa  ?>" />
        <input type="hidden" id="contrato" name="contrato" value="<? //echo $nombre_contrato  ?>" />
        <input type="hidden" id="fecha" name="fecha" value="<? //echo $fecha_exel  ?>" />
        <input type="hidden" id="id_user" name="id_user" value="<? //echo $id_usuario  ?>" />
        <input type="hidden" id="pgc" name="pgc" value="<? //echo $pro_gc_contrato;  ?>" />
    </form>
</td>
</tr>
</table>-->

<? //$pgc=2;  ?>
<script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>


<script language="javascript">
    $(document).ready(function() {
        $(".botonExcel").click(function(event) {
            $("#datos_a_enviar").val($("<div>").append($("#Exportar_a_Excel").eq(0).clone()).html());
            $("#FormularioExportacion").submit();
        });
    });
</script>
<? //echo  "la fecha fin termina".$fecha_consulta_fin; ?>

<table  id="Exportar_a_Excel" align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#999999">
        <th colspan="10" scope="col">DETALLE</th>
    </tr>
    <tr  bgcolor="#999999">
        <th width="14%" scope="col">LDSERV</th>
        <th width="7%"scope="col">RUT</th>
        <th width="10%" scope="col">NOMBRE</th>
        <th width="10%"scope="col">APELLIDO</th>
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



    $query4 = " SELECT  DISTINCT f.id_func, f.nombre_func, f.ape1_func, f.rut_func, f.dv_func, m.log_marca, ";
    $query4.=" f.fech_ing_func, f.fech_out_func, m. * , l.perfil_ldserv, e.nombre_empresa  ";
    $query4.=" FROM funcionario f, marcaciones m, empresa e, ldserv l, empco ec, dpto d , asignado a";
    $query4.=" WHERE f.rut_func = m.rut_marca ";
    $query4.=" AND f.estado_func =" . $pgc . " ";
    $query4.=" AND a.estado_asignado =" . $pgc . " ";
    $query4.=" AND f.id_ldserv_func = l.id_ldserv ";
    $query4.=" AND f.id_func = a.id_funcionario_asignado ";
    $query4.=" AND f.id_emp_func = e.id_empresa ";
    $query4.=" AND e.id_empresa =" . $empresa . " ";
    $query4.=" AND e.id_empresa =ec.id_empresa_empco ";
    $query4.=" AND m.cod_marca =0 ";
    $query4.=" AND m.fecha_marca >= a.fecha_asignado ";
    $query4.=" AND m.fecha_marca <= a.fecha_fin_asignado ";
    $query4.=" AND m.fecha_marca>=" . $fecha_consulta_mes_ini . " ";
    $query4.=" AND m.fecha_marca<=" . $fecha_consulta_fin . " ";
    $query4.=" AND ( m.control_marca<=2 or m.control_marca =5 ) ";
    $query4.=" ORDER BY m.rut_marca, m.fecha_marca ;";
//echo $query4;  

    $result4 = mysql_query($query4) or die("error =" . mysql_error());
    $num4 = mysql_num_rows($result4);
    $num_filas4 = $num4;

    while ($fila4 = mysql_fetch_array($result4)) {
        $id_marca = $fila4["id_marca"];
        $nombre_func = $fila4["nombre_func"];
        $ape1_func = $fila4["ape1_func"];
        $rut_func = $fila4["rut_func"];
        $dv_func = $fila4["dv_func"];
        $fecha_marca = $fila4["fecha_marca"];
        $fecha_mostrar = invertirFecha($fecha_marca);
        $hora_in_marca = $fila4["hora_in_marca"];
        $hora_colacion_func = $fila4["hora_colacion_func"];
        $hora_out_marca = $fila4["hora_out_marca"];
        $comen_marca = $fila4["comen_marca"];
        $nombre_empresa = $fila4["nombre_empresa"];
        $perfil_ldserv = $fila4["perfil_ldserv"];
        $control_marca = $fila["control_marca"];
        $log_marca = $fila4["log_marca"];
        // $pro_gc_contrato=$fila4["pro_gc_contrato"];
        //resto las horas

        $diferencia = resta($hora_in_marca, $hora_out_marca);
        // le resto la hora de colacion
        $hhfacturable = almuerzo($diferencia, $hora_colacion_func);
        ?>		
        <tr align="center"> 




            <td><? echo $perfil_ldserv ?> </td>
            <td> <? echo $rut_func . "-" . $dv_func; ?></td>
            <td> <? echo $nombre_func ?></td>
            <td> <? echo $ape1_func ?></td>
            <td> <? echo $fecha_mostrar ?></td>
            <td> <? echo $hora_in_marca ?></td>
            <td> <? echo $hora_colacion_func ?></td>
            <td> <? echo $hora_out_marca; ?></td> 
            <? if ($hora_in_marca == "00:00:00" or $hora_out_marca == "00:00:00") { ?>

                <td> <? echo AUSENTE ?> </td>

            <? } else { ?>
                <td> <? echo $hhfacturable ?> </td>

            <?
            }

            if ($comen_marca != "") {
                ?>
                <td> <? echo "Modificado el:" . $log_marca = ajuste_log($log_marca); ?></td>

            <? } else { ?>

                <td> </td>

            <? } ?>
        </tr> 	
        <?
        $reg++;
    }
    ?>
</tbody>


</table>            
<?

function resta($inicio, $fin) {
    $dif = date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio));
    return $dif;
}

function almuerzo($diferencia, $horal) {
    $alm = date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal));
    return $alm;
}
?>	


<table  align="center"width="90%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center"><form action="pdf_sem.php" method="post" >
                <button   type="submit" formtarget="_blank">PDF</button>
                <input type="hidden" id="empresa" name="empresa" value="<? echo $empresa ?>" />
                <input type="hidden" id="nomempresa" name="nomempresa" value="<? echo $nom_empresa ?>" />
                <input type="hidden" id="fecha" name="fecha_ini" value="<? echo $fecha_ini ?>" />
                <input type="hidden" id="fecha" name="fecha_fin" value="<? echo $fecha_fin ?>" />
                <input type="hidden" id="id_user" name="id_user" value="<? echo $id_user; ?>" />
                <input type="hidden" id="fechapdf" name="fechapdf" value="<? echo $fecha_exel ?>" />
                <input type="hidden" id="pgc" name="pgc" value="<? echo $pgc; ?>" />

            </form></td>


        <td>
            <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
                <p align="center" style="cursor:hand"> <img src="./img/export_to_excel.gif" class="botonExcel" /></p>
                <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                <input type="hidden" id="empresa" name="empresa" value="<? echo $nombre_empresa ?>" />
                <input type="hidden" id="contrato" name="contrato" value="<? echo $nombre_contrato ?>" />
                <input type="hidden" id="fecha" name="fecha" value="<? echo $fecha_exel ?>" />
                <input type="hidden" id="id_user" name="id_user" value="<? echo $id_user; ?>" />
                <input type="hidden" id="pgc" name="pgc" value="<? echo $pro_gc_contrato; ?>" />
            </form>
        </td>
    </tr>
</table>

<? // echo $pro_gc_contrato;  ?>











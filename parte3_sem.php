<? //$pgc=2;     ?>




<table align="center" width="90%" border="1" cellspacing="0" cellpadding="0">
    <tr bgcolor="#999999">
        <th colspan="8" scope="col">TOTALES POR DEPARTAMENTO</th>
    </tr>
    <tr bgcolor="#999999">
        <th width="15%" scope="col">DEPTO</th>
        <th width="25%" scope="col">LS/PERFIL</th>
        <th width="15%" scope="col">PROFESIONALES</th>
        <th width="15%" scope="col">TOTAL HORAS SEMANA</th>
        <th width="15%" scope="col">TOTAL HORAS ACUMULADO MES</th>
        <th width="15%" scope="col">TOTAL HORAS FRACCIÓN</th>
    </tr>
    <?
    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");



    $query6 = " SELECT DISTINCT a.id_dpto_asignado, d.nombre_dpto ";
    $query6.=" FROM funcionario f, marcaciones m, ldserv l, dpto d, asignado a";
    $query6.=" WHERE f.id_func = a.id_funcionario_asignado ";
    $query6.=" AND f.estado_func =" . $pgc . " ";
    $query6.=" AND a.estado_asignado =" . $pgc . " ";
    $query6.=" AND f.id_emp_func =" . $empresa . " ";
    $query6.=" AND a.id_dpto_asignado = d.id_dpto ";
    $query6.=" AND f.rut_func = m.rut_marca";
    $query6.=" AND m.fecha_marca >= a.fecha_asignado";
    $query6.=" AND m.fecha_marca <= a.fecha_fin_asignado";
    $query6.=" AND m.fecha_marca>=" . $fecha_consulta_ini . " ";
    $query6.=" AND m.fecha_marca<=" . $fecha_consulta_fin . " ";
    $query6.=" AND m.cod_marca =0 ";
    $query6.=" AND ( m.control_marca<=2 or m.control_marca =5 )";
    $query6.=" GROUP BY a.id_dpto_asignado; ";
    $query6; //QUERY QUE ME TRAE LOS DEPARTAMENTOS.



    $result6 = mysql_query($query6) or die("error =" . mysql_error());
    $num6 = mysql_num_rows($result6);
    $num_filas6 = $num6;

    while ($fila6 = mysql_fetch_array($result6)) {
        $id_dpto_func = $fila6["id_dpto_asignado"];
        $nombre_dpto = $fila6["nombre_dpto"];
        ?>    
        <tr>
            <th scope="col"><?php echo $nombre_dpto; ?></th>
            <th colspan="6" scope="col">
        <table  class="tabla_bordes" width="100%" border="1" style="border-bottom:none;" cellspacing="0" cellpadding="0">
            <?
            $query3 = " SELECT f.rut_func, l.id_ldserv, l.perfil_ldserv, l.sigla_ldserv ,COUNT( DISTINCT f.rut_func ) AS prof ";
            $query3.= " FROM funcionario f, marcaciones m, ldserv l , asignado a";
            $query3.= " WHERE  f.id_func = a.id_funcionario_asignado ";
            $query3.= " AND f.rut_func = m.rut_marca ";
            $query3.= " AND f.id_ldserv_func = l.id_ldserv ";
            $query3.= " AND f.estado_func=" . $pgc . " ";
            $query3.=" AND a.estado_asignado =" . $pgc . " ";
            $query3.= " AND m.cod_marca =0 ";
            $query3.="  AND ( m.control_marca<=2 or m.control_marca =5 )";
            $query3.=" AND m.fecha_marca >= a.fecha_asignado";
            $query3.=" AND m.fecha_marca <= a.fecha_fin_asignado";
            $query3.= " AND m.fecha_marca>=" . $fecha_consulta_ini . " ";
            $query3.= " AND m.fecha_marca<=" . $fecha_consulta_fin . " ";
            $query3.= " AND f.id_emp_func =" . $empresa . " ";
            $query3.= " AND a.id_dpto_asignado =" . $id_dpto_func . " ";
            $query3.= " GROUP BY l.id_ldserv;	";

         // echo   "query 3" . $query3; // Query que me tra las lineas de servicio que tiene el departamento

            $result3 = mysql_query($query3) or die("error =" . mysql_error());
            $num3 = mysql_num_rows($result3);
            $num_filas3 = $num3;
            //por cada uno de los registros sumo el total y lo muestro al final 
            $horatotal = 0;
            $total_ld_dpto = 0;
            while ($fila3 = mysql_fetch_array($result3)) {
                $id_ldserv = $fila3["id_ldserv"];
                $perfil_ldserv = $fila3["perfil_ldserv"];
                $prof = $fila3["prof"];
                $sigla_ldserv = $fila3["sigla_ldserv"];
                ?>			
                <tr align="center">
                    <td width="10.35%" height="26"><?php echo $sigla_ldserv ?></td>
                    <td width="19%"><? echo $perfil_ldserv; ?></td>
                    <td width="17.65%"><?php echo $prof; ?></td>


                    <?
                    $query8 = "SELECT  m.fecha_marca, m.hora_in_marca, m.hora_out_marca, ";
                    $query8.=" m.hora_colacion_func";
                    $query8.=" FROM funcionario f, marcaciones m, ldserv l,  asignado a";
                    $query8.=" WHERE f.rut_func = m.rut_marca ";
                    $query8.=" AND f.id_func = a.id_funcionario_asignado ";
                    $query8.=" AND f.id_emp_func =" . $empresa . " ";
                    $query8.=" AND f.id_ldserv_func = l.id_ldserv ";
                    $query8.=" AND f.id_ldserv_func =" . $id_ldserv . " ";
                    $query8.=" AND f.estado_func =" . $pgc . " ";
                    $query8.=" AND a.estado_asignado =" . $pgc . " ";
                    $query8.= " AND a.id_dpto_asignado =" . $id_dpto_func . " ";
                    $query8.=" AND m.cod_marca =0 ";
                    $query8.=" AND (m.control_marca<=2 or m.control_marca =5) ";
                    $query8.=" AND m.fecha_marca >= a.fecha_asignado";
                    $query8.=" AND m.fecha_marca <= a.fecha_fin_asignado";
                    $query8.=" AND m.fecha_marca>=" . $fecha_consulta_ini . " ";
                    $query8.=" AND m.fecha_marca<=" . $fecha_consulta_fin . " ";
                    $query8.=" ORDER BY f.rut_func, m.fecha_marca ;";

                    // echo "query8" . $query8;


                    $result8 = mysql_query($query8) or die("error =" . mysql_error());
                    $num8 = mysql_num_rows($result8);
                    $num_filas8 = $num8;
                    //por cada uno de los registros sumo el total y lo muestro al final 

                    $horatotal = 0;

                    while ($fila8 = mysql_fetch_array($result8)) {

                        $fecha_marca = $fila8["fecha_marca"];
                        $hora_in_marca = $fila8["hora_in_marca"];
                        $hora_out_marca = $fila8["hora_out_marca"];
                        $hora_colacion_func = $fila8["hora_colacion_func"];
                        $perfil_ldserv = $fila8["perfil_ldserv"];
                        $diferencia = resta2($hora_in_marca, $hora_out_marca);
                        // le resto la hora de colacion
                        $hhfacturable = almuerzo2($diferencia, $hora_colacion_func);
                        $horatotal = sumahoras2($hhfacturable, $horatotal);



                        //fin del ciclo que me suma todas las horas
                    }//fin siclo de las horas
                    ?>			


                    <td width="17.65%"><? echo $horatotal; ?></td>
                    <?
                    $query9 = " SELECT  m.fecha_marca, m.hora_in_marca, m.hora_out_marca, ";
                    $query9.=" m.hora_colacion_func";
                    $query9.=" FROM  funcionario f, marcaciones m, ldserv l,  asignado a";
                    $query9.=" WHERE  f.rut_func = m.rut_marca ";
                    $query9.=" AND  f.id_func = a.id_funcionario_asignado ";
                    $query9.=" AND f.id_emp_func =" . $empresa . " ";
                    $query9.=" AND f.id_ldserv_func = l.id_ldserv ";
                    $query9.=" AND f.id_ldserv_func =" . $id_ldserv . " ";
                    $query9.=" AND f.estado_func =" . $pgc . " ";
                    $query9.=" AND a.estado_asignado =" . $pgc . " ";
                    $query9.= " AND a.id_dpto_asignado =" . $id_dpto_func . " ";
                    $query9.=" AND f.rut_func = m.rut_marca ";
                    $query9.=" AND m.cod_marca =0 ";
                    $query9.=" AND (m.control_marca<=2 or m.control_marca =5) ";
                    $query9.=" AND m.fecha_marca >= a.fecha_asignado";
                    $query9.=" AND m.fecha_marca <= a.fecha_fin_asignado";
                    $query9.=" AND m.fecha_marca>=" . $fecha_consulta_mes_ini . " ";
                    $query9.=" AND m.fecha_marca<=" . $fecha_consulta_mes_fin . " ";
                    $query9.=" ORDER BY f.rut_func, m.fecha_marca ;";

                  // echo $query9; //query que saca el total del mes segun la consulta 


                    $result9 = mysql_query($query9) or die("error =" . mysql_error());
                    $num9 = mysql_num_rows($result9);
                    $num_filas9 = $num9;
                    //por cada uno de los registros sumo el total y lo muestro al final 

                    $horatotalmes = 0;

                    while ($fila9 = mysql_fetch_array($result9)) {

                        $fecha_marca = $fila9["fecha_marca"];
                        $hora_in_marca2 = $fila9["hora_in_marca"];
                        $hora_out_marca2 = $fila9["hora_out_marca"];
                        $hora_colacion2_func = $fila9["hora_colacion_func"];
                        $perfil_ldserv = $fila9["perfil_ldserv"];
                        $diferencia2 = resta2($hora_in_marca2, $hora_out_marca2);
                        // le resto la hora de colacion
                        $hhfacturable2 = almuerzo2($diferencia2, $hora_colacion2_func);
                        $horatotalmes = sumahoras2($hhfacturable2, $horatotalmes);


                        //fin del ciclo que me suma todas las horas
                    }//fin siclo de las horas
                    ?>       



                    <td width="17.65%"><?php echo $horatotalmes; ?></td>

                    <? $hora_fraccion = horafraccion($horatotalmes); ?>


                    <td width="17.65%"><?php echo $hora_fraccion ?></td>

                </tr>
            <? } ?>

        </table>

        <? $total_ld_dpto = $total_linea_pesos + $total_ld_dpto; ?>

    </th>

    </tr>
    <?
} // fin del ciclo que me lista los departamentos
?> 

</table>

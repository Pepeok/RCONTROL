<table align="center" width="90%" border="1" cellspacing="1" cellpadding="0">
    <tr>
        <th colspan="11" align="center" bgcolor="#999999" scope="col">TOTALES A FACTURAR POR LINEA DE SERVICIO/PERFIL</th>
    </tr>
    <tr bgcolor="#999999">
        <th width="22%" colspan="2" scope="col">LS/PERFIL</th>
        <th width="2%" scope="col">Profesionales</th>
        <th width="4.5%" scope="col">DPTO</th>
        <th width="4%" scope="col">Total Horas</th>
        <th width="3%" scope="col">Total Horas Fraccion</th>
        <th width="6%" scope="col">Total horas mes</th>
        <th width="6%" scope="col">Valor Total Mes(UF)</th>
        <th width="6%" scope="col">Valor Total Mes(CLP)</th>
        <th width="6%" scope="col">Valor Total Mes(CLP)</th>
    </tr>
    <?
    $reg2 = 0;
                $query = " SELECT DISTINCT f.rut_func, l.perfil_ldserv, l.sigla_ldserv, f.id_ldserv_func, COUNT( DISTINCT f.rut_func ) AS tot_ldserv, precio_uf_ldserv ";
                $query.= " FROM funcionario f, ldserv l , dpto d, asignado a , marcaciones m ";
                $query.= " WHERE  f.estado_func =" . $pgc . " ";
                $query.= " AND f.id_emp_func =" . $empresa . " ";
                $query.= " AND d.id_dpto = a.id_dpto_asignado ";
                $query.= " AND f.id_ldserv_func = l.id_ldserv ";
                $query.= " AND a.id_funcionario_asignado=f.id_func ";
                $query.= " AND f.fech_out_func>=" . $fecha_ini_consulta . " ";
                $query.= " AND f.fech_ing_func<=" . $fecha_fin_consulta . "  ";
                $query.= " AND a.fecha_fin_asignado>=" . $fecha_ini_consulta . " ";
                $query.= " AND a.fecha_asignado<=" . $fecha_fin_consulta . "  ";
                $query.= " AND m.fecha_marca >= a.fecha_asignado ";
                $query.= " AND m.fecha_marca <= a.fecha_fin_asignado ";
                $query.= " AND m.rut_marca=f.rut_func ";
                $query.= " GROUP BY id_ldserv_func ";



    //echo $query;

    $result = mysql_query($query) or die("error =" . mysql_error());
    $num = mysql_num_rows($result);
    $num_filas = $num;
    while ($fila = mysql_fetch_array($result)) {
        $id_ldserv_func = $fila["id_ldserv_func"];
        $tot_ldserv = $fila["tot_ldserv"];
        $perfil_ldserv = $fila["perfil_ldserv"];
        $precio_uf_ldserv = $fila["precio_uf_ldserv"];
        $sigla_ldserv = $fila["sigla_ldserv"];
        ?>    
        <!-- ACA ARMO LA PRIMERA PÁRTE DE LA CAJA-->                      
        <tr align="center">
            <td width="4%"><?php echo $sigla_ldserv ?></td>
            <td width="12%"><?php echo $perfil_ldserv ?></td>
            <td><?php echo $tot_ldserv ?></td>
            <td colspan="3">
                <!-- LA SIGUIENTE  TABLA  PREGUNTO POR DPTOS EN CADA LINEA DE SERVICIO ENCONTRADA-->		                               
                <table class="tabla_bordes"  style="border-bottom:none;"width="100%" border="1" cellspacing="0" cellpadding="0">	  
                    <?
                    // ESTA QUERY TRAE EL NUMERO DEL DPTO Y EL NOMBRE SEGUN EL PERFIL A CONSULTAR
                    $query2 = " SELECT DISTINCT a.id_dpto_asignado,  d.nombre_dpto ,l.precio_uf_ldserv ";
                    $query2.=" FROM funcionario f, marcaciones m , ldserv l ,dpto d , asignado a ";
                    $query2.=" WHERE f.rut_func=m.rut_marca ";
                    $query2.=" AND f.id_func = a.id_funcionario_asignado ";
                    $query2.=" AND f.id_emp_func=" . $empresa . " ";
                    $query2.=" AND f.estado_func =" . $pgc . " ";
                    $query2.=" AND a.estado_asignado =" . $pgc . " ";
                    $query2.=" AND id_dpto=a.id_dpto_asignado ";
                    $query2.=" AND m.fecha_marca >= a.fecha_asignado ";
                    $query2.=" AND m.fecha_marca <= a.fecha_fin_asignado ";
                    $query2.=" AND m.fecha_marca>=" . $fecha_ini_consulta . " ";
                    $query2.=" AND m.fecha_marca<=" . $fecha_fin_consulta . " ";
                    $query2.=" AND f.id_ldserv_func=" . $id_ldserv_func . " ";
                    $query2.=" AND l.id_ldserv = f.id_ldserv_func ";
                    $query2.=" AND m.cod_marca =0 ";
		    $query2.=" AND (m.control_marca<=2 or m.control_marca =5) ";               


                    //echo $query2;  


                    $result2 = mysql_query($query2) or die("error =" . mysql_error());
                    $num2 = mysql_num_rows($result2);
                    $num_filas2 = $num2;
                    // LISTO LOS DEPARTAMENTOS 
                    $total_horas_mes = 0;
                    while ($fila2 = mysql_fetch_array($result2)) {
                        //iniclo Ciclo por linea y dpto
                        $id_dpto_func = $fila2["id_dpto_asignado"];
                        $nombre_dpto = $fila2["nombre_dpto"];
                        ?>
                        <!-- IMPRIMO EL DEPARTAMENTO Y TRAIGO LAS HORAS ASOCIADAS A ESE DEPARTAMENTO-->
                        <tr>
                            <td align="center" width="33%"><? echo $nombre_dpto ?></td>
                            <?
                            $query3 = " SELECT  m.fecha_marca, m.hora_in_marca,";
                            $query3.=" m.hora_out_marca, m.hora_colacion_func ";
                            $query3.=" FROM funcionario f, marcaciones m, ldserv l , asignado a";
                            $query3.=" WHERE f.rut_func = m.rut_marca ";
                            $query3.=" AND f.id_func = a.id_funcionario_asignado ";
                            $query3.=" AND m.fecha_marca >= a.fecha_asignado ";
                            $query3.=" AND m.fecha_marca <= a.fecha_fin_asignado ";
                            $query3.=" AND f.id_ldserv_func = l.id_ldserv ";
                            $query3.=" AND f.estado_func =" . $pgc . " ";
                            $query3.=" AND a.estado_asignado =" . $pgc . " ";
                            $query3.=" AND m.cod_marca =0 ";
                            $query3.=" AND (m.control_marca<=2 or m.control_marca =5) ";
                            $query3.=" AND m.fecha_marca>=" . $fecha_ini_consulta . " ";
                            $query3.=" AND m.fecha_marca<=" . $fecha_fin_consulta . " ";
                            $query3.=" AND f.id_emp_func =" . $empresa . "  ";
                            $query3.=" AND a.id_dpto_asignado =" . $id_dpto_func . " ";
                            $query3.=" AND f.id_ldserv_func =" . $id_ldserv_func . " ";
                            $query3.=" ORDER BY f.rut_func, m.fecha_marca ";
                          
                           // echo $query3;	
                            $result3 = mysql_query($query3) or die("error =" . mysql_error());
                            $num3 = mysql_num_rows($result3);
                            $num_filas3 = $num3;
                            //por cada uno de los registros sumo el total y lo muestro al final 
                            $horatotal = 0;
                            while ($fila3 = mysql_fetch_array($result3)) {
                                $fecha_marca = $fila3["fecha_marca"];
                                $hora_in_marca = $fila3["hora_in_marca"];
                                $hora_out_marca = $fila3["hora_out_marca"];
                                $hora_colacion_func = $fila3["hora_colacion_func"];

                                //calculo de HH	
                                $diferencia = resta2($hora_in_marca, $hora_out_marca); //horas del día
                                //echo "<br>Diferencia".$diferencia; 
                                $hhfacturable = almuerzo2($diferencia, $hora_colacion_func); // le resto la hora de colacion
                                //echo "<br>FACTURABLE".$hhfacturable;
                                $horatotal = sumahoras2($hhfacturable, $horatotal); //horas facturables
                                //echo "<BR>TOTAL".$horatotal;
                                //fin del ciclo que me suma todas las horas		
                            }//fin siclo de las horas
                            ?>			
                            <!-- imprimo la hora total del Dpto-->
                            <td align="center" width="33%"><? echo $horatotal; ?></td>
                            <?
                            //formula para Fraccionar la hora 
                            $horafrac = horafraccion($horatotal);
                            ?>
                            <td align="center" width="33%"><? echo $horafrac; ?></td>
                        </tr>	
                        <?
                        $total_horas_mes = sumahoras($horatotal, $total_horas_mes);
                    }//fin siclo por linea y dpto
                    ?>
                </table> 
                <!--Fin de la Tabla que que imprime tantos dptos exiten en una linea--> 
            </td>
            <?
            $hora_frac_mes = horafraccion($total_horas_mes);
            $total_uf = $hora_frac_mes * $precio_uf_ldserv;
            $total_uf = (round($total_uf, 4));
            ?>
            <td><? echo $hora_frac_mes; ?></td>
            <td><? echo $total_uf; ?></td>

            <?
            //$total_clp1=round($hora_frac_mes,4)*$valoruf_oc_contrato;
            //$total_clp=round($total_clp1,4)*$precio_uf_ldserv;
            $total_clp = round($total_uf * $valoruf_oc_contrato, 0);
            //echo $total_clp;
            $decimales = explode(".", $total_clp); //nuevo
            if (substr($decimales[1], 0, 2) < 51) {//nuevo
                list($total_clp_mostrar1) = colocapunto(floor($total_clp)); //nuevo
                //echo "FLOOR"; //nuevo
                echo "<td>" . $total_clp_mostrar1 . "</td>";
                $valor_total_mes1 = floor($total_clp) + $valor_total_mes1; //nuevo
            } else { //nuevo
                list($total_clp_mostrar) = colocapunto(round($total_clp, 0));
                //echo "ROUND";	
                echo "<td>" . $total_clp_mostrar . "</td>"; //nuevo
                $valor_total_mes2 = round($total_clp, 0) + $valor_total_mes2; //nuevo 
            }
            ?>
        <!--<td>
            <? /* 	if (total_clp_mostrar>0){	
              echo $total_clp_mostrar;
              }else{ echo $total_clp_mostrar1; }
              ; */ ?></td>-->

            <?
            $reg2++;
            //$valor_total_mes=$total_clp+$valor_total_mes;
            $valor_total_mes11 = explode(".", $valor_total_mes1); //nuevo
            $valor_total_mes22 = explode(".", $valor_total_mes2); //nuevo
            //averiguar como hacer la extraccion de 4 decimales de un float//
            //$valor_total_mes=$valor_total_mes11[0]+$valor_total_mes22[0];
            $valor_total_mes = $valor_total_mes1 + $valor_total_mes2;
            //list($total_mes_mostrar)=colocapunto(round($valor_total_mes,0));
            list($total_mes_mostrar) = colocapunto(round($valor_total_mes, 0));
        }
        ?>    
        <td><?php echo $total_mes_mostrar ?></td>
</table>
<div align="center"><p>** Totales a facturar por Linea de Servicio/Perfil deben ser replicados en la descripción de la Factura respectiva.</p></div>

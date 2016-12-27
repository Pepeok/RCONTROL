<?
$querycont = " SELECT  e.nombre_empresa, c.*";
$querycont.= "FROM empresa e , contrato c ";
$querycont.= "WHERE c.id_pgc_contrato=" . $pgc . " ";
$querycont.= " AND e.id_empresa=c.id_empresa_contrato ";
$querycont.= " AND  e.id_empresa =" . $empresa . " ;";
//echo $querycont;
$resultct = mysql_query($querycont) or die("error =" . mysql_error());
$numct = mysql_num_rows($resultct);
$num_filasct = $numct;

if ($num_filasct > 0) {
    while ($filact = mysql_fetch_array($resultct)) {
        $nombre_empresa = $filact["nombre_empresa"];
        $nombre_contrato = $filact["nombre_contrato"];
        $pro_gc_contrato = $filact["pro_gc_contrato"];
        $oc_contrato = $filact["oc_contrato"];
        $fecha_oc_contrato = $filact["fecha_oc_contrato"];
        $valoruf_oc_contrato = $filact["valoruf_oc_contrato"];

        // echo $querycont;
        ?>


        <table  align="center"width="90%" border="1" cellspacing="1" cellpadding="0">
            <tr >
                <th width="18%" bgcolor="#999999" scope="col">Proceso Grandes Compras</th>
                <th width="12%" bgcolor="#999999" scope="col">Empresa</th>
                <th width="10%"  bgcolor="#999999" scope="col">Contrato</th>
                <th width="10%" bgcolor="#999999" scope="col">OC</th>
                <th width="40%" bgcolor="#999999" scope="col">LS/Perfil</th>
                <th width="10%" bgcolor="#999999" scope="col">Profesionales</th>



            <tr align="center">
                <td><? echo $pro_gc_contrato ?></td>
                <td><? echo $nombre_empresa ?></td>
                <td><? echo $nombre_contrato ?></td>
                <td><? echo $oc_contrato ?></td>
                <td colspan="2">
    <?
    }


    $id_usuario = $_SESSION["id_usuario"];
    $perfil = $_SESSION["id_perfil"];
    $nombrep = $_SESSION["nombrep"];
    $apellido = $_SESSION["apellidop"];
    $email = $_SESSION["email"];



    /*$query = " SELECT f.rut_func, l.perfil_ldserv,l.sigla_ldserv, f.id_ldserv_func, COUNT( f.id_ldserv_func )as tot_ldserv ";
    $query.= " FROM funcionario f, ldserv l , dpto d ,asignado a ";
    $query.= " WHERE f.id_emp_func =" . $empresa . " ";
    $query.= " AND f.id_ldserv_func = l.id_ldserv ";
    $query.= " AND f.fech_out_func>=$fecha_consulta_ini ";
    $query.= " AND f.fech_ing_func<=$fecha_consulta_fin ";
    $query.= " AND f.estado_func =" . $pgc . " ";
    $query.= " AND f.id_func = a.id_funcionario_asignado ";
    $query.= " AND a.id_dpto_asignado = d.id_dpto ";
    $query.= " GROUP BY id_ldserv_func ";*/
                $query = " SELECT DISTINCT f.rut_func, l.perfil_ldserv, l.sigla_ldserv, f.id_ldserv_func, COUNT( DISTINCT f.rut_func ) AS tot_ldserv ";
                $query.= " FROM funcionario f, ldserv l , dpto d, asignado a , marcaciones m ";
                $query.= " WHERE  f.estado_func =" . $pgc . " ";
                $query.= " AND f.id_emp_func =" . $empresa . " ";
                $query.= " AND d.id_dpto = f.id_dpto_func ";
                $query.= " AND f.id_ldserv_func = l.id_ldserv ";
                $query.= " AND a.id_funcionario_asignado=f.id_func ";
                $query.= " AND f.fech_out_func>=" . $fecha_consulta_ini . " ";
                $query.= " AND f.fech_ing_func<=" . $fecha_consulta_fin . "  ";
                $query.= " AND a.fecha_fin_asignado>=" . $fecha_consulta_ini . " ";
                $query.= " AND a.fecha_asignado<=" . $fecha_consulta_fin . "  ";
                $query.= " AND m.fecha_marca >= a.fecha_asignado ";
                $query.= " AND m.fecha_marca <= a.fecha_fin_asignado ";
                $query.= " AND m.rut_marca=f.rut_func ";
                $query.= " GROUP BY id_ldserv_func ";


     //echo $query;

    $result = mysql_query($query) or die("error =" . mysql_error());
    $num = mysql_num_rows($result);
    $num_filas = $num;
    ?>



                <table  class="tabla_bordes" width="100%" border="1" cellspacing="0" cellpadding="0">
    <?
    $reg = 0;
    while ($fila = mysql_fetch_array($result)) {
        $id_ldserv_func = $fila["id_ldserv_func"];
        $tot_ldserv = $fila["tot_ldserv"];
        $perfil_ldserv = $fila["perfil_ldserv"];
        $sigla_ldserv = $fila["sigla_ldserv"];
        ?>    

                        <tr>
                            <td align="center" width="15%"><? echo $sigla_ldserv ?></td>
                            <td align="center" width="65%"><? echo $perfil_ldserv ?></td>
                            <td align="center" width="25%"><? echo $tot_ldserv ?></td>
                        </tr>
        <? $reg++;
    }
    ?>

                </table>

            </td>
        </tr>
    </table>
<? } else { ?>
    <script type="text/javascript">

        sin_datos();


    </script>
    <?
}// e}cho $pro_gc_contrato; ?>
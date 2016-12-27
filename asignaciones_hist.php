
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>


<script language="javascript">



</script>


<?php
include("../conectabd/conexion_bd.php");
?>



<table class="table table-striped table-bordered bootstrap-datatable datatable" >

    <thead>
        <tr>
            <th>ID</th>
            <th>PROFESIONAL</th>
            <th>EMPRESA</th>
            <th>TDR</th>
            <th>LS</th>
            <th>PERFIL</th>
            <th>DPTO</th>
            <th>JEFE PROYECTO</th>
            <th>DESDE</th>
            <th>HASTA</th>
            <th>EDITAR</th>
           
            
        </tr>
    </thead>   
    <tbody>

        <?
        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");


        $query = " SELECT DISTINCT a. * ,l.perfil_ldserv, l.sigla_ldserv, f.id_func, f.nombre_func, f.ape1_func, e.nombre_empresa,";
        $query .= " d.nombre_dpto, d.id_dpto, u.nombre, u.apellido, a.nota_asignado, p.nombre_proyectos, pg.nombre_pgcompras";
        $query .= " FROM usuario u, funcionario f, asignado a, dpto d, empresa e, proyectos p, pgcompras pg ,ldserv l";
        $query .= " WHERE a.id_funcionario_asignado = f.id_func ";
        $query .= " AND f.id_emp_func = e.id_empresa ";
        $query .= " AND f.id_ldserv_func = l.id_ldserv ";
        $query .= " AND a.id_dpto_asignado = d.id_dpto ";
        $query .= " AND a.id_jefepro_asignado = u.id_usuario ";
        $query .= " AND a.id_proyecto_asignado = p.id_proyectos ";
        $query .= " AND f.estado_func = pg.id_pgcompras ";
        $query .= " AND a.estado_asignado >0 ";
        

       //echo $query;
        $result = mysql_query($query) or die("error = " . mysql_error());
        $num = mysql_num_rows($result);
        $num_filas = $num;

        echo "<h3>Se Encontrarón = " . $num_filas . " Registros </h3>";


        while ($fila = mysql_fetch_array($result)) {
            $id_asignado = $fila["id_asignado"];
            $id_func = $fila["id_func"];
            $nombre_func = $fila["nombre_func"];
            $ape1_func = $fila["ape1_func"];
            $id_proyectos = $fila["id_proyectos"];
            $nombre_proyectos = $fila["nombre_proyectos"];
            $id_dpto = $fila["id_dpto"];
            $nombre_dpto = $fila["nombre_dpto"];
            $id_proyecto_asignado = $fila["id_proyecto_asignado"];
            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];
            $fecha_asignado = $fila["fecha_asignado"];
            $fecha_fin_asignado = $fila["fecha_fin_asignado"];
            $fecha_asignado = invertirFecha($fecha_asignado);
            $fecha_fin_asignado = invertirFecha($fecha_fin_asignado);
            $pro_gc_contrato = $fila["nombre_pgcompras"];
            $estado_asignado = $fila["id_pgc_contrato"];
            $empresa = $fila["nombre_empresa"];
            $ldserv = $fila["perfil_ldserv"];
            $ndserv = $fila["sigla_ldserv"];
            ?>		


            <tr> 



                <td><? echo $id_asignado; ?></td>
                <td><? echo $nombre_func . " " . $ape1_func ?></td>
                <td><? echo $empresa; ?></td>
                <td style="width:8%"><? echo $pro_gc_contrato; ?></td>
                <td><? echo $ndserv; ?></td>
                <td><? echo $ldserv; ?></td>
                <td><? echo $nombre_dpto; ?></td>
                <td><? echo $nombre . " " . $apellido; ?></td>
                <td style="width:8%"><? echo $fecha_asignado; ?></td>
                <td style="width:8%"><? echo $fecha_fin_asignado; ?></td>
                
                <td style="text-align:center;
                    width:5%" >
                    <a  href="javascript:modifica_asignacion('<? echo $id_func; ?>') " class="btn btn-mini btn-success"  title="Modificar">
                        <i class="halflings-icon edit white"></i></a>								</td>
            </tr>
        <? } ?> 
    </tbody>
</table>            


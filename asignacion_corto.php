<?
include ("js.php");
error_reporting(E_ALL ^ E_NOTICE);
?>

<table border=1 whidth="100%" align="center"cellspacing=0 cellpadding=2 bordercolor="666633">

    <thead style="font-size:10 ">
        <tr>
            <th colspan="7" style="background-color: #a1a1a1">ASIGNACIONES DEL PROFESIONAL</th>
        </tr>
        <tr >
            <th>DPTO</th>
            <th>PROYECTO</th>
            <th>JEFE PROYECTO</th>
            <th>DESDE</th>
            <th>HASTA</th>
            <th>TDR</th>
            <th>Asignaciones</th>
        </tr>
    </thead>   
    <tbody>

        <?
        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");


        $query = " SELECT a. * , d.nombre_dpto, d.jdpto_dpto, p.nombre_proyectos ";
        $query.=" ,u.nombre, u.apellido, pg.nombre_pgcompras";
        $query.=" FROM asignado a, proyectos p, dpto d, usuario u , pgcompras pg ";
        $query.=" WHERE a.id_funcionario_asignado =  '$id_func' ";
        $query.=" AND a.id_dpto_asignado = d.id_dpto ";
        $query.=" AND a.id_proyecto_asignado = p.id_proyectos ";
        $query.=" AND a.id_jefepro_asignado = u.id_usuario ";
        $query.=" AND a.estado_asignado = pg.id_pgcompras ";


        //echo $query;
        $result = mysql_query($query) or die("error =" . mysql_error());
        $num = mysql_num_rows($result);
        $num_filas = $num;

        if ($num_filas > 0) {

            while ($fila = mysql_fetch_array($result)) {
                $id_asignado = $fila["id_funcionario_asignado"];
                $id_proyectos = $fila["id_proyectos"];
                $nombre_proyectos = $fila["nombre_proyectos"];
                $nombre_dpto = $fila["nombre_dpto"];
                $nombre = $fila["nombre"];
                $apellido = $fila["apellido"];
                $fecha_asignado = invertirFecha($fila["fecha_asignado"]);
                $fecha_fin_asignado = invertirFecha($fila["fecha_fin_asignado"]);

                $nombre_pgcompras = $fila["nombre_pgcompras"];
                $estado_asignado = $fila["id_pgc_contrato"];
                $nota_asignado = $fila["nota_asignado"];
                ?>		


                <tr style="font-size:14"> 



                    <td><? echo $nombre_dpto; ?></td>
                    <td><? echo $nombre_proyectos; ?></td>
                    <td><? echo $nombre . " " . $apellido; ?></td>
                    <td style="width:12%"><? echo $fecha_asignado; ?></td>
                    <td style="width:12%"><? echo $fecha_fin_asignado; ?></td>
                    <td style="width:8%"><? echo $nombre_pgcompras; ?></td>
                    <td id="boton1"style="text-align:center; width:5%" >
                        <a  href="javascript:modifica_asignacion('<? echo $id_func . '&idlogin=' . $id_login; ?>') " class="btn btn-mini btn-success" id="boton_ventana" title="Ver">
                            <i class="halflings-icon eye-open white"></i></a>
                    </td>
                    


                </tr>
                <?
            }
        } else {
            ?>

            <tr style="font-size:12">
                <td align="center" colspan="6" >ESTE PROFESIONAL NO TIENE ASIGNACIONES</td>
                <td id="boton1"style="text-align:center; width:5%" >
                    <a  href="javascript:modifica_asignacion('<? echo $id_func . '&idlogin=' . $id_login; ?>') " class="btn btn-mini btn-success" id="boton_ventana" title="Ingresar">
                        <i class="halflings-icon plus-sign white"></i></a>
                </td>
            </tr>           
        <? }
        ?> 
    </tbody>
</table>

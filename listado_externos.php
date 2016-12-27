

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>

<script language="javascript">
</script>

<? include("../conectabd/conexion_bd.php"); 
$id_login = $_SESSION["id_usuario"];

?>


<table class="table table-striped table-bordered bootstrap-datatable datatable "  width="100%">
    <thead>
        <tr>
           <th>#</th>
            <th>TDR</th>
            <th>CONTRATO</th>
            <th>LS</th>
            <th>PERFIL</th>
            <th>EMPRESA</th>
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>F. INICIO</th>
            <th>F. TERMINO </th>
            <th>DPTO </th>
            <th>J DE PROYECTO </th>
            <th>ACCIÓN </th>
        </tr>
    </thead>   
    <tbody>
        <?
        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

        $query = " SELECT d.nombre_dpto, c.nombre_contrato, f.id_func, c.pro_gc_contrato, l.sigla_ldserv, l.perfil_ldserv, e.nombre_empresa, f.rut_func, f.dv_func, f.nombre_func, f.ape1_func, f.fech_ing_func, f.fech_out_func ,
 u.nombre , u.apellido
FROM pgcompras pg, contrato c, empresa e, funcionario f, ldserv l, dpto d, asignado a, usuario u
WHERE f.id_func = a.id_funcionario_asignado
AND f.id_emp_func = e.id_empresa
AND f.estado_func >0
AND a.estado_asignado >0
AND a.fecha_fin_asignado >= CURDATE( ) 
AND l.id_ldserv = f.id_ldserv_func
AND a.id_jefepro_asignado = u.id_usuario
AND u.id_dpto_usuario = d.id_dpto
AND pg.id_pgcompras = c.id_pgc_contrato
AND c.id_empresa_contrato = f.id_emp_func
AND c.id_empresa_contrato = e.id_empresa
AND l.pgc_ldserv = c.pro_gc_contrato
ORDER BY id_func ASC ; 
 "; 

       // echo $query;

        $result = mysql_query($query) or die("error =" . mysql_error());
        $num = mysql_num_rows($result);
        $num_filas = $num;

        echo "<h3>Se Encontrarón= " . $num_filas . " Registros </h3>";

        while ($fila = mysql_fetch_array($result)) {


            $id_func = $fila["id_func"];
            $rut = $fila["rut_func"];
            $dv = $fila["dv_func"];
            $nombre_func = $fila["nombre_func"];
            $apellido1 = $fila["ape1_func"];
            $funcionario = $nombre_func . " " . $apellido1;
            $empresa = $fila["nombre_empresa"];
            $ldserv = $fila["perfil_ldserv"];
            $fecha_ing_func = invertirFecha($fila["fech_ing_func"]);
            $fecha_out_func = invertirFecha($fila["fech_out_func"]);
            $ndserv = $fila["sigla_ldserv"];
            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];
            
            $nombre_tdr = $fila["pro_gc_contrato"];
            $contrato= $fila["nombre_contrato"];
            $dpto= $fila["nombre_dpto"];
            $nombre_fu= $fila["nombre"] ;
            $apellido_fu= $fila["apellido"];
            $jdpro=$nombre ." ". $apellido ;

                        ?>		
            <tr> 
                <td><? echo $id_func; ?></td>
                <td><? echo $nombre_tdr; ?></td>
                <td><? echo $contrato; ?></td>
                <td><? echo $ndserv; ?></td>
                <td><? echo $ldserv; ?></td>
                <td><? echo $empresa; ?></td>
                <td> <? echo $rut . "-" . $dv; ?></td>
                <td> <? echo $funcionario ?></td>
                <td style="text-align:center; width:8%"> <? echo $fecha_ing_func; ?></td>
                <td style="text-align:center; width:8%"> <? echo $fecha_out_func; ?></td>
                <td style="text-align:center; width:8%"> <? echo $dpto; ?></td>
                <td style="text-align:center; width:8%"> <? echo $jdpro; ?></td>
                
                    <?php if (($_SESSION["id_perfil"]) == 1) { ?>
                <td style="text-align:center; width:7%">
                        <a  href="javascript:modifica_externo('<? echo $id_func . '&idlogin=' . $id_login ?>') " class="btn btn-mini btn-success"  title="Modificar">
                            <i class="halflings-icon edit white"></i></a> 	
                        <a  href="javascript:elimina_externo('<? echo $id_func . '&idlogin=' . $id_login ?>') " class="btn btn-mini btn-warning"  title="Eliminar">
                            <i class="halflings-icon remove white"></i></a>		
                        <?php } ?>
                </td>
            </tr>
        <? } ?> 
            
       <div id="contenidoOculto" style='display:block;'></div>
    </tbody>
</table>            


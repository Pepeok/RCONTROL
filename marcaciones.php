
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<script language="javascript">

    function modifica_marca(id)
    {
        window.open('mod_marca.php?id_marca=+' + id + '+', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');


    }
    function falta_marca(id)
    {
        window.open('completa_marca.php?id_marca=+' + id + '+', 'n_w', 'width=600, height=800, scrollbars=yes, left=400, top=50 toolbar=no,menubar=no');

    }

</script>


<?php
include("../conectabd/conexion_bd.php");
$id_usuario = $_SESSION["id_usuario"];
$perfil = $_SESSION["id_perfil"];
?>



<table class="table table-striped table-bordered bootstrap-datatable datatable" >


    <thead>
        <tr>
            <th>#</th>

            <th>JEFE PROYECTO</th>
            <th>RUT</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>FECHA</th>
            <th>ENTRADA</th>
            <th>COLACION</th>
            <th>SALIDA</th>
            <th>HH FACTURABLE</th>
            <th>ACCIÓN</th>
        </tr>
    </thead>   
    <tbody>

        <?
        $reg = 1;


        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");



        if ($perfil == 4) { //Jefe de Departamento
            $query = " SELECT DISTINCT e.nombre_empresa, m. * , f. *,  l.perfil_ldserv ";
            $query.=" FROM funcionario f, empresa e, marcaciones m, asignado a, usuario u , ldserv l";
            $query.=" WHERE a.id_jefedpto_asignado =" . $id_usuario . " ";
            $query.=" AND a.id_funcionario_asignado = f.id_func ";
            $query.=" AND f.id_ldserv_func = l.id_ldserv ";
            $query.=" AND f.estado_func >0 ";
            $query.=" AND m.cod_marca =0 ";
            $query.=" AND m.fecha_marca >= f.fech_ing_func ";
            $query.=" AND f.rut_func = m.rut_marca ";
            $query.=" AND f.id_emp_func = e.id_empresa ";
            $query.=" AND m.control_marca <=4 ";
            $query.=" ORDER BY m.rut_marca, m.fecha_marca ;";

            echo $query;

            $result = mysql_query($query) or die("error =" . mysql_error());
            $num = mysql_num_rows($result);
            $num_filas = $num;
        }

        if ($perfil == 2) { //Jefe de proyecto
            $query = " SELECT DISTINCT e.nombre_empresa, m. * , f. *,  l.perfil_ldserv ";
            $query.=" FROM funcionario f, empresa e, marcaciones m, asignado a, usuario u , ldserv l";
            $query.=" WHERE a.id_jefepro_asignado =" . $id_usuario . " ";
            $query.=" AND a.id_funcionario_asignado = f.id_func ";
            $query.=" AND f.id_ldserv_func = l.id_ldserv ";
            $query.=" AND f.estado_func >0 ";
            $query.=" AND m.cod_marca =0 ";
            $query.=" AND m.fecha_marca >= f.fech_ing_func ";
            $query.=" AND f.rut_func = m.rut_marca ";
            $query.=" AND f.id_emp_func = e.id_empresa ";
            $query.=" AND m.control_marca <=4 ";
            $query.=" ORDER BY m.rut_marca, m.fecha_marca ;";


            $result = mysql_query($query) or die("error =" . mysql_error());
            $num = mysql_num_rows($result);
            $num_filas = $num;
        }

        echo $query;
        echo $perfil;
        echo "<h3>Se Encontrarón= " . $num_filas . " Registros </h3>";


        while ($fila = mysql_fetch_array($result)) {



            $id_marca = $fila["id_marca"];
            $nombre_func = $fila["nombre_func"];
            $ape1_func = $fila["ape1_func"];
            $rut_func = $fila["rut_func"];
            $dv_func = $fila["dv_func"];
            $fecha_marca = $fila["fecha_marca"];
            $hora_in_marca = $fila["hora_in_marca"];
            $hora_colacion_func = $fila["hora_colacion_func"];
            $hora_out_marca = $fila["hora_out_marca"];
            $comen_marca = $fila["comen_marca"];
            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];

            $jefepro = $nombre . " " . $apellido;

            $fecha_marca_mostrar = invertirFecha($fecha_marca);
            ?>		




            <tr> 


                <td><? echo $id_marca //$reg  ?></td>								
                <td><? echo $jefepro ?></td>
                <td> <? echo $rut_marca ?></td>
                <td> <? echo $nombre_func ?></td>
                <td> <? echo $apellido1 ?></td>
                <td> <? echo $fecha_marca ?></td>
                <td> <? echo $hora_in_marca ?></td>
                <td> <? echo $hora_colacion_func; ?></td> 
                <td> <? echo $hora_out_marca ?></td>

    <? if ($hora_in_marca == "00:00:00" or $hora_out_marca == "00:00:00") {
        ?>
                    <td  class="alert" style="text-align:center;" >  <? echo "Falta " ?> </td>
                    <td  class="alert" style="text-align:center; ">  <? echo "Marcación" ?> </td>
                    <td style="text-align:center; width:5%" >
                        <a href="javascript:falta_marca('<? echo $id_marca; ?>') " class="btn btn-mini btn-success"  title="Modificar">
                            <i class="halflings-icon edit white"></i></a>


                                                                                <!--<a  href="mod_marca.php?id_marca=<? echo $id_marca; ?>" target="_blank"role="button" class="btn btn-mini btn-success" data-toggle="modal" title="Modificar">
                                                                                                                                <i class="halflings-icon edit white"></i></a>-->
                    </td>

    <?
    } else {

        $diferencia = resta($hora_in_marca, $hora_out_marca);



        $hhtotal = almuerzo($diferencia, $horal);
        ?>		<td> <? echo $hhtotal; ?></td> 


                    <td style="text-align:center; width:auto" > <? echo $hhtotal; ?></td>		 
                    <td style="text-align:center; width:5%" >
                    <?
                    if ($control_marca == 4) {
                        echo Informado;
                    } else {
                        ?>
                            <a href="javascript:modifica_marca('<? echo $id_marca; ?>') " class="btn btn-mini btn-success"  title="Modificar">
                                <i class="halflings-icon edit white"></i></a>
        <? } ?>

                    </td>
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

function redondear_hora($hora) {
    $sep = explode(':', $hora);
    $minutos = $sep[1];
    $hora = $sep[0];
    if ($minutos > 30) {
        $hora = $hora + 1;
    }
    return "$hora:00";   // sin minutos
}
?>	

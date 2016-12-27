
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>

<table class="table table-striped table-bordered bootstrap-datatable datatable" >
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">EMPRESA</th>
            <th scope="col">LS/PERFIL</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">APELLIDO</th>
            <th scope="col">RUT</th>
            <th scope="col">DIAS TRABAJADOS</th>
            <th scope="col">HORAS TOTAL</th>
        </tr>
    </thead>
    <tbody>

        <?
        $id_usuario = $_SESSION["id_usuario"];
        $perfil = $_SESSION["id_perfil"];
        $nombre = $_SESSION["nombre"];
        $apellido = $_SESSION["apellido"];
        $email = $_SESSION["email"];
        $reg = 1;
        include("../conectabd/conexion_bd.php");
        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

        $query1 = " SELECT DISTINCT u.id_usuario, u.nombre_usuario, f.id_func, f.nombre_func,ape1_func,f.rut_func, f.dv_func, l.perfil_ldserv ";
        $query1.=" FROM usuario u, asignado a, funcionario f, ldserv l  ";
        $query1.=" WHERE u.id_usuario =" . $id_usuario . "";
        $query1.=" AND u.id_usuario = a.id_jefepro_asignado ";
        $query1.=" AND id_funcionario_asignado = f.id_func ";
        $query1.=" AND f.id_ldserv_func = l.id_ldserv ";
        $query1.=" AND f.estado_func >0 ";
        $query1.=" AND a.fecha_fin_asignado>=" . $fecha_consulta_act . " ;";

        //echo "QUERY 1 ->".$query1."<br>";


        $result1 = mysql_query($query1) or die("error =" . mysql_error());
        $num1 = mysql_num_rows($result1);
        $num_filas1 = $num1;

        $hora_perfil = 0;



        while ($fila1 = mysql_fetch_array($result1)) {

            $id_func = $fila1["id_func"];
            $nombre_func = $fila1["nombre_func"];
            $ape1_func = $fila1["ape1_func"];
            $rut_func1 = $fila1["rut_func"];
            $dv_func = $fila1["dv_func"];
            $perfil_ldserv = $fila1["perfil_ldserv"];

            $query2 = " SELECT DISTINCT e.nombre_empresa, l.perfil_ldserv, f.nombre_func, f.ape1_func ,";
            $query2.=" f.rut_func, f.dv_func, m.fecha_marca , m.hora_in_marca, m.hora_out_marca, m.hora_colacion_func ";
            $query2.=" FROM funcionario f, empresa e, marcaciones m, ldserv l , asignado a";
            $query2.=" WHERE f.id_func =" . $id_func . " ";
            $query2.=" AND f.id_func = a.id_funcionario_asignado";
            $query2.=" AND f.rut_func = m.rut_marca ";
            $query2.=" AND f.id_emp_func = e.id_empresa ";
            $query2.=" AND f.id_ldserv_func = l.id_ldserv ";
            $query2.=" AND m.cod_marca =0 ";
            $query2.=" AND m.fecha_marca >= f.fech_ing_func ";
            $query2.=" AND m.fecha_marca<=f.fech_out_func ";
            $query2.=" AND m.fecha_marca>=" . $fecha_consulta . " ";
            $query2.=" AND a.estado_asignado>0 ";
            $query2.=" AND m.control_marca <=2 ";
            $query2.=" ORDER BY m.rut_marca, m.fecha_marca ;";

            //echo "QUERY 2 ->".$query2."<br>";
            $result2 = mysql_query($query2) or die("error =" . mysql_error());
            $num2 = mysql_num_rows($result2);
            $num_filas2 = $num2;

            $horatotal = 0;
            if($num_filas2>0){

            while ($fila2 = mysql_fetch_array($result2)) {

                //$rut_func1=$fila2["rut_func"];
                //$dv_func=$fila2["dv_func"];

                $fecha_marca = $fila2["fecha_marca"];
                $hora_in_marca = $fila2["hora_in_marca"];
                $hora_out_marca = $fila2["hora_out_marca"];
                $hora_colacion = $fila2["hora_colacion_func"];
                //$perfil_ldserv=$fila2["perfil_ldserv"];
                $nombre_empresa = $fila2["nombre_empresa"];
                //$nombre_func=$fila2["nombre_func"];
                //$ape1_func=$fila2["ape1_func"];
                //resto las horas
                $diferencia = resta($hora_in_marca, $hora_out_marca);
                // le resto la hora de colacion
                $hhfacturable = almuerzo($diferencia, $hora_colacion);

                $dias = $num_filas2;

                $horatotal = sumahoras($hhfacturable, $horatotal); //llamando a la función.
            }
            ?>
            <tr>
                <td>&nbsp;<? echo $reg ?></td>
                <td>&nbsp;<? echo $nombre_empresa ?></td>
                <td>&nbsp;<? echo $perfil_ldserv ?></td>
                <td>&nbsp;<? echo $nombre_func ?></td>
                <td>&nbsp;<? echo $ape1_func ?></td>
                <td>&nbsp;<? echo $rut_func1 . "-" . $dv_func ?></td>
                <td>&nbsp;<? echo $num_filas2 ?></td>
                <td>&nbsp;<? echo $horatotal ?></td>
            </tr>

    <?
    $reg++;

    $hora_perfil = sumahoras2($horatotal, $hora_perfil);
        }}
?>
           </tr>
    </tbody>  
</table>
        <?

        function sumahoras($hora1, $hora2) {
            $hora1 = explode(":", $hora1);
            $hora2 = explode(":", $hora2);
            $horas = (int) $hora1[0] + (int) $hora2[0];
            $minutos = (int) $hora1[1] + (int) $hora2[1];
            $segundos = (int) $hora1[2] + (int) $hora2[2];
            $horas+=(int) ($minutos / 60);
            $minutos = (int) ($minutos % 60) + (int) ($segundos / 60);
            $segundos = (int) ($segundos % 60);
            return (intval($horas) < 10 ? '0' . intval($horas) : intval($horas)) . ':' . ($minutos < 10 ? '0' . $minutos : $minutos) . ':' . ($segundos < 10 ? '0' . $segundos : $segundos);
        }

        function sumahoras2($hora3, $hora4) {
            $hora3 = explode(":", $hora3);
            $hora4 = explode(":", $hora4);
            $horast = (int) $hora3[0] + (int) $hora4[0];
            $minutost = (int) $hora3[1] + (int) $hora4[1];
            $segundost = (int) $hora3[2] + (int) $hora4[2];
            $horast+=(int) ($minutost / 60);
            $minutost = (int) ($minutost % 60) + (int) ($segundost / 60);
            $segundost = (int) ($segundost % 60);
            return (intval($horast) < 10 ? '0' . intval($horast) : intval($horast)) . ':' . ($minutost < 10 ? '0' . $minutost : $minutost) . ':' . ($segundost < 10 ? '0' . $segundost : $segundost);
        }

        function resta2($inicio, $fin) {


            $dif = date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio));

            return $dif;
        }

        function almuerzo2($diferencia, $horal) {


            $alm = date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal));

            return $alm;
        }
        ?>

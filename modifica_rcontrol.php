<div id="resultado">

    <?
    include("../conectabd/conexion_bd.php");
    $id_usuario = $_SESSION["id_usuario"];
    $perfil = $_SESSION["id_perfil"];
    $dia_act = strftime("%d");
    $mes_act = strftime("%m");
    $ano_act = strftime("%Y");


    if (isset($_POST["clave"])) {

        $mes_act = $_POST["clave"];
    }

    $fecha_consulta_inicio = "'" . $ano_act . "-" . $mes_act . "-01'";
    $fecha_consulta_fin = "'" . $ano_act . "-" . $mes_act . "-31'";

    function invertirFecha2($Fecha) {
        $Fecha = explode("-", $Fecha);
        $fec = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];
        return $fec;
    }

    $nombre_mes = nombre_demes($mes_act);
    ?>

    <div class="btn-group center" >
        <form class="form-horizontal" id="formulario" name="formulario">

            <select class="form-control" id="clave" name="clave">
                <option value="<? echo $mes_act; ?>"> <? echo $nombre_mes ?></option>
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
            <button type="button" class="btn btn-primary" name="enviar" id="enviar" onClick="buscar_modificaciones(this.form)">Ver</button>
        </form>
    </div>

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
                <th>Comentario</th>
                <th> ESTADO</th>
            </tr>
        </thead>  
        <tbody>


        <?
        $reg = 1;




        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

        $query = " SELECT u.nombre, u.apellido, u.email_usuario, f.id_func, f.nombre_func, f.ape1_func, ";
        $query.=" f.rut_func, f.dv_func, f.fech_ing_func, f.fech_out_func, m.* ";
        $query.=" FROM funcionario f, marcaciones m, usuario u, asignado a ";
        $query.=" WHERE id_usuario = a.id_jefepro_asignado ";
        $query.=" AND m.cod_marca=0 ";
        $query.=" AND a.id_funcionario_asignado = f.id_func ";
        $query.=" AND f.estado_func >0 ";
        $query.=" AND f.rut_func = m.rut_marca ";
        $query.=" AND m.fecha_marca>=" . $fecha_consulta_inicio . " ";
        $query.=" AND m.fecha_marca<=" . $fecha_consulta_fin . " ";
        $query.=" AND (m.control_marca=1)  ";
        $query.=" ORDER BY m.rut_marca, m.fecha_marca ;";

        //echo $query;

        $result = mysql_query($query) or die("error =" . mysql_error());
        $num = mysql_num_rows($result);
        $num_filas = $num;

      
        

        while ($fila = mysql_fetch_array($result)) {



            $nombre_func = $fila["nombre_func"];
            $ape1_func = $fila["ape1_func"];
            $rut_func = $fila["rut_func"];
            $dv_func = $fila["dv_func"];

            $id_marca = $fila["id_marca"];
            $fecha_marca = $fila["fecha_marca"];
            $hora_in_marca = $fila["hora_in_marca"];
            $hora_colacion_func = $fila["hora_colacion_func"];
            $hora_out_marca = $fila["hora_out_marca"];
            $comen_marca = $fila["comen_marca"];
            $estado_marca = $fila["estado_marca"];
            $inf_rrhh_marca = $fila["informada_marca"];

            $nombre = $fila["nombre"];
            $apellido = $fila["apellido"];
            $email_usuario = $fila["email_usuario"];
            $jefepro = $nombre . " " . $apellido;

            $fecha_marca_mostrar = invertirFecha2($fecha_marca);
            $control_marca = $fila["control_marca"];

            //resto las horas
            $diferencia = restam($hora_in_marca, $hora_out_marca);
            // le resto la hora de colacion
            $hhfacturable = almuerzom($diferencia, $hora_colacion_func);
            ?>		
            
                <tr>	
                    <td><? echo $reg ?></td>
                    <td><? echo $jefepro ?></td>
                    <td> <? echo $rut_func . "-" . $dv_func; ?></td>
                    <td> <? echo $nombre_func ?></td>
                    <td> <? echo $ape1_func ?></td>
                    <td> <? echo $fecha_marca_mostrar ?></td>
                    <td> <? echo $hora_in_marca ?></td>
                    <td> <? echo $hora_colacion_func; ?></td> 
                    <td> <? echo $hora_out_marca ?></td>
                    <td ><? echo $estado_marca ?></td>
                    <td >INFORMADA</td>

                </tr> 
                
        <? $reg++; } ?>  
            </tbody>
        </table>            

    </div>					

    <?

    function restam($inicio, $fin) {


        $dif = date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio));

        return $dif;
    }

    function almuerzom($diferencia, $horal) {


        $alm = date("H:i:s", strtotime("00:00:00") + strtotime($diferencia) - strtotime($horal));

        return $alm;
    }

    function nombre_demes($mes_act) {
        $mes_act = $mes_act;
        switch ($mes_act) {

            case 1 :
                $res_mes = "Enero";
                break;

            case 2 :
                $res_mes = "Febrero";
                break;

            case 3 :
                $res_mes = "Marzo";
                break;

            case 4 :
                $res_mes = "Abril";
                break;

            case 5 :
                $res_mes = "Mayo";
                break;

            case 6 :
                $res_mes = "Junio";
                break;

            case 7 :
                $res_mes = "Julio";
                break;

            case 8 :
                $res_mes = "Agosto";
                break;

            case 9 :
                $res_mes = "Septiembre";
                break;

            case 10 :
                $res_mes = "Octubre";
                break;

            case 11 :
                $res_mes = "Noviembre";
                break;

            case 12 :
                $res_mes = "Diciembre";
                break;

            default :
                $res_mes = "Codigo error ";
        }

        return ($res_mes);
        }
    ?>		

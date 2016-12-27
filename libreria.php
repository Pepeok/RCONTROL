<?php
//$id_func = $_GET['id_func'];
$dia_act = strftime("%d");
$mes_act = strftime("%m");
$ano_act = strftime("%Y");
$hora_act = strftime("%H");
$minutos_act = strftime("%M");
$fecha_actual = $dia_act . "-" . $mes_act . "-" . $ano_act;
$hora_actual = $hora_act . ":" . $minutos_act;
$fecha_consulta = $ano_act . "-" . $mes_act . "-" . $dia_act;

error_reporting(E_ALL ^ E_NOTICE);

function horafraccion($hora1) {
    $hora1 = explode(":", $hora1);
    $horas = (int) $hora1[0];
    $minutos = (int) $hora1[1];
    $segundos = (int) $hora1[2];
    $minfrac = ($minutos / 60);
    $segfrac = ($segundos / 3600);
    $suma = $horas + $minfrac + $segfrac;
    $suma2 = round($suma, 4);
    $hora_frac = $suma2;
    return $hora_frac;
}

function sumahoras3($hora1, $hora2, $hora3) {
    $hora1 = explode(":", $hora1);
    $hora2 = explode(":", $hora2);
    $hora3 = explode(":", $hora3);
    $horas = (int) $hora1[0] + (int) $hora2[0] + (int) $hora3[0];
    $minutos = (int) $hora1[1] + (int) $hora2[1] + (int) $hora3[1];
    $segundos = (int) $hora1[2] + (int) $hora2[2] + (int) $hora3[2];
    $horas+=(int) ($minutos / 60);
    $minutos = (int) ($minutos % 60) + (int) ($segundos / 60);
    $segundos = (int) ($segundos % 60);
    return (intval($horas) < 10 ? '0' . intval($horas) : intval($horas)) . ':' . ($minutos < 10 ? '0' . $minutos : $minutos) . ':' . ($segundos < 10 ? '0' . $segundos : $segundos);
}

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

function nombredelmes($fecha) {
    $fecha = explode("-", $fecha);
    $nom_mes = $fecha[1];
    return $nom_mes;
}

// funcion que saca el año que ingreso el usuario
function anioconsultado($fecha) {
    $fecha = explode("-", $fecha);
    $num_año = $fecha[0];
    return $num_año;
}

/* Funcion que invierte la fecha que recibe desde el formulario
  Con el fin que sea expresado en el MYSQL */

function fecha_mysql($Fecha) {
    $Fecha = explode("-", $Fecha);
    $femysql = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];

    return $femysql;
}

//*******Fin invierte Fecha***********//

function invertirFecha($Fecha) {
    $Fecha = explode("-", $Fecha);
    $fec = $Fecha[2] . "-" . $Fecha[1] . "-" . $Fecha[0];
    return $fec;
}

function fechaexel($Fecha) {
    $Fecha = explode("-", $Fecha);
    $fecha_exel = $Fecha[2] . "" . $Fecha[1] . "" . $Fecha[0];
    return $fecha_exel;
}

function colocapunto($valor) {

    switch (strlen($valor)) {

        case 0 : if ($valor == "") {
                $resultado = "&nbsp;";
            }
            break;

        case 4 : $resultado = substr_replace($valor, '.', 1, 0);
            break;

        case 5 : $resultado = substr_replace($valor, '.', 2, 0);
            break;

        case 6 : if ($valor == "&nbsp;") {
                $resultado = $valor;
            } else {
                $resultado = substr_replace($valor, '.', 3, 0);
            }
            break;

        case 7 : $resultado = substr_replace($valor, '.', 4, 0);
            $resultado = substr_replace($resultado, '.', 1, 0);
            break;

        case 8 : $resultado = substr_replace($valor, '.', 5, 0);
            $resultado = substr_replace($resultado, '.', 2, 0);
            break;

        case 9 : $resultado = substr_replace($valor, '.', 6, 0);
            $resultado = substr_replace($resultado, '.', 3, 0);
            break;

        case 10 : $resultado = substr_replace($valor, '.', 7, 0);
            $resultado = substr_replace($resultado, '.', 4, 0);
            $resultado = substr_replace($resultado, '.', 1, 0);
            break;

        case 11 : $resultado = substr_replace($valor, '.', 8, 0);
            $resultado = substr_replace($resultado, '.', 5, 0);
            $resultado = substr_replace($resultado, '.', 2, 0);
            break;

        case 12 : $resultado = substr_replace($valor, '.', 9, 0);
            $resultado = substr_replace($resultado, '.', 6, 0);
            $resultado = substr_replace($resultado, '.', 3, 0);
            break;

        case 13 : $resultado = substr_replace($valor, '.', 10, 0);
            $resultado = substr_replace($resultado, '.', 7, 0);
            $resultado = substr_replace($resultado, '.', 4, 0);
            $resultado = substr_replace($resultado, '.', 1, 0);
            break;

        default : $resultado = $valor;
    }
    return array($resultado);
}
function nombre_mes($mes_act)
    {
        $mes_act = $mes_act;
        switch ($mes_act) {

            case 1  :
                $res_mes = "Enero";
                break;

            case 2  :
                $res_mes = "Febrero";
                break;

            case 3  :
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

function ajuste_log($log_marca) {
    $fecha = preg_split("/[\s-]/", $log_marca);
    $ano = $fecha[0];
    $mes = $fecha[1];
    $dia = $fecha[2];
    $hora = $fecha[3];
    $log = $dia . "-" . $mes . "-" . $ano . " a las " . $hora;
    return $log;
}

function validar_rut($rut, $digito_v) {
    $x = 2;
    $sumatorio = 0;

    for ($i = strlen($rut) - 1; $i = 0; $i--) {
        if ($x = 7) {
            $x = 2;
        }
        $sumatorio = $sumatorio + ($rut[$i] * $x);
        $x++;
    }
    $digito = bcmod($sumatorio, 11);
    $digito = 11 - $digito;

    switch ($digito) {
        case 10:
            $digito = k;
            break;
        case 11:
            $digito = 0;
            break;
    }

    if (strtolower($digito_v) == $digito) {
        $verificado = true;
    } else {
        $verificado = false;
    }

    return $verificado;
}

function digito_ver($rut) {
    $x = 2;
    $sumatorio = 0;
    for ($i = strlen($rut) - 1; $i = 0; $i--) {
        if ($x7) {
            $x = 2;
        }
        $sumatorio = $sumatorio + ($rut[$i] * $x);
        $x++;
    }
    $digito = bcmod($sumatorio, 11);
    $digito = 11 - $digito;

    switch ($digito) {
        case 10:
            $digito = K;
            break;
        case 11:
            $digito = 0;
            break;
    }

    return $digito;
}

function empresa($nombre, $valor) {
    //  include("config.inc.php");
    $query = "SELECT * from empresa order by id_empresa";
    //echo $query;
    mysql_select_db("rcontrol");
    $result = mysql_query($query);
    echo "<select name='$nombre' id='$nombre'>";
    echo "<option value=''>Selecciona un una Empresa...</option>";
    while ($registro = mysql_fetch_array($result)) {
    
        echo "<option value='" . $registro['id_empresa'] . "'";
       // if ($registro['idpadre'] == $valor)
            echo " selected";
        echo ">" . $registro['nombre_empresa'] . "</option>\r\n";
    }
    echo "</select>";
}

function ldserv($nombre, $valor) {
//  include("config.inc.php");
    $query = "SELECT * FROM ldserv order by id_ldserv";
    //echo $query;
    mysql_select_db('rcontrol');
    $result = mysql_query($query);
    echo "<select name='$nombre' id='$nombre'>";
    echo "<option value=''>Selecciona una Linea de Servicio...</option>";
    while ($registro = mysql_fetch_array($result)) {
        echo "<option value='" . $registro['id_ldserv'] . "'";
        //if ($registro['id_ldserv'] == $valor)
            echo " selected";
        echo ">" . $registro['perfil_ldserv'] . "</option>\r\n";
    }
    echo "</select>";
}

function pgc($nombre, $valor) {
//  include("config.inc.php");
    $query = "select * from pgcompras order by id_pgcompras";
    echo $query;
    mysql_select_db('rcontrol');
    $result = mysql_query($query);
    echo "<select name='$nombre' id='$nombre'>";
    echo "<option value='0'>Selecciona un Contrato...</option>";
    while ($registro = mysql_fetch_array($result)) {
        echo "<option value='" . $registro['id_pgcompras'] . "'";
       // if ($registro['id_pgcompras'] == $valor)
            echo " selected";
        echo ">" . $registro['nombre_pgcompras'] . "</option>\r\n";
    }
    echo "</select>";
}

function getRealIP() {

    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_X_FORWARDED'])) {
        return $_SERVER['HTTP_X_FORWARDED'];
    } elseif (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_FORWARDED_FOR'];
    } elseif (isset($_SERVER['HTTP_FORWARDED'])) {
        return $_SERVER['HTTP_FORWARDED'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

function jdpto($dpto) {
    //echo $dpto=$dpto;
    mysql_select_db('rcontrol');
    $consulta_mysql = 'select * from dpto where id_dpto='.$dpto.';';
    $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
    $num = mysql_num_rows($result);
    $num_filas = $num;
    while ($fila = mysql_fetch_array($result)) {
    $jdpto= $fila['jdpto_dpto'] ;
    }
    //echo $jdpto;
    return $jdpto;
   

}

?>

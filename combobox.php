<?php

include("../conectabd/conexion_bd.php");

if ($_GET['buscar'] == "padreemp") {

    $consulta_mysql2 = 'select e.*  from inter1 i, empresa e where  ';
    $consulta_mysql2.=' i.id_ldserv_inter1=' . mysql_real_escape_string(intval($_GET['idhijo'])) . ' ';
    $consulta_mysql2.=' and i.id_empresa_inter1=e.id_empresa ;';
//echo 	$consulta_mysql2;
    mysql_select_db('rcontrol');
    $result = mysql_query($consulta_mysql2) or die("error =" . mysql_error());
    $num = mysql_num_rows($result);
    $num_filas = $num;
    echo "<select id='empresa2' class='form-control' name='empresa2'  >";
    echo "<option value='0'>Seleccione Una Empresa</option>";
    while ($fila2 = mysql_fetch_array($result)) {
        echo "<option value='" . $fila2['id_empresa'] . "'";
        //if ($fila2['id_empresa'] == $valoractual)
        echo " selected";
        echo ">" . $fila2['nombre_empresa'] . "</option>";
    }
    echo "</select>";
}

if ($_GET['buscar'] == "hijos") {
    $consulta = " SELECT l.* FROM ldserv l , empresa e, inter1 i ";
    $consulta.=" WHERE e.id_empresa='" . mysql_real_escape_string(intval($_GET['idpadre'])) . "' ";
    $consulta.=" AND e.id_empresa=i.id_empresa_inter1 ";
    $consulta.=" AND i.id_ldserv_inter1=l.id_ldserv  order by l.id_ldserv asc";
//echo $consulta;
    mysql_select_db('rcontrol');
    $todos = mysql_query($consulta);

// Comienzo a imprimir el select
    echo "<select name='ldserv2' id='ldserv2'>";
    while ($registro = mysql_fetch_array($todos)) {
// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
// Imprimo las opciones del select
        echo "<option value='" . $registro['id_ldserv'] . "'";
        // if ($registro['id_ldserv'] == $valoractual)
        echo " selected";
        echo ">" . $registro['perfil_ldserv'] . " - " . $registro['pgc_ldserv'] . "</option>";
    }
    echo "</select>";
}

if ($_GET['buscar'] == "nietos") {

    $consulta = " SELECT p.id_pgcompras, p.nombre_pgcompras ";
    $consulta.=" FROM ldserv l, empresa e, inter1 i, pgcompras p, empco em ";
    $consulta.= " WHERE l.id_ldserv ='" . mysql_real_escape_string(intval($_GET['idhijo'])) . "' ";
    $consulta.= " AND l.id_ldserv = i.id_ldserv_inter1 ";
    $consulta.= " AND i.id_empresa_inter1 = e.id_empresa ";
    $consulta.= " AND e.id_empresa = em.id_empresa_empco ";
    $consulta.= " AND em.pro_gc_empco = p.id_pgcompras ";
    $consulta.= " AND l.pgc_ldserv = p.nombre_pgcompras ";


//echo $consulta;
    mysql_select_db('rcontrol');
    $todos = mysql_query($consulta);

// Comienzo a imprimir el select
    echo "<select name='tdr2' id='tdr2'>";
    while ($registro = mysql_fetch_array($todos)) {
// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
// Imprimo las opciones del select
        echo "<option value='" . $registro['id_pgcompras'] . "'";
        // if ($registro['id_ldserv'] == $valoractual)
        echo " selected";
        echo ">" . $registro['nombre_pgcompras'] . "</option>";
    }
    echo "</select>";
}
//__________________________________________________________________________________________________

mysql_select_db('rcontrol');

if ($_GET['buscar'] == "jefes") {
    $consulta = "select * from usuario where id_dpto_usuario=" . $_GET['id'];
    echo $consulta;
    $query = mysql_query($consulta);
    while ($fila = mysql_fetch_array($query)) {
        echo '<option value="' . $fila['id_usuario'] . '">' . $fila['nombre'] . "&nbsp; " . $fila['apellido'] . '</option>';
    };
}
mysql_select_db('rcontrol');

if ($_GET['buscar'] == "proyectos") {
    $consulta2 = "select * from proyectos where id_jefepro_proyectos=" . $_GET['id2'];
    echo $consulta2;
    $query2 = mysql_query($consulta2);
    echo $query2;
    while ($fila2 = mysql_fetch_array($query2)) {
        echo " <option value=" . $fila2['id_proyectos'] . ">" . $fila2['nombre_proyectos'] . " </option> ";
    }
}
?>
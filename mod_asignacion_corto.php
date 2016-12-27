<?

include ("js.php");
error_reporting(E_ALL ^ E_NOTICE);
?>
                 

  <table border=1 cellspacing=0 cellpadding=2 bordercolor="666633">

    <thead style="font-size:10 ">
        <tr >
            <th style="width: 10px;">DPTO</th>
            <th>PROYECTO</th>
            <th>JEFE PROYECTO</th>
            <th>DESDE</th>
            <th>HASTA</th>
            <th>ACCIÓN</th>
        </tr>
    </thead>   
    <tbody>

        <?
        mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");

?>
       <form  id="form2" name="form2"  method="post" action="modificar_externos.php" >


            <tr style="font-size:11"> 



                <td style="width: 10px;">    
                    
                        <?
                        $consulta_mysql = 'select * from dpto';
                        $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                        $num = mysql_num_rows($result);
                        $num_filas = $num;

                        echo "<select id='empresa' class='form-control' name='empresa' >";
                        echo "<option value='0'>DPTO</option>";
                        while ($fila = mysql_fetch_array($result)) {
                            echo "<option value='" . $fila['id_dpto'] . "'>" . $fila['nombre_dpto'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                       	
                    
                </td>
                <td>  <?
                        $consulta_mysql = 'select * from proyectos';
                        $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                        $num = mysql_num_rows($result);
                        $num_filas = $num;

                        echo "<select id='proyectos' class='form-control' name='empresa' >";
                        echo "<option value='0'>PROYECTO</option>";
                        while ($fila = mysql_fetch_array($result)) {
                            echo "<option value='" . $fila['id_proyectos'] . "'>" . $fila['nombre_proyectos'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                </td>
                <td>  <?
                        $consulta_mysql = 'select * from usuario';
                        $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                        $num = mysql_num_rows($result);
                        $num_filas = $num;

                        echo "<select id='jdproyecto' class='form-control' name='empresa' >";
                        echo "<option value='0'>Jefe de Proyecto</option>";
                        while ($fila = mysql_fetch_array($result)) {
                            echo "<option value='" . $fila['id_usuario'] . "'>" . $fila['nombre'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                </td>
                <td><input type="date" SIZE="9" id="fecha_ini" name="dpto" value=""/> </td>
                <td><input type="date" SIZE="9"  id="fecha_fin" name="dpto" value=""/> </td>
                <td style="text-align:center; width:5%" >
                    <a  href="javascript:modifica_asignacion('<? echo $id_asignado; ?>') " class="btn btn-mini btn-success"  title="Modificar">
                        <i class="halflings-icon edit white"></i></a></td>
            </tr>
             </form>

    </tbody>
</table>

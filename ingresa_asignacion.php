<html>

    <?
    include('js.php');
    $id_func = $_GET['id_func'];


    mysql_select_db("rcontrol") or die("No se pudo conectar a BD rcontrol");
    ?>

    <body>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-6">
                    <div class="row-fluid">
                        <div class="box span12">
                            <div class="box-header" data-original-title>
                                <h2><i class="halflings-icon edit"></i> Seleccione los datos para Nueva Asignación</h2>
                                <div class="box-icon">

                                </div>
                            </div>
                            <div class="box-content">
                                <form class="form-horizontal" id="form2" name="form2"  method="post" action="ingresar_asignacion.php" >

                                    <input name="id_func"     type="hidden" value="<? echo $id_func ?>" />
                                    <input name="id_usuario"  type="hidden" value="<? echo $idlogin; ?>" />
                                    <input name="fecha_in"     type="hidden" value="<? echo $fech_ing_func_mostrar ?>" />
                                    <input name="fecha_out"     type="hidden" value="<? echo $fech_out_func_mostrar ?>" />
                                    <input name="estado_asignado"     type="hidden" value="<? echo $estado_func ?>" />

                                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                        <div class="control-group">
                                            <label class="control-label">Departamento </label>
                                            <div class="controls">
                                                <?
                                                $consulta_mysql = 'select * from dpto where id_dpto>0';
                                                $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                                                $num = mysql_num_rows($result);
                                                $num_filas = $num;
                                                echo "<select id='dpto' class='form-control' name='dpto'>";
                                                echo "<option value='0'>Dpto</option>";
                                                while ($fila = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $fila['id_dpto'] . "'>" . $fila['nombre_dpto'] . "</option>";
                                                }
                                                echo "</select>";
                                                ?>

                                            </div>
                                        </div>

                                        <!--	//QUERY COMBO 2 -->

                                        <div class="control-group">
                                            <label class="control-label">Jefe de Proyecto</label>
                                            <div class="controls">


                                                <?php
                                                echo "<select id='jdepro'class='form-control' name='jdepro'>";
                                                echo "<option value='0'>Jefe De Proyecto</option>";
                                                echo $nombre_jdpro = $fila['nombre'] . "&nbsp; " . $fila['apellido'];
                                                echo "</select>";
                                                ?>



                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Proyecto </label>
                                            <div class="controls">
                                                <?
                                                echo "<select id='proyecto'class='form-control' name='proyecto'>";
                                                echo "<option value='0'>Proyecto</option>";
                                                echo $nombre_pro = $fila['sigla_proyectos'] . "&nbsp; " . $fila['nombre_proyectos'];
                                                echo "</select>";
                                                ?>

                                            </div>
                                        </div>

                                        <div class="control-group">

                                            <label class="control-label" for="focusedInput">Fecha Asignado</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused cursor" id="fecha_ina" name="fecha_ina" type="text"  value="<? echo $fech_ing_func_mostrar ?>" readonly="readonly"	required>

                                            </div>

                                        </div>

                                        <div class="control-group ">
                                            <label class="control-label" for="focusedInput">Fecha Fin Asignado</label>
                                            <div class="controls">
                                                <input class="input-xlarge focused cursor" id="fechaouta" name="fechaouta" type="text"   value="<? echo $fech_out_func_mostrar ?>" required readonly="readonly">

                                            </div>

                                        </div>

                                        <div id="botones" class="form-actions">
                                            <button type="button" class="btn btn-primary" name="botonas" id="botonas" onclick="javascript:valida_form_asignacion(this.form);"id="botonas">Agregar</button>
                                            <button type="button" class="btn" name="boton2"  id="boton2"onclick="javascript:window.close();">Cancelar</button>
                                        </div>


                                    </form>
                                    </form>
                                    
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        
<div class="box-content buttons">
    <h2 > Informe Mensual de Marcaciones </h2>
    <div class="box-content">
        <form class="form-horizontal" action="informe_mensual_empresas.php" name="form" target="_blank"id="form" method="post">
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="selectError3" >Año</label>
                    <div class="controls">
                        <select id="anio" name="anio" >
                            <option value="">Seleccione Año</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError3" >Mes</label>
                    <div class="controls">
                        <select id="mes" name="mes" >
                            <option value="">Seleccione mes</option>
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
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError3" >Empresa</label>
                    <div class="controls">
                        <?
                        $consulta_mysql = 'select * from empresa where id_empresa>0 and id_empresa!=8 order by id_empresa asc';
                        $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                        $num = mysql_num_rows($result);
                        $num_filas = $num;
                        echo "<select class='form-control' name='empresa'id='empresa'>";
                        echo "<option value=''>Empresa</option>";
                        while ($fila = mysql_fetch_array($result)) {
                            echo "<option value='" . $fila['id_empresa'] . "'>" . $fila['nombre_empresa'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="selectError3" >Proceso G/C</label>
                    <div class="controls">
                        <?
                        $consulta_mysql = 'select * from pgcompras';
                        $result = mysql_query($consulta_mysql) or die("error =" . mysql_error());
                        $num = mysql_num_rows($result);
                        $num_filas = $num;
                        echo "<select class='form-control' name='pgc'>";
                        echo "<option value=''>PGC</option>";
                        while ($fila = mysql_fetch_array($result)) {
                            echo "<option value='" . $fila['id_pgcompras'] . "'>" . $fila['nombre_pgcompras'] . "</option>";
                        }
                        echo "</select>";
                        ?>
                    </div>
                </div>

                <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario; ?>" />
                <div class="form-actions">
                    <button type="button" class="btn btn-primary"  formtarget="_blank" onclick="javascript:valida_form_mes(this.form);">Consultar</button>
                    
                    <button class="btn" onClick="location.reload(true)">Cancelar</button>
                </div>
            </fieldset>
        </form>

    </div>
</div>

<script type="text/javascript">

</script>
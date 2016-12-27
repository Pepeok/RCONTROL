<div class="box-content buttons">
<h2 > Informe Semanal de Marcaciones </h2>
	<div class="box-content">
		<form class="form-horizontal" action="informe_semanal_empresas.php"  method="post">
			<fieldset>
				<div class="control-group success">
					<label class="control-label" >Fecha Inicio Semana</label>
					<div class="controls">
			  			<input type="text" name="fecha_ini" id="fecha_ini" required>(dd-mm-aaaa)
			  		</div>
		  		</div>
			<div class="control-group success">
			<label class="control-label" for="inputSuccess">Fecha Fin Semana</label>
				<div class="controls">
			  		<input type="text" name="fecha_fin" id="fecha_fin" required>(dd-mm-aaaa)
				</div>
		  	</div>
		  	<div class="control-group">
			<label class="control-label" for="selectError3" >Empresa</label>
				<div class="controls">
				  <?
					$consulta_mysql='select * from empresa';
					$result=mysql_query($consulta_mysql)or die("error =".mysql_error());
					$num=mysql_num_rows($result);
					$num_filas=$num;
					echo "<select class='form-control' name='empresa'  ' required>";
					while($fila=mysql_fetch_array($result)){
						echo "<option value='".$fila['id_empresa']."'>".$fila['nombre_empresa']."</option>";
					}
					echo "</select>";
					?>
				</div>
		  	</div>
		 	<div class="control-group">
			<label class="control-label" for="selectError3" >Proceso G/C</label>
				<div class="controls">
				  <?
					$consulta_mysql='select * from pgcompras';
					$result=mysql_query($consulta_mysql)or die("error =".mysql_error());
					$num=mysql_num_rows($result);
					$num_filas=$num;
					echo "<select class='form-control' name='pgc'  ' required>";
					while($fila=mysql_fetch_array($result)){
						echo "<option value='".$fila['id_pgcompras']."'>".$fila['nombre_pgcompras']."</option>";
					}
					echo "</select>";
					?>
				</div>
		  	</div>

		  <input type="hidden" id="id_usuario" name="id_usuario" value="<? echo $id_usuario; ?>" />

		  <div class="form-actions">
			<button type="submit" class="btn btn-primary" formtarget="_blank">Consultar	</button>
			<button class="btn" onClick="location.reload(true)">Cancelar</button>
		  </div>
		</fieldset>
	  </form>
</div>
</div>

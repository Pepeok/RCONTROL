    		<div class="box-content buttons">
    				<h2 > Proyección de Horas Profesionales Externos </h2>
					<div class="box-content">
						<form class="form-horizontal" action="informe_proyeccion_horas.php"  method="post">
							<fieldset>
								<div class="control-group">
								<label class="control-label" for="selectError3" >Año</label>
								<div class="controls">
								  <select id="anio" name="anio" required>
								  	<option >Seleccione Año</option>
									<option value="2015">2015</option>
									<option value="2016">2016</option>
									<option value="2017">2017</option>
									</select>
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="selectError3" >Mes</label>
								<div class="controls">
								  <select id="mes" name="mes" required>
								  	<option >Seleccione mes</option>
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
								<label class="control-label" for="selectError3" >Proceso G/C</label>
								<div class="controls">
								  <select id="pgc" name="pgc" required>
								  	<option >Seleccione PGC</option>
									<option value="2">GC-5748</option>
									<option value="1">GC-5465</option>
																		
								  </select>
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
				</div><!--/span-->

<script type="text/javascript">	

	 function validar_formulario(formulario)
     {
       if(formulario.anio.value=="")
         {
           alert("Seleccion un año !!");
           formulario.anio.focus();
           return false;
         }
       if(formulario.mes.value=="")
         {
           alert("Seleccione MES !!");
           formulario.mes.focus();
           return false;
         }else{
           if(formulario.empresa.value="")
             {
               alert("Seleccione una Empresa!!");
               formulario.empresa.focus();
               return false;
             }
		 }
       if(formulario.pgc.value=="")
         {
           alert("Debe identificar el Proceso de Grandes Compras !!");
           formulario.pgc.focus();
           return false;
         }
       
       formulario.submit();

     }

  </script>
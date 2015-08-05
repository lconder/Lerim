<div class="container">
	<div class="row">
		<h1>Ingrese los datos de la nueva Muestra:</h1>
		<form class="form-horizontal" action="<?php echo base_url() ?>index.php?/Welcome/agregaMuestra" method="post" >
			<fieldset>
			<legend></legend>
				<div class="form-group">	
	  				<label class="col-lg-2 control-label" for="nombre">Nombre</label>
		  			<div class="col-xs-5">
		    			<input id="nombre" name="nombre" type="text" placeholder="Nombre de la muestra" class="form-control" required="">
		    			<input id="cliente" name="cliente" type="hidden" value=<?php echo $id;?>>
		  			</div>
				</div>
				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="representante">Fecha</label>
	  				<div class="col-xs-5">
	    				<input id="fecha" name="fecha" type="date" class="form-control" max=<?php echo  date("Y-m-d")?> required="">  
	  				</div>
				</div>
				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="telefono">Hora</label>
	  				<div class="col-xs-5">
	    				<input id="hora" name="hora" type="time" placeholder="Hora de la muestra" class="form-control" required="">
	  				</div>
	  			</div>
	  			
				<div class="form-group">
	  				<label for="select" class="col-lg-2 control-label">Tipo:</label>
            		<div class="col-xs-5">
                	<select class="form-control" id="tipo" name="tipo">
                	<?php foreach($tipos->result() as $row)
	  				{?>
	                    <option value=<?php echo $row->id;?>><?php echo $row->nombre?></option>
	                  <?php }?>
	                  	<option value="0"> Otro</option>
                	</select>
					</div>
				</div>
				<div  class="hide" class="form-group" id="divTipo">
	  				<label class="col-lg-2 control-label" for="representante">Nuevo Tipo:</label>
	  				<div class="col-xs-5">
	    				<input id="nuevoTipo" name="nuevoTipo" type="text" class="form-control">  
	  				</div>
				</div>
				

				<div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-default">Limpiar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
			</fieldset>
		</form>
	</div>
</div>
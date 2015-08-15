<div class="container">
	<div class="row">
		<h1>Ingrese los datos del nuevo cliente:</h1>
		<form class="form-horizontal" action="<?php echo base_url() ?>index.php?/Welcome/agregaCliente" method="post" >
			<fieldset>
			<legend></legend>
				<div class="form-group">	
	  				<label class="col-lg-2 control-label" for="nombre">Nombre</label>
		  			<div class="col-xs-5">
		    			<input id="nombre" name="nombre" type="text" placeholder="Nombre de empresa" class="form-control" required="">
		  			</div>
				</div>
				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="representante">Representante</label>
	  				<div class="col-xs-5">
	    				<input id="representante" name="representante" type="text" placeholder="Representante de la empresa" class="form-control" required="">  
	  				</div>
				</div>
				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="telefono">Teléfono</label>
	  				<div class="col-xs-5">
	    				<input id="telefono" name="telefono" type="number" placeholder="Teléfono" class="form-control" required="">
	  				</div>
	  			</div>
	  			<div class="form-group">
	  				<label class="col-lg-2 control-label" for="email">Email</label>
	  				<div class="col-xs-5">
	    				<input id="email" name="email" type="email" placeholder="email@ejemplo.com" class="form-control" required="">
	  				</div>
	  			</div>

				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="direccion">Dirección</label>
	  				<div class="col-xs-5">
	    				<input id="direccion" name="direccion" type="text" placeholder="Dirección de la empresa" class="form-control" required="">
	  				</div>
				</div>

				<div class="form-group">
	  				<label class="col-lg-2 control-label" for="rfc">R.F.C</label>
	  				<div class="col-xs-5">
	    				<input id="rfc" name="rfc" type="text" placeholder="RFC" class="form-control" required="">
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
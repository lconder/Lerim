<form class="form-horizontal" action="<?php echo base_url() ?>index.php?/Welcome/guardarAnalisis" method="post">
<?php
echo "<h1><strong>Seleccione los ánalisis a realizar:</strong></h1><br>";
foreach($analisis->result() as $row)
{
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
			   		<h1 class="panel-title"><?php echo $row->nombre; ?></h1>
			   	</div>
			   	 <div class="row">
		      		<div class="col-md-6">
		        		<div class="panel-body">
			    			<p><?php echo $row->descripcion;?></p>
			    		</div>
		      		</div>
		      		<div class="col-md-6">
		        		<div class="panel-body">
			    			<p align="right">
			    				
                    				<label>
                        				<input type="checkbox" value=<?php echo $row->id_tipo_analisis;?> name="ids[]">Realizar
                   					</label>
                				
                			</p>
			    		</div>
		      		</div>
		    	</div>
			</div>
		</div>		   	
	</div>
</div>
<?php
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
			   		<h1 class="panel-title"><input id="nuevoNombre" name="nuevoNombre" placeholder="Nombre del análisis" type="text" class="form-control"> </h1>
			   	</div>
			   	 <div class="row">
		      		<div class="col-md-6">
		        		<div class="panel-body">
		        			<div class="row">
      							<div class="col-md-6">
        							<p><textarea  rows="3" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Descripción del análisis" type="text" class="form-control"></textarea></p>
      							</div>
      						<div class="col-md-6">
        						<input id="nuevaUnidad" name="nuevaUnidad" placeholder="Unidad del análisis" type="text" class="form-control">
      						</div>
      					</div>			
			    		</div>
		      		</div>
		      		<div class="col-md-6">
		        		<div class="panel-body">
			    			<p align="right">
			    				
                    				<label>
                        				<input type="checkbox" id="otroAnalisis"  value="0" name="ids[]">Realizar
                   					</label>
                				
                			</p>
			    		</div>
		      		</div>
		    	</div>
			</div>
		</div>		   	
	</div>
</div>

<input id="id" name="id" type="hidden" value=<?php echo $id;?> class="form-control" required="">
<div class="form-group">
            <div class="col-lg-offset-2">
            	<a href="<?php echo base_url() ?>index.php?/<?php echo $this->session->userdata('urlAntigua');?>" class="btn btn-default" role="button">Regresar</a>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
</form>
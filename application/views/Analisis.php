<form class="form-horizontal" action="<?php echo base_url() ?>index.php?/Welcome/actualizarAnalisis" method="post">
<?php
echo "<h1><strong>Ingrese los valores de los análisis realizados:</strong></h1><br>";
?>
<div class="container">
<div class="row">
	<div class="form-group">
		<label class="col-md-2 control-label" for="fecha_analisis">Fecha An&aacute;lisis: </label>
			<div class="col-sm-3">
		    	<input id="fecha_analisis" name="fecha_analisis" type="date" class="form-control"  value=<?php echo  $fecha_analisis?> max=<?php echo  date("Y-m-d")?> required="">  
		  	</div>
		  	<label class="col-md-2 control-label" for="fecha_resultados">Fecha Resultados: </label>
			<div class="col-sm-3">
		    	<input id="fecha_resultados" name="fecha_resultados" type="date" class="form-control" value=<?php echo  $fecha_resultado?> max=<?php echo  date("Y-m-d")?> required="">  
		  	</div>
	</div>
<?php
foreach($analisis->result() as $row)
{
?>


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
                        				<input id="<?php echo "resultado_".$row->id_tipo_analisis;?>" name="<?php echo "resultado_".$row->id_tipo_analisis;?>" type="text" value="<?php echo $row->resultado;?>" class="form-control" >
                        				<input type="checkbox" checked="checked" style="opacity:0" value="<?php echo $row->id_tipo_analisis;?>" name="ids[]">
                        				<?php echo $row->medida;?> 
                   					</label>
                				
                			</p>
                			<p align="right">
			    				
                    				<label>
                        				<input id="<?php echo "ref_".$row->id_tipo_analisis;?>" name="<?php echo "ref_".$row->id_tipo_analisis;?>" type="text" value="<?php echo $row->referencia;?>" class="form-control" >
                        				Referencia
                   					</label>
                				
                			</p>
			    		</div>
		      		</div>
		    	</div>
			</div>
		</div>		   	

<?php
}
?>
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
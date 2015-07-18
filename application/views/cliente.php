<div class="container">
	<div class="row">
		 <div class="col-md-6">
			<?php
				foreach($cliente->result() as $row) 
				{
					echo "<h1><strong>".$row->nombre."</strong></h1>";
					echo "<h3>".$row->representante."</h3>";
					echo "<h3>".$row->telefono."</h3>";
					echo "<h3>".$row->direccion."</h3>";
					echo "<h3>".$row->RFC."</h3><br>";
				}	
			?>
		</div>	      
     	 <div align="right" class="col-md-6">
     	 	<div class="row">
     	 		<div class="col-md-6">
       				<h1><a href="<?php echo base_url();?>index.php/welcome/editarCliente/<?php echo $row->id_cliente?>">&nbsp;<img src="<?php echo base_url();?>assets/img/edit.png" width="80" alt="140"></a></h1>
      			</div>
      			<div class="col-md-6">
       				<h1><a href="<?php echo base_url();?>index.php/welcome/nuevaMuestra/<?php echo $row->id_cliente?>">&nbsp;<img src="<?php echo base_url();?>assets/img/add.png" width="80" alt="140"></a></h1>
      			</div>
     	 		
     	 	</div>
      	</div>

	</div>
	<table class="table table-striped table-hover ">
	    <thead>
	        <tr>
	            <th>Nombre</th>
	            <th>Tipo</th>
	            <th>Fecha</th>
	            <th>Hora</th>
	            <th>Ánalisis</th>
	        </tr>
	    </thead>

	<?php
		foreach($muestras->result() as $row) {?>
		<tr>
			 <td>
                <a href="<?php echo base_url();?>index.php?/welcome/analisis/<?php echo $row->id_muestra?>">&nbsp;<?php echo $row->nombre;?></a>
            </td>
			<td><?php echo $row->tipo; ?></td>
			<td><?php echo $row->fecha; ?></td>
			<td><?php echo $row->hora; ?></td>
			<td><a href="<?php echo base_url();?>index.php/welcome/posiblesAnalisis/<?php echo $row->id_muestra?>">&nbsp;<i class="mdi-content-add-circle-outline"></i></a></td>
		</tr>
		<?php }?>

</div>

      


  
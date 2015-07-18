<div class="container">
    <table class="table table-striped table-hover">
        <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th >Fecha</th>
        <th>Hora</th>
        <th>Cliente</th>
        <th>Ánalisis</th>
      </tr>
      <?php foreach($muestras->result() as $row) { ?>
          <tr>
            <td>
                <a href="<?php echo base_url();?>index.php?/welcome/analisis/<?php echo $row->id_muestra?>">&nbsp;<?php echo $row->nombre;?></a>
            </td>
            <td><?php echo $row->tipo;?></td>
            <td><?php echo $row->fecha;?></td>
            <td><?php echo $row->hora;?></td>
            <td><?php echo $row->cliente;?></td>
            <td><a href="<?php echo base_url();?>index.php/welcome/posiblesAnalisis/<?php echo $row->id_muestra?>">&nbsp;<i class="mdi-content-add-circle-outline"></i></a></td>
          </tr>
          <?php }?>
        </table>
</div>
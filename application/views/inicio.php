<div class="container">
    <table  class="table table-striped table-hover">
        <tr >
        <th >Nombre</th>
        <th >Representante</th>
        <th >Teléfono</th>
        <th >Dirección</th>
        <th >RFC</th>
        <th >Agregar muestra</th>
      </tr>
      <?php foreach($clientes->result() as $row) { ?>
          <tr>
            <td>
                <a href="<?php echo base_url();?>index.php/welcome/bio/<?php echo $row->id_cliente?>">&nbsp;<?php echo $row->nombre;?></a>
            </td>
            <td><?php echo $row->representante;?></td>
            <td><?php echo $row->telefono;?></td>
            <td><?php echo $row->direccion;?></td>
            <td><?php echo $row->RFC;?></td>
            <td>
              <a href="<?php echo base_url();?>index.php/welcome/nuevaMuestra/<?php echo $row->id_cliente?>">&nbsp;<i class="mdi-content-add-circle-outline"></i></a>
              <a href="<?php echo base_url();?>index.php/welcome/editarCliente/<?php echo $row->id_cliente?>">&nbsp;<i class="mdi-content-create"></i></a>
            </td>
          </tr>
          <?php }?>
        </table>
</div>
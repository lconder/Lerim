<div class="container">
    <table  class="table table-striped table-hover">
      <thead>
        <tr >
          <th >Nombre</th>
          <th >Representante</th>
          <th >Teléfono</th>
          <th >Email</th>
          <th >Dirección</th>
          <th >RFC</th>
          <th >Agregar muestra</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th colspan="6" class="ts-pager form-horizontal">
            <button type="button" class="btn btn-primary"><i class="mdi-av-skip-previous"></i></div></button>
            <button type="button" class="btn btn-primary"><i class="mdi-navigation-chevron-left"></i></button>
            <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
            <button type="button" class="btn btn-primary"><i class="mdi-navigation-chevron-right"></i></button>
            <button type="button" class="btn btn-primary"><i class="mdi-av-skip-next"></i></button>
            <select  title="Select page size">
              <option selected="selected"  value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
            </select>
            <select class="pagenum input-mini"  title="Select page number"></select>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach($clientes->result() as $row) { ?>
            <tr>
              <td>
                  <a href="<?php echo base_url();?>index.php/welcome/bio/<?php echo $row->id_cliente?>">&nbsp;<?php echo $row->nombre;?></a>
              </td>
              <td><?php echo $row->representante;?></td>
              <td><?php echo $row->telefono;?></td>
              <td><?php echo $row->email;?></td>
              <td><?php echo $row->direccion;?></td>
              <td><?php echo $row->RFC;?></td>
              <td>
                <a href="<?php echo base_url();?>index.php/welcome/nuevaMuestra/<?php echo $row->id_cliente?>">&nbsp;<i class="mdi-content-add-circle-outline"></i></a>
                <a href="<?php echo base_url();?>index.php/welcome/editarCliente/<?php echo $row->id_cliente?>">&nbsp;<i class="mdi-content-create"></i></a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
</div>
<div class="container">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
        <th>Nombre</th>
        <th>Tipo</th>
        <th >Fecha</th>
        <th>Hora</th>
        <th>Cliente</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <tbody>
      <?php 
      if($muestras)
      {
        foreach($muestras->result() as $row) { ?>
            <tr>
              <td>
                  <a href="<?php echo base_url();?>index.php?/Welcome/analisis/<?php echo $row->id_muestra?>">&nbsp;<?php echo $row->nombre;?></a>
              </td>
              <td><?php echo $row->tipo;?></td>
              <td><?php echo $row->fecha;?></td>
              <td><?php echo $row->hora;?></td>
              <td><?php echo $row->cliente;?></td>
              <td>
                <a href="<?php echo base_url();?>index.php/Welcome/posiblesAnalisis/<?php echo $row->id_muestra?>"  title="Agregar Analisis">&nbsp;<i class="mdi-content-add-circle-outline"></i></a>
                <a href="<?php echo base_url();?>index.php/Welcome/enviarEmail/<?php echo $row->id_muestra?>" >&nbsp;<i class="mdi-communication-email" title="Enviar e-mail"></i></a>
                <a href="<?php echo base_url();?>index.php/Welcome/mostrarPDF/<?php echo $row->id_muestra?>" target="_blank">&nbsp;<i class="mdi-action-description" title="Generar PDF"></i></a>
              </td>
            </tr>
          <?php }}?>
        </tbody>
        <tfoot>
        <tr>
          <th colspan="5" class="ts-pager form-horizontal">
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
        </table>
</div>
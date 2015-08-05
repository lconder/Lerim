<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url();?>index.php/welcome/clientes">Lerim</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url();?>index.php/welcome/nuevoCliente">Agregar Cliente</a></li>
            <li><a href="<?php echo base_url();?>index.php/welcome/muestras">Muestras</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:void(0)">Página</a></li>
            <li><a href="<?=base_url();?>index.php/Welcome/cerrarsesion">Cerrar Sesión</a></li>
           
        </ul>
    </div>
</div>
<div class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Lerim</a>
    </div>
    <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url();?>index.php/Welcome/Clientes">Clientes</a></li>
            <li><a href="<?php echo base_url();?>index.php/Welcome/muestras">Muestras</a></li>
            <li><a href="<?php echo base_url();?>index.php/Welcome/nuevoCliente">Agregar Cliente</a></li>

        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="https://login.secureserver.net/index.php" target="_blank">Correo</a></li>
            <li><a href="http://www.lerim.com.mx">Página</a></li>
            <li><a href="<?=base_url();?>index.php/Welcome/cerrarsesion">Cerrar Sesión</a></li>
           
        </ul>
    </div>
</div>
<h1>Bienvenido a Lerim</h1>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center ">Por favor, introduzca sus datos:</h1>
            <form class="form-horizontal" action="<?php echo base_url() ?>index.php?/Welcome/login" method="POST" >
    				<fieldset>
        			<div class="form-group">
	           			<label for="inputEmail" class="col-lg-2 control-label">Usuario</label>
	            		<div class="col-lg-10">
	                		<input type="text" class="form-control" name="User" id="User" placeholder="Usuario" required>
	            		</div>
        		</div>
		        <div class="form-group">
		            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
		            <div class="col-lg-10">
		                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required>
		                <button class="btn btn-primary" type="submit">
		                    Iniciar</button>
		        	</div>
		        </div>

             </form>
        </div>
    </div>
</div>



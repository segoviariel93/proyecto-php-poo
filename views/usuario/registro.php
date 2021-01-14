<h1>Registrarse</h1>


<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos (no se aceptan campos vacios)</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failedEmail'): ?>
	<strong class="alert_red">Registro de email fallido!</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'emailDuplicado'): ?>
	<strong class="alert_red">Registro fallido, el email ya existe</strong>
<?php endif; ?>


<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" />
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" />
	
	<label for="email">Email</label>
	<input  name="email" />
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" />
	
	<input type="submit" value="Registrarse" class="btn btn-outline-success btn-sm" />
</form>
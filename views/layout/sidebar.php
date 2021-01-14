<!-- BARRA LATERAL -->

<!-- Aqui se revisa si el usuario se logeo o deberia registrarse en el sistema con las varbles de sesion -->


<?php
require_once 'models/Model.php';
require_once 'models/categoria.php';
//En caso de registro extos borra las sesiones fallidas del usuario
if (isset($_SESSION['identity'])) {
	$_SESSION['error_login'] = null; //borra sesione sfalidas
	unset($_SESSION['error_login']);
}
?>

<aside id="lateral">
	<div id="login" class="block_aside">
		<?php if (!isset($_SESSION['identity'])) : ?>
			<h3>Entrar a la web</h3>
			<form action="<?= base_url ?>usuario/login" method="post">
				<label for="email">Email</label>
				<input type="email" name="email" />
				<label for="password">Contraseña</label>
				<input type="password" name="password" />
				<input type="submit" value="Enviar" class="btn btn-outline-success btn-sm" />
			</form>
		<?php else : ?>
			<h3><?php echo $_SESSION['identity']->nombre; ?> <?php echo $_SESSION['identity']->apellidos; ?></h3>
		<?php endif; ?>

		<!-- En esta parte de en funcion de si el usuario registrado es administrador o usuario normal se habilitan o desabilitan ciertas opciones -->
		<!-- para ello se revisa si la variable de sesion $_SESSION['admin'] existe -->
		<ul>
			<?php if (isset($_SESSION['identity'])) : ?>
				<?php if ($_SESSION['identity']->rol == "user") : ?>
					<?php
					$categoria = new Categoria();
					$categorias = $categoria->getAll();
					?>
					
						<div id="categoria" role="tablist" aria-multiselectable="true">
							<?php while ($categoria = $categorias->fetch_object()) : ?>
								<div class="card">
									<div class="card-header" role="tab" id="section1HeaderId">
										<h5 class="mb-0">
											<a  href="<?= base_url . 'entrada/listaPorCategoria/' . $categoria->id ?>">
												<?= $categoria->nombre  ?>
											</a>
										</h5>
									</div>									
								</div>
							<?php endwhile; ?>
						</div>


	
<?php endif; ?>
<?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) : ?>
	<li><a href="<?= base_url ?>categoria/index">Administrar Categorias (Admin)</a></li>
<?php endif; ?>
<li><a href="<?= base_url ?>usuario/logout">Cerrar Sesion</a></li>

<?php else : ?>
	<li><a href="<?= base_url ?>usuario/registro">Registrate aqui</a></li>
<?php endif; ?>
</ul>
</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">
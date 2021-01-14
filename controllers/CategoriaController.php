<?php
require_once 'models/categoria.php';


class categoriaController extends Controller
{

	public function index()
	{
		if (Utils::isIdentity()) { //revisa si esta logrado el user par amsotrar ono contenido
			$categoria = new Categoria();
			$categorias = $categoria->getAll();

			if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) { //for admins
				require_once "views/categoria/listado.php";
			} else {
				echo "importe y renderize una vista para hacer la accion seleccionada en el usuario ( no administrdor )";
			}
		}

		//require_once 'views/categoria/crear.php'; vista q debe ser renderizada en fincion de sis es ususrio o admin
	}

	public function ver()
	{
		if ($this->existGET(['id'])) {
			$id = $_GET['id'];

			// Conseguir categoria
			$categoria = new Categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();
		}

		require_once 'views/categoria/ver.php';
	}

	public function crear()
	{
		try {
			if (Utils::isAdmin()) {
				$categoria = new Categoria();
				require_once 'views/categoria/crear.php';
			} else {
				$this->redirect("categoria/index", ['error' => 'usted no tiene permisos de adminstrador.']);
			}
		} catch (Exception $ex) {
			error_log("categoriaController::crear => error:" . $ex);
		}
	}

	public function save()
	{
		try {
			if (Utils::isAdmin()) {
				if (isset($_POST) && isset($_POST['nombre'])) {
					// Guardar la categoria en bd
					$categoria = new Categoria();
					$categoria->setNombre($_POST['nombre']);
					$save = $categoria->save();
				}
				$this->redirect("categoria/index");
			} else {
				$this->redirect("categoria/index", ['error' => 'Usted no tiene los privilegios para registrar nuevas categorias']);
			}
		} catch (Exception $ex) {
			error_log("categoriaController::save => error" . $ex);
		}
	}
}

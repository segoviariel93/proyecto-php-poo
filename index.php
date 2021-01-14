
<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';
require_once 'models/Model.php';
require_once 'models/categoria.php';
require_once 'models/Entrada.php';


$app=new app();

require_once 'views/layout/footer.php';

?>

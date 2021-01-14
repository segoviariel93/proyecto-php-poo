<?php

function controllers_autoload($classname)
{
	echo '<script>';
	echo 'console.log(' . json_encode($classname) . ')';
	echo '</script>';
	if (file_exists('controllers/' . $classname . '.php')) {
		include 'controllers/' . $classname . '.php';
	}
}

spl_autoload_register('controllers_autoload');

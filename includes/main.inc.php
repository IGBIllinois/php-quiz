<?php

require_once "conf/app.inc.php";
require_once "conf/config.inc.php";
require_once 'vendor/autoload.php';

function class_autoload($class_name) {
    if(file_exists('libs/' . $class_name . '.class.inc.php'))
    {
        include 'libs/' . $class_name . '.class.inc.php';
    }


}
spl_autoload_register('class_autoload');


if (settings::get_debug()) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

}
try{
	$sqlDataBase = new PDO("mysql:host=". settings::get_mysql_host() . ";dbname=" . settings::get_mysql_database(),
		settings::get_mysql_user(),
		settings::get_mysql_password());
    
} catch(PDOException $e) {
	echo $e->getMessage();

}





?>

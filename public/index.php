<?php

header("Content-type: text/html;charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Expires: ".date("r",strtotime('-1 month')));
define('_ELBRUS_START', microtime(true));



/*ini_set('error_reporting', E_ALL);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);/**/



# Загрузка ядра
require_once(__DIR__ . '/../config/common.php');



# Переход в маршрутизатор
require_once(\registry::call()->get('FOLDER_ROOT') . 'app/router/_index.php');

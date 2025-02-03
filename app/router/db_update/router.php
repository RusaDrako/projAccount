<?php
/**
 * Обновление БД по конфигу
 */
namespace app\router\db_update;

use RusaDrako\db_update\DB;

echo '<pre>';

$config=require_once(\registry::call()->get('FOLDER_ROOT') . '/config/app_db.php');



foreach($config['db']?:[] as $k_db=>$v_db){
	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo "База данных: {$k_db} - {$v_db['connector']['name']}";
	echo PHP_EOL;
	echo '================================================================================';
	echo PHP_EOL;
	echo '================================================================================';
	echo '<br>';
	$dbConnector = \factory::getDB($v_db['connector']['name']);
	$dbUpdate=new DB( $v_db['connector']['db_name'], $v_db['tables'], $v_db['connector']['driver'], $dbConnector);

	$arr=$dbUpdate->updateDB();

	foreach($arr as $k_sql=>$v_sql){
		echo PHP_EOL;
		echo $k_sql;
		if(substr($k_sql, 0, 1)!='-'){
			try{
				$dbConnector->query($v_sql);
				echo " - готово";
			}catch(\ RusaDrako\driver_db\drivers\DriverDB $e){
				echo PHP_EOL;
				echo "\t{$e->getMessage()}";
			}catch(\Exception $e){
				echo PHP_EOL;
				echo "\t" . get_class($e) . " {$e->getMessage()}";
			}
		} else {
			echo PHP_EOL;
			echo "\t{$v_sql}";
		}
		echo PHP_EOL;
		echo '================================================================================';
	}
}

echo PHP_EOL;
echo PHP_EOL;
echo 'Готово';

exit;
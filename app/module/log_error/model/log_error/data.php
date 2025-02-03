<?php
namespace app\module\log_error\model\log_error;

/**
 */
class data extends \RD_Obj_Data {

	/** */
	protected function setting() {
		$this->table_name   = 'log_error';
	}

	/** Список активных заданий */
	public function getLastGroupList($limit = 20) {
		$sql = <<<SQL
SELECT max(id_log_error) AS ID
		, log_error_type AS TYPE
		, log_error_file AS FILE
		, log_error_line AS LINE
		, count(1) AS COUNT
		, max(log_error_create) AS CREATED
	FROM log_error
	GROUP BY log_error_file, log_error_line, log_error_type
	ORDER BY ID DESC
	LIMIT {$limit}
SQL;
//		$sql = $this->replace_alias($sql);
		$data = $this->obj_db->select($sql); //$this->query($sql);
		foreach($data as $k=>$v){
			echo $v['FILE'];
			$data[$k]['TITLE']=substr($v['FILE'], strlen(\registry::call()->get('FOLDER_ROOT')));
		}
		return $data;
	}
//'id_log_error'          => 'ID',          # ID записи
//	//			'user_id'               => 'USER_ID',     # ID пользователя
//'log_error_type'        => 'TYPE',        # Тип ошибки
//'log_error_message'     => 'MESSAGE',     # Сообщение об ошибках
//'log_error_file'        => 'FILE',        # Файл
//'log_error_line'        => 'LINE',        # Номер строки
//'log_error_request'     => 'REQUEST',     # Входящие данные
//	//			'log_error_backtrace'   => 'BACKTRACE',   # Бэктрайс
//'log_error_create'      => 'CREATED',     # Дата создания
	/** Список активных заданий */
	public function getLastList($limit = 20) {
		$sql = <<<SQL
SELECT :col: FROM :tab: ORDER BY :key: DESC LIMIT {$limit}
SQL;
		$data = $this->select($sql);
		return $data;
	}

/**/
}

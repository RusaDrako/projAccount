<?php
namespace app\model\account\account;

/**
 */
class data extends \RD_Obj_Data {

	/** */
	protected function setting() {
		$this->table_name='account';
	}

	/** */
	public function getByGUID($guid) {
		$sql = <<<SQL
SELECT :col: FROM :tab: WHERE guid = '{$guid}'
SQL;
		$data = $this->select($sql);
		$data = $data->first();
		return $data;
	}

/**/
}

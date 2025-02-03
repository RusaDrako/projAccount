<?php
namespace app\model\account\transaction;

/**
 */
class data extends \RD_Obj_Data {

	/** */
	protected function setting() {
		$this->table_name='transaction';
	}

	/** */
	public function getAccountBalance($account_id) {
		if(!$account_id){return 0;}
		$sql = <<<SQL
SELECT SUM(IF(is_receipt = 1, amount, -amount)) AS BALANCE FROM :tab:
WHERE account_id={$account_id} GROUP BY account_id
SQL;
		$data = $this->query($sql)[0]['BALANCE'];
		return $data;
	}

//	/** */
//	public function getAllOrderDatePlan($start, $finish) {
//		$sql = <<<SQL
//SELECT :col: FROM :tab: WHERE date > DATE_SUB(now(), INTERVAL {$days} DAY) ORDER BY date DESC, time_start ASC
//SQL;
//		$data = $this->select($sql);
//		return $data;
//	}

	/**/
}

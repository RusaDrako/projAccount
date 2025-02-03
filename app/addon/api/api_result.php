<?php
namespace app\addon\api;

use app\model\account\log_request\item;
use RusaDrako\api\Result;

/**  */
class api_result extends Result {

	/** */
	public function __destruct() {
		if($this->log_request){
			$this->log_request->save();
		}
	}

	/** @var item $log_request */
	protected $log_request=false;

	public function get_log_request() {
		if($this->log_request === false){
			/** @var item log_request */
			$this->log_request = \factory::getModel("account\log_request")->newItem();
			$this->log_request->setProp('REQUEST', json_encode(\request::call()->get_list()));
		}
		return $this->log_request;
	}

	public function result($data) {
		$result = parent::result($data);
		$log_request_item=$this->get_log_request();
		$log_request_item->setProp('RESPONSE', $result);;
		$log_request_item->setProp('TYPE', "OK");
		api_result::view_result($result);
	}

	public function error($num, $description) {
		$result = parent::error($num, $description);
		$log_request_item=$this->get_log_request();
		$log_request_item->setProp('RESPONSE', $result);;
		$log_request_item->setProp('TYPE', "ERROR");
		api_result::view_result($result);
	}


	protected static function view_result($result){
		header('Content-Type: application/json; charset=utf-8');
		echo $result;
		exit;
	}

/**/
}

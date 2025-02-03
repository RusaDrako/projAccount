<?php
namespace app\addon;

/** Расширение функционала шаблонизатора для проекта */
class view extends \Elbrus\Framework\view\view {

	//public static function template_name($name) {
	//	$name=substr($name, strlen(\registry::call()->get('FOLDER_ROOT')));
	//	$name=substr($name, 0, -4);
	//	return $name;
	//}
	//
	//public static function get_template_name_html_s() {
	//	$backtrace=debug_backtrace();
	//	$name=static::template_name($backtrace[0]['file']);
	//	return "<!-- start {$name} -->";
	//}
	//
	//public static function get_template_name_html_e() {
	//	$backtrace=debug_backtrace();
	//	$name=static::template_name($backtrace[0]['file']);
	//	return "<!-- end {$name} -->";
	//}

	public function page_error($text) {
		$this->variable('error_text',   $text);
		$this->page('_error/error');
		exit;
	}

	public function page($template, array $data=[]) {
		$this->display('default/header');
		foreach($data as $k=>$v){
			$this->variable($k, $v);
		}
		$this->display($template);
		$this->display('default/footer');
	}

/**/
}

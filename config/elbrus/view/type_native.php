<?php
namespace config\elbrus\view;

use RusaDrako\templater\Templater;


/**  */
class type_native extends \Elbrus\Framework\view\_abs\abs_adapter {

	/** Загружает настройки шаблонизатора */
	public function _setting() {
		$folder_root = \registry::call()->get('FOLDER_ROOT') . 'app/view/templater';

		# Активируем библиотеку
		$this->_obj_view_engine=new Templater();
		$this->_obj_view_engine->addRootFolder($folder_root);
		# Отображать названия шаблона
		$this->_obj_view_engine->setShowTemplateName(true);
		$this->_obj_view_engine->setErrorForUndefinedData(false);
	}


	/**
	 * @param array $folders ссылка к папке модуля
	 */
	public function addRootFolders(array $folders) {
		foreach($folders as $v){
			$this->_obj_view_engine->addRootFolder($v);
		}
	}

	/** Загружает переменную в шаблонизатор
	 * @param string $name Имя переменной в шаблонизаторе
	 * @param string|array|object $value Значение переменной
	 */
	public function variable($name, $value) {
		$this->_obj_view_engine->assign($name, $value);
	}


	/** Выводит указанный шаблон
	 * @param string $link Ссылка на файл шаблона
	 */
	public function block($link, array $data=[]) {
		$this->_obj_view_engine->display($this->_name_file($link), $data);
	}


	/** Возвращает html-код указанного шаблона
	 * @param string $link Ссылка на файл шаблона
	 */
	public function html($link, array $data=[]) {
		return $this->_obj_view_engine->render($this->_name_file($link), $data);
	}

/**/
}

<?php $this->templater->display('log_error/log_error_title'); ?>
<hr>
<pre>
<?php
//var_dump(is_object($this->list_obj), $this->list_obj);
if(is_object($this->list_obj)){
	$this->templater->display('log_error/list', ["list_obj"=>$this->list_obj]);
} else {
	$this->templater->display('log_error/list_arr', ["list_arr"=>$this->list_obj]);
}
?>

<style>
	.error_line{
		white-space: nowrap; /* Отменяем перенос текста */
		overflow: hidden; /* Обрезаем содержимое */
		padding: 5px; /* Поля */
		text-overflow: ellipsis; /* Многоточие */
	}
</style>

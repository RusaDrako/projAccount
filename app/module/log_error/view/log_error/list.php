<?php
foreach($this->list_obj ? $this->list_obj->iterator() : [] as $k=>$v){
	$key=$k+1;
	echo <<<HTML
<div class="error_line">
{$v->ID}. {$v->CREATED} ({$v->TYPE}) <a href="/log_error/item/{$v->ID}">{$v->TITLE}</a><br>
</div>
HTML;
}
?>
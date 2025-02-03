<?php
foreach($this->list_arr as $k=>$v){
	$key=$k+1;
	echo <<<HTML
<div class="error_line">
{$key}. ({$v['COUNT']}) {$v['CREATED']} ({$v['TYPE']}) <a href="/log_error/item/{$v['ID']}">{$v['TITLE']} ({$v['LINE']})</a><br>
</div>
HTML;
}
?>
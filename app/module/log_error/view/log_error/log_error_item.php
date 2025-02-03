<?php $this->templater->display('log_error/log_error_title'); ?>

<hr>

<?php $this->templater->display('log_error/item'); ?>

<div style="background: #ffdddd; padding: 10px; border: 1px solid #000;">
	Ошибка № <?= $this->item->ID; ?> от <?= $this->item->CREATED; ?>. Тип <?= $this->item->TYPE; ?>
	<hr>
	Место ошибки:
	<div style="white-space: nowrap; overflow: auto; padding: 10px; border: 1px solid #000;"><b><?= $this->item->FILE_SHORT; ?> (<?= $this->item->LINE; ?>)</b></div>
	<hr>
	Сообщение:
	<pre style="overflow: auto; padding: 10px; border: 1px solid #000;">
<?= $this->item->MESSAGE; ?>
	</pre>
	<hr>
	Запрос:
	<pre style="overflow: auto; padding: 10px; border: 1px solid #000;">
<?= $this->item->REQUEST; ?>
	</pre>
</div>

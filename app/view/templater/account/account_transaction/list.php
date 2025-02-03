<?php $this->templater->display('wallet/transaction/title'); ?>

<?php foreach($this->list_obj->iterator() as $k => $v){ ?>
	<? /*var_dump($v);*/ ?>
	<div class="row border-success border-bottom">
		<div class="col align-content-center">
			<span style="background-color: <?= $v->COLOR_CSS ?>; padding: 0 5px;"><?= $v->TITLE ?></span>
		</div>
		<div class="col-2 align-content-center text-end p-1">
			<a class="bg-primary icon icon-sm" href="/<?= $this->url_path_root ?>/transaction/edit/<?= $v->ID ?>"><i class="fa-solid fa-edit"></i></a>
		</div>
	</div>
<?php } ?>
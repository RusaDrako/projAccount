<h3><?= $this->title ?></h3>
<hr>
<table class="table">
<?php if($this->table_title && is_array($this->table_title) && isset($this->table[0])){ ?>
	<thead>
		<tr>
		<?php foreach($this->table[0] as $k=>$v){ ?>
			<th scope="col">
				<?= $this->table_title[$k]?:'---' ?>
			</th>
		<?php } ?>
		</tr>
	</thead>
<?php } ?>

<?php foreach($this->table as $k=>$v){ ?>
	<tr scope="row">
	<?php foreach($v as $v_2){ ?>
		<td>
			<?= $v_2 ?>
		</td>
	<?php } ?>
	</tr>
<?php } ?>
</table>

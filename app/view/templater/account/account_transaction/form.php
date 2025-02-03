<?php

use app\lib\template_form;

$form_name="transaction";

$this->templater->display('wallet/transaction/title');

//var_dump($this->input);
?>

<div class="row">
	<div class="col-10 col-md-8 col-lg-6 col-lx-4 offset-1 offset-md-2 offset-lg-3 offset-lx-4">
		<div class="bg-success-subtle p-2 py-2">
			<form method="post">
				<div class="row mb-2">
					<div class="col-12">
						Категория
					</div>
					<div class="col-12">
						<?= template_form::create_select(template_form::get_array_for_create_select($this->list_transaction_category, 'ID', 'TITLE'), 'transaction_category_id', $this->input['transaction_category_id'], $form_name) ?>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Дата
					</div>
					<div class="col-12">
						<?= template_form::create_input_date('date', $this->input['date'], $form_name) ?>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Сумма
					</div>
					<div class="col-12">
						<?= template_form::create_input_text('amount', $this->input['amount'], $form_name) ?>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Описание
					</div>
					<div class="col-12">
						<?= template_form::create_textarea('description', $this->input['description'], $form_name) ?>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-12">
						Поступление
						<?= template_form::create_input_checkbox('is_income', $this->input['is_income'], '', $form_name) ?>
					</div>
				</div>
				<?php if($this->err){ ?>
					<div class="row mb-2">
						<div class="col-12">
							<label>
								<br><pre style="color: #800;"><?php implode('<br>', $this->err) ?></pre>
							</label>
						</div>
					</div>
				<?php } ?>
				<button class="form-control bg-primary text-white" name="is_submit" value="1">Сохранить</button>
			</form>
		</div>
	</div>
</div>

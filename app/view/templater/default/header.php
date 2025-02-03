<html>
	<head>
		<title><?php echo \registry::call()->get('TITLE_PROJECT');?></title>
		<link rel="icon" type="image/png" href="/img/logo.png">

		<?php $this->templater->display('default/js_css'); ?>

	</head>
	<body class="">
		<div class="container-fluid fixed-top bg-success bg-opacity-75 p-1">
			<div class="container">
				<div class="row menu_top">
					<div class="col-2 col-md-1 text-center align-content-center p-0">
						<a href="/"><img src="/img/logo.png" class="" style="max-height: 50px;"></a>
					</div>
					<div class="col align-content-center">
						<?php $this->templater->display('default/menu_top'); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="py-3"></div>
		<div class="container p-3 mt-5 mb-3 bg-success-subtle border border-dark rounded-2">

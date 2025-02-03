<html>
	<head>
		<title><?php echo \registry::call()->get('TITLE_PROJECT');?></title>
		<link rel="icon" type="image/png" href="/img/logo.png">

		<?php $this->templater->display('default/js_css'); ?>

	</head>
	<body class="welcome p-6">
		<div class="container text-center welcome pt-5">
			<div class="row justify-content-center pt-5">
				<div class="col-10 col-md-8 col-lg-6 col-xl-5 bg-success-subtle border border-1 border-dark rounded-4 p-3 mt-lg-5" style="position: relative;">
					<div class="flag_rf border border-dark"></div>
					<a href="/index"><img src="/img/logo.png" style="max-height: 150px;"></a>
					<h1><?php echo \registry::call()->get('TITLE_PROJECT');?></h1>
					<div class="row">
						<div class="col-8 offset-2">
							<a href="/index" class="d-block bg-primary border border-dark rounded-2 text-white text-decoration-none p-3 mt-3" style="font-size: 30px;">
								<i class="fa-regular fa-right-to-bracket"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>It's Store Time Bitches!</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	 
	<script type="text/javascript" src="<?= base_url(); ?>assets/javascript/libs/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="<?= base_url(); ?>assets/javascript/libs/jquery.mobile-1.0.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>assets/css/libs/jquery.mobile-1.0.css" />

	<script type="text/javascript" src="<?= base_url(); ?>assets/javascript/app.js"></script>
</head>
<body>

<div data-role="page">
	<div data-role="header">
		<h1>It's Store Time Bitches!</h1>
	</div>
	
	<div data-role="header" class="ui-bar-b">
		<h2>Store History</h2>
	</div>

	<div data-role="content">
		<ul data-role="listview">
			<?php foreach ($history as $user): ?>
			<li>
				<a data-ajax="false">
					<?= $user->firstName; ?>
					<span class="ui-li-count"><?= date('n/j/Y g:i a', strtotime($user->date)); ?></span>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

</body>
</html>

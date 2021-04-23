<!doctype HTML>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
		
	</head>
	<body>
		<?php if (is_user_logged_in()): ?>
		<div class="container">
			
		<form action="" method="POST">
			<input type="submit" value="Logout" name="logout" class="btn" />
			
		</form>
			<?php if (user_is_ubermaster()): ?>
			<span>Welcome back, oh grand ubermaster, you have been missed</span>
			<?php endif;?>
			</div>
		<?php endif;?>
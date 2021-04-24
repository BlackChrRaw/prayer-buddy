<!doctype HTML>
<html>
	<head>
		<title><?php echo $title?></title>
		
		<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" />
		
<script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
		<script src="https://kit.fontawesome.com/49cb223047.js" crossorigin="anonymous"></script>
			  
			  
<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>
	<body>
		<?php if (is_user_logged_in()): ?>
		
			<div class="container">
			<div class="navbar">
			<div class="col col-9">
				<a href='/' id="logo" class="navbar-brand"><img src='img/logo.jpg' /></a>
			</div>
		<form action="" method="POST">
			<input type="submit" value="Logout" name="logout" class="btn navbar-link" />
			
		</form>
				</div>
			<style>
				#logo img{height: 100px}
				
			</style>
			<?php if (user_is_ubermaster()): ?>
			<div class="card">
				<span class="card-body">Welcome back, oh grand ubermaster, you have been missed</span>
			</div>
			<?php endif;?>
			</div>
		<?php endif;?>
<?php require VIEW_PATH. DIRECTORY_SEPARATOR. "header.php";?>


<section class="container text-center align-middle">
	
		<div class="card  ">
			
			<form class="card-body" action="" method="post">
				<h1 class="card-title">Prayer Login</h1>
				<?php if (!empty($errors)):?>
				<div class="error">
					<?php echo $errors[0]?>
				</div>
				<?php endif; ?>
				<input type="text" id="login" class="form-control" name="login" placeholder="login" value="<?php echo $login ?>">
      <input type="password" id="password" class="form-control" name="password" placeholder="password">
      <input type="submit" class="form-control" value="Log In">
    </form>
			</div>
</section>


<?php require VIEW_PATH. DIRECTORY_SEPARATOR. "footer.php";?>
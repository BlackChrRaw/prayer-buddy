<?php require VIEW_PATH. DIRECTORY_SEPARATOR. "header.php";?>

<section class="container align-middle">
	
		<div class="card ">
			
			<form class="card-body" action="" method="post">
				<h1 class="card-title">Create a new password</h1>
				<p>Preconditions:</p>
				<ul>
				<li>8 characters length</li>
				<li>2 letters in Upper Case</li>
				<li>1 Special Character <code>(!@#$&amp;*)</code></li>
				<li>2 numerals <code>(0-9)</code></li>
				<li>3 letters in Lower Case</li>
				</ul>
				<?php if (!empty($errors)):?>
				<div class="error">
					<?php echo $errors[0]?>
				</div>
				<?php endif; ?>
				<div class="input-group">
				<input type="password" id="new-password" class="form-control" name="password" placeholder="password" autocomplete="new-password">
				<div class="input-group-append">
					<input type="button" name="show_password" class="input-group-text btn" id="show_password" value="Show" />
				</div>
				</div>
				<input type="submit" class="form-control" value="Create!" id="submit">
				<script type="text/javascript">
				$('#show_password').click(function(){
					$('#new-password').attr('type', function (index, attr){
						return attr == 'password'? 'text' : 'password';
					});
					var val = $(this).val()
					if (val == 'Show')
					{
						$(this).val('Hide');
					} else {
						$(this).val('Show');
					}
					
					
				});
				$('#submit').click(function (){
					$('#new-password').attr('type', 'password');
				})
				</script>
					
			</form>
		</div>
</section>


<?php require VIEW_PATH. DIRECTORY_SEPARATOR. "footer.php";?>
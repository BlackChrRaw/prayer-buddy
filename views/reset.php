

			  
			  <style>
				  #toggle_prayer_table {margin: 5px 0}
				  .card {margin-bottom: 1em}
			  </style>
<div class="container">
	
	<div class="card">
		
		<div class="card-body">
		<span class="card-title">
			<form action="" method="post">
				<input type="submit" name="reset-buddies" value="Reset buddies" class="btn btn-secondary" />
				
			</form>
			
		</span>
		<input type="button" id="toggle_prayer_table" value="Show buddy table" class="btn btn-secondary" />
			
		</div>
		
	</div>
	
	<div class="card w-50"  id="prayer_table" style="display: none;">
	<table class="table" >
		<tr><th>Bidder:</th><th>Bidt voor:</th></tr>
	<?php foreach($users as $user):?>
		<tr><td><?php echo $user->name?></td><td><?php echo \Users\Users::getUserById($user->prayer_id)->name ?></td></tr>
	<?php endforeach; ?>
		</table>
	</div>
	<script>
	$("#toggle_prayer_table").click(function (){
		
		$("#prayer_table").slideToggle();
	});
	</script>
</div>
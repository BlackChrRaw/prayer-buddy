
<div class="container">
<div class="card">
	<div class="card-body">
		
			<h2>Your prayer requests</h2>
			
			
				<div class="input-group request proto" >
					<textarea class="form-control" name="requests[]" placeholder="Fill your request"></textarea>
					
					<div class="btn btn-primary input-group-append remove_request">
						<i class="far fa-trash-alt"></i>
					</div>
				</div>
			<form action="" method="post" id="user-requests-form">
			<div class="my_prayer_requests">
			<?php foreach ($requests as $request):?>
				<div class="input-group request " >
					
					<textarea class="form-control" name="requests[]"><?php echo $request->content?></textarea>
					<div class="btn btn-primary remove_request">
						<i class="far fa-trash-alt"></i>
					</div>
					<!--<input type="button" name="remove_request" class="btn btn-primary input-group-append remove_request" value="-" />-->
				</div>
				<?php endforeach;?>
			
			</div>
				<div class="btn btn-primary" id='add_request'>
					<i class="fas fa-plus "></i>
				</div>
			
				<div class='btn btn-primary float-right' id="submit-requests">
					<i class="far fa-save"></i>
					
				</div>
			<input type="hidden" name="submit-requests" value="Save" class="" />
			
		</form>
		
		<style>
			.request.proto {display: none;}
			.request { margin-bottom: 1em}
			#add_request {margin-bottom: 1em}
			.remove_request {padding-top:1.2em; margin-left: 5px}
		</style>
		<script>
		 $('.remove_request').click(function (){
			 $(this).parent().remove();
		 });
		 
		 $('#add_request').click(function (){
			 var newRow = $('.request.proto').clone(true);
			 $(newRow).removeClass('proto')
			 $(newRow).appendTo('.my_prayer_requests')
		 });
		 $('#submit-requests').click(function(){
			 $('#user-requests-form').submit();
		 })
		</script>
	</div>
</div>
	</div>
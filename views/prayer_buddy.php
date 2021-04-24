<div class="container">
	
	<div class="card">
		
		<div class="card-body">
		<span class="card-title">
			<p class="card-text">Your prayer buddy</p>
			<p class="card-text"><strong><?php echo \Users\Users::getUser()->buddy()->name ?></strong></p>
			<p>Your buddy's prayer requests:</p>
			<?php if (empty($requests)):?>
			<p>None yet. Pray anyway ;)</p>
			<?php else:?>
			<ul>
			<?php foreach ($requests as $request):?>
				<li><?php echo $request->content?></li>
			<?php endforeach;?>
			</ul>
			<?php endif;?>
		</span>
		
		</div>
	</div>
	
</div>
<?php foreach($users as $user): ?>
	<article>
		<? #TODO: No hard paths ?>
		<?=$this->html->link($user->username,'/users/view/'.$user->_id) ?>
	</article>
<?php endforeach; ?>
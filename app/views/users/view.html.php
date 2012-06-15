<h2><?=$user->username; ?></h2>
<h2><?=$user->fullname; ?></h2>
<a href="<?=$user->website; ?>" target="_blank"><?=$user->username; ?></a>
<?php
	/*Data Dump*/
	echo '<pre>';
	print_r($user->data());
	echo '</pre>';
?>

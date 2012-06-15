<h2><?=$user->username; ?></h2>
<a href="<?=$user->website; ?>" target="_blank"><?=$user->fullname; ?></a>
<?php
	/*Data Dump*/
	echo '<pre>';
	print_r($user->data());
	echo '</pre>';
?>

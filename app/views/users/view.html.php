<h2><?=$user->username; ?></h2>
<a href="<?=$user->website; ?>" target="_blank"><?=$user->full_name; ?></a>
<?php
	/*Data Dump*/
	echo '<pre>';
	print_r($user->data());
	echo '</pre>';
?>

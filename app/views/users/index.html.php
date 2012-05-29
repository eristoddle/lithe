<?php foreach($users as $user){ ?>
    <div><a href="<?=$user->website ?>" target="_blank"><?=$user->username ?></a></div>
<?php } ?>
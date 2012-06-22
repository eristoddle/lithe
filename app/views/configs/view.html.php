<?php if (!count($configs)): ?>
    <?php foreach($configs as $config): ?>
        <p>
            <?=$config->name; ?> : <?=$config->value; ?>
        </p>
    <?php endforeach; ?>
<?php endif; ?>
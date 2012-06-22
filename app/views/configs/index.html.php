<?php foreach($configs as $config): ?>
    <p>
        <strong>Name:</strong><?=$config['name']; ?><br/>
        <strong>Value:</strong><?=$config['value']; ?><br/>
        <?=$this->html->link('Edit Value','/configs/edit/'.$config['name'], array('class'=>'btn btn-primary')) ?>
    </p>
<?php endforeach; ?>
<?=$this->html->link('Add Value','/configs/add/', array('class'=>'btn btn-primary')) ?>
<?
use \lithium\core\Environment;
?>
<div id="recent-posts-widget">
    <ul>
        <?php foreach (Environment::get('locales') as $locale => $name):
                $url = compact('locale') + $this->_request->params;
        ?>
            <li><?=$this->Html->link($name, $url); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<div id="tags-widget">
    <ul>
        <?php foreach (Environment::get('locales') as $locale => $name):
                $url = compact('locale') + $this->_request->params;
        ?>
            <li><?=$this->Html->link($name, $url); ?></li>
        <?php endforeach; ?>
    </ul>
</div>
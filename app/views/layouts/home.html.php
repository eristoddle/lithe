<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2012, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?=$this->html->charset()?>
	<title><?=$this->title()?></title>
	<?=$this->html->style(array('bootstrap.min','bootstrap-responsive.min','app')); ?>
	<?=$this->html->script('head.js')?>
	<?=$this->scripts()?>
	<?=$this->html->link('Icon', null, array('type' => 'icon'))?>
	<?= $this->html->link('RSS-Feed', '/posts.rss', array('type' => 'rss')); ?>
</head>
<body class="app">
<?=$this->_render('element', 'navbar')?>
	<div class="container-fluid">
		<header id="header">
			<?=$this->_render('element', 'header')?>
		</header>
		<div class="row-fluid">
			<div class="span3">
				<?=$this->_render('element', 'sidebar')?>
			</div>
			<div class="span9">
				<div id="content">
					<?//$this->sessionMessage->renderAll()?>
					<?=$this->content()?>
				</div>
			</div>
		</div>
		<footer id="footer">
			<?=$this->_render('element', 'footer')?>
		</footer>
	</div>
	<script type="text/javascript" charset="utf-8">
		head.js(
			"<?=$this->url('/js/jquery.min.js')?>",
			"<?=$this->url('/js/icanhaz.min.js')?>",
			"<?=$this->url('/js/bootstrap.min.js')?>",
			"<?//=$this->url('/js/app.js')?>",
			function() {
				ich.grabTemplates(); //make sure, icanhaz bootstraps correctly.
			}
		);
	</script>
</body>
</html>
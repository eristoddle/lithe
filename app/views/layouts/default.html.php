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
	<div class="container">
		<header id="header">
			<?=$this->_render('element', 'header')?>
		</header>
		<div id="content">
		<?php
			$session_flash_message = $this->session->message();
			if ($session_flash_message) { ?>
				<div class="alert alert-info">
					<?=$session_flash_message ?>
				</div>
		<?
			}
		?>
			<?=$this->content()?>
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
				ich.grabTemplates();
			}
		);
	</script>
</body>
</html>
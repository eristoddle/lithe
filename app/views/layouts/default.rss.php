<?php #TODO Replace body with a teaser and id with a slug ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
<rss version="2.0">
	<channel>
		<title>lithe blog</title>
		<description>A test blog using lithium</description>
		<link>http://lithe.dir23.com/</link>
		<lastBuildDate><?= date('D, d M Y g:i:s O'); ?></lastBuildDate>
		<pubDate><?= date('D, d M Y g:i:s O'); ?></pubDate>
		<?= $this->content(); ?>
	</channel>
</rss>
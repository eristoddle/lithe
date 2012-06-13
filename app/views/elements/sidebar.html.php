<div class="well sidebar-nav">
	<ul class="nav nav-list">
		<li class="nav-header">Recent Posts</li>
		<?=$this->PostWidget->recentPostsWidget();?>
		<li class="nav-header">Tags</li>
		<div class="btn-group">
			<?=$this->TagCloud->cloud();?>
		</div>
		</ul>
</div>
<?php
if ( !defined('ROOT_DIR') )
	exit;
?>
<div id="right-sidebar">
	<div id="right-sidebar-content">
		<div id="admin-session-info">
			<p>Welcome Administrator<br />
			<a href="<?php echo SITEURL; ?>" title="View Site" target="_blank">View Site</a> | <a href="logout.php" title="Sign Out">Sign Out</a></p>
		</div>
		
		<ul id="navigation">
			<li><a href="home.php" class="navigation-parent<?php echo navPosition(getCurrentFilename(), 'home.php'); ?> no-submenu">Dashboard</a></li>
			<li>
				<a href="#" class="navigation-parent<?php echo navPosition(getCurrentFilename(), 'files.php'); ?>">Files</a>
				<ul>
					<li><a<?php echo navPosition(getCurrentFilename(), 'files.php', 'add'); ?> href="files.php?action=add">New File </a></li>
					<li><a<?php echo navPosition(getCurrentFilename(), 'files.php', 'manage'); ?> href="files.php?action=manage">Manage File</a></li>
				</ul>
			</li>
			<li><a href="#" class="navigation-parent<?php echo navPosition(getCurrentFilename(), 'articles.php'); ?>">Articles</a>
				<ul>
					<li><a<?php echo navPosition(getCurrentFilename(), 'articles.php', 'add'); ?> href="articles.php?action=add">New Article</a></li>
					<li><a<?php echo navPosition(getCurrentFilename(), 'articles.php', 'manage'); ?> href="articles.php?action=manage">Manage Articles</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="navigation-parent<?php echo navPosition(getCurrentFilename(), 'categories.php'); ?>">Categories</a>
				<ul>
					<li><a<?php echo navPosition(getCurrentFilename(), 'categories.php', 'add'); ?> href="categories.php?action=add">Create New Category</a></li>
					<li><a<?php echo navPosition(getCurrentFilename(), 'categories.php', 'manage'); ?> href="categories.php?action=manage">Manage Category</a></li>
				</ul>
			</li>
			<li>
				<a href="#" class="navigation-parent<?php echo navPosition(getCurrentFilename(), 'mimetypes.php'); ?>">Mime Types</a>
				<ul>
					<li><a<?php echo navPosition(getCurrentFilename(), 'mimetypes.php', 'add'); ?> href="mimetypes.php?action=add">Create New Mime Types Icon</a></li>
					<li><a<?php echo navPosition(getCurrentFilename(), 'mimetypes.php', 'manage'); ?> href="mimetypes.php?action=manage">Manage Mime Types Icon</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<?php
require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" version="-//W3C//DTD XHTML 1.1//EN" xml:lang="en">
<!--
 ____________________________________________________________
|                                                            |
|    DITATOMPEL PERSONAL SITE v3.0                           |
|    2nd-heartbeat - The Desktop Env                         |
|    Published on Oct, 12 2011                               |
|    Copyleft 2009 - 2011, DitatompeL Some Rights Reserved   |
|____________________________________________________________|

-->
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<title><?php echo SITENAME; ?></title>
	<meta name="revisit-after" content="2 days" />
	<link rel="shortcut icon" href="images/favicon.png" />
	<link href="themes/default.css" rel="stylesheet" type="text/css"/>
	<link href="themes/mac_os_x.css" rel="stylesheet" type="text/css"/>
	<link href="css/ditatompel-v3.css" rel="stylesheet" type="text/css"/>
	<link href="css/player.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="jslib/prototype.js"> </script>
	<script type="text/javascript" src="jslib/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="jslib/jquery.jplayer.min.js" ></script>
	<script type="text/javascript" src="jslib/jquery.backstretch.min.js"> </script>
	<script type="text/javascript" src="jslib/effects.js"> </script>
	<script type="text/javascript" src="jslib/window.js"> </script>
	<script type="text/javascript" src="jslib/window_effects.js"> </script>
	<script type="text/javascript" src="jslib/ditatompel.js"> </script>
</head>

<body>
<script type="text/javascript">
	function dita(o, k){
		sonia = new Window({
			className: "mac_os_x",
			title: o,
			width:700,
			height:300,
			url: k, 
			hideEffectOptions: {duration:0.5}
		});
		sonia.show();
	}
	stringtools = new Window('String-Tool-Conversions', {
		className: "mac_os_x",
		title: "String Tool Conversions 1.01",
		width:840,
		height:450,
		url: "http://go.webdatasolusindo.co.id/stringtools/",
		hideEffect: Effect.SwitchOff
	});
	
	<?php
	$queryJSFileCategories = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " WHERE category_show = 'Y' ORDER BY category_id ASC");
	while ( $resultJSFileCategories = mysql_fetch_array($queryJSFileCategories) ) {
	?>
	dolphin_to_article_id_<?php echo $resultJSFileCategories['category_id']; ?> = new Window('<?php echo $resultJSFileCategories['category_title']; ?>', {
		className: "mac_os_x",
		title: "<?php echo $resultJSFileCategories['category_title']; ?>",
		width:600,
		height:300,
		hideEffectOptions: {duration:0.3},
		showEffectOptions: {duration:0.5}
	});
	dolphin_to_article_id_<?php echo $resultJSFileCategories['category_id']; ?>.getContent().innerHTML =
		"<div class=\"dolphin_list dol-large\"><ul class=\"clear\">" +
		<?php
		$queryJSFile = mysql_query("SELECT file_id, file_title, file_url, mimetype_id FROM " .  $dbtable['files'] . " WHERE category_id = '" . $resultJSFileCategories['category_id'] . "' ORDER BY file_id DESC");
		while ($resultJSFile = mysql_fetch_array($queryJSFile) ) {
			$fileIcon = mimeTypeInfo($resultJSFile['mimetype_id']);
		?>
		"<li><a<?php echo windowLink($resultJSFile['file_url'], $resultJSFile['file_title']); ?> title=\"<?php echo $resultJSFile['file_title']; ?>\"><img src=\"images/mimetypes/<?php echo $fileIcon['link']; ?>\" alt=\"\" class=\"thumb\" /></a><span class=\"title\"><span class=\"wrap\"><?php echo $resultJSFile['file_title']; ?></span></span></li>" +
		<?php
		}
		?>
		"</ul>"+"</div>";
	<?php
	
	} // end while
	?>
	
	dolphin_to_articles_uncategories = new Window('Uncategories File', {
		className: "mac_os_x",
		title: "Uncategories File",
		width:600,
		height:300,
		top:40,
		left:200,
		hideEffectOptions: {duration:0.3},
		showEffectOptions: {duration:0.5}
	});
	
	dolphin_to_articles_uncategories.getContent().innerHTML =
	"<div class=\"dolphin_list dol-large\"><ul class=\"clear\">" +
	<?php
	$queryJSUncategories = mysql_query("SELECT file_id, file_title, file_url, mimetype_id FROM " . $dbtable['files'] . " WHERE category_id = '0' ORDER BY file_id DESC");
	while ($resultJSUncategories = mysql_fetch_array($queryJSUncategories) ) {
		$fileIconUncategories = mimeTypeInfo($resultJSUncategories['mimetype_id']);
	?>
	"<li><a<?php echo windowLink($resultJSUncategories['file_url'], $resultJSUncategories['file_title']); ?> title=\"<?php echo $resultJSUncategories['file_title']; ?>\"><img src=\"images/mimetypes/<?php echo $fileIconUncategories['link']; ?>\" alt=\"\" class=\"thumb\" /></a><span class=\"title\"><span class=\"wrap\"><?php echo $resultJSUncategories['file_title']; ?></span></span></li>" +
	<?php
	}
	?>
	"</ul>"+"</div>";
	
	stringtools.showCenter();
</script>

<!-- let's the show begin -->

<!-- top navigation begin -->
<div id="ditatompel_dock"> 
	<div id="ditatompel_logo"><img src="images/favicon.png" class="menu_class" /></div>
	<div id="ditatompel_top_main_menu">
		<ul id="ditatompel_inline_top_menu">
			<li><a href="#">About</a>
				<ul>
					<li><a href="#" onClick="dita('The Meaning of Being Hacker', 'archives/README.html');">Internal iFrame Example</a></li>
					<li><a href="#" onClick="dita('This is window title', 'http://ls-la.ditatompel.crayoncreative.net/papers/how-to-xxxx-someone-with-your-bare-hands.txt');">External iFrame Example</a></li>
					<li><a href="#">Hover Me!</a>
						<ul>
							<li><a href="#" onClick="dita('This is window title', 'archives/page-example.html');">3rd Dropdown Menu</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li><a href="#" onClick="">Files</a>
				<ul>
					<?php
					$queryFileCategories = mysql_query("SELECT category_id, category_title FROM " . $dbtable['categories'] . " WHERE category_show = 'Y' ORDER BY category_id ASC");
					while ( $resultFileCategories = mysql_fetch_array($queryFileCategories) ) {
					?>
					<li><a href="#" onClick="dolphin_to_article_id_<?php echo $resultFileCategories['category_id']; ?>.show();"><?php echo $resultFileCategories['category_title']; ?></a></li>
					<?php
					}
					?>
					<li><a href="#" onClick="dolphin_to_articles_uncategories.show();">Uncategories</a></li>
				</ul>
			</li>
			<li><a href="#" id="help">Help</a>
				<ul>
					<li><a href="#" onClick="dita('Credits', 'README.html');">Credits</a></li>
				</ul>
			</li>
		</ul>
		<div id="dock_right"><a href="#" id="music-player">Music Player</a></div>
	</div>
</div>
<!-- top navigation end -->

<div id="ditatompel_dock_bottom"></div> <!-- dock on bottom area -->

<!-- start menu begin -->
<ul class="the_menu">
	<li><a href="#" onClick="stringtools.show();" class="ditatompel_startmenu_item_stringtools">String Tool Conversions 1.01</a></li>
	<li><a href="#" onClick="ditatompelVirtualConsole();" class="ditatompel_startmenu_item_terminal">Konsole</a></li>
</ul>
<!-- start menu end -->

<!-- music player -->
<div id = "music-player-action">
	<div id="jquery_jplayer_2" class="jp-jplayer"></div>
	<div class="jp-audio">
		<div class="jp-type-playlist">
			<div id="jp_interface_2" class="jp-interface">
				<ul class="jp-controls">
					<li><a href="#" class="jp-play" tabindex="1">play</a></li>
					<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
					<li><a href="#" class="jp-stop" tabindex="1">stop</a></li>
					<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
					<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
					<li><a href="#" class="jp-previous" tabindex="1">previous</a></li>
					<li><a href="#" class="jp-next" tabindex="1">next</a></li>
				</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>

				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
				<div class="jp-current-time"></div>
				<div class="jp-duration"></div>
			</div>
			<div id="jp_playlist_2" class="jp-playlist">
				<ul>
					<li></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- music player end -->

</body>
</html>
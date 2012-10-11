<?php
require_once('config.php');
if ( isset($_GET['id']) && !empty($_GET['id']) ) {
	$query = mysql_query("SELECT article_id, article_title, article_content, article_created_on, article_last_update FROM " . $dbtable['articles'] . " WHERE article_id = '" . cleanSQL($_GET['id']) . "'");
	if ( mysql_num_rows ($query) == 1 ) {
		$result = mysql_fetch_array($query);
		?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $result['article_title']; ?> - DitatompeL Personal Site</title>
	<meta name="robots" content="index, nofollow">
	<style type="text/css">
	body {
		margin:5px 5%;
		padding:0;
		font-family: Tahoma, Arial, sans-serif;
		font-size: 12px;
		min-width:320px;
	}
	p.eof {
		font-family:Courier,Monospace;
		text-align:center;
		min-width:320px;
	}
	div.footer {
		font-family:Courier,Monospace;
		padding:10px 0;
		font-size: 10px;
	}
	pre.footer a {
		text-decoration:none;
	}
	</style>
</head>
<body>
<?php echo textAreaReturn($result['article_content']); ?>
<p class="eof"> ---------- EOF ---------- </p>
<div class="footer">
# [ <?php echo $result['article_title']; ?> - DitatompeL Personal Site ] <br />
# <a href="<?php echo SITEURL . 'articles.php?id=' . $result['article_id']; ?>"><?php echo SITEURL . 'articles.php?id=' . $result['article_id']; ?></a><br />
# Published on : <?php echo tanggalIndo($result['article_created_on']); ?><br />
# Last Update : <?php echo tanggalIndo($result['article_last_update']); ?>
</div>
</body>
</html>
		<?php
	}
}
?>


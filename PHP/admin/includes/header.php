<?php
session_start();
if ( !defined('ROOT_DIR') )
	exit;
if ( !isAdmin() ) {
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/wysiwyg.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>
<body> 

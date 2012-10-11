<?php
session_start();
require_once('../config.php');
if ( isAdmin() ) {
	// jika cookie admin valid, redirect ke halaman home.php
	header("Location: home.php");
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
	<script type="text/javascript" src="js/main.js"></script>
</head>

<body id="login">
<div id="login-title"><h1>Admin Area</h1></div>
<div id="login-content">
	<form id="loginForm">
		<div id="loginNotif"></div>
		<p>
			<label for="username">Username :</label>
			<input class="text-input" id="username" name="username" type="text" />
		</p>
		<div class="clear"></div>
		<p>
			<label for="password">Password :</label>
			<input class="text-input" id="password" name="password" type="password" />
		</p>
		<div class="clear"></div>
		<p><input id="loginButton" class="button" type="submit" value="Login" /></p>
	</form>
</div>
</body>
</html>
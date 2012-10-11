<?php
session_start();
require ('../config.php');
$message = NULL;
if ( isset($_POST['username']) && isset($_POST['password']) ) {
	if ( empty($_POST['username']) || empty($_POST['password']) )
		$message = '<div class="notification attention"><span>Username / Password is empty!</span></div>';
	else {
		if ( $_POST['username'] == $username && md5($_POST['password']) == $password ) {
			setcookie(md5($_POST['username'] . SITENAME), $password);
			$message = '<div class="notification success"><span>Login success, please wait...<script language="javascript">window.location.replace("home.php");</script></span></div>';
		}
		else
			$message = '<div class="notification error"><span>Wrong Username / Password!</span></div>';
	}
	echo $message;
}
?>
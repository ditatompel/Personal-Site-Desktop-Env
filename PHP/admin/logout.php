<?php
require_once('../config.php');
setcookie(md5($username . SITENAME), '', time() - 1036800);
header("Location: index.php");
exit;
?>

<?php
@session_start();

require_once('./db_connect.php');
$username = "vokzal_user_1";
$password = "vokzal_user_1_p4ssw0rd";

$login = $_GET['login'];
$pass = md5($_GET['password']);

@$dbhandle = mysql_connect($hostname, $username, $password) or die('0');
@$selected = mysql_select_db($database, $dbhandle) or die('0');
@$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$pass'", $dbhandle) or die('0');

@$a = mysql_fetch_array($result);
if ($a['login']) {
	$_SESSION['logged'] = true;
	$_SESSION['login'] = $a['login'];
	echo 1;
} else {
	$_SESSION['logged'] = false;
	echo 0;
}

?>
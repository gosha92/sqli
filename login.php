<?php
@session_start();
require_once('./db_connect.php');

$login = $_GET['login'];
$pass = md5($_GET['password']);

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");
$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$pass'", $dbhandle) or die("MySQL error.");

$a = mysql_fetch_array($result);
if ($a[0]) {
	$_SESSION['logged'] = true;
	$_SESSION['login'] = $a[0];
	echo $a[0];
} else {
	$_SESSION['logged'] = false;
	echo 0;
}

?>
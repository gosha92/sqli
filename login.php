<?php
@session_start();

$login = $_GET['login'];
$pass = md5($_GET['password']);

/* */
$database = "vokzal";
$username = "root";
$password = "";
$hostname = "localhost";
/* */

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");
$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT * FROM users WHERE login='$login' AND password='$pass'", $dbhandle) or die("MySQL error.");

if(mysql_fetch_object($result)) {
	$_SESSION['logged'] = true;
	echo 1;
} else {
	$_SESSION['logged'] = false;
	echo 0;
}

?>
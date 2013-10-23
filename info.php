<?php
@session_start();
if (!$_SESSION['logged']) header('Location: ./index.php');
require_once('./db_connect.php');

$number = mysql_real_escape_string($_GET['number']);
$secret = mysql_real_escape_string($_GET['secret']);

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");
$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT * FROM trains WHERE num='$number' AND secret='$secret'", $dbhandle) or die(mysql_error($dbhandle));
if(!mysql_fetch_array($result))
	die('Несуществующий номер, или неверно указан секретный код.');
$result = mysql_query("SELECT * FROM additional WHERE secret='$secret'", $dbhandle) or die(mysql_error($dbhandle));
$a = mysql_fetch_array($result);

echo '<p>Машинист: '.$a[1].'</p>';
echo '<p>Количество вагонов: '.$a[2].'</p>';
echo '<p>Время в пути: '.$a[3].'</p>';

?>
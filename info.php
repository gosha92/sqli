<?php
@session_start();
if (!$_SESSION['logged']) header('Location: ./index.php');

require_once('./db_connect.php');
$username = "vokzal_user_3";
$password = "vokzal_user_3_p4ssw0rd";

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");

$number = mysql_real_escape_string($_GET['number']);
$secret = mysql_real_escape_string($_GET['secret']);

$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT * FROM trains WHERE num='$number' AND secret='$secret'", $dbhandle) or die(mysql_error($dbhandle));
if(!mysql_fetch_array($result))
	die('Несуществующий номер, или неверно указан секретный код.');
$result = mysql_query("SELECT * FROM additional WHERE secret='$secret'", $dbhandle) or die(mysql_error($dbhandle));
$a = mysql_fetch_array($result);

echo '<table>';
echo "<tr><td>Машинист:</td><td>$a[1]</td></tr>";
echo "<tr><td>Время в пути:</td><td>$a[3]</td></tr>";
echo "<tr><td>Количество вагонов:</td><td>$a[2]</td></tr>";
echo "<tr><td>Номер для связи:</td><td>$a[5]</td></tr>";
echo "</table><img src=\"./images/$a[4].jpg\" />";

?>
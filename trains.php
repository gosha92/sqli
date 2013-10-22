<?php
@session_start();
if (!$_SESSION['logged']) header('Location: /index.php');

$s = $_GET['search'];

/* */
$database = "vokzal";
$username = "root";
$password = "";
$hostname = "localhost";
/* */

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");
$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT num, from_, time_from, time_to, driver FROM trains WHERE from_ LIKE '%$s%'", $dbhandle) or die(mysql_error($dbhandle));

echo '<tr><th>Номер</th><th>Пункт отбытия</th><th>Время отбытия</th><th>Время прибытия</th><th>Машинист</th></tr>';
while ($row = mysql_fetch_array($result)) {
	echo '<tr>';
	echo '<td>'.($row[0]).'</td>';
	echo '<td>'.($row[1]).'</td>';
	echo '<td>'.($row[2]).'</td>';
	echo '<td>'.($row[3]).'</td>';
	echo '<td>'.($row[4]).'</td>';
	echo '</tr>';
}

?>
<?php
@session_start();
if (!$_SESSION['logged']) header('Location: ./index.php');

$driver = mysql_real_escape_string($_GET['driver']);
$secret = mysql_real_escape_string($_GET['secret']);

/* */
$database = "vokzal";
$username = "root";
$password = "";
$hostname = "localhost";
/* */

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL.");
$selected = mysql_select_db($database, $dbhandle) or die("Could not select database.");
$result = mysql_query("SELECT name, photo, birthday, city FROM drivers WHERE name='$driver' AND secret='$secret'", $dbhandle) or die(mysql_error($dbhandle));

$b = false;
$str =  '<tr><th>name</th><th>photo</th><th>birthday</th><th>city</th></tr>';
while ($row = mysql_fetch_array($result)) {
	$b = true;
	$str .= '<tr>';
	$str .= '<td>'.($row[0]).'</td>';
	$str .= '<td>'.($row[1]).'</td>';
	$str .= '<td>'.($row[2]).'</td>';
	$str .= '<td>'.($row[3]).'</td>';
	$str .= '</tr>';
}

if ($b)
	echo $str;
else
	echo 'Несуществующее имя, или неверно указан секретный код.';

?>
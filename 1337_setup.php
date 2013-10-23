<?php

require_once('./db_connect.php');

$dbhandle = mysql_connect($hostname, $root_username, $root_password) or die(mysql_error());

echo 'Если появятся какие-то сообщения об ошибках, не пугайтесь - все хорошо.<br>';

$Q =
"
DROP USER 'vokzal_user_1'
DELETE FROM mysql.tables_priv WHERE User='vokzal_user_1'
CREATE user 'vokzal_user_1'@'%' IDENTIFIED BY 'vokzal_user_1_p4ssw0rd'
INSERT INTO mysql.tables_priv VALUES('%', '$database', 'vokzal_user_1', 'users', 'root', CURRENT_TIMESTAMP, 'SELECT', 'SELECT')

DROP USER 'vokzal_user_2'
DELETE FROM mysql.tables_priv WHERE User='vokzal_user_2'
CREATE user 'vokzal_user_2'@'%' IDENTIFIED BY 'vokzal_user_2_p4ssw0rd'
INSERT INTO mysql.tables_priv VALUES('%', '$database', 'vokzal_user_2', 'trains', 'root', CURRENT_TIMESTAMP, 'SELECT', 'SELECT')

DROP USER 'vokzal_user_3'
DELETE FROM mysql.tables_priv WHERE User='vokzal_user_3'
CREATE user 'vokzal_user_3'@'%' IDENTIFIED BY 'vokzal_user_3_p4ssw0rd'
INSERT INTO mysql.tables_priv VALUES('%', '$database', 'vokzal_user_3', 'trains', 'root', CURRENT_TIMESTAMP, 'SELECT', 'SELECT')
INSERT INTO mysql.tables_priv VALUES('%', '$database', 'vokzal_user_3', 'additional', 'root', CURRENT_TIMESTAMP, 'SELECT', 'SELECT')

FLUSH PRIVILEGES

DROP DATABASE IF EXISTS $database
CREATE DATABASE $database
";

$A = explode("\r\n", $Q);
foreach ($A as &$query) {
	if ($query == '') continue;
    mysql_query($query);
	if ($E = mysql_error())
		echo $query.' : '.$E.'<br>';
}

mysql_select_db($database, $dbhandle) or die(mysql_error());

$Q =
"
CREATE TABLE users (login char(20), password char(32))

INSERT INTO users (login, password) VALUES ('admin', '9ca62edac6b2ee917a62fd51e4381b69'), ('gosha_', '200820e3227815ed1756a6b531e7e0d2');

CREATE TABLE trains (num char(10), time_to char(40), time_from char(40), punkt char(40), secret char(32))

INSERT INTO trains (num, time_to, time_from, punkt, secret) VALUES ('1056', '19:00', '20:00', 'Moscow', '6c0b3c0735218a0f33fe0a0cf91a569d'), ('7101', '16:00', '16:15', 'London', '814fe5a684dcc3fcab34406a78400548'), ('0334', '16:17', '16:35', 'Paris', '8af9005666d0f70bbe995be85b8cb73b'), ('1109', '17:20', '17:30', 'Kiev', 'd1ee46d04f56a7e72f2ef87b05e79c06'), ('1601', '18:10', '18:15', 'Rostov', '1bb7443d327ba914fc05c7c858937471'), ('4003', '21:05', '21:45', 'Praga', '1da93ead8f608c95666c63f33a0c0c06'), ('2908', '20:06', '20:30', 'Madrid', 'a8dbac4b32b06a02a8d139d85f8fce29'), ('7761', '13:05', '14:10', 'Budapesht', 'cd057c5126f070841df31a875371fb93'), ('8811', '15:30', '15:40', 'Milan', '67bae590bd66bf30bc9e59a1cb8e1592'), ('7000', '23:07', '23:22', 'Minsk', '9921f60b13814e58426343b878d112ff'), ('1309', '17:40', '17:55', 'Barcelona', '6774322b914452537ab2ed2b4f672d62'), ('5401', '11:00', '11:30', 'Samara', 'dc6231b1db1454d806aaf73b64d7923c'), ('1001', '12:00', '12:05', 'Rotterdam', '828a1f0e9546e907ecfa7dcfa1e06745'), ('6143', '7:40', '8:00', 'Ierusalim', 'c93ad9669fd843c3abc0be5183c350f1')

CREATE TABLE additional (secret char(32), driver char(50), vagons char(10), time_  char(10), img char(10), telephone char(20))

INSERT INTO additional (secret, driver, vagons, time_, img, telephone) VALUES ('6c0b3c0735218a0f33fe0a0cf91a569d', 'Ivan Petrov', '14', '12:45:11', '1', '43-111-000'), ('814fe5a684dcc3fcab34406a78400548', 'Johm Williams', '20', '1:05:01', '2', '41-203-055'), ('8af9005666d0f70bbe995be85b8cb73b', 'Marin Coutu', '21', '5:31:01', '3', '00-101-517'), ('d1ee46d04f56a7e72f2ef87b05e79c06', 'Stepan Bedenko', '11', '08:15:52', '4', '15-66-780'), ('1bb7443d327ba914fc05c7c858937471', 'Alexandr Popov', '13', '07:33:01', '5', '12-00-001'), ('1da93ead8f608c95666c63f33a0c0c06', 'Josef Holub', '14', '12:45:11', '6', '68-091-014'), ('a8dbac4b32b06a02a8d139d85f8fce29', 'Jose Ramon Herrera', '20', '1:05:01', '7', '61-111-045'), ('cd057c5126f070841df31a875371fb93', 'Bence Farkas', '21', '5:31:01', '8', '15-99-901'), ('67bae590bd66bf30bc9e59a1cb8e1592', 'Leo Bonetti', '11', '08:15:52', '9', '02-034-991'), ('9921f60b13814e58426343b878d112ff', 'Victor Petkevich', '13', '07:33:01', '10', '61-145-146'), ('6774322b914452537ab2ed2b4f672d62', 'Salvador Romero', '14', '12:45:11', '11', '59-998-117'), ('dc6231b1db1454d806aaf73b64d7923c', 'Vasily Udaltsov', '20', '1:05:01', '12', '66-105-101'), ('828a1f0e9546e907ecfa7dcfa1e06745', 'Albert van de Brink', '21', '5:31:01', '13', '11-098-706'), ('c93ad9669fd843c3abc0be5183c350f1', 'Aviram Shiffman', '11', '08:15:52', '14', '77-809-91')
";

$A = explode("\r\n", $Q);
foreach ($A as &$query) {
	if ($query == '') continue;
    mysql_query($query);
	if ($E = mysql_error())
		echo $query.' : '.$E.'<br>';
}

?>
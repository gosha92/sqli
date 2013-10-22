#  mysql --user=root --password=
#mysql> source create.sql

DROP DATABASE IF EXISTS `vokzal`;

CREATE DATABASE `vokzal`;

use vokzal;

CREATE TABLE users (
login char(20),
password char(32)
);

INSERT INTO users (login, password) VALUES ('admin', '9ca62edac6b2ee917a62fd51e4381b69');

CREATE TABLE trains (
num char(10),
time_to char(40),
time_from char(40),
punkt char(40),
secret char(32)
);

INSERT INTO trains (num, time_to, time_from, punkt, secret) VALUES ('1056', '19:00', '20:00', 'Moscow', '6c0b3c0735218a0f33fe0a0cf91a569d'), ('7101', '16:00', '16:15', 'London', '814fe5a684dcc3fcab34406a78400548'), ('0334', '16:17', '16:35', 'Paris', '8af9005666d0f70bbe995be85b8cb73b'), ('1109', '17:20', '17:30', 'Kiev', 'd1ee46d04f56a7e72f2ef87b05e79c06'), ('1109', '18:10', '18:15', 'Rostov', '1bb7443d327ba914fc05c7c858937471'), ('4003', '21:05', '21:45', 'Praga', '1da93ead8f608c95666c63f33a0c0c06'), ('2908', '20:06', '20:30', 'Madrid', 'a8dbac4b32b06a02a8d139d85f8fce29'), ('7761', '13:05', '14:10', 'Budapesht', 'cd057c5126f070841df31a875371fb93'), ('8811', '15:30', '15:40', 'Milan', '67bae590bd66bf30bc9e59a1cb8e1592'), ('7000', '23:07', '23:22', 'Minsk', '9921f60b13814e58426343b878d112ff'), ('1309', '17:40', '17:55', 'Barcelona', '6774322b914452537ab2ed2b4f672d62'), ('5401', '11:00', '11:30', 'Samara', 'dc6231b1db1454d806aaf73b64d7923c'), ('1001', '12:00', '12:05', 'Rotterdam', '828a1f0e9546e907ecfa7dcfa1e06745'), ('6143', '7:40', '8:00', 'Ierusalim', 'c93ad9669fd843c3abc0be5183c350f1');

CREATE TABLE additional (
secret char(32),
driver char(50)
);

INSERT INTO additional (secret, driver) VALUES ('c93ad9669fd843c3abc0be5183c350f1', 'Ivan Petrov');

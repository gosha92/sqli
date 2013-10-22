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
num int,
from_ char(40),
time_from char(40),
time_to char(40),
driver char(40),
secret char(32)
);

INSERT INTO trains (num, from_, time_from, time_to, driver, secret) VALUES (1506, 'Moscow', '19:00', '02:00', 'Ivan Petrov', '6c0b3c0735218a0f33fe0a0cf91a569d'), (3312, 'Ekaterinburg', '15:20', '12:10', 'Sergey Kozlov', 'd27ce863483702aa288277205ab5aa62'), (1007, 'London', '10:20', '20:00', 'John Smith', '021b1f292389c75105ce6b21768da516');

CREATE TABLE drivers (
name char(40),
secret char(32),
photo int,
birthday char(20),
city char(30)
);

INSERT INTO drivers (name, secret, photo, birthday, city) VALUES ('Ivan Petrov', '6c0b3c0735218a0f33fe0a0cf91a569d', '1', '27.11.1992', 'Chelyabinsk'), ('Sergey Kozlov', 'd27ce863483702aa288277205ab5aa62', '2', '11.08.1987', 'Rostov'), ('John Smith', '021b1f292389c75105ce6b21768da516', '3', '05.07.1988', 'Paris');

<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DBNAME', 'project2pm');

$connection = mysqli_connect(HOST, USER, PASSWORD, DBNAME);
if (!$connection) {
    die(mysqli_errno($connection));

}



<?php
session_start( );
$httpHost=$_SERVER['HTTP_HOST'];

define('BASE_URL','http://'.$httpHost.'/coreproject2pm/');
define('ROOT',dirname(dirname(__DIR__)).'/coreproject2pm/');
//echo BASE_URL;




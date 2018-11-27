<?php
session_start();
ob_start();
$httpHost=$_SERVER['HTTP_HOST'];

define('BASE_URL','http://'.$httpHost.'/coreproject2pm/');
define("ROOT",dirname(dirname(__DIR__)).'/coreproject2pm/');
define('ADMIN_PATH',BASE_URL.'admin/');




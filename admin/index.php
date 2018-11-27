<?php
//Yo sabbai ko kamm url ma aaeuneii request ko information collect garnu ho//

//require configuration file
require_once('../configuration/configuration.php');
//require database connection
require_once(ROOT .'application/database.php');

//require helper function
require_once(ROOT . 'helper/redirect.php');

//require helper function
require_once(ROOT . 'helper/messages.php');

//get the current url page
$urlRequest = isset($_GET['url']) ? ($_GET['url']) : 'dashboard';
$title = $urlRequest;
$urlRequest = $urlRequest . '.php';


if (!isset($_SESSION['user_username']) || $_SESSION['is_log_in']!=TRUE){
    $_SESSION['error']='Invalid access';
     To('admin/login');
}

?>

<?php
//required html header files here
require_once(ROOT . 'admin/views/layout/header.php');


?>


<?php
//Page xaw kei xaiina vamey raw check garyea ko ho//
$pagePath = ROOT . 'admin/views/pages/' . $urlRequest;

if (file_exists($pagePath) && is_file($pagePath)) {
    require_once(ROOT . 'admin/views/layout/top_time.php');
    require_once(ROOT . 'admin/views/layout/nav.php');
    require_once($pagePath);
} else {
    require_once(ROOT . 'helper/errors/404.php');
}

?>


<?php
//required html footer files here
require_once(ROOT . 'admin/views/layout/footer.php');


?>


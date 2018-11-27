<?php
//Yo sabbai ko kamm url ma aaeuneii request ko information collect garnu ho//

//require configuration file
require_once('configuration/configuration.php');

require_once (ROOT.'application/database.php');

//get the current url page
$urlRequest = isset($_GET['url']) ? ($_GET['url']) : 'home';
$title = $urlRequest;
$urlRequest = $urlRequest . '.php';

?>

<?php
//required html header files here
require_once(ROOT . 'views/layout/header.php');


?>


<?php
//Page xaw kei xaiina vamey raw check garyea ko ho//
$pagePath = ROOT . 'Views/pages/' . $urlRequest;

if (file_exists($pagePath) && is_file($pagePath)) {
    require_once(ROOT . '/views/layout/main-header.php');
    require_once(ROOT . '/views/layout/nav.php');
    require_once($pagePath);
    require_once(ROOT . '/views/layout/main-footer.php');

} else {
    require_once(ROOT . 'helper/errors/404.php');
}

?>


<?php
//required html header files here
require_once(ROOT . 'views/layout/footer.php');


?>


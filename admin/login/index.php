<?php
//require configuration file
require_once('../../configuration/configuration.php');
//require database connection
require_once(ROOT . 'application/database.php');

//require helper function
require_once(ROOT . 'helper/redirect.php');

//require helper function
require_once(ROOT . 'helper/messages.php');

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM tbl_users WHERE  username='$userName' AND password='$password' AND status=1 ";
    $result = mysqli_query($connection, $query);
    $numberofColums = mysqli_num_rows($result);
    if ($numberofColums > 0) {
        $userData = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];
        $_SESSION['user_username'] = $userData['username'];
        $_SESSION['user_email'] = $userData['email'];
        $_SESSION['user_image'] = $userData['image'];
        $_SESSION['user_type'] = $userData['user_type'];
        $_SESSION['is_log_in'] = TRUE;
        To('admin/dashboard');


    } else {
        $_SESSION['error'] = 'username and password not match';

    }

} else {
    $_SESSION['error'] = 'Login First ';

}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login </title>
    <title>Login Page </title>
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/vendors/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/vendors/font-awesome/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/vendors/nprogress/nprogress.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/vendors/google-code-prettify/bin/prettify.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/vendors/google-code-prettify/bin/prettify.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/build/css/custom.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'public/backend/custom/custom.css' ?>">


</head>
<body style="background-color: white;  ">
<div class="main-div">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top: 85px">

                <div class="login_wrapper">
                    <div class="msgBox">
                        <h1><i class="fa fa-lock"> </i> Dashboard Login</h1>
                        <hr>
                        <?= Messages() ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Enter Name"
                                       id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control"
                                       id="password">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary"> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?= BASE_URL . 'public/backend/vendors/jquery/dist/jquery.min.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/fastclick/lib/fastclick.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/nprogress/nprogress.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/jquery.hotkeys/jquery.hotkeys.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/vendors/google-code-prettify/src/prettify.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/build/js/custom.min.js' ?>"></script>
<script src="<?= BASE_URL . 'public/backend/custom/custom.js' ?>"></script>
</body>
</html>


<?php

if (!empty($_POST) && !empty($_FILES)) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $conform_password = md5($_POST['password_confirmation']);
    if ($password != $conform_password) {
        $_SESSION['error'] = "password not match";
        To('admin/addUser');
    }
    $userType = $_POST['user_type'];
    $status = $_POST['status'];

    // this is for upload images
    $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
    $imageName = md5(time()) . '.' . $ext;
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $uploadPath = ROOT . 'public/images/users/';
    if ($error == 0) {
        if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
            $image = $imageName;
        }
    }
    // insert query for inserting data in mysqli database
    $query = "INSERT INTO tbl_users (name,username,email,password,user_type,status,image)
            VALUES('$name','$username','$email','$password','$userType','$status','$image') ";
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = "Data was successfully inserted";
        To('admin/show_users');
    } else {
        $_SESSION['error'] = "Data was not inserted";
        To('admin/addUser');
    }

}

?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="x_panel">
                        <div class="col-md-12">
                            <h2><i class="glyphicon glyphicon-user"></i> Users Record</h2>
                            <hr>
                            <!--                --><? //=Messages() ?>
                            <div class="col-md-8">
                                <form action="" method="post" enctype="multipart/form-data">

                                    <?= Messages() ?>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>

                                    <div class="form-group">
                                        <label for="username">User Name</label>
                                        <input type="text" name="username" class="form-control" id="username">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="user_type">User Type</label>
                                                <select name="user_type" id="user_type" class="form-control">
                                                    <option selected disabled>Select</option>
                                                    <option value="user">User</option>
                                                    <option value="admin">Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="STATUS" class="form-control">
                                                    <option selected disabled>Status</option>
                                                    <option value="1"> Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for=""> Profile picture</label>
                                                <input type="file" name="upload" id="change_image"
                                                       class="btn btn-default btn-sm ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password">
                                    </div>

                                    <div class="form-group">
                                        <label for="cpassword">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                               id="cpassword">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add
                                            Record
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="col-md-4">
                                <img src="<?= BASE_URL . 'public/icons/error.jpg' ?>" id="show_preview"
                                     alt="image not found"
                                     class="img-responsive thumbnail" style="margin-top: 22px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
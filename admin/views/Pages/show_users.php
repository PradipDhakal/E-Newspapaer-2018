<?php
//================show all data====================
$criteriaId = $_SESSION['user_id'];
if ($_SESSION['user_type'] !== 'admin') {
    $query = "SELECT * FROM tbl_users WHERE  id= '$criteriaId'";
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_array($result);
} else {
    $query = "SELECT * FROM tbl_users ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_array($result);
}
//-------------search data------------------
if (isset($_POST['search'])) {
    $searchData = $_POST['search_data'];
    $query = "SELECT * FROM tbl_users WHERE
              name LIKE '%$searchData%'
               || username LIKE '%$searchData%'
               || email LIKE '%$searchData%'
               || user_type LIKE '%$searchData%'
               || status LIKE '%$searchData%'
                ";
    $result = mysqli_query($connection, $query);
}

//===============delete users info=======================
if (isset($_POST['delete_user'])) {
    $criteria = $_POST['user_id'];

    //fetch data for image
    $query = "SELECT * FROM tbl_users WHERE id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $userImage = $userData['image'];
    $imagePath = ROOT . 'public/images/users/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }


    //DELETE USER INFORMATION
    $deleteQuery = "DELETE FROM tbl_users WHERE id=" . $criteria;
    $deletResult = mysqli_query($connection, $deleteQuery);
    if ($deletResult == true) {
        $_SESSION['success'] = 'Information was successfully deleted';
        To('Admin/show_users');

    } else {
        $_SESSION['error'] = 'There  was a problem';
        To('Admin/show_users');
    }

}

//===============update users info=======================
if (isset($_POST['edit_user'])) {
    $criteria = $_POST['user_id'];
    //fetch data for image
    $query = "SELECT * FROM tbl_users WHERE id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $singleUserData = mysqli_fetch_assoc($result);

}
if (isset($_POST['update_user'])) {

    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $criteria = $_POST['user_id'];

// this is for upload images
    if (!empty($_FILES['upload']['name'])) {
        $query = "SELECT * FROM tbl_users WHERE id=" . $criteria;
        $result = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($result);
        $userImage = $userData['image'];
        $imagePath = ROOT . 'public/images/users/' . $userImage;

        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
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
        // update query for inserting data in mysqli database
        $query = "UPDATE tbl_users
          SET name='$name',username='$username',email='$email',image='$image' WHERE id=" . $criteria;
        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'data was successfully updated';
            To('Admin/show_users');
        } else {
            $_SESSION['error'] = "errors";
            To('Admin/show_users');
        }

    } else {

        $query = "UPDATE tbl_users 
            SET name='$name',username='$username',email='$email' WHERE id=" . $criteria;

        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'data was successfully updated';
            To('Admin/show_users');
        } else {
            $_SESSION['error'] = "errors";
            To('Admin/show_users');
        }

    }

}

//===============update users type start=======================
if (isset($_POST['admin'])) {
    $criteria = $_POST['user_id'];
    $userType = 'user';
    $query = "UPDATE tbl_users SET user_type='$userType' WHERE id=" . $criteria;
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = 'User type was successfully updated';
        To('Admin/show_users');
    } else {
        $_SESSION['error'] = "errors";
        To('Admin/show_users');
    }

}
if (isset($_POST['user'])) {
    $criteria = $_POST['user_id'];
    $userType = 'admin';
    $query = "UPDATE tbl_users SET user_type='$userType' WHERE id=" . $criteria;
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = 'User type was successfully updated';
        To('Admin/show_users');
    } else {
        $_SESSION['error'] = "errors";
        To('Admin/show_users');
    }
}
//===============update users type end=======================

//===============update users status start=======================
if (isset($_POST['active'])) {
    $criteria = $_POST['user_id'];
    $status = 0;
    $query = "UPDATE tbl_users SET status='$status' WHERE id=" . $criteria;
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = 'User type was successfully updated';
        To('Admin/show_users');
    } else {
        $_SESSION['error'] = "errors";
        To('Admin/show_users');
    }

}
if (isset($_POST['inactive'])) {
    $criteria = $_POST['user_id'];
    $status = 1;
    $query = "UPDATE tbl_users SET status='$status'  WHERE id=" . $criteria;
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = 'User type was successfully updated';
        To('Admin/show_users');
    } else {
        $_SESSION['error'] = "errors";
        To('Admin/show_users');
    }
}
//===============update users status end=======================

?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <?php if (isset($_POST['edit_user'])) : ?>
                <!--        edit garnaw ko lageii-->
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="glyphicon glyphicon-edit"></i> Upload Info</h2>
                        <hr>
                        <div class="col-md-8">


                            <form action="" method="post" enctype="multipart/form-data">


                                <input type="hidden" name="user_id" value="<?= $singleUserData['id'] ?>">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="<?= $singleUserData['name'] ?>"
                                           class="form-control" id="name">
                                </div>

                                <div class="form-group">
                                    <label for="username">User Name</label>
                                    <input type="text" name="username" value="<?= $singleUserData['username'] ?>"
                                           class="form-control" id="username">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" value="<?= $singleUserData['email'] ?>"
                                           class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label for=""> Profile picture</label>
                                    <input type="file" name="upload" id="change_image"
                                           class="btn btn-default btn-sm ">
                                </div>
                                <div class="form-group">
                                    <button name="update_user" class="btn btn-primary"><i
                                                class="glyphicon glyphicon-edit"></i> Update Info
                                    </button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-4">
                            <img src="<?= BASE_URL . 'public/images/users/' . $singleUserData['image'] ?>"
                                 id="show_change_image"
                                 alt="image not found"
                                 class="img-responsive thumbnail" style="margin-top: 22px">
                        </div>
                        <div class="col-md-12">
                            <!--                        <h1> Edit Users </h1>-->

                        </div>
                    </div>
                </div>
            <?php else: ?>

            <!------------------------------------------------------------------------------------------------------------------- -->
            <!--        show garna ko lageiii-->
            <div class="row">
                <div class="x_panel">
                    <div class="col-md-12">
                        <d iv class="col-md-12">
                            <h1> <?= $title ?></h1>
                            <hr>
                            <?= Messages() ?>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="search_data" name="search_data" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button name="search" class="btn btn-primary">search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="show_all_user_data"></div>
                            <div id="oldData">
                                <table id="oldData" class="table table-hover">
                                    <tr>
                                        <td>S.n</td>
                                        <td>Name</td>
                                        <td>User Name</td>
                                        <td>Email</td>
                                        <td>User Type</td>
                                        <td>Status</td>
                                        <td>Image</td>
                                        <td>Action</td>
                                    </tr>

                                    <?php foreach ($result as $key => $users): ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td><?= $users['name'] ?></td>
                                            <td><?= $users['username'] ?></td>
                                            <td><?= $users['email'] ?></td>
                                            <td>

                                                <form action="" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $users['id'] ?>">
                                                    <?php if ($users['user_type'] == 'admin') : ?>
                                                        <button name="admin" class="btn btn-primary btn btn-xs "> Admin
                                                        </button>
                                                    <?php else : ?>
                                                        <button name="user" class="btn btn-info btn btn-xs">Users
                                                        </button>
                                                    <?php endif; ?>

                                                </form>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $users['id'] ?>">
                                                    <?php if ($users['STATUS'] == '1') : ?>
                                                        <button name='active' class="btn btn-primary btn btn-xs ">
                                                            Active
                                                        </button>
                                                    <?php else : ?>
                                                        <button name='inactive' class="btn btn-info btn btn-xs">Inactive
                                                        </button>
                                                    <?php endif; ?>
                                                </form>
                                            </td>
                                            <td>
                                                <img src="<?= BASE_URL . 'public/images/users/' . $users['image'] ?>"
                                                     alt="images not found" width="50">
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="user_id" value="<?= $users['id'] ?>">
                                                    <button name="edit_user" class="btn btn-primary btn-xs"
                                                            onclick="return confirm('Are you sure want to edit the data ?')">
                                                        <i
                                                                class="glyphicon glyphicon-edit"></i> Edit
                                                    </button>
                                                    <?php if ($_SESSION['user_type'] == 'admin') : ?>
                                                        <button name="delete_user" class="btn btn-danger btn-xs"
                                                                onclick="return confirm('Are you sure want to delete the data ?')">
                                                            <i class="glyphicon glyphicon-trash"></i> Delete
                                                        </button>
                                                    <?php else: ?>

                                                    <?php endif; ?>

                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                </table>
                            </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
//================show all data====================
$criteriaId = $_SESSION['user_id'];

if ($_SESSION['user_type'] != 'admin') {
    $query = " SELECT * from tbl_slider  where  user_id =" . $criteriaId;
    $result = mysqli_query($connection, $query);
} else {
    $query = " SELECT * from tbl_slider order  by  id DESC ";
    $result = mysqli_query($connection, $query);
}


// -----------DELETE USERS  INFORMATION--------------------//

if (isset($_POST['delete_user'])) {
    $criteria = $_POST['news_cri'];

    $query = "SELECT * FROM tbl_slider WHERE id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $userImage = $userData['image'];
    $imagePath = ROOT . 'public/images/slider/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }
    $queryData = "delete from tbl_slider where id=" . $criteria;
    $deleteResult = mysqli_query($connection, $queryData);

    if ($deleteResult == True) {
        $_SESSION['success'] = 'Data was successfully deleted';
        To('admin/show_slider');
    } else {
        $_SESSION['error'] = 'Sorry data was could not be deleted';
        To('admin/show_slider');
    }

}

//---------- *************DELETE***********-----------------//


//-----------------------Edit news --------------//


if (isset($_POST['edit_user'])) {

    $criteria = $_POST['news_cri'];

    $query = "SELECT * FROM tbl_slider where id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $user_data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_info'])) {
    $heading = $_POST['heading'];
    $description = $_POST['description'];
    $criteria = $_POST['news_cri'];

    if (!empty($_FILES['upload']['name'])) {
        $query = "SELECT * FROM tbl_slider WHERE id=" . $criteria;
        $result = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($result);
        $userImage = $userData['image'];
        $imagePath = ROOT . 'public/images/slider/' . $userImage;
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
        $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
        $imageName = md5(time()) . '.' . $ext;
        $error = $_FILES['upload']['error'];
        $tmpName = $_FILES['upload']['tmp_name'];
        $uploadPath = ROOT . 'public/images/slider/';
        if ($error == 0) {
            if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
                $image = $imageName;
            }
        }

        $query = "UPDATE tbl_slider SET title='$heading', image_name='$image', description='$description' WHERE id=" . $criteria;

        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'Sliders were successfully  updated ';
            To('admin/show_slider');
        } else {
            $_SESSION['error'] = "Data was not successfully updated";
            To('admin/show_slider');
        }
    } else {

        $query = "UPDATE tbl_slider SET title='$heading', description='$description' WHERE id=" . $criteria;

        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'Sliders were successfully  updated ';
            To('admin/show_slider');
        } else {
            $_SESSION['error'] = "Data was not successfully updated";
            To('admin/show_slider');
        }

    }

}
?>

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix">
            <?php if (isset($_POST['edit_user'])) : ?>
                <div class="col-md-12">
                    <h2><i class="glyphicon glyphicon-edit"></i> Update Submenu</h2>
                    <hr>
                    <div class="col-md-9">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="news_cri" value="<?= $user_data['id'] ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title ">Title</label>
                                        <input type="text" class="form-control" name="heading" id="title"
                                               value="<?= $user_data['title'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" class="form-control" name="upload" id="image ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <textarea name="description" id="description" class="form-control"
                                <?= $user_data['description'] ?></textarea>
                            </div>
                            <div class="from-group">
                                <button name="update_info" class="btn btn-primary"><i class="fa fa-edit"></i> Update
                                    Records
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <img src="<?= BASE_URL . 'public/images/slider/' . $user_data['image_name'] ?>"
                             id="show_change_image"
                             alt="image not found"
                             class="img-responsive thumbnail" style="margin-top: 18px; margin-left: -15px">
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <h1>Show Slider </h1>
                            <?= Messages() ?>
                            <table id="oldData" class="table table-bordered">
                                <tr>
                                    <td>S.N</td>
                                    <td>Title</td>
                                    <td>description</td>
                                    <td>User Id</td>
                                    <td>Image</td>
                                    <td>Edit</td>

                                </tr>
                                <?php foreach ($result as $key => $news): ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= substr($news['title'], 0, 20) ?></td>
                                        <td><?= substr($news['description'], 0, 50) ?></td>
                                        <td><?= $news['user_id'] ?></td>

                                        <td>
                                            <img src="<?= BASE_URL . 'public/images/slider/' . $news['image_name'] ?>"
                                                 alt="images not found" width="50">
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="news_cri"
                                                       value="<?= $news['id'] ?>">
                                                <button class="btn btn-success btn-sm " name="edit_user"
                                                        onclick="return confirm('Are you sure want to edit the data ?')">
                                                    Edit
                                                </button>

                                                <button class="btn btn-danger btn-sm " name="delete_user"
                                                        onclick="return confirm('Are you sure want to delete the data ?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
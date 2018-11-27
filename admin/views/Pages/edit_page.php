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
//===============update users info=======================
if (isset($_POST['edit_user'])) {
    $criteria = $_POST['news_cri'];
    $query = "SELECT * FROM tbl_news WHERE id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $singleUserData = mysqli_fetch_assoc($result);

}

if (isset($_POST['update_user'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $criteria = $_POST['news_id'];

// this is for  images  delete and upload
    if (!empty($_FILES['upload']['name'])) {
        $criteria = $_POST['news_id'];
        $query = "SELECT * FROM tbl_news WHERE id=" . $criteria;
        $result = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($result);
        $userImage = $userData['image'];
        $imagePath = ROOT . 'public/images/news/' . $userImage;

        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
        $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
        $imageName = md5(time()) . '.' . $ext;
        $error = $_FILES['upload']['error'];
        $tmpName = $_FILES['upload']['tmp_name'];
        $uploadPath = ROOT . 'public/images/news/';
        if ($error == 0) {
            if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
                $image = $imageName;
            }
        }
        // update query for inserting data in mysqli database
        $query = "UPDATE tbl_news
          SET title='$title',description='$description',image='$image' WHERE id=" . $criteria;
        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'Data was successfully updated';
            To('Admin/show_page');
        } else {
            $_SESSION['error'] = "errors were found";
            To('Admin/edit_page');
        }

    } else {

        $query = "UPDATE tbl_news 
            SET title='$title',description='$description' WHERE id=" . $criteria;
        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'Data was successfully updated';
            To('Admin/show_page');
        } else {
            $_SESSION['error'] = " were found";
            To('Admin/edit_page');
        }

    }

}


?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <h2><i class="glyphicon glyphicon-edit"></i> Upload Info</h2>
                    <hr>
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="news_id" value="<?= $singleUserData['id'] ?>">
                            <div class="form-group">
                                <?= Messages(); ?>

                                <label for="title">Title</label>
                                <input type="text" name="title" value="<?= $singleUserData['title'] ?>"
                                       class="form-control" id="title">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" style="resize: none" id="description" cols="30"
                                          rows="10"> <?= $singleUserData['description'] ?> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="change_image"> Image </label>
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
                        <img src="<?= BASE_URL . 'public/images/news/' . $singleUserData['image'] ?>"
                             id="show_change_image"
                             alt="image not found"
                             class="img-responsive thumbnail" style="margin-top: 22px">
                    </div>
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

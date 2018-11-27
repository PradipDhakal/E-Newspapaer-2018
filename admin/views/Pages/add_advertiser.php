<?php

if (!empty($_FILES)) {

    $criteriaId = $_SESSION['user_id'];

    // this is for upload images
    $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
    $imageName = md5(time()) . '.' . $ext;
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $uploadPath = ROOT . 'public/images/sponsers/';
    if ($error == 0) {
        if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
            $image = $imageName;
        }
    }
    // insert query for inserting data in mysqli database
    $query = "INSERT INTO tbl_advertiser (img_name,user_id)
            VALUES('$image','$criteriaId')";
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = "Data was successfully inserted";
        To('admin/add_advertiser');
    } else {
        $_SESSION['error'] = "Data was not inserted";
        To('admin/add_advertiser');
    }

}

$criteriaId = $_SESSION['user_id'];
$advertiserQ = "SELECT * FROM tbl_advertiser";
$advertisement= mysqli_query($connection, $advertiserQ);



//delete images //

if (isset($_POST['delete_image'])) {
    $criteria = $_POST['gallery_cri'];
    $query = "SELECT * FROM tbl_advertiser WHERE id=" . $_POST['gallery_cri'];
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $userImage = $userData['image'];
    $imagePath = ROOT . 'public/images/sponsers/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }
    $queryData = "delete from tbl_advertiser where id=" . $criteria;
    $deleteResult = mysqli_query($connection, $queryData);

    if ($deleteResult == True) {
        $_SESSION['success'] = 'Data was successfully deleted';
        To('admin/add_advertiser');
    } else {
        $_SESSION['error'] = 'Sorry data was could not be deleted';
        To('admin/add_advertiser');
    }


}


?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="col-md-9">
                            <?= Messages() ?>
                            <h2><i class="glyphicon glyphicon-arrow-right"></i> Sponsers </h2>
                            <hr>

                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for=""> Profile picture</label>
                                    <input type="file" name="upload" id="change_image"
                                           class="btn btn-default btn-sm ">
                                </div>
                                <div class="form-group">
                                    <button style="margin-top: 1%" class="btn btn-primary"><i
                                                class="glyphicon glyphicon-plus"></i> Add Records
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <img src="<?= BASE_URL . 'public/icons/error.jpg' ?>" id="show_preview"
                                 alt="image not found"
                                 class="img-responsive thumbnail" style="margin-top: 22px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="col-md-12">
                            <div class=" row">
                                <h1> Delete Sponsers Images </h1>
                                <?= Messages() ?>
                                <hr>
                                <?php foreach ($advertisement as $ads) : ?>
                                    <div class="col-md-4 galleryBox">
                                        <img src="<?=BASE_URL. 'public/images/sponsers/'. $ads['img_name']?>"
                                             name="gallery" alt="Images not found" class="img-responsive thumbnail"
                                             height="50">
                                        <form action="" method="post" enctype='multipart/form-data'>
                                            <input type="hidden" name="gallery_cri" formenctype="multipart/form-data"
                                                   value="<?= $ads['id'] ?>">
                                            <input type="checkbox" name="delete_all" ">
                                            <button style="margin-top: 1%; margin-left: 2% " class="btn btn-danger"
                                                    onclick="return confirm('Are you sure wants to delete the image ?')"
                                                    name="delete_image"> Delete Image
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<?php
//================show all data====================

$criteriaId = $_SESSION['user_id'];
$query = "SELECT * FROM tbl_gallery WHERE user_id='$criteriaId'";
$result = mysqli_query($connection, $query);

if (isset($_POST['delete_image'])) {

    $criteria=$_POST['gallery_cri'];


    $query="Select * from tbl_gallery where id=.$criteria";
    $result=mysqli_query($connection,$query);
    $userData=mysqli_fetch_assoc($result);
    $userImage = $userData['img_name'];
    $imagePath = ROOT . 'public/images/gallery/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }

   $queryData = "delete from tbl_gallery where id=" . $criteria;
    $deleteResult = mysqli_query($connection, $queryData);

    if ($deleteResult == True) {
        $_SESSION['success'] = 'Image was successfully deleted';
        To('admin/show_gallery');
    } else {
        $_SESSION['error'] = 'Sorry image could not be deleted';
        To('admin/show_gallery');
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
                            <div class=" row">
                                <h1> <?= $title ?></h1>
                                <?= Messages() ?>
                                <hr>
                                <?php foreach ($result as $image) : ?>
                                    <div class="col-md-4 galleryBox">
                                        <img src="<?= BASE_URL . 'public/images/gallery/' . $image['img_name'] ?>"
                                             name="gallery" alt="Images not found" class="img-responsive thumbnail"
                                             height="100">
                                        <form action="" method="post">
                                            <input type="hidden" name="gallery_cri" value="<?= $image['id'] ?>">
                                            <input type="checkbox" name="delete_all" >
                                            <button class="btn btn-danger"
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


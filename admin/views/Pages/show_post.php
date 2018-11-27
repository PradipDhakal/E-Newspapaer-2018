<?php
//================show all data====================

$criteriaId = $_SESSION['user_id'];
$query = "SELECT * FROM tbl_gallery WHERE user_id='$criteriaId'";
$result = mysqli_query($connection, $query);
?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="col-md-12">
                            <h1> <?= $title ?></h1>
                            <?= Messages() ?>
                            <hr>

                            <?php foreach ($result as $image) : ?>
                                <div class="col-md-4 galleryBox">
                                    <img src="<?= BASE_URL . 'public/images/gallery/' . $image['img_name'] ?>"
                                         alt="Images not found" class="img-responsive thumbnail" height="100">
                                    <!--                        <input type="checkbox" name="delet_all[]" value="-->
                                    <? //=$image['id']?><!--">-->
                                    <!--                        <a href=""> delete</a>-->
                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

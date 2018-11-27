<?php

if (!empty($_POST) && !empty($_FILES)) {
    $title = $_POST['head'];
    $description = $_POST['description'];
    $criteriaId = $_SESSION['user_id'];

    // this is for upload imagess
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

    // insert query for inserting data in mysqli database
    $query = "INSERT INTO tbl_slider (title,image_name,description,user_id)
            VALUES('$title','$image','$description','$criteriaId')";
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = "Data was successfully inserted";
        To('admin/show_slider');
    } else {
        $_SESSION['error'] = "Data was not inserted";
        To('admin/add_slider');
    }

}

?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="col-md-12">
                            <?= Messages() ?>
                            <h2><i class="glyphicon glyphicon-arrow-right"></i> Add Slider</h2>
                            <hr>

                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="title"> Title</label>
                                    <textarea name="head" id="title" rows="4" style="resize: none;"
                                              class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for=""> Profile picture</label>
                                    <input type="file" name="upload" id="change_image"
                                           class="btn btn-default btn-sm ">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description </label>
                                    <textarea name="description" id="description" rows="10"
                                              class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Records
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

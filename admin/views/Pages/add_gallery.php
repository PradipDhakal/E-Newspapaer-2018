<?php

if (!empty($_FILES) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $numberofUploadFile = count($_FILES['upload']['name']);
    $criteriaId = $_SESSION['user_id'];
    $x = 0;

//      loop
    for ($i = 0; $i < $numberofUploadFile; $i++) {
        $ext = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
        $imageName = md5(microtime()) . '.' . $ext;
        $error = $_FILES['upload']['error'] [$i];
        $tmpName = $_FILES['upload']['tmp_name'] [$i];
        $uploadPath = ROOT . 'public/images/gallery/';
        if ($error == 0) {
            if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
                $image = $imageName;

                // insert query for inserting data in mysqli database
                $query = "INSERT INTO tbl_gallery (img_name,user_id) 
                VALUES('$imageName','$criteriaId')";
                $result = mysqli_query($connection, $query);

                if ($result == TRUE) {
                    $x++;
                }
            }
        }
    }
    if ($numberofUploadFile === $x) {
        $_SESSION['success'] = 'Images  uploaded';
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
                            <h2><i class="fa fa-image"></i> Add Gallery Images</h2>
                            <hr>
                            <!--                --><? //=Messages() ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <?= Messages() ?>
                                <div class="form-group">
                                    <label for=""> Add Images <a href="" style="color:red"> *(select multiple
                                            images) </a>
                                    </label>
                                    <input type="file" name="upload[]" multiple class="btn btn-default btn-sm ">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary"><i class="fa fa-upload"></i> Upload Image</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
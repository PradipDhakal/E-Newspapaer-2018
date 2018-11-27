<?php
$sql = "SELECT * FROM tbl_category ORDER BY id DESC ";
$catResult = mysqli_query($connection, $sql);

if (!empty($_POST) && !empty($_FILES)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $catId = $_POST['cat_id'];
    $userId = $_SESSION['user_id'];


//    Image upload ko lagi //

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

    $query = "INSERT INTO tbl_news(title,image,description)
    VALUES('$title','$image','$description')";
    $result = mysqli_query($connection, $query);
    $lastInsertId = mysqli_insert_id($connection);
    if ($lastInsertId) {
        $queryABC = "INSERT INTO tbl_news_category(news_id,cat_id,user_id)VALUES('$lastInsertId','$catId','$userId')";
        $resultRT = mysqli_query($connection, $queryABC);

        if ($resultRT == TRUE) {
            $_SESSION['success'] = 'News were inserted';
            To('admin/show_news');
        } else {
            $_SESSION['error'] = 'Error';
            To('admin/add_news');
        }
    }
}
?>
<div class="right_col" role="main">
    <div class="container-fluid">
        <div class="content">
            <div class="row">
                <div class="col - md - 12">
                    <div class="x_panel">
                        <div class="col-md-12">
                            <h2>Add News</h2>
                            <hr>
                            <form action="" method="post" enctype="multipart/form-data">
                                <?= Messages() ?>
                                <div class="form - group">
                                    <label for="category">Select Category</label>
                                    <select name="cat_id" id="category" class="form-control"  >
                                        <?php foreach ($catResult as $cat) : ?>
                                            <option value=" <?= $cat['id'] ?>"> <?= $cat['cat_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <textarea name="title" id="title" style="resize: none;" class="form-control"
                                              rows="4"></textarea>

                                </div>
                                <div class="form-group">
                                    <label for=""> Image </label>
                                    <input type="file" name="upload" id="change_image" class="btn btn-default btn-sm ">
                                </div>
                                <div class="form-group">
                                    <label for="description"> Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add Record
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

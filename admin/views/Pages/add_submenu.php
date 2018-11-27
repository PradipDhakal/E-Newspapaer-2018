<?php
$sql = "SELECT * FROM tbl_menu ORDER BY id DESC ";
$catResult = mysqli_query($connection, $sql);

if (!empty($_POST) && !empty($_FILES)) {
    $title = $_POST['title'];
    $news = $_POST['news'];
    $description = $_POST['description'];
    $catId = $_POST['cat_id'];
    $userId = $_SESSION['user_id'];

//--------------------Image-----upload------ko-----lagiii-------------------- //

    $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
    $imageName = md5(time()) . '.' . $ext;
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $uploadPath = ROOT . 'public/images/menu/';
    if ($error == 0) {
        if (move_uploaded_file($tmpName, $uploadPath . $imageName)) {
            $image = $imageName;
        }
    }

    $query = "INSERT INTO  tbl_menu_news(title,news,description,image)
    VALUES('$title','$news','$description','$image')";
    $result = mysqli_query($connection, $query);
    $lastInsertId = mysqli_insert_id($connection);
    if ($lastInsertId) {
        $queryABC = "INSERT INTO tbl_submenu(menu_news_id,menu_id,user_id)VALUES('$lastInsertId','$catId','$userId')";
        $resultRT = mysqli_query($connection, $queryABC);

        if ($resultRT == TRUE) {
            $_SESSION['success'] = 'News were inserted';
            To('admin/show_submenu');
        } else {
            $_SESSION['error'] = 'Errors were found';
            To('admin/add_submenu');
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
                        <div class="row">

                            <h2>Add Submenu</h2>
                            <hr>
                            <div class="col-md-9">
                                <div class="row">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <?= Messages() ?>
                                        <div class="form - group">
                                            <label for="category">Select Menu</label>
                                            <select name="cat_id" id="category" class="form-control">
                                                <?php foreach ($catResult as $cat) : ?>
                                                    <option value=" <?= $cat['id'] ?>"> <?= $cat['menu_name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title"> Title </label>
                                            <input type="text" name="title" id="title" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="news"> News Title </label>
                                            <input type="text" name="news" id="news" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Image </label>
                                            <input type="file" name="upload" id="change_image"
                                                   class="btn btn-default btn-sm ">
                                        </div>

                                        <div class="form-group">
                                            <label for="description"> Description</label>
                                            <textarea name="description" id="description"
                                                      class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add
                                                Records
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-3">
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
<?php

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['cat_name'];

    // insert query for inserting data in mysqli database
    $query = "INSERT INTO tbl_category(cat_name)  VALUE('$catName')";
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = "Data was successfully inserted";
        To('admin/add_category');
    } else {
        $_SESSION['error'] = "Data was not inserted";
        To('admin/add_category');
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
                            <h2><i class="fa fa-newspaper-o"></i> Add News Category</h2>
                            <hr>
                            <!--                --><? //=Messages() ?>
                            <div class="col-md-8">
                                <form action="" method="post">

                                    <?= Messages() ?>

                                    <div class="form-group">
                                        <label for="name">Category Name</label>
                                        <input type="text" name="cat_name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Add
                                            Record
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
</div>

<?php
if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $menuName = $_POST['menu_id'];

    // insert query for inserting data in mysqli database
    $query = "INSERT INTO tbl_menu (menu_name)  VALUE('$menuName')";
    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = "Data was successfully inserted";
        To('admin/add_submenu');
    } else {
        $_SESSION['error'] = "Data was not inserted";
        To('admin/add_menu');
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
                            <h2><i class="fa fa-newspaper-o"></i> Add Menu Category</h2>
                            <hr>
                            <div class="col-md-8">
                                <form action="" method="post">

                                    <?= Messages() ?>

                                    <div class="form-group">
                                        <label for="name">Menu Name</label>
                                        <input type="text" name="menu_id" class="form-control" id="name">
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

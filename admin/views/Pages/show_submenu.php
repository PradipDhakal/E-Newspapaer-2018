<?php
//================show all data====================
$criteriaId = $_SESSION['user_id'];

if ($_SESSION['user_type'] != 'admin') {
    $query = "SELECT tbl_menu.menu_name,tbl_menu_news.id as nw_id,tbl_menu_news.*,tbl_users.username FROM tbl_submenu
JOIN tbl_menu ON tbl_menu.id=tbl_submenu.menu_id
JOIN tbl_menu_news ON tbl_menu_news.id=tbl_submenu.menu_news_id
JOIN tbl_users ON tbl_users.id=tbl_submenu.user_id WHERE tbl_submenu.user_id='$criteriaId'";
    $result = mysqli_query($connection, $query);
} else {
    $query = "SELECT tbl_menu.menu_name,tbl_menu_news.id as nw_id,tbl_menu_news.*,tbl_users.username FROM tbl_submenu
JOIN tbl_menu ON tbl_menu.id=tbl_submenu.menu_id
JOIN tbl_menu_news ON tbl_menu_news.id=tbl_submenu.menu_news_id
JOIN tbl_users ON tbl_users.id=tbl_submenu.user_id";
    $result = mysqli_query($connection, $query);
}



//-------------search data------------------
if (isset($_POST['search'])) {
    $searchData = $_POST['search_data'];
    $searchQuery = "SELECT tbl_menu.menu_name,tbl_menu_news.*,tbl_users.username FROM tbl_submenu
JOIN tbl_menu ON tbl_menu.id=tbl_submenu.menu_id
JOIN tbl_menu_news ON tbl_menu_news.id=tbl_submenu.menu_news_id
JOIN tbl_users ON tbl_users.id=tbl_submenu.user_id, WHERE
                || menu_name LIKE '%$searchData%'
                || title LIKE '%$searchData%'
                || username LIKE '%$searchData%'  
               ";
    $result = mysqli_query($connection, $searchQuery);
}


// -----------DELETE USERS  INFORMATION--------------------//


if (isset($_POST['delete_user'])) {
    $criteria = $_POST['news_cri'];
    $query = "SELECT * FROM tbl_menu_news WHERE id=" . $_POST['news_criteria'];
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $userImage = $userData['image'];
    $imagePath = ROOT . 'public/images/menu/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }
    $queryData = "delete from tbl_menu_news where id=" . $criteria;
    $deleteResult = mysqli_query($connection, $queryData);


    if ($deleteResult == True) {
        $_SESSION['success'] = 'Data was successfully deleted';
        To('admin/show_submenu');
    } else {
        $_SESSION['error'] = 'Sorry data was could not be deleted';
        To('admin/show_submenu');
    }


}
//---------- *************DELETE***********-----------------//







//-----------------------Edit news --------------//

if (isset($_POST['edit_user'])) {
    $query = "SELECT * FROM tbl_menu_news";
    $result = mysqli_query($connection, $query);
    $user_data = mysqli_fetch_assoc($result);

}

if (isset($_POST['update_info'])) {
    $title = $_POST['title'];
    $news = $_POST['news'];
    $description = $_POST['description'];
    $criteria = $_POST['news_cri'];

    if (!empty($_FILES['upload']['name'])) {
        $query = "SELECT * FROM tbl_menu_news WHERE id=" . $criteria;
        $result = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($result);
        $userImage = $userData['image'];
        $imagePath = ROOT . 'public/images/menu/' . $userImage;
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }
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

        $query = "UPDATE tbl_menu_news SET title='$title',news='$news',image='$image',description='$description' WHERE id=" . $criteria;

        if ($result = mysqli_query($connection, $query)) {
            $_SESSION['success'] = 'Data was  updated ';
            To('admin/show_submenu');
        } else {
            $_SESSION['error'] = "Data was not successfully updated";
            To('admin/show_submenu');
        }

    }

   else{

       $query= "UPDATE tbl_menu_news SET title='$title',news='$news',description='$description' WHERE id=" . $criteria;
       if ($result = mysqli_query($connection, $query)) {
           $_SESSION['success'] = 'Data was updated ';
           To('admin/show_submenu');
       } else {
           $_SESSION['error'] = "Data was not successfully updated";
           To('admin/show_submenu');
       }

   }



}

?>

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix">
            <?php if (isset($_POST['edit_user'])) : ?>
                <!------    ****************** EDIT DATA HO YO ********************      ---->
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="glyphicon glyphicon-edit"></i> Update Submenu</h2>
                        <hr>
                        <div class="col-md-9">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="news_cri" value="<?= $user_data['id'] ?>">

                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="title ">News Title</label>
                                            <input type="text" class="form-control" name="title" id="title "
                                                   value="<?= $user_data['title'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="news ">News</label>
                                            <input type="text" class="form-control" name="news" id="news "
                                                   value="<?= $user_data['news'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control" name="upload" id="image ">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description"> Description</label>
                                    <textarea name="description" id="description" class="form-control"
                                    <?= $user_data['description'] ?></textarea>
                                </div>
                                <div class="from-group">
                                    <button name="update_info" class="btn btn-primary"><i class="fa fa-edit"></i> Update
                                        Records
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <img src="<?= BASE_URL . 'public/images/menu/' . $user_data['image'] ?>"
                                 id="show_change_image"
                                 alt="image not found"
                                 class="img-responsive thumbnail" style="margin-top: 18px; margin-left: -15px">
                        </div>
                    </div>
                </div>
            <?php else: ?>


<!------    ****************** SHOW DATA HO YO ********************      ---->
                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <h1 class="glyphicon glyphicon-list">Show_Submenu</h1>
                            <?= Messages() ?>
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="search_data" name="search_data" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button name="search" class="btn btn-primary">search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="oldData" class="table table-hover">
                                <tr>
                                    <td>S.N</td>
                                    <td>Title</td>
                                    <td>Sub Title</td>
                                    <td>News Heading</td>
                                    <td>Posted By</td>
                                    <td>Image</td>
                                    <td>Action</td>
                                </tr>
                                <?php foreach ($result as $key => $news): ?>
                                    <tr>
                                        <td><?= ++$key ?></td>
                                        <td><?= substr($news['menu_name'], 0, 20) ?></td>
                                        <td><?= substr($news['title'], 0, 10) ?></td>
                                        <td><?= substr($news['news'], 0, 80) ?></td>
                                        <td><?= $news['username'] ?></td>
                                        <td>
                                            <img src="<?= BASE_URL . 'public/images/menu/' . $news['image'] ?>"
                                                 alt="images not found" width="50">
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                <input type="hidden" name="news_cri"
                                                       value="<?= $news['nw_id'] ?>">
                                                <button class="btn btn-success btn-xs " name="edit_user"
                                                        onclick="return confirm('Are you sure want to edit the data ?')">
                                                    Edit
                                                </button>
                                                <button class="btn btn-danger btn-xs " name="delete_user"
                                                        onclick="return confirm('Are you sure want to delete the data ?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
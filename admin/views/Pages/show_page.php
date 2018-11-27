<?php
//================show all data====================
$criteriaId = $_SESSION['user_id'];


if ($_SESSION['user_id'] != 2) {

    $query = "SELECT tbl_news.*,tbl_news.id as nw_id, tbl_users.username, tbl_category.cat_name
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id
WHERE tbl_news_category.user_id=1";
    $result = mysqli_query($connection, $query);
} else {
    $query = "SELECT tbl_news.*,tbl_news.id as nw_id, tbl_users.username, tbl_category.cat_name
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id";
    $result = mysqli_query($connection, $query);
}


// -----------DELETE USERS  INFORMATION--------------------//

if (isset($_POST['delete_user'])) {
    $criteria = $_POST['news_cri'];
    $query = "SELECT * FROM tbl_news WHERE id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $userImage = $userData['image'];
    $imagePath = ROOT . 'public/images/news/' . $userImage;

    if (file_exists($imagePath) && is_file($imagePath)) {
        unlink($imagePath);
    }

    $queryData = "delete from tbl_news where id=" . $criteria;
    $deleteResult = mysqli_query($connection, $queryData);


    if ($deleteResult == True) {
        $_SESSION['success'] = 'Data was successfully deleted';
        To('admin/show_page');
    } else {
        $_SESSION['error'] = 'Sorry data was could not be deleted';
        To('admin/show_page');
    }

}

//---------- *************DELETE***********-----------------//




?>

<div class="right_col" role="main">

    <div class="clearfix">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel ">
                    <h1> <?= $title ?></h1>
                    <?= Messages() ?>
                    <table id="oldData" class="table table-bordered">
                        <tr>
                            <td>S.N</td>
                            <td>Title</td>
                            <td>Category</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                        <?php foreach ($result as $key => $news): ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= substr($news['title'], 0, 150) ?></td>
                                <td><?= $news['cat_name'] ?></td>
                                <td>
                                    <img src="<?= BASE_URL . 'public/images/news/' . $news['image'] ?>"
                                         alt="images not found" width="50">
                                </td>
                                <td>
                                    <form action="<?= BASE_URL . 'admin/edit_page' ?>" method="post"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="news_cri"
                                               value="<?= $news['nw_id'] ?>">
                                        <button class="btn btn-success btn-xs " name="edit_user"
                                                onclick="return confirm('Are you sure want to edit the data ?')">
                                            Edit
                                        </button>
                                    </form>
                                    <form action="#" method="post"
                                          enctype="multipart/form-data">
                                        <input type="hidden" name="news_cri"
                                               value="<?= $news['nw_id'] ?>">

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
    </div>
</div>
</div>

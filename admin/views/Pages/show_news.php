<?php
//================show all data====================
$criteriaId = $_SESSION['user_id'];

if ($_SESSION['user_type'] != 'admin') {
    $query = "SELECT COUNT(tbl_news.title) as total_news,GROUP_CONCAT(DISTINCT tbl_category.cat_name SEPARATOR ',' )as category ,tbl_news.id as nw_id, tbl_users.username 
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id 
WHERE tbl_news_category.user_id=$criteriaId";
    $result = mysqli_query($connection, $query);
} else {
    $query = "SELECT COUNT(tbl_news.title) as total_news,GROUP_CONCAT(DISTINCT tbl_category.cat_name SEPARATOR ',' )as category ,tbl_news.id as nw_id, tbl_users.username 
FROM tbl_news
LEFT JOIN tbl_news_category ON  tbl_news.id=tbl_news_category.news_Id
LEFT JOIN tbl_category ON  tbl_category.id=tbl_news_category.cat_id
LEFT JOIN tbl_users ON tbl_users.id=tbl_news_category.user_id 
GROUP By tbl_news_category.user_id ";
    $result = mysqli_query($connection, $query);
}


if (isset($_POST['show_button'])) {
    $criteria = $_POST['cri_news'];

    $query = "SELECT * FROM tbl_menu_news where id=" . $criteria;
    $result = mysqli_query($connection, $query);
    $user_data = mysqli_fetch_assoc($result);
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
        To('admin/show_news');
    } else {
        $_SESSION['error'] = 'Sorry data was could not be deleted';
        To('admin/show_news');
    }

}

//---------- *************DELETE***********-----------------//


//-----------------------Edit news --------------//
//
if (isset($_POST['edit_user'])) {

    $query = "SELECT * FROM tbl_news where id=" . $_POST['news_cri'];
    $result = mysqli_query($connection, $query);
    $user_data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update_info'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $criteria = $_POST['news_cri'];

    $query = "UPDATE tbl_news SET title='$title', description='$description' WHERE id=" . $criteria;

    if ($result = mysqli_query($connection, $query)) {
        $_SESSION['success'] = 'Data was  updated ';
        To('admin/show_news');
    } else {
        $_SESSION['error'] = "Data was not successfully updated";
        To('admin/show_news');
    }
}

?>

<div class="right_col" role="main">
    <div class="">
        <div class="clearfix">
            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel col">
                        <h1> <?= $title ?></h1>
                        <?= Messages() ?>
                        <table id="oldData" class="table table-bordered">
                            <tr>
                                <td>S.N</td>
                                <td>Category</td>
                                <td>Posted By</td>
                                <td>Total News</td>
                                <td>Views</td>
                            </tr>
                            <?php foreach ($result as $key => $news): ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $news['category'] ?></td>
                                    <td><?= $news['username'] ?></td>
                                    <td><?= $news['total_news'] ?></td>
                                    <td>

                                        <form action="" method="post">
                                            <input type="hidden" name="cri_news">
                                         <a href="<?=BASE_URL.'admin/show_page' ?>" class="btn btn-primary btn-xs"
                                            name="show_button">   Show News </a>
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
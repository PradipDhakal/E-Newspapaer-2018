<?php

$criteriaId = $_SESSION['user_id'];
if ($_SESSION['user_type'] != 'admin') {

    $queryData = "SELECT tbl_users.username,GROUP_CONCAT(DISTINCT tbl_category.cat_name SEPARATOR ',')as category,tbl_users.user_type,tbl_users.image FROM tbl_news_category
JOIN tbl_users on tbl_users.id=tbl_news_category.user_id
JOIN tbl_category on tbl_category.id=tbl_news_category.cat_id
WHERE tbl_news_category.user_id=". $criteriaId;
    $queryResult = mysqli_query($connection, $queryData);
} else {
    $queryData = "SELECT tbl_users.username,GROUP_CONCAT(DISTINCT tbl_category.cat_name SEPARATOR ',')as category,tbl_users.user_type,tbl_users.image FROM tbl_news_category
JOIN tbl_users on tbl_users.id=tbl_news_category.user_id
JOIN tbl_category on tbl_category.id=tbl_news_category.cat_id
GROUP BY tbl_news_category.user_id";
    $queryResult = mysqli_query($connection, $queryData);
}


$user = "SELECT COUNT(id) FROM tbl_users ";
$userResult = mysqli_query($connection, $user);

$newsData = "SELECT COUNT(news_id) FROM tbl_news_category";
$newsResult = mysqli_query($connection, $newsData);

$categoryData = "SELECT COUNT(cat_name) FROM tbl_category";
$categoryResult = mysqli_query($connection, $categoryData);

$sliderQuery = "SELECT COUNT(title) FROM tbl_slider";
$sliderResult = mysqli_query($connection, $sliderQuery);

$galleryData = "SELECT COUNT(id) FROM tbl_gallery";
$galleryResult = mysqli_query($connection, $galleryData);


?>

<div class="right_col" role="main">
    <div class="">

        <!--  ******************    COUNT *************       -->
        <div class="form-group">
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <h4>
                        <div style="margin-left:15px "><i class="fa fa-user"></i> Total Users</div>
                    </h4>
                    <?php foreach ($userResult as $result) : ?>
                        <a href="<?= BASE_URL.'admin/show_users'?>"> <div style="margin-left: 47px" class="count"><?= $result['COUNT(id)'] ?></div> </a>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <h4>
                        <div style="margin-left: 5px"><i class="fa fa-newspaper-o"></i> Total News</div>
                    </h4>
                    <?php foreach ($newsResult as $resultnews) : ?>
                        <a href="<?= BASE_URL.'admin/show_news'?>">     <div style="margin-left: 47px" class="count"><?= $resultnews['COUNT(news_id)'] ?></div> </a>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-2 col-sm-5 col-xs-5 tile_stats_count">
                    <h4>
                        <div style="margin-left: -10px"><i class="fa fa-list"></i> Total Category</div>
                    </h4>
                    <?php foreach ($categoryResult as $category) : ?>
                        <div style="margin-left: 50px" class="count"><?= $category['COUNT(cat_name)'] ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <h4>
                        <div style="margin-left: 0px"><i class="fa fa-newspaper-o"></i> Total Sliders</div>
                    </h4>
                    <?php foreach ($sliderResult as $slider) : ?>
                        <div style="margin-left: 52px" class="count"><?= $slider['COUNT(title)'] ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
                    <h4>
                         <div style="margin-left: 2px"><i class="fa fa-image"></i> Total Gallery Images</div>
                    </h4>
                    <?php foreach ($galleryResult as $gallery) : ?>
                        <div style="margin-left: 70px" class="count"><?= $gallery['COUNT(id)'] ?></div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>


        <!--    ************************   COUNT *********************        -->


        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Show all the users

                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="x_panel">
                                    <h1> <?= $title ?></h1>
                                    <?= Messages() ?>
                                    <table id="oldData" class="table table-hover">
                                        <tr>
                                            <td>S.n</td>
                                            <td>User Name</td>
                                            <td>Image</td>
                                            <td>User Type</td>
                                            <td>Category</td>
                                        </tr>
                                        <?php foreach ($queryResult as $key => $query): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $query['username'] ?></td>
                                                <td>
                                                    <img src="<?= BASE_URL . 'public/images/users/' . $query['image'] ?>"
                                                         alt="images not found" width="130">
                                                </td>
                                                <td><?= $query['user_type'] ?></td>
                                                <td><?= $query['category'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

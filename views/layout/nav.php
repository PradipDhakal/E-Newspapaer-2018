<?php

$menuQuery = "SELECT * FROM tbl_menu ORDER by  id ASC ";
$menuData = mysqli_query($connection, $menuQuery);



?>

<section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar"><span class="sr-only">Toggle navigation</span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav main_nav">
                <li class="active"><a href="<?= BASE_URL . 'home' ?>"><span class="fa fa-home desktop-home"></span><span
                                class="mobile-show">Home</span></a></li>
                    <?php foreach ($menuData as $menu_items): ?>
                    <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-expanded="false"><span> <?= $menu_items['menu_name'] ?></a>
                        <?php
                        $menu_content_query = "SELECT  tbl_submenu.*,tbl_menu_news.title FROM tbl_submenu
                        JOIN tbl_menu_news ON tbl_menu_news.id = tbl_submenu.menu_news_id where menu_id=" . $menu_items['id'];
                        $menu_content_result = mysqli_query($connection, $menu_content_query);
                        $menu_array = mysqli_fetch_array($menu_content_result);
                        $rows = mysqli_num_rows($menu_content_result);
                        ?>
                        <ul class="dropdown-menu" role="menu">
                            <?php foreach ($menu_content_result as $menu_contents): ?>
                                <li>
                                    <a href="<?= BASE_URL .'nav_page?cat_id='.$menu_contents['menu_news_id']?>" > <?= $menu_contents['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                         </ul>
                        <?php endforeach; ?>
                    <li><a href="errors">404 Page</a></li>
            </ul>
        </div>
    </nav>
</section>









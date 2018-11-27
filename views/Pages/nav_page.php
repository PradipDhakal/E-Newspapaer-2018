<?php
$asd = $_GET['cat_id'];

$query = "SELECT * from tbl_menu_news where id=" . $asd;
$queryData = mysqli_query($connection, $query);

?>

<section id="contentSection">
    <div class="row">
        <div class="col-lg-12 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_page">
                    <ol class="breadcrumb">
                        <li><a href="<?= BASE_URL . 'home' ?>"> Home </a></li>
                        <li><a href="<?= BASE_URL . '#' ?>">Technology</a></li>
                        <li class="active">Mobile</li>
                    </ol>


                    <div class="post_commentbox"><a href="#"><i class="fa fa-user"></i>Wpfreeware</a> <span><i
                                    class="fa fa-calendar"></i>6:49 AM</span> <a href="#"><i class="fa fa-tags"></i>Technology</a>
                    </div>


                    <?php foreach ($queryData

                    as $data) : ?>

                    <p>

                    <h1 style=" text-align: center">  <?= substr($data['news'], 0, 50) ?>  </h1>

                    </p>

                    <div class="single_page_content"><img class="img-center"
                                                          src="<?= BASE_URL . 'public/images/menu/' . $data['image'] ?>"
                                                          alt="img not found" style="width: 75%;height: 50% "  >

                        <p>
                            <?= $data['description'] ?>

                        </p>
                        <?php endforeach; ?>


                        <button class="btn default-btn">Default</button>
                        <button class="btn btn-red">Red Button</button>
                        <button class="btn btn-yellow">Yellow Button</button>
                        <button class="btn btn-green">Green Button</button>
                        <button class="btn btn-black">Black Button</button>
                        <button class="btn btn-orange">Orange Button</button>
                        <button class="btn btn-blue">Blue Button</button>
                        <button class="btn btn-lime">Lime Button</button>
                        <button class="btn btn-theme">Theme Button</button>
                    </div>
                    <div class="social_link">
                        <ul class="sociallink_nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>

        <nav class="nav-slit"><a class="prev" href="#"> <span class="icon-wrap"><i class="fa fa-angle-left"></i></span>
                <div>
                    <h3>City Lights</h3>
                    <img src="../images/post_img1.jpg" alt=""/></div>
            </a> <a class="next" href="#"> <span class="icon-wrap"><i class="fa fa-angle-right"></i></span>
                <div>
                    <h3>Street Hills</h3>
                    <img src="../images/post_img1.jpg" alt=""/></div>
            </a></nav>
        </aside>
    </div>
    </div>
</section>




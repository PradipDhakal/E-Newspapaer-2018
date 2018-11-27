<?php

$asd=$_GET['cat_id'];

$slider="SELECT * from tbl_slider where id=".$asd;
$sliderData = mysqli_query($connection, $slider);


$dfg="SELECT * from tbl_advertiser order by id desc limit 4";
$asdData = mysqli_query($connection, $dfg);

?>

<section id="contentSection">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9">
            <div class="left_content">
                <div class="single_page">
                    <ol class="breadcrumb">
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="#">Technology</a></li>
                        <li class="active">Mobile</li>
                    </ol>


                    <div class="post_commentbox"><a href="#"><i class="fa fa-user"></i>Wpfreeware</a> <span><i
                                    class="fa fa-calendar"></i>6:49 AM</span> <a href="#"><i class="fa fa-tags"></i>Technology</a>
                    </div>

                    <?php foreach ($sliderData as $query) : ?>

                        <p>
                            <h1>  <?= $query['title'] ?>  </h1>


                        </p>

                    <div  class="single_page_content"><img style="width: 150%; height: 10%;"    src="<?= BASE_URL . 'public/images/slider/' . $query['image_name'] ?>" alt="img not found">

                            <p>
                                <?= $query['description'] ?>

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

        <div style="margin-top: 10%" class="col-md-3">
                <div class="single_sidebar wow fadeInDown">
                    <div class="slick_slider">
                        <h2><span>Sponsor</span></h2>
                        <?php foreach ($asdData as $tyu ) : ?>
                        <a class="sideAdd" href="#"><img src="<?= BASE_URL . 'public/images/sponsers/'. $tyu['img_name'] ?>"
                                                         alt="img not found"></a></div>

              <?php endforeach;  ?>
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



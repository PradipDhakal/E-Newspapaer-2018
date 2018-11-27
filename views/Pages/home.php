<?php
$sliderQuery = "select * from tbl_slider order by id desc ";
$sliderResult = mysqli_query($connection, $sliderQuery);

$galleryQuery = "select * from tbl_gallery order by id desc limit 5 ";
$galleryData = mysqli_query($connection, $galleryQuery);


$lastinsertedQuery = "SELECT * from tbl_news order by id desc limit 4";
$lastData = mysqli_query($connection, $lastinsertedQuery);

$mostView = "SELECT * from tbl_news order by id desc limit 4";
$viewData = mysqli_query($connection, $mostView);


$popularQuery = "SELECT * from tbl_news order by id view limit 4";
$popularData = mysqli_query($connection, $popularQuery);


$galleryQuery = "select * from tbl_gallery order by id asc limit 6 ";
$galleryData = mysqli_query($connection, $galleryQuery);

$query = "SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=19";
$queryData = mysqli_query($connection, $query);

$fashionQuery = "SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=18";
$fashionData = mysqli_query($connection, $fashionQuery);

$businessQuery = "SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=20 limit 2 ";
$businessData = mysqli_query($connection, $businessQuery);


$sportsQuery = "SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=22 limit 2";
$sportsData = mysqli_query($connection, $sportsQuery);

$latestPost = "SELECT tbl_news.*,tbl_category.cat_name FROM tbl_news
    JOIN tbl_news_category ON tbl_news.id=tbl_news_category.news_id
    JOIN tbl_category ON tbl_news_category.cat_id=tbl_category.id
WHERE tbl_category.id=23 limit 3";
$latestData = mysqli_query($connection, $latestPost);


$dfg = "SELECT * from tbl_advertiser order by id desc limit 4";
$asdData = mysqli_query($connection, $dfg);

?>


<!-----------------LATEST NEWS------------->

<section id="newsSection">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="latest_newsarea"><span>Latest News</span>
                <ul id="ticker01" class="news_sticker">

                    <?php foreach ($latestData as $newsSlider) : ?>
                        <li><a href="#"><img style="width: 35px;"
                                             src="<?= BASE_URL . 'public/images/news/' . $newsSlider['image'] ?>"
                                             alt="img not found"> <?= substr($newsSlider['title'], 0, 50) ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <div class="social_area">
                    <ul class="social_nav">
                        <li class="facebook"><a href="#"></a></li>
                        <li class="twitter"><a href="#"></a></li>
                        <li class="flickr"><a href="#"></a></li>
                        <li class="pinterest"><a href="#"></a></li>
                        <li class="googleplus"><a href="#"></a></li>
                        <li class="vimeo"><a href="#"></a></li>
                        <li class="youtube"><a href="#"></a></li>
                        <li class="mail"><a href="#"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-------------SLIDER SECTION--------------->

<section id="sliderSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="slick_slider">
                <?php foreach ($sliderResult as $gallery) : ?>
                    <div class="single_iteam"><a href="">
                            <img src="<?= BASE_URL . 'public/images/slider/' . $gallery['image_name'] ?>"
                                 alt="img not found"></a>

                        <div class="slider_article">
                            <h2><a class="slider_tittle"
                                   href="<?= BASE_URL . 'slider_singlepage?cat_id=' . $gallery['id'] ?>">   <?= $gallery['title'] ?>
                                </a></h2>
                            <p>
                                <?= substr($gallery['description'], 0, 250) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-------------LATEST POST-------------->

        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="latest_post">
                <h2><span>Latest post</span></h2>
                <div class="latest_post_container">
                    <div id="prev-button"><i class="fa fa-chevron-up"></i></div>
                    <ul class="latest_postnav">


                        <?php foreach ($lastData as $last) : ?>
                            <li>
                                <div class="media"><a href=" pages/single_page.html" class="media-left"> <img
                                                alt="img not found"
                                                src=" <?= BASE_URL . 'public/images/news/' . $last['image'] ?> "> </a>
                                    <div class="media-body"><a
                                                href="<?= BASE_URL . 'single_page?cat_id=' . $last['id'] ?>"
                                                class="catg_title">
                                            <?= $last['title'] ?>
                                        </a></div>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div id="next-button"><i class="fa  fa-chevron-down"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>


<!------Business----->

<section id="contentSection">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8">
            <div class="left_content">
                <div class="single_post_content">
                    <h2><span>Business</span></h2>
                    <div class="single_post_content_left">
                        <ul class="business_catgnav  wow fadeInDown">

                            <?php foreach ($businessData

                            as $business) : ?>
                            <li>
                                <figure class="bsbig_fig"><a href=""
                                                             class="featured_img"> <img
                                                src="<?= BASE_URL . 'public/images/news/' . $business['image'] ?> "
                                                alt="img not found">
                                        <span class="overlay"></span>
                                    </a>
                                    <figcaption><a
                                                href="<?= BASE_URL . 'single_page?cat_id=' . $business['id'] ?>"> <?= $business['title'] ?>
                                        </a></figcaption>
                                    <p> <?= substr($business['description'], 0, 250) ?> </p>
                                </figure>
                            </li>

                        </ul>
                    </div>

                    <div class="single_post_content_right">
                        <ul class="spost_nav">

                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>

                <!------- FASHION  ------->

                <div class="fashion_technology_area">
                    <div class="fashion">
                        <div class="single_post_content">
                            <h2><span>Fashion</span></h2>
                            <form action="" method="post">
                                <input type="hidden" id="game_id">
                                <?php foreach ($fashionData as $fashion) : ?>
                                    <ul class="spost_nav">
                                        <li>
                                            <div class="media wow fadeInDown"><a href="pages/single_page.html"
                                                                                 class="media-left"> <img alt="" src="
                                                 <?= BASE_URL . 'public/images/news/' . $fashion['image'] ?>"> </a>
                                                <div class="media-body"><a
                                                            href="<?= BASE_URL . 'single_page?cat_id=' . $fashion['id'] ?>"
                                                            class="catg_title"><?= $fashion['title'] ?></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>


                    <!--------- TECHNOLOGY------------->

                    <div class="technology">
                        <div class="single_post_content">
                            <h2><span>Technology</span></h2>

                            <form action="" method="post">
                                <input type="hidden" id="new_id">
                                <ul class="spost_nav">
                                    <?php foreach ($queryData as $news) : ?>
                                        <li>
                                            <div class="media wow fadeInDown"><a href="<?= BASE_URL . 'single_page' ?>"
                                                                                 class="media-left"> <img
                                                            alt="img not found"
                                                            src="<?= BASE_URL . 'public/images/news/' . $news['image'] ?>">
                                                </a>
                                                <div class="media-body"><a
                                                            href="<?= BASE_URL . 'single_page?cat_id=' . $news['id'] ?>"
                                                            class="catg_title"> <?= $news['title'] ?>
                                                    </a></div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>

                <!-------    PHOTOGRAPHY    ------->

                <div class="single_post_content">
                    <h2><span>Photography</span></h2>
                    <ul class="photograph_nav  wow fadeInDown">
                        <?php foreach ($galleryData as $gallery) : ?>
                            <li>
                                <div class="photo_grid">
                                    <figure class="effect-layla"><a class="fancybox-buttons"
                                                                    data-fancybox-group="button"
                                                                    href="<?= BASE_URL . 'public/images/gallery/' . $gallery['img_name'] ?>"
                                                                    title="Photography Ttile 1"> <img
                                                    src="<?= BASE_URL . 'public/images/gallery/' . $gallery['img_name'] ?>"
                                                    alt="Img not found"/></a></figure>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!------      GAMES     ------>

                <div class="single_post_content">
                    <h2><span>Games</span></h2>
                    <ul class="business_catgnav">
                        <form action="" method="post">
                            <input type="hidden" id="new_id">
                            <?php foreach ($sportsData as $sports) : ?>
                                <li>
                                    <figure class="bsbig_fig  wow fadeInDown"><a class="featured_img"
                                                                                 href="pages/single_page.html"> <img
                                                    src="<?= BASE_URL . 'public/images/news/' . $sports['image'] ?>"
                                                    alt="img not found"> <span class="overlay"></span>
                                        </a>
                                        <figcaption><a
                                                    href="<?= BASE_URL . 'single_page?cat_id=' . $sports['id'] ?>"> <?= $sports['title'] ?>
                                            </a></figcaption>
                                        <p>
                                            <?= substr($sports['description'], 0, 250) ?>
                                        </p>
                                    </figure>
                                </li>
                            <?php endforeach; ?>
                        </form>
                    </ul>
                </div>
            </div>
        </div>

        <!----------Sponsers Post---------->


        <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="single_sidebar wow fadeInDown">
                <div class="slick_slider">
                    <div class="single_post_content">
                    <h2><span>Advertisements</span></h2>

                    <?php foreach ($asdData as $tyu) : ?>
                        <a class="sideAdd" href="#"><img
                                    src="<?= BASE_URL . 'public/images/sponsers/' . $tyu['img_name'] ?>"
                                    alt="img not found"></a>


                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>







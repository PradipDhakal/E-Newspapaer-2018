<header id="header">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_top">
                <div class="header_top_left">
                    <ul class="top_nav">
                        <li><a href="<?=BASE_URL?>">Home</a></li>
                        <li><a href="<?=BASE_URL. 'about' ?>">About</a></li>
                        <li><a href="<?=BASE_URL. 'contact' ?>">Contact</a></li>
                        <li><a href="<?=BASE_URL. 'admin/dashboard' ?>">Dashboard</a></li>
                    </ul>
                </div>
                <div class="header_top_right">
                    <p><?= date('Y-m-d') ?> </p>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="header_bottom">
                <div class="logo_area"><a href="" class="logo"><img src="<?=BASE_URL. '/public/icons/cnn1.png' ?>" alt=""></a></div>
                <div class="add_banner"><a href="#"><img src="<?=BASE_URL. '/public/icons/cnn.jpg'?>" style="height: 165px" alt=""></a></div>
            </div>
        </div>
    </div>
</header>
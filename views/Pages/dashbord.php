<div class="top-time">
    <div class="container-fluid">
        <h1>23rd June of Sunday 2012</h1>


        <div class="user-setting">
            <div class="dropdown">
                <button id="dLabel" type="button" class="btn btn-default" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Alex
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dLabel">
                    <li><a href="#!"><i class="glyphicon glyphicon-user"></i> View Profile</a></li>
                    <li><a href="#!"><i class="glyphicon glyphicon-fire"></i> Setting</a></li>
                    <li><a href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                </ul>
            </div>
        </div>

    </div>

</div><!--end of top-time-->



<div class="nav">
    <div class="nav-top">
        <img src="public_html/Assets/images/faces/1a.png">
        <h4>Alex</h4>
        <p>alex@gmail.com</p>
    </div>

    <div class="navlinks">
        <div class="search-box">
            <form>
                <input type="text" class="search" placeholder="Search">
            </form>
        </div>
        <div class="menu">
            <ul>
                <li><a href="_main_layout.php?page=dashboard"><i class="glyphicon glyphicon-cloud"> </i> Dashboard</a></li>

                <li class="drop-down"><a href=""><i class="glyphicon glyphicon-user"> </i>  Users</a>
                    <ul>
                        <li><a href="_main_layout.php?page=add-user"><i class="fa fa-plus"></i> Add User</a></li>
                        <li><a href="_main_layout.php?page=users"><i class="fa fa-user"></i> Users</a></li>
                    </ul>
                </li>

                <li><a href=""><i class="glyphicon glyphicon-ice-lolly-tasted"> </i>  Slider</a></li>

                <li class="drop-down"><a href=""><i class="glyphicon glyphicon-new-window"> </i>  News</a>
                    <ul>
                        <li><a href="_main_layout.php?page=add-news"><i class="fa fa-plus"></i> Add News</a></li>
                        <li><a href="_main_layout.php?page=add-category"><i class="fa fa-plus"></i> Add News Category</a></li>
                    </ul>
                </li>
                <li><a href=""><i class="glyphicon glyphicon-globe"> </i>  Visit Site</a></li>
                <li><a href=""><i class="glyphicon glyphicon-log-out"> </i>  Log Out</a></li>
            </ul>
        </div>
    </div>
</div><!--end of navigation-->



<!--content-->
<div class="container-fluid">

    <div class="col-md-4">
        <div class="info users-info">
            <h5><i class="fa fa-users"></i> User</h5>

            <section></section>

            <footer></footer>
        </div>
    </div>


    <div class="col-md-4">
        <div class="info news-info">
            <h5><i class="fa fa-newspaper-o"></i> News</h5>

            <section></section>

            <footer></footer>
        </div>
    </div>


    <div class="col-md-4">
        <div class="info slider-info">
            <h5><i class="fa fa-image"></i> Slider</h5>

            <section></section>

            <footer></footer>

        </div>
    </div>


    <div class="">

        <section>
            <div class="col-md-4"></div>

            <div class="col-md-8">
                <div class="chart">
                    <h5><i class="fa fa-area-chart"></i> Website Visits</h5>
                    <hr/>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </section>

    </div>

</div>



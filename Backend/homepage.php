<?php
// Include config file
require_once "config.php";
require_once "header.php";
//Define Variables
$test = "";
$username = "";
if (!isset($_SESSION)) {
    session_start();
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <!-- CSS File -->
        <link rel="stylesheet" href="styles/index.css?v=<?php echo time(); ?>" />
        <title>MeTube</title>
    </head>

    <body>
    <main>
        <div class=”side-bar”>
            <div class="nav">
                <a href="homepage.php" class="nav-link">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
                <a href="trending_video_list.php" class="nav-link">
                    <i class="material-icons">local_fire_department</i>
                    <span>Trending</span>
                </a>
                <?php 
                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                    echo ("
                <a href='subscriptions.php' class='nav-link'>
                    <i class='material-icons'>subscriptions</i>
                    <span>Subscriptions</span>
                </a>
                <a href='favorites_video_list.php' class='nav-link'>
                    <i class='material-icons'>favorite_border</i>
                    <span>Favorites</span>");
                }
                ?>
                <hr>
            </div>

            <div class="sidebar-text-categories">
                    <h4 class="sidebar-text">Categories</h4>
                </div>

                <a href="populate_video_list_category.php?link=science" class="nav-link">
                    <span>Science & Technology</span>
                </a>
                <a href="populate_video_list_category.php?link=car" class="nav-link">
                    <span>Autos & Vehicles</span>
                </a>
                <a href="populate_video_list_category.php?link=music" class="nav-link">
                    <span>Music</span>
                </a>
                <a href="populate_video_list_category.php?link=pet" class="nav-link">
                    <span>Pets & Animals</span>
                </a>
                <a href="populate_video_list_category.php?link=sport" class="nav-link">
                    <span>Sports</span>
                </a>
                <a href="populate_video_list_category.php?link=travel" class="nav-link">
                    <span>Travel & Events</span>
                </a>
                <a href="populate_video_list_category.php?link=gaming" class="nav-link">
                    <span>Gaming</span>
                </a>
                <a href="populate_video_list_category.php?link=people" class="nav-link">
                    <span>People & Blogs</span>            
                </a>
                <a href="populate_video_list_category.php?link=comedy" class="nav-link">
                    <span>Comedy</span>
                </a>
                <a href="populate_video_list_category.php?link=film" class="nav-link">
                    <span>Film & Animation</span>
                </a>
                <a href="populate_video_list_category.php?link=news" class="nav-link">
                    <span>News & Politics</span>
                </a>
                <a href="populate_video_list_category.php?link=style" class="nav-link">
                    <span>How to & Style</span>
                </a>
                <a href="populate_video_list_category.php?link=entertainment" class="nav-link">
                    <span>Entertainment</span>
                </a>
                <a href="populate_video_list_category.php?link=nonprofit" class="nav-link">
                    <span>Nonprofits & Activism</span>
                </a>
                <a href="populate_video_list_category.php?link=education" class="nav-link">
                    <span>Education</span>
                </a>
            </div>
        </div>

        <div class="content">
        <div class="videos">
            <?php include 'populate_video_list.php'; ?>
        </div>
    </div>
    </main>
    </body>
</html>
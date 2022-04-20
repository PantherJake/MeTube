<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles/index.css" />
    <title>Youtube Clone with HTML & CSS</title>
</head>

<body>
    <header class="header">
        <div class="logo left">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png"
                style="width:35px;height:20px;">
            <p style="font-weight: bold;">MeTube</p>
        </div>

        <div class="search center">
            <form action="">
                <input type="text" placeholder="Search" />
                <button><i class="material-icons">search</i></button>
            </form>
        </div>

        <div class="icons right">
            <a href="upload.html" class="material-icons">
                <i class="material-icons">videocam</i>
            </a>
            <a href="logout.php" class="material-icons">
                <i class="material-icons">videocam</i>
            </a>
            <a href="channel.html" class="material-icons display-this">
                <i class="material-icons display-this">account_circle</i>
            </a>
            
        </div>
    </header>
    <main>
        <div class=”side-bar”>

            <div class="nav">
                <a href="homepage.php" class="nav-link">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
                <a class="nav-link">
                    <i class="material-icons">local_fire_department</i>
                    <span>Trending</span>
                </a>
                <a class="nav-link">
                    <i class="material-icons">subscriptions</i>
                    <span>Subscriptions</span>
                </a>
                <hr>
            </div>

            <a class="nav-link">
                <i class="material-icons">library_add_check</i>
                <span>Library</span>
            </a>
            <a class="nav-link">
                <i class="material-icons">history</i>
                <span>History</span>
            </a>
            <a class="nav-link">
                <i class="material-icons">play_arrow</i>
                <span>Your Videos</span>
            </a>
            <a class="nav-link">
                <i class="material-icons">thumb_up</i>
                <span>Liked Videos</span>
            </a>

        </div>
        <div class="content">

            
            <div class="videos">

                <?php include 'populate_video_list.php';?>
                <!-- a video starts 
                <div class="video">
                    <div class="thumbnail">
                        <a href="">
                            <img src="http://d1jnx9ba8s6j9r.cloudfront.net/blog/wp-content/uploads/2019/10/Database-Management-System.jpg"
                            alt="" />
                        </a>
                    </div>
                    <div class="details">
                        <div class="author">
                            <a href="">
                                <img src="https://people.cs.clemson.edu/~jzwang/images/wang.jpg" alt="" />
                            </a>
                        </div>
                        <div class="title">
                            <a href="" class="title-content">
                                <h3>Database Management System</h3>
                            </a>
                            <a href="" class="author-profile">
                                Zijun Wang
                            </a>
                            <a class="video-details">
                                <span> 0 Views • 3 Months Ago </span>
                            </a>
                        </div>
                    </div>
                </div>
                 a video Ends -->

                 


            </div>

        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
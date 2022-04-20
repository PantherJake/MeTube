<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles/channel.css" />
    <title>Youtube Clone with HTML & CSS</title>
</head>

<body>
    <header class="header">
        <div class="logo left">
            <i id="menu" class="material-icons">menu</i>
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
                <?php
                    include_once 'config.php';
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        echo "<a href='upload.php' class='material-icons'>";
                        echo "<i class='material-icons'>videocam</i>";
                        echo "</a>";
                        echo "<a href='logout.php' class='material-icons'>";
                        echo "<i class='material-icons'>logout</i>";
                        echo "</a>";
                        echo "<a href='channel.php' class='material-icons display-this'>";
                        echo "<i class='material-icons display-this'>account_circle</i>";
                        echo "</a>";
                    }
                    else{
                        echo "<a href='upload.php' class='material-icons'>";
                        echo "<i class='material-icons'>videocam</i>";
                        echo "</a>";
                        echo "<a href='login.php' class='material-icons'>";
                        echo "<i class='material-icons'>login</i>";
                        echo "</a>";
                        echo "<a href='login.php' class='material-icons display-this'>";
                        echo "<i class='material-icons display-this'>perm_identity</i>";
                        echo "</a>";
                    }
                ?>
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
                    <i class="material-icons">subscriptions</i>
                    <span>Subscriptions</span>
                </a>
                <hr>

                <div class="sidebar-text-categories">
                    <h4 class="sidebar-text">Categories</h4>
                </div>

                <a class="nav-link">
                    <span>Science & Technology</span>
                </a>
                <a class="nav-link">
                    <span>Autos & Vehicles</span>
                </a>
                <a class="nav-link">
                    <span>Music</span>
                </a>
                <a class="nav-link">
                    <span>Pets & Animals</span>
                </a>
                <a class="nav-link">
                    <span>Sports</span>
                </a>
                <a class="nav-link">
                    <span>Travel & Events</span>
                </a>
                <a class="nav-link">
                    <span>Gamin</span>
                </a>
                <a class="nav-link">
                    <span>People & Blogs</span>            
                </a>
                <a class="nav-link">
                    <span>Comedy</span>
                </a>
                <a class="nav-link">
                    <span>Film & Animation</span>
                </a>
                <a class="nav-link">
                    <span>News & Politics</span>
                </a>
                <a class="nav-link">
                    <span>How to & Style</span>
                </a>
                <a class="nav-link">
                    <span>Entertainment</span>
                </a>
                <a class="nav-link">
                    <span>Nonprofits & Activism</span>
                </a>
                <a class="nav-link">
                    <span>Education</span>
                </a>
            </div>
        </div>
        <div class="content">

            <div class="content-header">
                <div class="upper-header">
                    <div class="profile">
                        <div class="user">
                            <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj"
                                alt="" />
                        </div>
                        <div class="user-description">
                            <h3>
                                <?php 
                                include_once 'config.php';
                                echo $_SESSION['username'];
                                 ?>
                            </h3>
                            <span> No Subscribers </span>
                        </div>
                    </div>

                    <div class="options">
                        <a href="upload.php">
                            <button>Upload Video</button>
                        </a>

                    </div>
                </div>
                
                <div class="tabs">
                    <button >HOME</button>
                    <button >VIDEOS</button>
                    <button >PLAYLISTS</button>
                    <button >CHANNELS</button>
                </div>


            </div>

            <div class="content-videos">

            </div>

        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
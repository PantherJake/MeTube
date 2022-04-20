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
        <a href="homepage.php" style="text-decoration: none; color: black;">
            <div class="logo left">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png" style="width:35px;height:20px;">
                <p style="font-weight: bold;">MeTube</p>
            </div>
        </a>

        <div class="search center">
            <form action="">
                <input type="text" placeholder="Search" />
                <button><i class="material-icons">search</i></button>
            </form>
        </div>

        <div class="icons right">
            <a href="upload.php" title="Message" class="material-icons">
                <i class="material-icons">chat</i>
            </a>
            <a href="upload.php" title="Upload" class="material-icons">
                <i class="material-icons">upload</i>
            </a>
            <a href="logout.php" title="Log out" class="material-icons">
                <i class="material-icons">logout</i>
            </a>
            <a href="channel.html" title="Profile" class="material-icons display-this">
                <i class="material-icons display-this">account_circle</i>
            </a>

        </div>
    </header>
    <main>
        <div class=”side-bar”>

            <div class="nav">
                <a class="nav-link active">
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
                <i class="material-icons">watch_later</i>
                <span>Watch Later</span>
            </a>
            <a class="nav-link">
                <i class="material-icons">thumb_up</i>
                <span>Liked Videos</span>
            </a>

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
                        <a href="upload.html">
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
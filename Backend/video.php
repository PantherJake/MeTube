<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles/video.css" />
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
                        echo "<a href='profile.php' class='material-icons display-this'>";
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
        <div class="content">
            <div class="video-player">
                <video width="70%" height="auto" controls controlsList="nodownload">
                    <source src="videos/a5399e4c92d0c21347c7c8a7aeffd81614079b6734a07ec1fd751af762181fbe/Title.mp4" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
            </div>
            <div class="video-header">
                <div class="video-title">
                    <p>
                        Just a random video I posted for testing purpose
                    </p>
                </div>
                <div class="video-options">
                    <?php
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        echo "<a href='videos/a5399e4c92d0c21347c7c8a7aeffd81614079b6734a07ec1fd751af762181fbe/Title.mp4' style='color:black; text-decoration: none;' class='video-option' download>";
                        echo "<span class='material-icons'>";
                        echo "file_download";
                        echo "</span>";
                        echo "Download";
                        echo "</a>";
                        echo "<a href='videos/a5399e4c92d0c21347c7c8a7aeffd81614079b6734a07ec1fd751af762181fbe/Title.mp4' style='color:black; text-decoration: none;' class='video-option' download>";
                        echo "<span class='material-icons'>";
                        echo "playlist_add";
                        echo "</span>";
                        echo "Save";
                        echo "</a>";
                    }
                    ?>  
                </div>

                <hr>

                <div class="profile">
                    <div class="user">
                        <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj"
                            alt="" />
                    </div>
                    <div class="user-description">
                        <h3>
                            Francesco Ciulla
                        </h3>
                        <br>
                        <p><b>Description: </b> This is the description</p>
                        <p><b>Category: </b> Education</p>
                        <p><b>Keywords: </b> None</p>
                        <p><b>Date: </b> None</p>
                    </div>
                </div>

                <hr>
            </div>

            <div class="comment-section">
                <h3>Comments</h3>
                <br>
                <div class="user-comment">
                    <div class="user">
                        <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj"
                            alt="" />
                    </div>

                    <textarea></textarea>
                </div>
            </div>
        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
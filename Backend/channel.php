<?php
// Include config file
require_once "config.php";
require_once "header.php";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"])) {
    header("location: login.php");
    exit;
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
        <link rel="stylesheet" href="styles/channel.css" />
        <title>Youtube Clone with HTML & CSS</title>
    </head>

    <body>
    <main>
    <div class="content">
        <div class="content-header">
            <div class="upper-header">
                <div class="profile">
                    <div class="user">
                        <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj" alt="" />
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
                <button>HOME</button>
                <button>VIDEOS</button>
                <button>PLAYLISTS</button>
                <button>CHANNELS</button>
            </div>


        </div>
        <div class="content-videos">
        </div>
    </div>
</main>
<!-- Main Body Ends -->
</body>

</html>
<?php
include_once 'config.php';
include_once 'header.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles/video.css" />
    <title>MeTube</title>
</head>

<body>
    <main>
        <div class="content">
            <div class="video-player">
                <video width="70%" height="auto" controls controlsList="nodownload">
                    <?php
                    $link = $_GET['link'];
                    $query = "SELECT * FROM video WHERE video_id = '$link'";
                    $result = mysqli_query($con,$query);
                    if (is_object($result)) {
                        if ($result->num_rows === 1) {
                            $row = $result->fetch_assoc();
                            echo "<source src=\""."videos/".$_GET['link']."/".$row['title'].".".$row['video_extension']."\""." type=\"video/mp4\">";
                            $new_view = $row['view_count'] + 1;
                            $query = "UPDATE video SET view_count = '$new_view' WHERE video_id = '$link'";
                            $result = mysqli_query($con,$query);
                        }
                        else{
                            echo "Invalid video id";
                        }
                    }
                    else{
                        echo "Error when attempting to access video";
                    }

                    ?>
                    Your browser does not support HTML video.
                </video>
            </div>
            <div class="video-header">
                    <?php
                    $link = $_GET['link'];
                    $query = "SELECT * FROM video WHERE video_id = '$link'";
                    $result = mysqli_query($con,$query);
                    if (is_object($result)) {
                        if ($result->num_rows === 1) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            echo "<div class=\"video-title\">";
                            echo "<p>";
                            echo $row['title'];
                            echo "</p>";
                            echo "</div>";
                            echo "<div class=\"video-options\">";
                            if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                                echo "<a href='videos/".$_GET['link']."/".$row['title'].".".$row['video_extension']."' style='color:black; text-decoration: none;' class='video-option' download>";
                                echo "<span class='material-icons'>";
                                echo "file_download";
                                echo "</span>";
                                echo "Download";
                                echo "</a>";
                                echo "<a href='add_to_favorites.php?link=".$_GET['link']."' style='color:black; text-decoration: none;' class='video-option'>";
                                echo "<span class='material-icons'>";
                                echo "playlist_add";
                                echo "</span>";
                                echo "Add to Favorites!";
                                echo "</a>";
                            }
                        }
                        else{
                            echo "Invalid video id";
                        }
                    }
                    else{
                        echo "Error when attempting to access video";
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
                    <?php

                    $link = $_GET['link'];
                    $query = "SELECT * FROM video WHERE video_id = '$link'";
                    $result = mysqli_query($con,$query);
                    if (is_object($result)) {
                        if ($result->num_rows === 1) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            echo "<h3>";
                            echo $row['username'];
                            echo "</h3>";
                            echo "<br>";
                            echo "<p><b>Description: </b>".$row['description']."</p>";
                            echo "<p><b>Category: </b>".$row['category']."</p>";
                            echo "<p><b>Keywords: </b>".$row['keywords']."</p>";
                            echo "<p><b>Upload Date: </b>".$row['upload_date']."</p>";
                            echo "<p><b>View Count: </b>".$row['view_count']."</p>";
                        }
                        else{
                            echo "Invalid video id";
                        }
                    }
                    else{
                        echo "Error when attempting to access video";
                    }

                        
                    ?>
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
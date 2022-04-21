<?php
// Include config file
require_once "config.php";
include_once 'header.php';
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['current_reply'] = 0;

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"])) {
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$receiver = $message = "";
$receiver_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate message

    $_SESSION['current_reply'] = $_POST["comment_id"];

    if (empty(trim($_POST["content"]))) {
        $message_err = "Please enter a message.";
    } elseif (strlen(trim($_POST["content"])) > 1000) {
        $message_err = "Message cannot be greater than 1000 characters.";
    } else {
        $message = trim($_POST["content"]);
    }

    // Check input errors before inserting in database
    if (empty($receiver_err) && empty($message_err)) {

        // Prepare an insert statement
        echo "hey we made it here";
        $sql = "INSERT INTO reply (comment_id, video_id, username, content) VALUES (?, ?, ?,?)";

        if ($stmt = mysqli_prepare($con, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $param_commentid, $param_videoid, $param_username, $param_content);
            // Set parameters
            $param_commentid = $_POST["comment_id"];
            $param_videoid = $link;
            $param_username = $_SESSION["username"];
            $param_content = $_POST["content"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                //$_SESSION['loggedin'] = true;
                header("location: video.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "this...";
        }
    }

    // Close connection
    //mysqli_close($con);
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
    <link rel="stylesheet" href="styles/video.css" />
    <title>Youtube Clone with HTML & CSS</title>
</head>

<body>
    <main>
        <div class="content">
            <div class="video-player">
                <video width="70%" height="auto" controls controlsList="nodownload">
                    <?php
                    $link = $_GET['link'];
                    $query = "SELECT * FROM video WHERE video_id = '$link'";
                    $result = mysqli_query($con, $query);
                    if (is_object($result)) {
                        if ($result->num_rows === 1) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            echo "<source src=\"" . "videos/" . $_GET['link'] . "/" . $row['title'] . "." . $row['video_extension'] . "\"" . " type=\"video/mp4\">";
                        } else {
                            echo "Invalid video id";
                        }
                    } else {
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
                $result = mysqli_query($con, $query);
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
                        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                            echo "<a href='videos/" . $_GET['link'] . "/" . $row['title'] . "." . $row['video_extension'] . "' style='color:black; text-decoration: none;' class='video-option' download>";
                            echo "<span class='material-icons'>";
                            echo "file_download";
                            echo "</span>";
                            echo "Download";
                            echo "</a>";
                            echo "<a href='videos/" . $_GET['link'] . "/" . $row['title'] . "." . $row['video_extension'] . "' style='color:black; text-decoration: none;' class='video-option' download>";
                            echo "<span class='material-icons'>";
                            echo "playlist_add";
                            echo "</span>";
                            echo "Save";
                            echo "</a>";
                        }
                    } else {
                        echo "Invalid video id";
                    }
                } else {
                    echo "Error when attempting to access video";
                }
                ?>
            </div>

            <hr>

            <div class="profile">
                <div class="user">
                    <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj" alt="" />
                </div>
                <div class="user-description">
                    <?php

                    $link = $_GET['link'];
                    $query = "SELECT * FROM video WHERE video_id = '$link'";
                    $result = mysqli_query($con, $query);
                    if (is_object($result)) {
                        if ($result->num_rows === 1) {
                            // output data of each row
                            $row = $result->fetch_assoc();
                            echo "<h3>";
                            echo $row['username'];
                            echo "</h3>";
                            echo "<br>";
                            echo "<p><b>Description: </b>" . $row['description'] . "</p>";
                            echo "<p><b>Category: </b>" . $row['category'] . "</p>";
                            echo "<p><b>Keywords: </b>" . $row['keywords'] . "</p>";
                            echo "<p><b>Upload Date: </b>" . $row['upload_date'] . "</p>";
                        } else {
                            echo "Invalid video id";
                        }
                    } else {
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
                    <img src="https://yt3.ggpht.com/bpzY-S4DYlbTeOpY5hIA7qz_hcbMkgvLAugtwKBGTTImNnWAGudX0y53bo_fJZ0auypxrWkUiw=s88-c-k-c0x00ffffff-no-rj" alt="" />
                </div>

                <?php
                $sql = "SELECT * FROM comment";
                if ($result = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['video_id'] == $link) {
                                echo "<div class='comments'>";
                                echo "<button id='reply' onclick='reply(this);'  value= {$row['comment_id']} name='comment_id'> Reply </button>";
                                echo "<h3> Commenter: " . $row['username'] . "</h3>";
                                echo "<br>";
                                echo "<p>" . $row['content'] . "</h5>";
                                echo "</div>";
                                $replies = "SELECT * FROM subcomment";
                                if ($reply_result = mysqli_query($con, $replies)) {
                                    if (mysqli_num_rows($reply_result) > 0) {
                                        while ($reply_row = mysqli_fetch_array($reply_result)) {
                                            if ($reply_row['comment_id'] == $row['comment_id']) {
                                                echo "<div class='inbox-message reply'>";
                                                echo "<button id='reply' onclick='reply(this);'  value= {$row['comment_id']} name='comment_id'> Reply </button>";
                                                echo "<h3> Replier: " . $reply_row['username'] . "</h3>";
                                                echo "<br>";
                                                echo "<p>" . $reply_row['content'] . "</h5>";
                                                echo "</div>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "No message found";
                    }
                }
                // Close connection
                //mysqli_close($con);
                ?>
            </div>
        </div>
        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
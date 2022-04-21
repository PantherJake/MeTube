<?php

include_once 'config.php';

if(isset($_SESSION["loggedin"])) {
    $username = $_SESSION['username'];
    $video_id = $_GET['link'];

    $good_to_add = 1;

    $query = "SELECT * FROM favorite WHERE username = '$username'";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "videoId: ".$row['video_id']."<br>";
            echo "videoId: ".$video_id."<br>";
            echo "username: " . $username;
            if($row['video_id'] === $video_id){
                $good_to_add = 0;
            }
        }
    }
    if($good_to_add === 1){
        $query = "INSERT INTO favorite SET `username` = '$username', `video_id` = '$video_id'";
        mysqli_query($con,$query);
    }
    header("location: video.php?link=".$video_id); 
}


?>
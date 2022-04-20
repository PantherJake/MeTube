<?php

include_once 'config.php';
require_once ('getID3-master/getid3/getid3.php');

$uploadOk = 1;

if(isset($_POST['submit'])){

    /* Run simple checks to ensure the files are suitable */

    // Capping the videos at 2GB in size
    if ($_FILES['userfile']['size'] > 2147483648){
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Limits on video upload types

    // Limits on thumbnail image upload types

    /* Parse the data from the input video file */

    $getID3_video = new getID3();

    $video_file_info = $getID3_video->analyze($_FILES['userfile']['tmp_name']);
    $video_file_name = $_FILES['userfile']['tmp_name'];

    $video_length = $video_file_info['playtime_string'];
    $video_upload_date = date("Y-m-d h:i:s");
    $video_title = $_POST['title'];//grab this from form
    $video_id = hash("sha256", $video_title.$video_length.$video_upload_date); //sha256 hash of video title, video length, upload date
    $video_category = $_POST['category'];//grab this from form
    $video_comment_count = 0;
    $video_description = $_POST['var_1'];//grab this from form
    $video_rating = 0;
    $video_view_count = 0;
    $video_keywords = $_POST['keywords'];

    $video_size = $_FILES['userfile']['size'];
    $thumbnail_size = $_FILES['thumbnail']['size'];

    $video_file_type = strtolower(pathinfo($_FILES['userfile']['name'],PATHINFO_EXTENSION));
    $thumbnail_file_type = strtolower(pathinfo($_FILES['thumbnail']['name'],PATHINFO_EXTENSION));

    $video_origname = $_FILES["userfile"]["name"];
    $thumbnail_origname = $_FILES["thumbnail"]["name"];

    //echo "DURATION: " . $video_length . ",<br>length: hard_code,<br> upload date: " . $video_upload_date . ", <br>title: " .  $video_title . ",<br> video id: " . $video_id . ",<br> category: " . $video_category . ",<br> desc: " . $video_description;

}

//2. upload files to the webapp
//3. store the paths in SQL


/* Uploading files to directory and storing information in SQL Database */

// Store every video/thumbnail in a directory that is named by their hash
$target_dir = "videos/" . $video_id . "/";

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "There was an issue uploading your file.";
  // if everything is ok, try to upload file
  } else {
    @mkdir($target_dir, 0777, true);
    //echo $target_dir . $video_title . "." . $video_file_type . "<br>" . $target_dir . $video_title . '_thumbnail.' . $thumbnail_file_type;
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target_dir.$video_title.".".$video_file_type) && move_uploaded_file($_FILES['thumbnail']['tmp_name'], $target_dir.$video_title.'_thumbnail.'.$thumbnail_file_type)) {

      $query = "INSERT INTO video (video_id, length, upload_date, category, title, comment_count, description, rating, view_count, keywords, thumbnail_extension) VALUES ('$video_id','$video_length','$video_upload_date','$video_category','$video_title','$video_comment_count','$video_description','$video_rating','$video_view_count','$video_keywords','$thumbnail_file_type')";
      $result=mysqli_query($con, $query) or die(mysqli_error($con));
      //echo "\n".$result."\n";
      mysqli_close($con);
    } else {
      @rmdir ($target_dir, 0777, true);
      echo "Sorry, there was an error uploading your file.";
    }
  }

  /* Redirect back to the user page screen */

  header("Location: homepage.html");
  exit();
  
?>


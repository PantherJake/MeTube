<?php
include_once 'config.php';
include_once 'header.php';

$query = "SELECT * FROM video";
$result = mysqli_query($con,$query);

if (is_object($result)) {
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            //echo "id: " . $row["video_id"]. " - Name: " . $row["length"]. " " . $row["keywords"]. "<br>";
            if($row['category'] === $_GET['link']){
                echo "<div class='video'>";
                echo "<div class='thumbnail'>";
                echo "<a href='video.php?link=".$row['video_id']."'>";
                echo "<img src='videos/".$row["video_id"]."/".$row['title']."_thumbnail.".$row['thumbnail_extension']."'";
                echo "alt='' />";
                echo "</a>";
                echo "</div>";
                echo "<div class='details'>";
                echo "<div class='author'>";
                echo "<a href='video.php?link=".$row['video_id']."'>";
                echo "<img src='https://people.cs.clemson.edu/~jzwang/images/wang.jpg' alt='' />";
                echo "</a>";
                echo "</div>";
                echo "<div class='title'>";
                echo "<a href='video.php?link=".$row['video_id']."' class='title-content'>";
                echo "<h3>".$row['title']."</h3>";
                echo "</a>";
                echo "<a href='video.php?link=".$row['video_id']."' class='author-profile'>";
                echo $row['username'];
                echo "</a>";
                echo "<a class='video-details'>";
                echo "<span>".$row['view_count']." Views</span>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    } 
    else {
    echo "0 results";
    }
}
else {
    echo "0 results";
}

mysqli_close($con);
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
</body>
</html>

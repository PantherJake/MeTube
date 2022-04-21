<?php
include_once 'config.php';

$query = "SELECT * FROM video";
$result = mysqli_query($con,$query);

if (is_object($result)) {
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            //echo "id: " . $row["video_id"]. " - Name: " . $row["length"]. " " . $row["keywords"]. "<br>";

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
    } else {
        echo "0 results";
    }
}
else {
    echo "0 results";
}

mysqli_close($con);
?>
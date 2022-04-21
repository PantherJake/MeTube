
<?php
include_once 'config.php';
include_once 'header.php';

$user = $_SESSION['username'];
$query = "SELECT * FROM favorite WHERE username = '$user'";
$result = mysqli_query($con,$query);
$none = 1;
if (is_object($result)) {
    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()){
        $posts[] = $row;
        }

        $query2 = "SELECT * FROM video";
        $result2 = mysqli_query($con,$query2);
            
            if (is_object($result2)) {
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()){
                        foreach ($posts as $row){
                            foreach ($row as $element){
                                if($element === $row2['video_id']){
                                    //echo "id: " . $row["video_id"]. " - Name: " . $row["length"]. " " . $row["keywords"]. "<br>";
                                    $none = 0;
                                    echo "<div class='video'>";
                                    echo "<div class='thumbnail'>";
                                    echo "<a href=''>";
                                    echo "<img src='videos/".$row2["video_id"]."/".$row2['title']."_thumbnail.".$row2['thumbnail_extension']."'";
                                    echo "alt='' />";
                                    echo "</a>";
                                    echo "</div>";
                                    echo "<div class='details'>";
                                    echo "<div class='author'>";
                                    echo "<a href=''>";
                                    echo "<img src='https://people.cs.clemson.edu/~jzwang/images/wang.jpg' alt='' />";
                                    echo "</a>";
                                    echo "</div>";
                                    echo "<div class='title'>";
                                    echo "<a href='' class='title-content'>";
                                    echo "<h3>".$row2['title']."</h3>";
                                    echo "</a>";
                                    echo "<a href='' class='author-profile'>";
                                    echo "Zijun Wang";
                                    echo "</a>";
                                    echo "<a class='video-details'>";
                                    echo "<span>".$row2['view_count']." Views</span>";
                                    echo "</a>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            }
                        }
                    }
                    if($none === 1){
                        echo "0 results";
                    }
        } else {
             echo "0 results";
        }
    }
    else {
        echo "0 results";
    }
}
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
    <link rel="stylesheet" href="styles/index.css?v=<?php echo time(); ?>" />
    <title>Youtube Clone with HTML & CSS</title>
</head>
<body>
</body>
</html>
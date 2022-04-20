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

<?php 
include_once 'config.php';
include_once 'header.php';

$query = "SELECT subscriptions FROM user WHERE user_id = ".$_SESSION['id'];
$result = mysqli_query($con,$query);

if (is_object($result)) {
    if($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {

        echo "<div class='profile'>";
        }
    }
    else {
        echo "0 results";
    }
}
else {
    echo "0 results";
}
?>

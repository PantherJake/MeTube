<?php
include_once 'config.php';
include_once 'header.php';

$playlist = $playlist_err = "";

// List playlists when selected
$query = "SELECT playlists FROM channel";
$result = mysqli_query($con,$query);

if (is_object($result)) {
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        }
    }
    else {
        echo "0 results.";
    }
}
else {
     echo "0 results.";   
}

// Create Playlist
function create_p() {
    if(!empty($_POST['playlist_name']) && isset($_POST['playlist_name'])) {
        $sql = "INSERT INTO playlist (playlist_name) VALUES (?)";
        echo "Hello";

        if($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = $_POST["playlist_name"];
            if(mysqli_stmt_execute($stmt)) {
                header("location: channel.php");
            }

            if($stmt->num_rows > 0) {
                echo $_POST['playlist_name']." is already a playlist.";
            }
        }
    }
    else {
        echo "Please enter a valid playlist.";
    }
}

// Delete Playlist
function delete_p() { 
    if(!empty($_POST['playlist_name']) && isset($_POST['playlist_name'])) {
        $sql = "DELETE from playlist WHERE playlist_name = ?";

        if($stmt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            $param_name = $_POST["playlist_name"];
            if(mysqli_stmt_execute($stmt)) {
                header("location: channel.php");
            }
            elseif($stmt->num_rows < 1) {
                echo $_POST['playlist_name']." is not a valid playlist";
            }
        }
    }
    else {
        echo "Please enter a valid playlist.";
    }
}

// Modify Playlist
function modify_p() {

}

// User redirected to how they want their playlist to change
if(isset($_GET['link'])) {
    if($_GET['link'] == 1) create_p();
    elseif($_GET['link'] == 2) modify_p();
    elseif($_GET['link'] == 3) delete_p();
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
    <title>MeTube</title>
</head>

<body>
<main>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-item-playlist">
            <a>
                <input type="text" value="Create Playlist" id="create" <?php echo (!empty($playlist_err)) ? 'is-invalid' : ''; ?>>
            </a>
            <a href="playlist_list.php?link=1">
                <input type="button" value="Create Playlist" id="create" <?php echo (!empty($playlist_err)) ? 'is-invalid' : ''; ?>>
            </a>
            <a href="playlist_list.php?link=2">
                <input type="button" value="Modify Playlist" id="modify" <?php echo (!empty($playlist_err)) ? 'is-invalid' : ''; ?>>
            </a>
            <a href="playlist_list.php?link=3">
                <input type="button" value="Delete Playlist" id="delete" <?php echo (!empty($playlist_err)) ? 'is-invalid' : ''; ?>>
            </a>
        </div>
    </main>
</body>
</html>

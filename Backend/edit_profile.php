<?php

// Include config file
require_once "config.php";
require_once "header.php";

// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$new_password = $confirm_password = $username = "";
$new_password_err = $confirm_password_err = $username_err = $old_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have at least 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    //validate non-existing username and old password matching
    if(trim($_POST['username']) !== ""){
        $user_query = $_POST['username'];
        $query = "SELECT username,password FROM user WHERE username = '$user_query'";
        $result = mysqli_query($con,$query);
        if (is_object($result)) {
            if ($result->num_rows === 1) {
                // output data of each row
                $row = $result->fetch_assoc();

                $username_error = "user: ". $row['username'];
                if($row['username'] === $_SESSION['username']){
                    //user is entering the same password they already had
                } 
                else{
                    $username_err = "This username is already taken.";
                    $username = trim($_POST["username"]);
                }

                if(!password_verify($new_password, $row['password'])){
                    $old_password_err = "Incorrect password: " . $row['password'];
                    //$new_password_err = password_hash($new_password, PASSWORD_DEFAULT);
                }
            } 
        }
    }else{
        $username_err = "please enter your original username if you do not want to change it";
    }

    

    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err) && empty($username_err)){
        // Prepare an update statement
        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
        $param_username = $_POST['username'];
        $old_username = $_SESSION['username'];
        $query = "UPDATE user SET password = '$param_password', username = '$param_username' WHERE username = '$old_username'";
        if(mysqli_query($con, $query)){
            echo "HERE";
            $_SESSION['username'] = $param_username;
            $query = "UPDATE video SET username = '$param_username' WHERE username = '$old_username'";
            echo $query;
            echo mysqli_query($con, $query) . " hey";
            header("location: homepage.php");
        }
        else{
            echo mysqli_query($con, $query);
        }
    }
    
    // Close connection
    mysqli_close($con);
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
        <title>MeTube</title>
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
                <a href="homepage.php">
                    <button>HOME</button>
                </a>
                <a href="my_uploads.php">
                    <button>VIDEOS</button>
                </a>
                <a href="playlist_list.php">
                    <button>PLAYLISTS</button>
                </a>
                <a href="edit_profile.php">
                    <button>Edit Profile</button>
                </a>
            </div>
        </div>
        <div class="content-videos">
            <div class="content">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                    <div style="margin-top:40px;">
                        <h3>Edit Profile Picture</h3>
                        <div style="margin-top:10px;">
                            <label>
                                <input type="file" name="userfile" id="userfile" accept="image/*" />
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:30px;">
                        <h3>Change username</h3>
                        <div style="margin-top:10px;">
                            <label>
                                <input type="text" name="username" id="username" placeholder="Enter Username" />
                                <span class="invalid-feedback"><?php echo $username_err; ?></span>
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:30px;">
                        <h3>Change password</h3>
                        <div style="margin-top:10px;">
                            <label>
                                <input type="password" name="new_password" id="new_password" placeholder="Enter Password"/>
                                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:30px;">
                        <h3>Confirm new password</h3>
                        <div style="margin-top:10px;">
                            <label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Enter Password"/>
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:30px;">
                        <h3>Confirm current password to make changes</h3>
                        <div style="margin-top:10px;">
                            <label>
                                <input type="password" name="old_password" id="old_password" placeholder="Confirm Password" required/>
                                <span class="invalid-feedback"><?php echo $old_password_err; ?></span>
                            </label>
                        </div>
                    </div>

                    <div style="margin-top:30px;">
                        <input type="submit" value="Make Changes" class="upload-button" name="submit">
                    <div>
            </form>
            </div>
        </div>
    </div>
</main>
        
<!-- Main Body Ends -->
</body>
</html>
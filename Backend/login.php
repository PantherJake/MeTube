<?php
require_once "config.php";

$email = $password = "";
$email_err = $password_err = "";

// Ensures a successful login obtains the users 'userID'
// $session_user_id = "";

if($_SERVER["REQUEST_METHOD"] == "GET") {

    // Validate email entry
    if(empty(trim($_GET["email"]))) {
        $email_err = "Please enter a valid email";
    }
    else {
        $sql = "SELECT userID FROM User WHERE email = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_GET["email"]);

            // Attempt to execute the SELECT statement
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                // If there is NOT a row with a value for user input 'email'
                if(mysqli_stmt_num_rows($stmt) != 1) {
                    $email_err = "No account associated with this email.";
                }
                else {
                    $email = trim($_GET["email"]);
                }
            }
            else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        
    }

    // Validate password entry
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a valid password.";     
    }
    else {
        $sql = "SELECT userID FROM User WHERE email = ".$email." AND password = ?";

        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_password);
            $param_password = trim($_GET["password"]);

            // Attempt to execute the SELECT statement
            if(mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                // If there is NOT a row with a value for user input 'password'
                if(mysqli_stmt_num_rows($stmt) != 1) {
                    $password_err = "Password incorrect.";
                }
                else {
                    $password = trim($_GET["email"]);
                }
            }
            else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if(empty($email_err) && empty($password_err)) {
        header("location: homepage.php");
    }
}
?>

<DOCTYPE! html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page </title>
    <link rel="stylesheet" href="styles/signup.css" />
</head>

<body>

    <div class="container">
        <div class="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png"
                style="width:88px;height:50px;">
            <p style="font-weight: bold; font-size:2em;">MeTube</p>
        </div>

        <form action="">

            <div class="form-item">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-item">
                <!-- add a password format display -->
                <span class="pwd-format">
                    8-15 AlphaNumeric Characters
                </span>
                <input type="password" name="password" id="password" placeholder="Enter password">
            </div>

            <div class="form-btns">
                <button class="signup" type="submit">Login</button>
                <div class="options">
                    Don't have an account? <a href="#">Sign up here</a>
                </div>
            </div>

        </form>
    </div>
</body>

</html>
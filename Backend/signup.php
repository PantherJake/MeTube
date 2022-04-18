<?php
require_once "config.php";

$first_name = $last_name = $password = $email = $confirm_password = "";
$first_name_err = $last_name_err = $password_err = $email_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first name
    if(empty(trim($_POST["first_name"]))){
        $username_err = "Please enter a valid first name.";
    } 
    elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["first_name"]))){
        $username_err = "First name can only contain letters";
    }

    //Validate last name
    if(empty(trim($_POST["last_name"]))){
        $username_err = "Please enter a valid last name.";
    } 
    elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["last_name"]))){
        $username_err = "Last name can only contain letters";
    }

    // Validate email
    if(empty(trim($_POST["email"]))) {
        $email_err = "Please enter a valid email.";
    }
    elseif(!strchr(trim($_POST["email"]), '@')){
        $email_err = "Email invalid, try again.";
    }

    // Search for copy of email
    else{
        $sql = "SELECT userID FROM User WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the SELECT statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                // If there is a row with user input 'email'
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already being used.";
                } 
                else{
                    $email_conf = "Check your email for confirmation.";
                    $msg = "Your email has been successfully confirmed,\nWelcome to MeTube";
                    mail($email, "Confirmation Email", $msg);
                    $email = trim($_POST["email"]);
                }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a valid password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Password must have at least 8 characters.";
    } 
    elseif(strlen(trim($_POST["password"])) > 15){
        $password_err = "Password must have at most 15 characters.";
    } 
    else{
        $password = trim($_POST["password"]);
    }
        
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";     
    } 
    elseif($password != $confirm_password) {
        $confirm_password_err = "Password did not match.";
    } 
    else {
        $confirm_password = trim($_POST["confirm_password"]);
    }

    // Confirm no errors in user input
    if(empty($first_name_err) && empty($last_name_err) && empty($email_err) 
        && empty($password_err) && empty($confirm_password_err)) {

        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
                
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
                
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                header("location: login.php");
            }
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }

}
?>

<!DOCTYPE html>
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
            <p style="font-weight: bold; font-size: large;">Join MeTube Today!</p>
        </div>

        <form action="">
            <div class="form-item-username">
                <input type="text" name="firstName" id="firstName" placeholder="First Name">
                <input type="text" name="lastName" id="lastName" placeholder="Last Name">
            </div>

            <div class="form-item">
                <input type="email" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-item">
                <!-- add a password format display -->
                <span class="pwd-format">
                    8-15 AlphaNumeric Characters
                </span>
                <input type="password" name="password" id="password" placeholder="Enter password">
                <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm password">
            </div>

            <div class="form-btns">
                <button class="signup" type="submit">Sign Up</button>
                <div class="options">
                    Already hav an account? <a href="#">Login here</a>
                </div>
            </div>

        </form>
    </div>
</body>

</html>

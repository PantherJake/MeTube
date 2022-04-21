<?php
// Initialize the session
 
// Include config file
require_once "config.php";
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        //echo $password;
        $param_username = $_POST['username'];

        $query = "SELECT username,password FROM user WHERE username = '$param_username'";
        $result = mysqli_query($con, $query);
        if (is_object($result)) {
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                echo "new_pass: " .$param_password. "in sql: ".$row['password'];
                if(password_verify($password, $row['password'])){
                    session_start();    
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $param_username;                            
                    header("location: homepage.php");
                }
                else{
                    $login_err = "Invalid password.";
                }
            }else{
                $login_err = "Invalid username or password.";
            }
        }else{
            $login_err = "Oops... Something went wrong.";
        }                         
    }
    
    mysqli_close($con);
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
            <p style="font-weight: bold; font-size:2em;">MeTube</p>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-item">
                <input type="text" name="username" id="username" placeholder="Username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>

            <div class="form-item">
                <span class="pwd-format">
                    8-15 AlphaNumeric Characters
                </span>
                <input type="password" name="password" id="password" placeholder="Enter password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-btns">
                <span class="invalid-feedback"><?php echo $login_err; ?></span>
                <button class="signup" type="submit">Login</button>
                <div class="options">
                    Don't have an account? <a href="signup.php">Sign up here</a>
                </div>
            </div>

        </form>
    </div>





</body>

</html>
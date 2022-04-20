<?php
// Include config file
require_once "config.php";
//Define Variables
$test = "";
$username = "";
?>

<html lang="en">
<body>
    <header class="header">
        <a href="homepage.php" style="text-decoration: none; color: black;">
            <div class="logo left">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png" style="width:35px;height:20px;">
                <p style="font-weight: bold;">MeTube</p>
            </div>
        </a>
        <div class="search center">
            <form action="">
                <input type="text" placeholder="Search" />
                <button><i class="material-icons">search</i></button>
            </form>
        </div>

        <div class="icons right">
            <p><?php echo $username; ?></p>
            <?php
            if (!isset($_SESSION["loggedin"])) {
                echo ("
                <div class='options' style='background-color=blue '>
                <a href='login.php'>
                    <button>Sign in</button>
                </a>
            </div>");

            } elseif (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
                $test = "You are logged in!";
                $username = $_SESSION["username"];
                echo ("
                <a href='message.php' title='Message' class='material-icons'>
                <i class='material-icons'>chat</i>
            </a>
            <a href='upload.php' title='Upload' class='material-icons'>
                <i class='material-icons'>upload</i>
            </a>
            <a href='logout.php' title='Log out' class='material-icons'>
                <i class='material-icons'>logout</i>
            </a>
                <a href='profile.php' title='Profile' class='material-icons display-this'>
                <i class='material-icons display-this'>account_circle</i>
                </a>");
            }
            ?>
        </div>
    </header>
    </body>
    </html>


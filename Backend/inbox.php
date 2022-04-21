<?php
// Include config file
require_once "config.php";

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['current_reply'] = 0;

// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"])) {
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$receiver = $message = "";
$receiver_err = $message_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate message

    $_SESSION['current_reply'] = $_POST["message_id"];

    if (empty(trim($_POST["message"]))) {
        $message_err = "Please enter a message.";
    } elseif (strlen(trim($_POST["message"])) > 1000) {
        $message_err = "Message cannot be greater than 1000 characters.";
    } else {
        $message = trim($_POST["message"]);
    }

    // Check input errors before inserting in database
    if (empty($receiver_err) && empty($message_err)) {

        // Prepare an insert statement
        echo "hey we made it here";
        $sql = "INSERT INTO reply (message_id, sender, receiver, message, date) VALUES (?, ?, ?, ?,?)";

        if ($stmt = mysqli_prepare($con, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issss", $param_messageid, $param_sender, $param_receiver, $param_message, $param_date);
            // Set parameters
            $param_messageid = $_POST["message_id"];
            $param_sender = $_SESSION["username"];
            $param_receiver = $receiver;
            $param_message = $message;
            $param_date = $param_date = date('d-m-y H:i:s A');

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                //$_SESSION['loggedin'] = true;
                header("location: inbox.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "this...";
        }
    }

    // Close connection
    //mysqli_close($con);
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
    <link rel="stylesheet" href="styles/message.css?v=<?php echo time(); ?>" />
    <title>Youtube Clone with HTML & CSS</title>


    <script>
        function reply(ele) {
            var current_message_id = ele.getAttribute('value');
            console.log(current_message_id);

            var reply_box = document.createElement('div');
            reply_box.innerHTML = '<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> <div class="same-row"> <h3>Your Message:</h3> <textarea name="message" <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>></textarea> <span class="invalid-feedback"><?php echo $message_err; ?></span> </div> <input type="submit" name="message_id" value=' + current_message_id + '> </form>';

            submit_btn = document.createElement('div');

            var reply_section = document.getElementsByClassName("message-section")[0];
            reply_section.appendChild(reply_box);
        }
    </script>
</head>

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
                <a href='channel.php' title='Profile' class='material-icons display-this'>
                <i class='material-icons display-this'>account_circle</i>
                </a>");
            }
            ?>
        </div>
    </header>
    <main>
        <div class=”side-bar”>
            <div class="nav">
                <a href="homepage.php" class="nav-link">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
                <a class="nav-link">
                    <i class="material-icons">subscriptions</i>
                    <span>Subscriptions</span>
                </a>
                <hr>

                <div class="sidebar-text-categories">
                    <h4 class="sidebar-text">Categories</h4>
                </div>

                <a class="nav-link">
                    <span>Science & Technology</span>
                </a>
                <a class="nav-link">
                    <span>Autos & Vehicles</span>
                </a>
                <a class="nav-link">
                    <span>Music</span>
                </a>
                <a class="nav-link">
                    <span>Pets & Animals</span>
                </a>
                <a class="nav-link">
                    <span>Sports</span>
                </a>
                <a class="nav-link">
                    <span>Travel & Events</span>
                </a>
                <a class="nav-link">
                    <span>Gamin</span>
                </a>
                <a class="nav-link">
                    <span>People & Blogs</span>
                </a>
                <a class="nav-link">
                    <span>Comedy</span>
                </a>
                <a class="nav-link">
                    <span>Film & Animation</span>
                </a>
                <a class="nav-link">
                    <span>News & Politics</span>
                </a>
                <a class="nav-link">
                    <span>How to & Style</span>
                </a>
                <a class="nav-link">
                    <span>Entertainment</span>
                </a>
                <a class="nav-link">
                    <span>Nonprofits & Activism</span>
                </a>
                <a class="nav-link">
                    <span>Education</span>
                </a>
            </div>
        </div>
        <div class="content">

            <div class="content-header">

                <div class="tabs">
                    <button onclick="window.location.href='message.php'">Send Message</button>
                    <button onclick="window.location.href='inbox.php'" style="color: black; border-bottom:2px solid black;" id="inbox">Inbox</button>
                    <button onclick="window.location.href='outbox.php'" id="outbox">Outbox</button>
                </div>
            </div>

            <div class="message-section">
                <?php
                $sql = "SELECT * FROM message";
                if ($result = mysqli_query($con, $sql)) {
                    if (mysqli_num_rows($result) > 0) {

                        while ($row = mysqli_fetch_array($result)) {
                            if ($row['receiver'] == $_SESSION['username']) {
                                echo "<div class='inbox-message'>";
                                echo "<button id='reply' onclick='reply(this);'  value= {$row['message_id']} name='message_id'> Reply </button>";
                                echo "<h3> Sender: " . $row['sender'] . "</h3>";
                                echo "<h5> Date:" . $row['date'] . "</h5>";
                                echo "<br>";
                                echo "<p>" . $row['message'] . "</h5>";
                                echo "</div>";
                                $replies = "SELECT * FROM reply";
                                if ($reply_result = mysqli_query($con, $replies)) {
                                    if (mysqli_num_rows($reply_result) > 0) {
                                        while ($reply_row = mysqli_fetch_array($reply_result)) {
                                            if ($reply_row['message_id'] == $row['message_id']) {
                                                echo "<div class='inbox-message reply'>";
                                                echo "<button id='reply' onclick='reply(this);'  value= {$row['message_id']} name='message_id'> Reply </button>";
                                                echo "<h3> Replier: " . $reply_row['sender'] . "</h3>";
                                                echo "<h5> Date:" . $reply_row['date'] . "</h5>";
                                                echo "<br>";
                                                echo "<p>" . $reply_row['message'] . "</h5>";
                                                echo "</div>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "No message found";
                    }
                }
                // Close connection
                //mysqli_close($con);
                ?>
            </div>

        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
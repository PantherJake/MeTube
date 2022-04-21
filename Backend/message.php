<?php
// Include config file
require_once "config.php";
require_once "header.php";
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
    // Validate username
    if (empty(trim($_POST["receiver"]))) {
        $receiver_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["receiver"]))) {
        $receiver_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM user WHERE username = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_receiver);

            // Set parameters
            $param_receiver = trim($_POST["receiver"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 0) {
                    $receiver_err = "This user does not exist";
                } else {
                    $receiver = trim($_POST["receiver"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate message
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
        $sql = "INSERT INTO message (sender, receiver,message, date) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($con, $sql)) {

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_sender, $param_receiver, $param_message, $param_date);
            // Set parameters
            $param_sender = $_SESSION["username"];
            $param_receiver = $receiver;
            $param_message = $message;
            $param_date = date('d-m-y H:i:s A');
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                //$_SESSION['loggedin'] = true;
                header("location: homepage.php");
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
    <link rel="stylesheet" href="styles/message.css" />
    <title>MeTube</title>
</head>

<body>
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
                    <button onclick="window.location.href='message.php'" style="color: black; border-bottom:2px solid black;">Send Message</button>
                    <button onclick="window.location.href='inbox.php'" id="inbox">Inbox</button>
                    <button onclick="window.location.href='outbox.php'" id="outbox">Outbox</button>
                </div>
            </div>

            <div class="message-section">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="same-row">
                        <h3>Recipient:</h3>
                        <input type="text" name="receiver" <?php echo (!empty($receiver_err)) ? 'is-invalid' : ''; ?>>
                        <span class="invalid-feedback"><?php echo $receiver_err; ?></span>
                    </div>
                    <div class="same-row">
                        <h3>Your Message:</h3>
                        <textarea name="message" <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>></textarea>
                        <span class="invalid-feedback"><?php echo $message_err; ?></span>
                    </div>
                    <input type="submit">
                </form>
            </div>

        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles/upload.css" />
    <title>MeTube</title>
</head>

<body>
    <header class="header">
        <div class="logo left">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/YouTube_full-color_icon_%282017%29.svg/2560px-YouTube_full-color_icon_%282017%29.svg.png"
                style="width:35px;height:20px;">
            <p style="font-weight: bold;">MeTube</p>
        </div>

        <div class="search center">
            <form action="">
                <input type="text" placeholder="Search" />
                <button><i class="material-icons">search</i></button>
            </form>
        </div>

        <div class="icons right">
                <?php
                    include_once 'config.php';
                    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
                        echo "<a href='upload.php' class='material-icons'>";
                        echo "<i class='material-icons'>videocam</i>";
                        echo "</a>";
                        echo "<a href='logout.php' class='material-icons'>";
                        echo "<i class='material-icons'>logout</i>";
                        echo "</a>";
                        echo "<a href='channel.php' class='material-icons display-this'>";
                        echo "<i class='material-icons display-this'>account_circle</i>";
                        echo "</a>";
                    }
                    else{
                        echo "<a href='upload.php' class='material-icons'>";
                        echo "<i class='material-icons'>videocam</i>";
                        echo "</a>";
                        echo "<a href='login.php' class='material-icons'>";
                        echo "<i class='material-icons'>login</i>";
                        echo "</a>";
                        echo "<a href='login.php' class='material-icons display-this'>";
                        echo "<i class='material-icons display-this'>perm_identity</i>";
                        echo "</a>";
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
            </div>
        </div>
        <div class="content">

            <form method="post" action="upload_submit.php" enctype="multipart/form-data">
                <div class="upload-video">
                    <h3>Upload</h3>
                    <div style="margin-top:20px;">
                        <label class="file-upload">
                            <input type="file" name="userfile" id="userfile" accept="video/*" />
                        </label>
                    </div>
                </div>
                <div class="details">
                    <h3>Details</h3>
                    <div class="title textholder">
                        <h5>Title (required) <i class="material-icons" style="font-size:medium">priority_high</i> </h5>
                        <input type="text" name="title" id="title"
                            placeholder="Add a title that describes your video" />
                    </div>

                    <div class="description textholder">
                        <h5>Description (required) <i class="material-icons" style="font-size:medium">priority_high</i>
                        </h5>
                        <textarea name="var_1" rows="5" cols="10" wrap="soft"
                            placeholder="Tell viewers about your video"></textarea>
                    </div>
                </div>
                <div class="thumbnail">
                    <h3>Thumbnail</h3>
                    <p>Select or upload a picture that shows what's in your video. A good thumbnail stands out and draws
                        viewers'
                        attention</p>
                    <div style="margin-top:20px;">
                        <label class="file-upload">
                            <input type="file" name="thumbnail" id="thumbnail" />
                        </label>
                    </div>
                </div>


                <div class="category">
                    <h3>Category</h3>
                    <select name="category" id="category">
                        <option value="film">Film & Animation</option>
                        <option value="car">Autos & Vehicles</option>
                        <option value="music">Music</option>
                        <option value="pet">Pets & Animals</option>
                        <option value="sport">Sports</option>
                        <option value="travel">Travel & Events</option>
                        <option value="gaming">Gaming</option>
                        <option value="people">People & Blogs</option>
                        <option value="comedy">Comedy</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="news">News & Politics</option>
                        <option value="style">How to & Style</option>
                        <option value="education">Education</option>
                        <option value="science">Science & Technology</option>
                        <option value="nonprofit">Nonprofits & Activism</option>
                    </select>
                </div>

                <div class="Keywords">
                    <h3>Keywords</h3>
                    <div class="words textholder">
                        <h5>Separate with space <i class="material-icons" style="font-size:medium">priority_high</i>
                        </h5>
                        <input type="text" name="keywords" id="keywords" />
                    </div>
                </div>


                <input type="submit" value="Upload" class="upload-button" name="submit">

            </form>

        </div>
    </main>
    <!-- Main Body Ends -->
</body>

</html>
<?php
    // Start the session to access the stored username
    session_start();

    // Check if the user is logged in (i.e., if the username is stored in the session)
    if (isset($_SESSION['username'])) {
        // Retrieve the username from the session and display it
        $user_name = $_SESSION['username'];
        // echo "Welcome, " . $username . "!"; // Display the username
    } 
    else {
        // If the user is not logged in, redirect to the login page or display a login link
        header('Location: login.php'); // Redirect to the login page
        exit();
    }
    // Store the username in a session variable
    $_SESSION['username'] = $user_name;
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> Home Page</title>
            <link rel="stylesheet" href="home_style.css">
            <link rel="icon" type="image/png" href="Logo.png" sizes="16x16">
            <script src = "navigation.js"></script>
        </head>
        <body>
            <div class="wrapper">
                <div class="sidebar">
                    <div class="profile">
                        <a href="upload.php">
                        <?php
                            $servername = "localhost";
                            $username = "root"; // Or use a custom username with restricted privileges
                            $password = "";     // Leave empty for default 'root' user in XAMPP
                            $dbname = "cg"; // Replace with your desired database name

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE username = ?");
                            $stmt->bind_param("s", $user_name);

                            // Execute the query
                            $stmt->execute();

                            // Bind the result to a variable
                            $stmt->bind_result($profilePath);
                            if ($stmt->fetch()) {
                                // $profilePath now contains the profile path from the database
                                // You can use it to display the user's profile image or perform other actions
                            
                                // For example, displaying the user's profile image
                                echo '<img src="' . $profilePath . '" alt="profile pic">';
                            } else {
                                // If the profile path is not found in the database, display the default profile image
                                echo '<img src="profile_pics\default_profile.png" alt="profile pic">';
                            }
                            
                            // Close the database connection and statement
                            $stmt->close();
                            $conn->close();
                        ?>
                        </a>
                        <h3 href="upload.php"><?php echo $user_name; ?></h3>
                    </div>
                    <ul>
                        <li><a href="#" class="active" data-page="home.html">
                            <span class="icon"> <img src="home.png"> </span>
                        </a></li>
                        <li><a href="#" data-page="games.html"> <!-- Add data-page attribute -->
                            <span class="icon"> <img src="games.png"> </span>
                        </a></li>
                        <li><a href="#" data-page="highscore.php" onclick="send_request(event)"> <!-- Add data-page attribute -->
                            <span class="icon"> <img src="highscore.png"> </span>
                        </a></li>
                        <li><a href="login.php">
                            <span class="icon"> <img src="logout.png"> </span>
                        </a></li>
                    </ul>
                </div>
                <div id = "content-area"></div>
                <div class="section">
                    <div class="top_navbar">
                        <div class="menu">
                            <a href="#"> <img src="menu.png"></a>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                var menu = document.querySelector(".menu");
                menu.addEventListener("click", function(){
                    document.querySelector("body").classList.toggle("active");
                })
            </script>
        </body>
    </html>
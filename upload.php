<?php
    // Start the session to access the stored username
    session_start();

    // Check if the user is logged in (i.e., if the username is stored in the session)
    if (isset($_SESSION['username'])) {
        // Retrieve the username from the session and display it
        $username = $_SESSION['username'];
        // echo "Welcome, " . $username . "!"; // Display the username
    } 
    else {
        // If the user is not logged in, redirect to the login page or display a login link
        header('Location: login.php'); // Redirect to the login page
        exit();
    }
    // Store the username in a session variable
    $_SESSION['username'] = $username;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile</title>
    <link rel="stylesheet" type="text/css" href="filestyle.css">
</head>
<body>
    <h2>Upload Your Profile Picture</h2>
    <form action="upload_verify.php" method="post" enctype="multipart/form-data">
        <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
        <input type="submit" value="Upload">
    </form>
</body>
</html>

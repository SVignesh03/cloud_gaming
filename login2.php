<?php
$servername = "localhost";
$username = "root"; // Or use a custom username with restricted privileges
$password = "";     // Leave empty for default 'root' user in XAMPP
$dbname = "cg"; // Replace with your desired database name
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the MySQL database (replace 'db_user', 'db_password', and 'db_name' with your actual database credentials)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query to fetch user information
    $sql = "SELECT id, pass_word FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($id, $pass_word);
    $result = $stmt->get_result();
    $stmt->fetch();


    if ($result->num_rows > 0) {
        echo "<span color='red'> Sorry you don't have a account create one </span>";
        sleep(2);
        header("Location: registeration.php");
        exit();
    }
    else {

       // Verify the password
        if (password_verify($pass_word, $hashed_password)) {
            // Password is correct, start a session and store user data
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $username;

            // Redirect to a secure page (e.g., home.php)
            header("Location: home.php");
            exit();
        }
        
        else {
        echo "Invalid username or password."; //<a href='login.php'>Try again</a>.";
        header("Location: login.php");
        exit();
    }
}

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

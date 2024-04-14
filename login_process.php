<?php
$servername = "localhost";
$username = "root"; // Or use a custom username with restricted privileges
$password = "";     // Leave empty for default 'root' user in XAMPP
$dbname = "cg"; // Replace with your desired database name
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_name = $_POST["username"];
    $password = $_POST["password"];

    // Connect to the MySQL database (replace 'db_user', 'db_password', and 'db_name' with your actual database credentials)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query to fetch user information
    $db = new PDO("mysql:host=localhost;dbname=cg;charset=utf8", "root", "");
    $sql = "SELECT id, pass_word FROM users WHERE username=:username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $user_name);
    $stmt->execute();
    // $stmt->store_result();
    $results = $stmt->fetchAll();
    $user_id = $results[0]["id"];
    $hashed_password = $results[0]["pass_word"];
    

    if ($result->num_rows > 0) {
        echo "Sorry you don't have a account create one";
        sleep(2);
        header("Location: registeration.php");
        exit();
    }
    else {

       // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session and store user data
            session_start();
            $_SESSION["user_id"] = $user_id;
            $_SESSION["username"] = $user_name;

            // Redirect to a secure page (e.g., home.php)
            header("Location: home_page.php");
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

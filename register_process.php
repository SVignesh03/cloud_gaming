<?php

// Check if the form is submitted
$servername = "localhost";
$username = "root"; // Or use a custom username with restricted privileges
$password = "";     // Leave empty for default 'root' user in XAMPP
$dbname = "cg"; // Replace with your desired database name

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["fname"]; 
    $last_name = $_POST["lname"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $country_code = $_POST["cc"];
    $mobile = $_POST["mobile"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $confirm_password = $_POST["confirm_password"];

    // Check if passwords match
    // if ($password !== $confirm_password) {
    //     die("Passwords do not match.");
    // }

    // TODO: Perform additional validation on username and password if needed.

    // Hash the password for security (you can use more advanced encryption methods)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Connect to the MySQL database (replace 'db_user', 'db_password', and 'db_name' with your actual database credentials)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query to insert the new user into the database
    $sql = "INSERT INTO users (first_name, last_name, DOB, email, country_code, mobile, username, pass_word) VALUES (?, ?, ?, ?, ?, ?, ?, ? )";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssiss", $first_name, $last_name, $dob, $email, $country_code, $mobile, $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful."; //You can now <a href='login.php'>login</a>.";
        sleep(2);
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

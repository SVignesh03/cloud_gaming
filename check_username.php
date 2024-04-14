<?php
// Your database connection code
$servername = "localhost";
$username = "root"; // Or use a custom username with restricted privileges
$password = "";     // Leave empty for default 'root' user in XAMPP
$dbname = "cg"; // Replace with your desired database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Check if the username exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    // Respond with 'available' or 'unavailable' based on query result
    if ($result->num_rows > 0) {
        echo 'unavailable';
    } else {
        echo 'available';
    }
}

$conn->close();
?>
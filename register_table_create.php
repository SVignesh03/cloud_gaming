<?php
// Replace 'db_user', 'db_password', and 'db_name' with your actual database credentials
$servername = "localhost";
$username = "root"; // Or use a custom username with restricted privileges
$password = "";     // Leave empty for default 'root' user in XAMPP
$dbname = "cg"; // Replace with your desired database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to create the 'users' table
$sql = "CREATE TABLE users (
    id INT(11) AUTO_INCREMENT NOT NULL UNIQUE,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100),
    DOB DATE NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    country_code VARCHAR(5),
    mobile INT(15),
    username VARCHAR(50) PRIMARY KEY,
    pass_word VARCHAR(255) NOT NULL
)";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>

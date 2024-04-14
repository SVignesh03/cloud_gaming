<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cg";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_name= "s_vignesh03";
// SQL query to add a new field to the existing table
// $newFieldName = "profile";
$db = new PDO("mysql:host=localhost;dbname=cg;charset=utf8", "root", "");
    $sql = "SELECT profile_pic FROM users WHERE username=:username";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":username", $user_name);
    $stmt->execute();
    // $stmt->store_result();
    $results = $stmt->fetchAll();
    $profile = $results[0]["profile_pic"];
    // $hashed_password = $results[0]["pass_word"];
$result = $stmt->fetch();
// Execute the query
if ($result) { 
    echo $profile;   
}    
    else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
$stmt->closeCursor();
?>

<?php
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

    $servername = "localhost";
    $username = "root"; // Or use a custom username with restricted privileges
    $password = "";     // Leave empty for default 'root' user in XAMPP
    $dbname = "cg"; // Replace with your desired database name
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $user_name = $_POST["username"];
        // $password = $_POST["password"];
    
        // Connect to the MySQL database (replace 'db_user', 'db_password', and 'db_name' with your actual database credentials)
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Prepare and execute the query to fetch user information
        // $db = new PDO("mysql:host=localhost;dbname=cg;charset=utf8", "root", "");
    }
    $select = "SELECT * FROM highscore WHERE user = '$user_name'";
    $select_r = mysqli_query($conn,$select);
    $select_a = mysqli_fetch_array($select_r);
    $o_score = $select_a['score'];
    if (isset($_COOKIE['myData'])) {
        $receivedData = urldecode($_COOKIE['myData']);
        // echo "Data received from JavaScript: " . $receivedData;
    }
    if($o_score === 0 or $o_score === NULL){    
    $insert = "INSERT INTO highscore (user, score) VALUES (?, ?)";
    $conn ->query($insert);
    }
    elseif($o_score < $receivedData){
        $update ="UPDATE highscore SET score = $receivedData";
        $conn ->query($update);
    }
            
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    /* Your CSS stylesheet here */
    table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ccc;
    }

    th {
      background-color: #f2f2f2;
      color: #333;
      font-weight: bold;
      text-align: left;
      padding: 8px;
      border: 1px solid #ccc;
    }

    td {
      padding: 8px;
      border: 1px solid #ccc;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <?php
    $scores = "SELECT * FROM highscore ORDER BY score DESC LIMIT 10;";
    $result = mysqli_query($conn, $scores);
    echo "<table><tr><th>User</th><th>Highscore</th></tr>";
    while($row -> fetch_assoc()) {
       $score = $row['score'];
       $user = $row['user'];
      echo "<tr><td>$user</td><td>$score</td></tr>";
    }
    echo "</table>";
  ?>
</body>
</html>

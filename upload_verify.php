<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cg";

session_start();

$user_name = $_SESSION['username'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted with a file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $targetDir = "profile_pics/"; // Directory to store uploaded images
    $targetFile = $targetDir . basename($_FILES["profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Generate the new filename using the username and file extension
    $newFileName = $user_name . "." . $imageFileType;
    $targetFile = $targetDir . $newFileName; // Full path of the target file


    // Check if the image file is an actual image or fake image
    // $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
    // if ($check === false) {
    //     echo "Error: File is not an image.";
    //     $uploadOk = 0;
    // }

    // Check if the file already exists
    // if (file_exists($targetFile)) {
    //     echo "Error: File already exists.";
    //     $uploadOk = 0;
    // }

    // Check file size (You can adjust the max file size according to your needs)
    if ($_FILES["profile_pic"]["size"] > 500000) {
        echo "Error: File is too large.";
        $uploadOk = 0;
    }

    // Allow certain image file formats (you can add more if needed)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") { //&& $imageFileType != "gif"
        echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // If all checks are passed, move the uploaded file to the target directory
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
            // File was successfully uploaded, now save the file path in the database
            $sql = "UPDATE users SET profile_pic = '$targetFile' WHERE username = '$user_name'";
            // $user_id = 1; // Replace with the actual user ID
            $stmt = $conn->prepare($sql);
            //$stmt->bind_param("s", $targetFile); // $user_name,
            if ($stmt->execute()) {
                echo "Profile picture uploaded successfully.";
            } else {
                echo "Error: Unable to save data in the database.";
            }
            $stmt->close();
        } else {
            echo "Error: Unable to upload file.";
        }
    }
}
$conn->close();
?>

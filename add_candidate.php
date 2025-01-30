<?php
include('config.php'); // Include the database connection
$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data and sanitize it
    $name = test_input($_POST['name']);
    $description = test_input($_POST['description']);

    // Handle the photo upload
    $target_dir = "uploads/"; // Directory to save the photos
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    
    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // Insert the data into the database
        $sql = "INSERT INTO tbl_candidates (name, photo, description) VALUES ('$name', '$target_file', '$description')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New candidate added successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error uploading photo.";
    }
}
?>

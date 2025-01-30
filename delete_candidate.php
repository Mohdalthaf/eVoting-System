<?php
include('config.php'); // Include database connection

// connection using values from config.php
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the candidate from the database
    $sql = "DELETE FROM tbl_candidates WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Candidate deleted successfully!');
                window.location.href = 'nomination.php'; // Redirect back to the nomination page
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

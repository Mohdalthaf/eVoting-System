<?php
include('config.php'); // Include the database connection

//connection using values from config.php
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch candidate details from the database
    $sql = "SELECT * FROM tbl_candidates WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $candidate = $result->fetch_assoc();
    } else {
        echo "Candidate not found.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = test_input($_POST['name']);
    $description = test_input($_POST['description']);

    // Handle the photo upload
    if ($_FILES["photo"]["name"]) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $photo = $target_file;
    } else {
        $photo = $_POST['existing_photo']; // Retain the existing photo
    }

    // Update the candidate details
    $sql = "UPDATE tbl_candidates SET name = '$name', photo = '$photo', description = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Show a pop-up message and redirect back to nomination.php
        echo "<script>
                alert('Candidate updated successfully!');
                window.location.href = 'nomination.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Candidate</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Edit Candidate</h2>
        <form action="edit_candidate.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $candidate['id']; ?>">

            <div class="form-group">
                <label for="name">Candidate Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?php echo $candidate['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="photo">Candidate Photo:</label>
                <input type="file" name="photo" id="photo" class="form-control">
                <input type="hidden" name="existing_photo" value="<?php echo $candidate['photo']; ?>">
            </div>

            <div class="form-group">
                <label for="description">Candidate Description:</label>
                <textarea name="description" id="description" class="form-control" required><?php echo $candidate['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Candidate</button>
        </form>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

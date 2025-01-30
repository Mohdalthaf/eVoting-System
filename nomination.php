<?php
include('config.php'); // Include the database connection

//connection using values from config.php
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle the form submission for adding a new candidate
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = test_input($_POST['name']);
    $description = test_input($_POST['description']);

    // Handle the photo upload
    if ($_FILES["photo"]["name"]) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $photo = $target_file;
    } else {
        $photo = ''; // No photo uploaded
    }

    // Insert the new candidate into the database
    $sql = "INSERT INTO tbl_candidates (name, photo, description) VALUES ('$name', '$photo', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Candidate added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Fetch all candidates from the database
$sql = "SELECT * FROM tbl_candidates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nomination Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    
    <style>
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <h2>Nomination Panel</h2>
            <a href="cpanel.php" class="btn btn-secondary">Back to Result</a>
        </div>

        <!-- Candidate Addition Form -->
        <h3>Add New Candidate</h3>
        <form action="nomination.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Candidate Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="photo">Candidate Photo:</label>
                <input type="file" name="photo" id="photo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Candidate Description:</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Candidate</button>
        </form>

        <!-- Candidate List -->
        <h3>Candidate List</h3>
        <table id="candidateTable" class="display table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td><img src='" . $row['photo'] . "' width='80' height='80'></td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>
                                <a href='edit_candidate.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                                <a href='delete_candidate.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirmDelete()'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No candidates found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready( function () {
            $('#candidateTable').DataTable(); // Activate DataTables for sorting and searching
        });

        function confirmDelete() {
            return confirm("Are you sure you want to delete this candidate?");
        }
    </script>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

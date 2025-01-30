<?php
include('config.php'); // Include the database connection

// connection using values from config.php
$conn = mysqli_connect($hostname, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all candidates from the database
$sql = "SELECT * FROM tbl_candidates";
$result = $conn->query($sql);

echo '<table class="table">';
echo '<thead><tr><th>Name</th><th>Photo</th><th>Description</th><th>Actions</th></tr></thead>';
echo '<tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><img src='" . $row['photo'] . "' width='100' height='100'></td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>
                <a href='edit_candidate.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                <a href='delete_candidate.php?id=" . $row['id'] . "' class='btn btn-danger'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No candidates found.</td></tr>";
}

echo '</tbody>';
echo '</table>';

// Close the database connection
$conn->close();
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "db_evoting");

// Check connection
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// active candidates
$sql = "SELECT * FROM tbl_candidates WHERE status = 'active'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Voting Panel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <style>
      .candidate {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
      }
      .candidate img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h2 class="specialHead">Choose Your Candidate</h2>
      <p class="normalFont">Prove your authenticity as a voter.</p>

      <form action="saveVote.php" method="POST">
        <div class="form-group">
          <label>Voter's Name:</label>
          <input type="text" name="voterName" class="form-control" required /><br />

          <label>Voter's Registered Email ID:</label>
          <input type="email" name="voterEmail" class="form-control" required /><br />

          <label>Voter's Card No.:</label>
          <input type="text" name="voterID" class="form-control" required /><br />

          <h3 class="normalFont">Select a Candidate:</h3>
          
          <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo '
                <div class="radio candidate">
                  <img src="' . htmlspecialchars($row["photo"]) . '" alt="Candidate Photo">
                  <label>
                    <input type="radio" name="selectedCandidate" value="' . htmlspecialchars($row["name"]) . '" required>
                    <strong>' . htmlspecialchars($row["name"]) . '</strong>
                    <p>' . htmlspecialchars($row["description"]) . '</p>
                  </label>
                </div>';
              }
            } else {
              echo "<p>No candidates available.</p>";
            }
          ?>

          <br />
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-default">Reset</button>
        </div>
      </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php $conn->close(); ?>

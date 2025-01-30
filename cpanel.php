<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet" type="text/css">

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="navbar-header">
            <a href="cpanel.php" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
          </div>

          <div class="collapse navbar-collapse" id="example-nav-collapse">
            <ul class="nav navbar-nav">
              <li><a href="nomination.php"><span class="subFont"><strong>Nomination's List</strong></span></a></li>
              <!-- <li><a href=""><span class="subFont"><strong></strong></span></a></li> -->
            </ul>

            <span class="normalFont">
              <a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a>
            </span>
          </div>
        </div>
      </nav>

      <div class="container" style="padding:100px;">
        <div class="row">
          <div class="col-sm-12" style="border:2px solid gray;">
            <div class="page-header">
              <h2 class="specialHead">CONTROL PANEL</h2>
              <p class="normalFont">This is the Administration Panel.</p>
            </div>

            <div class="col-sm-12">
              <?php
                require 'config.php';

                // Establish database connection
                $conn = mysqli_connect($hostname, $username, $password, $database);
                if (!$conn) {
                  echo "Error While Connecting.";
                } else {
                  // Fetch candidates from tbl_candidates
                  $sql = "SELECT * FROM tbl_candidates";
                  $result = mysqli_query($conn, $sql);

                  if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $candidate_name = $row['name']; // Assuming the column for the name is 'name'
                      
                      // Get vote count for each candidate from tbl_users
                      $sql_votes = "SELECT COUNT(*) AS vote_count FROM tbl_users WHERE voted_for='$candidate_name'";
                      $result_votes = mysqli_query($conn, $sql_votes);
                      $vote_count = 0;

                      if ($result_votes) {
                        $row_votes = mysqli_fetch_assoc($result_votes);
                        $vote_count = $row_votes['vote_count']; // Vote count for the candidate
                      }

                      // Calculate the progress bar value (assuming 10% per vote)
                      $progress_value = $vote_count * 10;

                      // Display the candidate name and the progress bar
                      echo "<strong>$candidate_name</strong><br>";
                      echo "
                        <div class='progress'>
                          <div class='progress-bar progress-bar-striped' role='progressbar' aria-valuenow=\"$progress_value\" aria-valuemin=\"0\" aria-valuemax=\"100\" style='width: $progress_value%'>
                            <span class='sr-only'>$candidate_name</span>
                          </div>
                        </div>
                      ";
                    }
                  }

                  // Get total votes
                  $sql = "SELECT COUNT(*) AS total_votes FROM tbl_users WHERE voted_for IS NOT NULL";
                  $result = mysqli_query($conn, $sql);
                  if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $total = $row['total_votes'];
                    echo "<hr>";
                    echo "<strong>Total Number of Votes</strong><br>";
                    echo "
                      <div class='text-primary'>
                        <h3 class='normalFont'>VOTES: $total</h3>
                      </div>
                    ";
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

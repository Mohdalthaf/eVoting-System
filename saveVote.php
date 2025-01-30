<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vote Submission</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .headerFont { font-family: 'Ubuntu', sans-serif; font-size: 24px; }
        .subFont { font-family: 'Raleway', sans-serif; font-size: 14px; }
        .specialHead { font-family: 'Oswald', sans-serif; }
        .normalFont { font-family: 'Roboto Condensed', sans-serif; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
                </div>
            </div>
        </nav>

        <div class="container" style="padding-top:150px;">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center" style="border:2px solid gray;padding:50px;">
                    <?php
                    require('config.php'); // Use the database connection from config.php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (!empty($_POST["voterName"]) && !empty($_POST["voterEmail"]) && !empty($_POST["voterID"]) && !empty($_POST["selectedCandidate"])) {
                            
                            // Prepare and bind parameters to prevent SQL injection
                            $stmt = $conn->prepare("INSERT INTO tbl_users (full_name, email, voter_id, voted_for) VALUES (?, ?, ?, ?)");
                            $stmt->bind_param("ssis", $full_name, $email, $voter_id, $voted_for);

                            // Get user inputs and sanitize them
                            $full_name = test_input($_POST["voterName"]);
                            $email = test_input($_POST["voterEmail"]);
                            $voter_id = intval($_POST["voterID"]); // Ensure voter ID is integer
                            $voted_for = test_input($_POST["selectedCandidate"]);

                            // Execute the query
                            if ($stmt->execute()) {
                                echo "<img src='images/success.png' width='70' height='70'>";
                                echo "<h3 class='text-info specialHead text-center'><strong>YOU'VE SUCCESSFULLY VOTED.</strong></h3>";
                            } else {
                                echo "<img src='images/error.png' width='70' height='70'>";
                                echo "<h3 class='text-danger specialHead text-center'><strong>ERROR: " . $stmt->error . "</strong></h3>";
                            }

                            // Close statement and connection
                            $stmt->close();
                        } else {
                            echo "<h3 class='text-warning'><strong>All fields are required.</strong></h3>";
                        }
                    }

                    $conn->close();
                    ?>
                    <a href='index.html' class='btn btn-primary'><span class='glyphicon glyphicon-ok'></span> <strong>Finish</strong></a>
                </div>
                <div class="col-sm-4"></div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

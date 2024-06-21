<?php

require('../php/functies.php');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kidsleague";

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are set
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['players'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $players = $_POST['players'];

        // Prepare an insert statement for Coaches
        $sthCoaches = $conn->prepare('INSERT INTO coaches (Coach_Naam, Coach_Email) VALUES (?, ?)');
        // Bind parameters for Coaches
        $sthCoaches->bind_param('ss', $name, $email);

        // Execute the statement for Coaches
        if ($sthCoaches->execute()) {
            echo "Uw aanmelding is succesvol voor de coach!<br>";
        } else {
            echo "Error: " . $sthCoaches->error;
        }

        // Prepare an insert statement for Spelers
        $sthSpelers = $conn->prepare('INSERT INTO spelers (Spelers_Naam) VALUES (?)');
        
        // Loop through each player and insert into the database
        foreach ($players as $player) {
            $sthSpelers->bind_param('s', $player);

            // Execute the statement for Spelers
            if ($sthSpelers->execute()) {
                header('Location: ../html/main.php');
                exit();
            } else {
                echo "Not Valid";
            }
        }

        // Close statement and connection
        $sthCoaches->close();
        $sthSpelers->close();
    } else {
        echo "Name, email, and at least one player are required.";
    }
}

// Close connection
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/teams.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Teams Aanmelding</title>
</head>
<body>

    <?php include("../include/header.html"); ?>

    <div class="main-container">
        <div class="form-container">
            <h2>Voetbalteam Aanmelden</h2>
            <form action="../php/process.php" method="POST">
                <input type="text" id="name" class="form-control mt-4" name="name" placeholder="Vul hier je Naam in: " required>
                <input type="text" class="form-control mt-4" name="subject" placeholder="Vul hier uw team naam in: ">
                <input type="email" id="email" class="form-control mt-4" name="email" placeholder="Vul hier je Email in: " required>
                <textarea class="form-control mt-4" rows="5" name="message" placeholder="Vul hier jouw vraag in: "></textarea>
                <br>
                <h3>Spelers</h3>

                <button type="button" class="btn btn-secondary btn-sm mt-3 ms-2" id="add-player-btn">Toevoegen</button>

                <div id="players-container">
                    <div class="player-group d-flex align-items-center mt-2">
                        <label for="player1" class="form-label me-2">Speler 1:</label>
                        <input type="text" id="player1" name="players[]" class="form-control me-2" required>
                    </div>
                </div>
                <input type="submit" class="submitknop" value="submit" name="submit">
            </form>
        </div>
    </div>

    <script src="../javascript/teams.js"></script>

</body>
</html>


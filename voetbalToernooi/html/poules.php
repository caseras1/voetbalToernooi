<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toernooi Poules</title>
    <link rel="stylesheet" href="../style/poules.css">
</head>
<body>
<?php
    include("../include/header.html");

    // Database verbinding instellen
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "kidsleague";

    // Maak verbinding met de database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controleer de verbinding
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Haal de poules en teams op uit de database
    $poules_query = "
        SELECT 
            p.Poules_ID, 
            t1.Team_Naam AS Team1, 
            t2.Team_Naam AS Team2, 
            t3.Team_Naam AS Team3, 
            t4.Team_Naam AS Team4
        FROM 
            poules p
        LEFT JOIN 
            teams t1 ON p.Team_ID1 = t1.Team_ID
        LEFT JOIN 
            teams t2 ON p.Team_ID2 = t2.Team_ID
        LEFT JOIN 
            teams t3 ON p.Team_ID3 = t3.Team_ID
        LEFT JOIN 
            teams t4 ON p.Team_ID4 = t4.Team_ID
    ";
    $poules_result = $conn->query($poules_query);

    // Data voor poules en teams ophalen
    $poules = [];

    if ($poules_result->num_rows > 0) {
        while ($poule = $poules_result->fetch_assoc()) {
            $poule_id = "Poule " . chr(64 + $poule['Poules_ID']); // Converteer Poules_ID naar letter (1 -> A, 2 -> B, etc.)
            $teams = array_filter([$poule['Team1'], $poule['Team2'], $poule['Team3'], $poule['Team4']]);
            $poules[$poule_id] = $teams;
        }
    }

    // Sluit de verbinding
    $conn->close();
?>

<div class="container">
    <h1>Toernooi Poules</h1>

    <div class="poule-container">
    <?php
    // Weergeven van poules en teams
    foreach ($poules as $poule => $teams) {
        echo "<div class='poule'>";
        echo "<h2>$poule</h2>";
        echo "<table>";
        echo "<tr><th>Team</th></tr>";
        foreach ($teams as $team) {
            echo "<tr><td>$team</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    ?>
    </div>
</div>


</body>
</html>

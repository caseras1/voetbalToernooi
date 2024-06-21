<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tussenstand Poules</title>
    <link rel="stylesheet" href="../style/poules.css">
</head>
<body>
<?php

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
            t1.Team_Naam AS Team1, t1.Team_ID AS Team_ID1, 
            t2.Team_Naam AS Team2, t2.Team_ID AS Team_ID2, 
            t3.Team_Naam AS Team3, t3.Team_ID AS Team_ID3, 
            t4.Team_Naam AS Team4, t4.Team_ID AS Team_ID4
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
            $teams = [
                ["name" => $poule['Team1'], "id" => $poule['Team_ID1'], "points" => 0],
                ["name" => $poule['Team2'], "id" => $poule['Team_ID2'], "points" => 0],
                ["name" => $poule['Team3'], "id" => $poule['Team_ID3'], "points" => 0],
                ["name" => $poule['Team4'], "id" => $poule['Team_ID4'], "points" => 0],
            ];
            $teams = array_filter($teams, function($team) {
                return !empty($team['name']);
            });
            $poules[$poule_id] = $teams;
        }
    }

    // Haal de uitslagen op en bereken de punten
    $uitslagen_query = "SELECT * FROM wedstrijden";
    $uitslagen_result = $conn->query($uitslagen_query);

    if ($uitslagen_result->num_rows > 0) {
        while ($wedstrijd = $uitslagen_result->fetch_assoc()) {
            $team1_id = $wedstrijd['Team_ID1'];
            $team2_id = $wedstrijd['Team_ID2'];
            $score1 = $wedstrijd['Score_ID1'];
            $score2 = $wedstrijd['Score_ID2'];

            foreach ($poules as &$poule) {
                if (is_array($poule)) {
                    foreach ($poule as &$team) {
                        if ($team['id'] == $team1_id) {
                            if ($score1 > $score2) {
                                $team['points'] += 3;
                            } elseif ($score1 == $score2) {
                                $team['points'] += 1;
                            }
                        }
                        if ($team['id'] == $team2_id) {
                            if ($score2 > $score1) {
                                $team['points'] += 3;
                            } elseif ($score2 == $score1) {
                                $team['points'] += 1;
                            }
                        }
                    }
                }
            }
        }
    }

    // Sluit de verbinding
    $conn->close();
?>

<div class="container">
    <h1>Tussenstand Poules</h1>

    <div class="poule-container">
    <?php
    // Weergeven van poules en teams met punten
    foreach ($poules as $poule => $teams) {
        echo "<div class='poule'>";
        echo "<h2>$poule</h2>";
        echo "<table>";
        echo "<tr><th>Team</th><th>Punten</th></tr>";
    
        // Sorteer de teams op punten
        usort($teams, function($a, $b) {
            return $b['points'] - $a['points'];
        });
    
        foreach ($teams as $team) {
            echo "<tr><td>{$team['name']}</td><td>{$team['points']}</td></tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    
    ?>
    </div>
</div>

</body>
</html>

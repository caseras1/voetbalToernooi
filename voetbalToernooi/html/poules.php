<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toernooi Poules en Wedstrijdschema</title>

</head>
<body>

<div class="container">
    <h1>Toernooi Poules en Wedstrijdschema</h1>

    <?php
    // Poule en team data
    $poules = [
        "Poule A" => ["Team 1", "Team 2", "Team 3", "Team 4"],
        "Poule B" => ["Team 5", "Team 6", "Team 7", "Team 8"],
        "Poule C" => ["Team 9", "Team 10", "Team 11", "Team 12"],
        "Poule D" => ["Team 13", "Team 14", "Team 15", "Team 16"],
        "Poule E" => ["Team 17", "Team 18", "Team 19", "Team 20"],
        "Poule F" => ["Team 21", "Team 22", "Team 23", "Team 24"],
        "Poule G" => ["Team 25", "Team 26", "Team 27", "Team 28"],
        "Poule H" => ["Team 29", "Team 30", "Team 31", "Team 32"],
    ];

    // Weergeven van poules en teams
    foreach ($poules as $poule => $teams) {
        echo "<h2>$poule</h2>";
        echo "<table>";
        echo "<tr><th>Team</th></tr>";
        foreach ($teams as $team) {
            echo "<tr><td>$team</td></tr>";
        }
        echo "</table>";
    }

    // Wedstrijdschema
    echo "<div class='schedule'>";
    echo "<h2>Wedstrijdschema</h2>";
    foreach ($poules as $poule => $teams) {
        echo "<h3>$poule</h3>";
        echo "<table>";
        echo "<tr><th>Wedstrijd</th></tr>";
        for ($i = 0; $i < count($teams); $i++) {
            for ($j = $i + 1; $j < count($teams); $j++) {
                echo "<tr><td>{$teams[$i]} vs {$teams[$j]}</td></tr>";
            }
        }
        echo "</table>";
    }
    echo "</div>";
    ?>

</div>

</body>
</html>

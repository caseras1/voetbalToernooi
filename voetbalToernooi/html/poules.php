<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toernooi Poules en Wedstrijdschema</title>
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
?>

<div class="container">
    <h1>Toernooi Poules en Wedstrijdschema</h1>

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

    <div class="schedule">
        <h2>Wedstrijdschema</h2>
        <form action="verwerk_uitslagen.php" method="post">
        <?php
        // Haal de wedstrijden op uit de database
        $wedstrijden_query = "
            SELECT 
                w.Wedstrijd_ID, 
                p.Poules_ID, 
                t1.Team_Naam AS Team1, 
                t2.Team_Naam AS Team2 
            FROM 
                wedstrijden w
            JOIN 
                poules p ON w.Poules_ID = p.Poules_ID
            JOIN 
                teams t1 ON w.Team_ID1 = t1.Team_ID
            JOIN 
                teams t2 ON w.Team_ID2 = t2.Team_ID
        ";
        $wedstrijden_result = $conn->query($wedstrijden_query);

        if ($wedstrijden_result->num_rows > 0) {
            while ($wedstrijd = $wedstrijden_result->fetch_assoc()) {
                $poule_id = "Poule " . chr(64 + $wedstrijd['Poules_ID']); // Converteer Poules_ID naar letter (1 -> A, 2 -> B, etc.)
                echo "<h3>$poule_id</h3>";
                echo "<table>";
                echo "<tr><th>Wedstrijd</th><th>Uitslag</th></tr>";
                echo "<tr>";
                echo "<td>{$wedstrijd['Team1']} vs {$wedstrijd['Team2']}</td>";
                echo "<td>
                        <input class='input-goals' type='number' name='score[{$wedstrijd['Wedstrijd_ID']}][team1]' min='0'> - 
                        <input class='input-goals' type='number' name='score[{$wedstrijd['Wedstrijd_ID']}][team2]' min='0'>
                      </td>";
                echo "</tr>";
                echo "</table>";
            }
        }
        ?>
        <input type="submit" value="Verstuur Uitslagen">
        </form>
    </div>

</div>
<?php
    include("../include/footer.html");
?>
</body>
</html>

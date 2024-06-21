<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedstrijdschema en Uitslagen</title>
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
            t4.Team_Naam AS Team4,
            t1.Team_ID AS Team_ID1, 
            t2.Team_ID AS Team_ID2, 
            t3.Team_ID AS Team_ID3, 
            t4.Team_ID AS Team_ID4
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
                ["name" => $poule['Team1'], "id" => $poule['Team_ID1']],
                ["name" => $poule['Team2'], "id" => $poule['Team_ID2']],
                ["name" => $poule['Team3'], "id" => $poule['Team_ID3']],
                ["name" => $poule['Team4'], "id" => $poule['Team_ID4']],
            ];
            $teams = array_filter($teams, function($team) {
                return !empty($team['name']);
            });
            $poules[$poule_id] = $teams;
        }
    }

    // Sluit de verbinding
    $conn->close();
?>

<div class="container">
    <h1>Wedstrijdschema en Uitslagen</h1>

    <div class="schedule">
        <h2>Wedstrijdschema</h2>
        <form action="verwerk_uitslagen.php" method="post">
        <?php
        foreach ($poules as $poule => $teams) {
            echo "<h3>$poule</h3>";
            echo "<table>";
            echo "<tr><th>Wedstrijd</th><th>Uitslag</th></tr>";
            for ($i = 0; $i < count($teams); $i++) {
                for ($j = $i + 1; $j < count($teams); $j++) {
                    echo "<tr>";
                    echo "<td>{$teams[$i]['name']} vs {$teams[$j]['name']}</td>";
                    echo "<td>
                            <input class='input-goals' type='number' name='score[{$teams[$i]['id']}_vs_{$teams[$j]['id']}][team1]' min='0'> 
                            - 
                            <input class='input-goals' type='number' name='score[{$teams[$i]['id']}_vs_{$teams[$j]['id']}][team2]' min='0'>
                          </td>";
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
        ?>
        <input type="submit" value="Verstuur Uitslagen">
        </form>
    </div>
</div>

</body>
</html>

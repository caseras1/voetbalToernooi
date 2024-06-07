<?php
session_start();
include("../php/config.php");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poule van 4 Teams</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <?php
    include("../include/header.html");
    ?>

    <h1>Poule A</h1>
    <?php
        $teams = [
            "De regenboog",
            "De ark",
            "De zonnebloem",
            "De avondturenberg"
        ];

        echo "<h2>Teams</h2>";
        echo "<table>";
        echo "<tr><th>Team</th><th>Naam</th></tr>";
        foreach ($teams as $index => $team) {
            $letter = chr(65 + $index); // ASCII waarde van 'A' is 65
            echo "<tr><td>Team $letter</td><td>$team</td></tr>";
        }
        echo "</table>";

        echo "<h2>Wedstrijden</h2>";
        echo "<table>";
        for ($i = 0; $i < count($teams); $i++) {
            for ($j = $i + 1; $j < count($teams); $j++) {
                $team1 = $teams[$i];
                $team2 = $teams[$j];
                $letter1 = chr(65 + $i);
                $letter2 = chr(65 + $j);
                echo "<tr><td>Team $letter1 ($team1) vs Team $letter2 ($team2)</td></tr>";
            }
        }
        echo "</table>";
    ?>

<h1>Poule B</h1>
    <?php
        $teams = [
            "De bloesengaard",
            "De Lachende leeuwen",
            "De kleine wereld",
            "De vlinderdans"
        ];

        echo "<h2>Teams</h2>";
        echo "<table>";
        echo "<tr><th>Team</th><th>Naam</th></tr>";
        foreach ($teams as $index => $team) {
            $letter = chr(65 + $index); // ASCII waarde van 'A' is 65
            echo "<tr><td>Team $letter</td><td>$team</td></tr>";
        }
        echo "</table>";

        echo "<h2>Wedstrijden</h2>";
        echo "<table>";
        for ($i = 0; $i < count($teams); $i++) {
            for ($j = $i + 1; $j < count($teams); $j++) {
                $team1 = $teams[$i];
                $team2 = $teams[$j];
                $letter1 = chr(65 + $i);
                $letter2 = chr(65 + $j);
                echo "<tr><td>Team $letter1 ($team1) vs Team $letter2 ($team2)</td></tr>";
            }
        }
        echo "</table>";
    ?>
    
</body>
</html>

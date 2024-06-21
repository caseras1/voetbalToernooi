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

// Verwerk de uitslagen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['score'] as $match => $scores) {
        list($team1_id, $team2_id) = explode("_vs_", $match);
        $score1 = $scores['team1'];
        $score2 = $scores['team2'];

        // Query om de uitslagen op te slaan
        $sql = "INSERT INTO wedstrijden (Poules_ID, Team_ID1, Team_ID2, Score_ID1, Score_ID2) 
                VALUES ((SELECT Poules_ID FROM poules WHERE Team_ID1 = $team1_id OR Team_ID2 = $team1_id OR Team_ID3 = $team1_id OR Team_ID4 = $team1_id LIMIT 1), 
                        $team1_id, $team2_id, $score1, $score2)";

        if ($conn->query($sql) === TRUE) {
            echo "Nieuwe uitslag succesvol toegevoegd.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Sluit de verbinding
$conn->close();

// Doorsturen naar de vorige pagina
header("Location: Wschema.php");
exit;
?>

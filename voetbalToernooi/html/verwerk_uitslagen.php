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

        // Gebruik een prepared statement om SQL Injection te voorkomen
        $stmt = $conn->prepare("INSERT INTO wedstrijden (Poules_ID, Team_ID1, Team_ID2, Score_ID1, Score_ID2) 
                                SELECT p.Poules_ID, ?, ?, ?, ?
                                FROM poules p
                                WHERE p.Team_ID1 = ? OR p.Team_ID2 = ? OR p.Team_ID3 = ? OR p.Team_ID4 = ?
                                LIMIT 1");
        
        // Bind parameters aan de prepared statement
        $stmt->bind_param("iiiiiiii", $team1_id, $team2_id, $score1, $score2, $team1_id, $team1_id, $team1_id, $team1_id);
        
        // Voer de query uit
        if ($stmt->execute()) {
            echo "Nieuwe uitslag succesvol toegevoegd.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Sluit de prepared statement
        $stmt->close();
    }
}

// Sluit de verbinding
$conn->close();

// Doorsturen naar de vorige pagina
header("Location: Wschema.php");
exit;
?>

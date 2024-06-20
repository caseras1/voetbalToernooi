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
    foreach ($_POST['score'] as $wedstrijd_id => $scores) {
        $score1 = $scores['team1'];
        $score2 = $scores['team2'];

        // Bereid de query voor om de uitslagen op te slaan
        $sql = "UPDATE wedstrijden SET Score_ID1 = ?, Score_ID2 = ? WHERE Wedstrijd_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $score1, $score2, $wedstrijd_id);

        // Voer de query uit
        if ($stmt->execute()) {
            echo "Nieuwe uitslagen succesvol toegevoegd.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Sluit de statement
        $stmt->close();
    }
}

// Sluit de verbinding
$conn->close();

// Doorsturen naar de vorige pagina
header("Location: index.php");
exit;
?>

<?php
$servername = "localhost";  // Verander dit naar je eigen database hostnaam
$username = "root";          // Verander dit naar je eigen database gebruikersnaam
$password = "";              // Verander dit naar je eigen database wachtwoord
$dbname = "KidsLeague";   // Verander dit naar de naam van je eigen database

// Maak verbinding met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Functie om teams uit de database op te halen
function getTeams() {
    global $conn;
    $sql = "SELECT Team_naam FROM teams";
    $result = $conn->query($sql);
    $teams = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $teams[] = $row['naam'];
        }
    }
    return $teams;
}
?>
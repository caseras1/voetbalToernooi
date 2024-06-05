<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/teams.css">
    <title>teams aanmelding</title>
</head>
<body>

    <?php
    include("../include/header.html");
    ?>

    <div class="main-container">
        <div class="form-container">
            <h2>Voetbalteam Aanmelden</h2>
            <form action="html/send-email.php" method="post" id="team-form">
                <label for="team-name">Team Naam:</label>
                <input type="text" id="team-name" name="team_name" required>

                <label for="coach-name">Coach Naam:</label>
                <input type="text" id="coach-name" name="coach_name" required>

                <label for="coach-email">Coach Email:</label>
                <input type="email" id="coach-email" name="coach_email" required>

                <label for="coach_phone">Coach Telefoon:</label>
                <input type="tel" id="coach_phone" name="coach_phone" required>

                <!-- <h3>Spelers</h3>
                <div id="players-container">
                    <div class="player-group">
                        <label for="player1">Speler 1:</label>
                        <input type="text" id="player1" name="players[]" required>
                    </div>
                </div>
                <button type="button" id="add-player-btn">Speler Toevoegen</button>-->
                <button type="submit">Stuur mij een mail</button> 
            </form>
        </div>
    </div>

    <script src="../javascript/teams.js"></script>


</body>
</html>

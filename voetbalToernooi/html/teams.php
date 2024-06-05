<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/teams.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>teams aanmelding</title>
</head>
<body>

    <?php
    include("../include/header.html");
    ?>

            <h2>Voetbalteam Aanmelden</h2>

            <form action="../html/process.php" method="post">
                <input type="text" class="form-control mt-4" name="name" placeholder="Vul hier je Naam in: " required> <br>
                <input type="text" class="form-control mt-4" name="subject" placeholder="Vul hier uw team naam in: "> <br>
                <input type="email" class="form-control mt-4" name="email" placeholder="Vul hier je Email in: " required> <br>
                <textarea class="form-control mt-4" rows="5" name="message" placeholder="Vul hier jouw vraag in: "></textarea> <br>

                <h3>Spelers</h3>
                <div id="players-container">
                    <div class="player-group">
                        <button type="button" id="add-player-btn">Speler Toevoegen</button>
                        <label for="player1">Speler 1:</label>
                        <input type="text" id="player1" name="players[]" required>
                    </div>
                </div>
            
                <input type="submit" class="btn btn-primary mt-4" value="Send" name="Verzenden">
            
                <script src="../javascript/teams.js"></script> 

            
            
            </form>


               

</body>
</html>

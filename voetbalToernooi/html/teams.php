<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/teams.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Teams Aanmelding</title>
</head>
<body>

        <?php include("../include/header.html"); ?>

    <div class="main-container">
        <div class="form-container">
            <h2>Voetbalteam Aanmelden</h2>
            <form action="../html/process.php" method="post">
                <input type="text" class="form-control mt-4" name="name" placeholder="Vul hier je Naam in: " required>
                <input type="text" class="form-control mt-4" name="subject" placeholder="Vul hier uw team naam in: ">
                <input type="email" class="form-control mt-4" name="email" placeholder="Vul hier je Email in: " required>
                <textarea class="form-control mt-4" rows="5" name="message" placeholder="Vul hier jouw vraag in: "></textarea>
                <br>
                <h3>Spelers</h3>

                <button type="button" class="btn btn-secondary btn-sm mt-3 ms-2" id="add-player-btn">Toevoegen</button>

                <div id="players-container">
                    <div class="player-group d-flex align-items-center mt-2">
                        <label for="player1" class="form-label me-2">Speler 1:</label>
                        <input type="text" id="player1" name="players[]" class="form-control me-2" required>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mt-4" value="Send" name="Verzenden">
            </form>
        </div>
    </div>

    <script src="../javascript/teams.js"></script>

</body>
</html>

<?php
session_start();
include("../php/config.php")

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel ="stylesheet" href="../style/main.css">
    <title>Document</title>
</head>
<body>

    <?php
    include("../include/header.html")
    ?>

    <div class="box">
   <h2>Welkom bij de KidsLeague</h2>
   <h4>wij zijn een voetbal toernooi georganiseerd door basisschool de Gentiaan voor scholen uit de omgeving west-Brabant <a href="../html/teams.php">inschrijven</a>  kan nog , VOL IS VOL!</h4>



    </div>
    <div class="box1">
<h2>Tussenstanden:</h2>
    <!-- Hier wordt een iframe gebruikt om een andere webpagina in te sluiten -->
    <iframe src="tussenstand2.php" width="500" height="200" title="Ingesloten Pagina"></iframe>

</body>
</html>



 </div>

 </div>
    <div class="box3">
        <div class=logo1>
<img src="../images/logo-voetbaltoernooi.PNG" href="main.php">

        </div>




    </div>

    


    <?php
    include("../include/footer.html")
    ?>
    
    
</body>
</html>
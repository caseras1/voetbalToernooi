<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/headerFooter.css">
    <title>Document</title>
</head>
<body>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.menu-toggle').click(function(){
                $('.dropdown-menu').slideToggle();
            });
        });
    </script>

    <div class="nav">
        <div class="logo">
            <a href="../html/main.php"><img class="logoS" src="../images/Logo.jpg" alt="logo"></a>
        </div>

        <div class="menu-toggle">&#9776;</div> <!-- Add menu toggle button -->
        
        <div class="links-middle">
            <a href="../html/main.php">Home</a>
            <a href="../html/about.php">Over Ons</a>
            <a href="../html/teams.php">Teams</a>
            <a href="../html/schema.php">Schema</a>
            <a href="../html/contact.php">Contact</a>
        </div>
        
        <div class="right-links">
            <a href="../html/login.php"><button class="btn">Log in</button></a>
        </div>
        <div class="dropdown-menu">
            <a href="../html/main.php">Home</a>
            <a href="../html/about.php">Over Ons</a>
            <a href="../html/teams.php">Teams</a>
            <a href="../html/schema.php">Schema</a>
            <a href="../html/contact.php">Contact</a>
        </div>
    </div>
</body>
</html>
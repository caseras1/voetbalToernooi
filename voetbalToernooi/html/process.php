<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Adjust the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $userEmail = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $players = $_POST['players'];

    $playerList = "";
    foreach ($players as $index => $player) {
        $player = htmlspecialchars($player);
        $playerList .= "<p><strong>Speler " . ($index + 1) . ":</strong> $player</p>";
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'case.testing.3@gmail.com'; // Your Gmail address
        $mail->Password = 'nrorjwcowgkzuxzc'; // Your Gmail password or app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Email to user
        $mail->setFrom('case.testing.3@gmail.com', 'Your Name'); // Your "From" address
        $mail->addAddress($userEmail); // Send confirmation email to the user

        $mail->isHTML(true);
        $mail->Subject = "Uw aanmelding!";
        $mail->Body    = "
        <h2>Bedankt voor uw aanmelding aan de Kids League in Veghel!</h2>
        <p>Hier is de door u ingevulde informatie:</p>
        <p><strong>Volledige Naam:</strong> $name</p>
        <p><strong>Team Naam:</strong> $subject</p>
        <p><strong>Email:</strong> $userEmail</p>
        <p><strong>Extra Bericht:</strong><br>$message</p>
        <h3>Spelers:</h3>
        $playerList";

        $mail->AltBody = "Bedankt voor uw aanmelding aan de Kids League in Veghel!\n\n".
                         "Hier is de door u ingevulde informatie:\n".
                         "Volledige Naam: $name\n".
                         "Team naam: $subject\n".
                         "Email: $userEmail\n".
                         "Extra Bericht:\n$message\n\n".
                         "Spelers:\n" . implode("\n", array_map(function($player, $index) {
                             return "Speler " . ($index + 1) . ": $player";
                         }, $players, array_keys($players)));

        $mail->send();

        // Email to yourself
        $mail->clearAddresses(); // Clear previous recipient addresses
        $mail->addAddress('case.testing.3@gmail.com'); // Replace with your email address

        $mail->Subject = "Nieuwe Aanmelding";
        $mail->Body    = "
        <h2>Nieuwe aanmelding binnen gekomen</h2>
        <p>Hier is de informatie:</p>
        <p><strong>Naam:</strong> $name</p>
        <p><strong>Email:</strong> $userEmail</p>
        <p><strong>Team naam:</strong> $subject</p>
        <p><strong>Extra Bericht:</strong><br>$message</p>
        <h3>Spelers:</h3>
        $playerList";

        $mail->AltBody = "New form submission received:\n\n".
                         "Volledige Naam: $name\n".
                         "Email: $userEmail\n".
                         "Team Naam: $subject\n".
                         "Extra Bericht:\n$message\n\n".
                         "Spelers:\n" . implode("\n", array_map(function($player, $index) {
                             return "Speler " . ($index + 1) . ": $player";
                         }, $players, array_keys($players)));

        $mail->send();

        // Redirect to main.php
        header('Location: ../html/main.php');
        exit;
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<p>h</p>
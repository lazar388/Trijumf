<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = htmlspecialchars($_POST["ime"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $poruka = htmlspecialchars($_POST["poruka"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP konfiguracija
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'trijumf6@gmail.com'; // Tvoj Gmail
        $mail->Password = 'xact arxk dull wwhk'; // Lozinka (pogledaj ispod kako da je dobiješ)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Podaci o pošiljaocu i primaocu
        $mail->setFrom($email, $ime );
        $mail->addAddress('trijumf6@gmail.com'); // Tvoj e-mail gde ćeš primati poruke

        // Sadržaj poruke
        $mail->Subject = 'Nova poruka sa sajta';
        $mail->Body = "Ime i Prezime: $ime\nE-mail: $email\nTelefon: $telefon\n\nPoruka:\n$poruka";

        $mail->send();
        include("izlazna.html");
    } catch (Exception $e) {
        include("izlazna2.html");
    }
}
?>
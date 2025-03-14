<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php'; // Učitava PHPMailer i dotenv

// Učitavanje .env fajla
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ime = htmlspecialchars($_POST["ime"]);
    $email = htmlspecialchars($_POST["email"]);
    $telefon = htmlspecialchars($_POST["telefon"]);
    $poruka = htmlspecialchars($_POST["poruka"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP konfiguracija
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        // Pošiljalac i primalac
        $mail->setFrom($_ENV['SMTP_USER'], 'Trijumf Teretana');
        $mail->addAddress($_ENV['SMTP_USER']); // Gde stiže poruka

        // Sadržaj mejla
        $mail->Subject = 'Nova poruka sa sajta';
        $mail->Body = "Ime i Prezime: $ime\nE-mail: $email\nTelefon: $telefon\n\nPoruka:\n$poruka";

        $mail->send();

        $response['status'] = 'success';
        $response['message'] = 'Poruka je uspešno poslata!';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = "Greška pri slanju: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
}
?>


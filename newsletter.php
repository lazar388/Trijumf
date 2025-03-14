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
    $email = htmlspecialchars($_POST["email"]);

    // Proveri da li je email validan
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = 'Neispravan format mejla.';
        echo json_encode($response);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Prvi email - obaveštenje o prijavi
        $mail->isSMTP();
        $mail->Host = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['SMTP_USER'];
        $mail->Password = $_ENV['SMTP_PASS'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_USER']);
        $mail->addAddress($_ENV['SMTP_USER']); // Primatelj prijave

        $mail->addReplyTo($email); // Ovdje dodajete email korisnika koji je poslao mejl
        $mail->Subject = 'Prijava na newsletter';
        $mail->Body = "Novi korisnik se prijavio na newsletter: $email";

        // Drugi email - potvrda prijave korisniku
        $responseMail = new PHPMailer(true);
        $responseMail->isSMTP();
        $responseMail->Host = $_ENV['SMTP_HOST'];
        $responseMail->SMTPAuth = true;
        $responseMail->Username = $_ENV['SMTP_USER'];
        $responseMail->Password = $_ENV['SMTP_PASS'];
        $responseMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $responseMail->Port = $_ENV['SMTP_PORT'];

        $responseMail->setFrom($_ENV['SMTP_USER']);
        $responseMail->addAddress($email); // Adresa korisnika koji se prijavio
        $responseMail->Subject = 'Potvrda prijave na newsletter';
        $responseMail->Body = 'Dragi korisniče,

Zahvaljujemo se što ste se prijavili na Trijumf newsletter! Vaša prijava je uspešno registrovana, i od sada ćete biti među prvima koji će dobiti najnovije informacije, savete i ekskluzivne ponude iz sveta fitnesa i zdravlja.

Uskoro ćete početi da primate naše redovne biltene sa najnovijim vestima, promocijama i novostima iz Trijumf Teretane. Nadamo se da će vam naši sadržaji biti korisni i inspirativni na vašem fitness putovanju.

Ako imate bilo kakvih pitanja ili sugestija, slobodno nas kontaktirajte. Uvek smo tu za vas!

Hvala još jednom na poverenju, i dobrodošli u našu zajednicu!

Srdačno,
Trijumf Teretana
www.trijumsd.com';

        // Pošaljite oba emaila
        $mail->send();
        $responseMail->send();

        $response['status'] = 'success';
        $response['message'] = 'Uspešno ste prijavljeni!';

    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = "Greška pri slanju: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
}
?>


<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST["email"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['status'] = 'error';
        $response['message'] = 'Neispravan format mejla.';
        echo json_encode($response);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'trijumf6@gmail.com';
        $mail->Password = 'xact arxk dull wwhk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($email);
        $mail->addAddress('trijumf6@gmail.com');

        $mail->Subject = 'Prijava na newsletter';
        $mail->Body = "Novi korisnik se prijavio na newsletter: $email";

        $mail->send();
        $response['status'] = 'success';
        $response['message'] = 'Uspešno ste prijavljeni!';
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = "Greška pri slanju: {$mail->ErrorInfo}";
    }

    echo json_encode($response);
}
?>


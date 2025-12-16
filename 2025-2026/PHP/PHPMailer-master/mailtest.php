<?php
//rfww zanw cnpf kfnn


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP beállítások
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'konyhasimatemailer@gmail.com';      // IDE a Gmail címed
    $mail->Password   = 'hliz zybb yhrm opyj';             // 16 karakteres app jelszó
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Feladó / címzett
    $mail->setFrom('konyhasimatemailer@gmail.com', 'Teszt Feladó');
    $mail->addAddress('konyhasi.mate.21@ady-nagyatad.hu', 'Teszt Címzett');

    // Tartalom
    $mail->isHTML(true);
    $mail->Subject = 'PHPMailer teszt';
    $mail->Body    = '<b>Siker!</b> Ez az email localhostból érkezett.';
    $mail->AltBody = 'Siker! Ez az email localhostból érkezett.';

    $mail->send();
    echo '✅ Email sikeresen elküldve!';
} catch (Exception $e) {
    echo '❌ Hiba történt: ', $mail->ErrorInfo;
}
?>
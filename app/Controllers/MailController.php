<?php

namespace app\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailController {
    public function sendMail($name, $email, $content) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->charSet = "UTF-8";
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'pracowniapizzysobiekursk@gmail.com';
        $mail->Password = 'pracowniapizzy123';

        $mail->setFrom($email, $name);
        $mail->isHTML(true);
        $mail->addAddress('pracowniapizzysobiekursk@gmail.com', '');
        $mail->Subject = 'Wiadomość ze strony Pracownia Pizzy!';
        $mail->Body    = $content;
        

        if( $mail->send()) {
            echo "Wiadomość wysłana!";
        }
        else {
            echo $mail->ErrorInfo;
        }
    }
}
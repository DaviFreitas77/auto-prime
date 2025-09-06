<?php
namespace app\controller;
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendMailController
{

    public function SendMail($name, $email, $subject, $message)
    {

        $mail = new PHPMailer();
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'autoprimemotors2@gmail.com';
            $mail->Password   = 'tvuqbkjvwblbgven';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('autoprimemotors2@gmail.com', 'Auto prime');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();

            echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}

$controller = new SendMailController();
$controller->SendMail($name, $email, $subject, $message);

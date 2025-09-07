<?php

namespace app\controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class SendMailController
{

    private $name;
    private $email;
    private $subject;
    private $message;

    public function __construct($name, $email, $subject, $message) {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function SendMail()
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
            $mail->addAddress($this->email, $this->name);

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->message;

            $mail->send();

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}


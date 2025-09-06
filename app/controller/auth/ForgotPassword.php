<?php

use app\model\User;
use app\controller\SendMailController;

require(__DIR__ . '/../../../database.php');
class ForgotPassword
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
    }

    public function forgotPassword()
    {

        $cpf = $_POST['cpf'];

        if (empty($cpf)) {
            $_SESSION['errors']['message'] = "Preencha todos os campos";
            $_SESSION['errorInput'] = true;
            header("Location: ../../../resources/view/ForgotPassword.php");
            exit;
        }

        $user = new User($cpf, null, null, null, $this->conn);
        $forgot = $user->ForgotPassword();
        $subject = 'Recuperação de senha';
        $message = "Olá " . $forgot['name'] . ", você solicitou a recuperação da senha. Use este código para continuar:";

        if ($forgot) {
            $email = new SendMailController();
            $sendEmail = $email->SendMail($forgot['name'], $forgot['email'], $subject, $message);
        }
    }
}
$controller = new ForgotPassword($conn);
$controller->forgotPassword();

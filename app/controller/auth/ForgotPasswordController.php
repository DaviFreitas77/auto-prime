<?php

namespace app\controller\auth;

require __DIR__ . '/../../../vendor/autoload.php';

use app\model\ForgotPassword;
use app\controller\SendMailController;

require(__DIR__ . '/../../../database.php');

class ForgotPasswordController
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

        //verifica se esta vazio
        if (empty($cpf)) {
            $_SESSION['errors']['message'] = "Preencha todos os campos";
            $_SESSION['errorInput'] = true;
            header("Location: ../../../resources/view/ForgotPassword.php");
            exit;
        }

        //verifica se o cpf existe no banco de dados
        $forgotPassword = new ForgotPassword(null, null, null, null, $this->conn);
        $forgotPassword->setCpf($cpf);
        $forgot = $forgotPassword->verifyCpf();


        // se não existe,retorna um erro
        if (!$forgot) {
            $_SESSION['errors']['message'] = "CPF não encontrado";
            header("Location: ../../../resources/view/ForgotPassword.php");
            exit;
        }

        //cria um código aleatótio de 4digitos 
        $codigo = rand(1000, 9999);

        $forgotPassword->setCod($codigo);
        $forgotPassword->setCreatedAt(date('Y-m-d H:i:s'));
        $forgotPassword->setExpiresAt(date('Y-m-d H:i:s', strtotime('+15 minutes')));

        $forgotPassword->saveCode();

        if (!$forgotPassword) {
            $_SESSION['errors']['message'] = "Erro ao salvar o código";
            header("Location: ../../../resources/view/ForgotPassword.php");
            exit;
        }



        //envia o email
        $subject = 'Recuperar sua senha';
        $message = "Olá " . $forgot['name'] . ", você solicitou a recuperação da senha. Use este código para continuar: " . $codigo;

        $email = new SendMailController($forgot['name'], $forgot['email'], $subject, $message);
        $sendEmail = $email->SendMail();
        $_SESSION['emailSent'] = true;
        $_SESSION['emailClient']= $forgot['email'];
         header("Location: ../../../resources/view/ForgotPassword.php");
        if (!$sendEmail) {
            $_SESSION['errors']['message'] = "Erro ao enviar o email;";
            header("Location: ../../../resources/view/ForgotPassword.php");
            exit;
        }
    }
}

$controller = new ForgotPasswordController($conn);
$controller->forgotPassword();

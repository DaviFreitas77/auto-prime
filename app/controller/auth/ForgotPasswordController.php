<?php

namespace app\controller\auth;

require __DIR__ . '/../../../vendor/autoload.php';

use app\model\ForgotPassword;
use app\controller\SendMailController;
use utils\RedirectHelper;

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
            RedirectHelper::redirectWithError(
                "Preencha todos os campos",
                'message',
                ['errorInput' => true, 'cpf' => $cpf]
            );
        }

        //verifica se o cpf existe no banco de dados
        $forgotPassword = new ForgotPassword(null, null, null, null, $this->conn);
        $forgotPassword->setCpf($cpf);
        $forgot = $forgotPassword->verifyCpf();


        // se não existe,retorna um erro
        if (!$forgot) {
            RedirectHelper::redirectWithError(
                "CPF não encontrado",
                'message',
            );
        }

        //cria um código aleatório de 4digitos 
        $codigo = rand(1000, 9999);

        $forgotPassword->setCod($codigo);
        $forgotPassword->setCreatedAt(date('Y-m-d H:i:s'));
        $forgotPassword->setExpiresAt(date('Y-m-d H:i:s', strtotime('+15 minutes')));

        if (!$forgotPassword->saveCode()) {
            RedirectHelper::redirectWithError(
                "Erro ao salvar o código",
                'message',
            );
        }
        $_SESSION['cpf'] = $forgot['cpf'];
        //envia o email
        $subject = 'Recuperar sua senha';
        $message = "Olá " . $forgot['nome'] . ", você solicitou a recuperação da senha. Use este código para continuar: " . $codigo;

        $email = new SendMailController($forgot['nome'], $forgot['email'], $subject, $message);
        $sendEmail = $email->SendMail();

        if (!$sendEmail) {
            RedirectHelper::redirectWithError(
                "Erro ao enviar o email",
                'message',
            );
        }

        $_SESSION['emailSent'] = true;
        $_SESSION['emailClient'] = $forgot['email'];
        header("Location: ../../../resources/view/ForgotPassword.php");
        exit;
    }

    public function ConfirmedCod()
    {
        $cod = $_POST['cod'];
        $confirmCod = new ForgotPassword(null, $cod, null, null, $this->conn);
        $result = $confirmCod->verifyCod();

        if (!$cod) {
            RedirectHelper::redirectWithError("Preencha todos os campos", "message", ['errorCod' => true]);
        }

        if ($result) {
            RedirectHelper::redirectWithSuccess("",  "message", ['codConfirmed' => true]);
        } else {
            RedirectHelper::redirectWithError("Código inválido ou expirado.",  "message", ['errorCod' => true]);
        }
    }

    public function changePassword()
    {
        $cpf = $_POST['cpf'];
        $forgotPassword = new ForgotPassword($cpf, null, null, null, $this->conn);
        $newPassword = $_POST['newPassword'];
        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        if (!$newPassword) {
            RedirectHelper::redirectWithError("Preencha todos os campos", "message", ['errorPassword' => true]);
        }

        if ($forgotPassword->changePassword($hashPassword)) {
            unset($_SESSION['cpf']);
            $forgotPassword->deleteCode();
            RedirectHelper::redirectWithSuccess("Senha atualizada","message",[],'../../../resources/view/login.php');
        } else {
            RedirectHelper::redirectWithError("Erro ao atualizar senha", "message", ['errorPassword' => true]);
        }
    }
}

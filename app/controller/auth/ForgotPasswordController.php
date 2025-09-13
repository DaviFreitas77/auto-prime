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
        $subject = "Recuperar sua senha";

        $message = sprintf(
            '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Recuperação de Senha</title>
</head>
<body style="font-family: Arial, sans-serif; margin:0; padding:0; background-color:#f4f4f4;">
  <table width="100%%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f4f4f4; padding:20px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.1);">
          
          <!-- Header -->
          <tr>
            <td align="center" style="background-color:#004d40; padding:20px;">
              <h1 style="color:#ffffff; margin:0; font-size:24px;">Auto Prime</h1>
            </td>
          </tr>
          
          <!-- Corpo -->
          <tr>
            <td style="padding:30px; color:#333333; font-size:16px; line-height:1.5;">
              <p>Olá <strong>%s</strong>,</p>
              <p>Você solicitou a recuperação da sua senha.</p>
              <p>Use este código para continuar:</p>
              
              <p style="text-align:center; margin:30px 0;">
                <span style="display:inline-block; padding:12px 24px; font-size:20px; font-weight:bold; color:#004d40; background:#e0f2f1; border-radius:6px; border:1px solid #004d40;">
                  %s
                </span>
              </p>
              
              <p>Se você não fez essa solicitação, pode ignorar este e-mail.</p>
            </td>
          </tr>
          
          <!-- Footer -->
          <tr>
            <td align="center" style="background-color:#f1f1f1; padding:15px; font-size:12px; color:#666666;">
              <p style="margin:0;">&copy; %s Sistema Auto Prime. Todos os direitos reservados.</p>
            </td>
          </tr>
          
        </table>
      </td>
    </tr>
  </table>
</body>
</html>',
            htmlspecialchars($forgot['nome']),
            htmlspecialchars($codigo),
            date('Y')
        );

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
            RedirectHelper::redirectWithSuccess("Senha atualizada", "message", [], '../../../resources/view/login.php');
        } else {
            RedirectHelper::redirectWithError("Erro ao atualizar senha", "message", ['errorPassword' => true]);
        }
    }
}

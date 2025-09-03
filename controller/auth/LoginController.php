<?php
require(__DIR__ . '/../../model/User.php');
require(__DIR__ . '/../../database.php');

class LoginController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
    }

    public function Login()
    {

        $cpf = $_POST['cpf'];
        $password = $_POST['password'];


        if (empty($cpf) || empty($password)) {
            $_SESSION['errors']['message']= "Preencha todos os campos";
            $_SESSION['old'] = $_POST;
            $_SESSION['errorInput']  = true;
            header("Location: ../../view/login.php");
            exit;
            return;
        }

        $user = new User($cpf, null, null, $password, $this->conn);
        $login = $user->Login();

        if (!$login) {

            $_SESSION['errors']['message'] = "Credenciais inválidas";
            $_SESSION['old'] = $_POST;
            header("Location: ../../view/login.php");
            exit;
        }
        $_SESSION['name'] = $login['name'];
        $_SESSION['id'] = $login['id'];

        header("Location: ../../view/dashboard.php");
        exit;
    }
}

$controller = new LoginController($conn);
$controller->login();

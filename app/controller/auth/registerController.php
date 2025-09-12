<?php

namespace app\controller\auth;
use app\model\User;
require __DIR__ . '/../../../vendor/autoload.php';
require(__DIR__ . '/../../../database.php');


class registerController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        session_start();
    }

    public function Register()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD']  === "POST") {
            $name = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($name)) $errors['name'] = "nome é obrigatório";
            if (empty($cpf)) $errors['cpf'] = "cpf é obrigatório";
            if (empty($email)) $errors['email'] = "email é obrigatório";
            if (empty($password)) $errors['password'] = "senha obrigatória";

            if (empty($errors)) {
                $user = new User(null, null, null, null, $this->conn);
                $user->setName($name);
                $user->setCpf($cpf);
                $user->setEmail($email);
                $user->setPassword($password);
                $register = $user->registerUser();
                if ($register) {
                    $_SESSION['message'] = "usuario cadastrado";
                    header("Location: ../../../resources/view/register.php");
                    exit;
                } else {
                    $_SESSION['message'] = $register;
                }
            }
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = $_POST;
            header("Location: ../../../resources/view/register.php");
            exit;
        }
    }
}

$controller = new registerController($conn);
$controller->Register();

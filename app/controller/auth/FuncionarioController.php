<?php
require(__DIR__ . '/../../../database.php');
use app\model\Funcionario;


class FuncionarioController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerEmployee()
    {
        session_start();
        if (!isset($_SESSION['name'])) {
            $_SESSION['errors']['message'] = "Você precisa estar logado para acessar essa função";
            header("Location: /login.php");
            exit;
        }

        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
        $position = $_POST['position'];
        $sector = $_POST['sector'];
        $admission_date = $_POST['admission_date'];
        $wage = $_POST['wage'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $photo = $_POST['photo'];

        if (empty($name) || empty($cpf) || empty($position) || empty($sector) || empty($admission_date) || empty($wage) || empty($address) || empty($telephone) || empty($email) || empty($photo)) {
            $_SESSION['errors']['message'] = "Preencha todos os campos";
            $_SESSION['old'] = $_POST;
        }

        $employee = new Funcionario($name, $cpf, $position, $sector, $admission_date, $wage, $address, $telephone, $email, $photo, $this->conn);

        $employee->registerFunc();

        if ($employee) {
            $_SESSION['message'] = "Funcionário cadastrado com sucesso";
            exit;
        } else {
            $_SESSION['errors']['message'] = "Erro ao cadastrar funcionário";
            exit;
        }
    }
}

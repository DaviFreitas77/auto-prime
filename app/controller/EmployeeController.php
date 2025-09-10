<?php

namespace app\controller;

require_once __DIR__ . '/../../database.php';

require_once __DIR__ . '/../model/Employee.php';
require_once __DIR__ . '/../../utils/RedirectHelper.php';

use app\model\Employee;
use utils\RedirectHelper;

class EmployeeController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function registerEmployee()
    {

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

        $employee = new Employee($name, $cpf, $position, $sector, $admission_date, $wage, $address, $telephone, $email, $photo, $this->conn);

        $employee->registerFunc();

        if ($employee) {
            $_SESSION['message'] = "Funcionário cadastrado com sucesso";
            exit;
        } else {
            $_SESSION['errors']['message'] = "Erro ao cadastrar funcionário";
            exit;
        }
    }

    public function allEmployees()
    {
        if (!isset($_SESSION['name'])) {
            header("Location: /login.php");
            exit;
        }
        $employee = new Employee($this->conn);
        return $employee->allEmployees();
    }

    public function Delete($id)
    {
        $id = $_GET['id'];
        $employee = new Employee($this->conn);
        $employee->deleteEmployee($id);
        RedirectHelper::redirectWithSuccess("Funcionário excluído com sucesso", "message", [], "../../resources/view/dashboard.php");
    }
    public function SearchEmployee()
    {
        $searchEmployee = $_GET['search'] ?? '';

        $employee = new Employee($this->conn);
        $employee->setCpf($searchEmployee);
        $employee->setposition($searchEmployee);
        $employee->setName($searchEmployee);
        $employee->setsector($searchEmployee);
        $employee->setEmail($searchEmployee);
        $results = $employee->search();
        return $results;
    }
}


$employeeController = new EmployeeController($conn);
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $employeeController->Delete($_GET['id']);
}
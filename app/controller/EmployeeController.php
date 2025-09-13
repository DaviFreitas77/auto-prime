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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->conn = $conn;
    }

    public function registerEmployee()
    {


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


        if (empty($name) || empty($cpf) || empty($position) || empty($sector) || empty($admission_date) || empty($wage) || empty($address) || empty($telephone) || empty($email)) {
            $_SESSION['errors']['message'] = "Preencha todos os campos";
            $_SESSION['old'] = $_POST;
            header("Location: ../../resources/view/dashboard.php");
            exit;
        }

        $employee = new Employee($this->conn, $name, $cpf, $position, $sector, $admission_date, '', $address, $telephone, $email, $photo);
        $employee->setWage($wage);

        if ($employee->registerFunc()) {
            $_SESSION['message'] = "Funcionário cadastrado com sucesso";
            header("Location: ../../resources/view/dashboard.php");
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

    public function delete()
    {
        $id = $_GET['id'];
        $employee = new Employee($this->conn);
        $employee->deleteEmployee($id);
        RedirectHelper::redirectWithSuccess("Funcionário excluído com sucesso", "message", [], "../../resources/view/dashboard.php");
    }

    public function getEmployeeById()
    {
        $id = $_GET['id'];

        $employee = new Employee($this->conn);
        return $employee->getEmployeeById($id);
    }

    public function UpdateEmployee()
    {
        $id = $_POST['id'];
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
        $employee = new Employee($this->conn, $name, $cpf, $position, $sector, $admission_date, $wage, $address, $telephone, $email, $photo);
        $employee->updateEmployee($id);
        if ($employee) {
            RedirectHelper::redirectWithSuccess("Funcionário atualizado com sucesso", "message", [], "../../resources/view/dashboard.php");
        } else {
            RedirectHelper::redirectWithSuccess("Erro ao atualizar funcionário", "errors", ["message" => "Erro ao atualizar funcionário"], "../../resources/view/dashboard.php");
        }
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

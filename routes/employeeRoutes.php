<?php
namespace routes;
require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database.php';

use app\controller\EmployeeController;

$employeeController = new EmployeeController($conn);
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $employeeController->delete();
}

if (isset($_POST['action']) && $_POST['action'] === 'register') {
    $employeeController->registerEmployee();
}

if (isset($_POST['action']) && $_POST['action'] === 'update' && isset($_POST['id'])) {
    $employeeController->UpdateEmployee();
}

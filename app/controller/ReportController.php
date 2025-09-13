<?php

namespace app\controller;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../database.php';

use utils\PDFHelper;
use app\controller\EmployeeController;

class ReportController
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function generateReport()
    {

        $employeeController = new EmployeeController($this->conn);
        $employees = $employeeController->allEmployees();


        $html = '
        <h2 style="text-align:center; color:#134e4a; font-family:inter;">Relatório de Funcionários</h2>
        <table style="width:100%; border-collapse:collapse; font-family:inter;">
            <thead>
                <tr style="background-color:#e0f2f1; color:#134e4a;">
                    <th style="border:1px solid #ccc; ">Nome</th>
                    <th style="border:1px solid #ccc; ">CPF</th>
                    <th style="border:1px solid #ccc; ">Cargo</th>
                    <th style="border:1px solid #ccc; ">Setor</th>
                    <th style="border:1px solid #ccc; ">Admissão</th>
                    <th style="border:1px solid #ccc; ">Salário</th>
                    <th style="border:1px solid #ccc; ">Endereço</th>
                    <th style="border:1px solid #ccc; ">Telefone</th>
                    <th style="border:1px solid #ccc; ">Email</th>
                </tr>
            </thead>
            <tbody>
    ';
        foreach ($employees as $employee) {
            $html .= "<tr>
        <td style='border:1px solid #ccc; padding:4px; width:120px;'>{$employee['name']}</td>
        <td style='border:1px solid #ccc; padding:4px;  width:120px;'>{$employee['cpf']}</td>
        <td style='border:1px solid #ccc; padding:4px;'>{$employee['position']}</td>
        <td style='border:1px solid #ccc; padding:4px;'>{$employee['sector']}</td>
        <td style='border:1px solid #ccc; padding:4px;width:120px;'>{$employee['admission_date']}</td>
        <td style='border:1px solid #ccc; padding:4px;width:120px;'>R$ {$employee['wage']}</td>
        <td style='border:1px solid #ccc; padding:4px; width:120px;'>{$employee['address']}</td>
        <td style='border:1px solid #ccc; padding:4px; width:120px;'>{$employee['telephone']}</td>
        <td style='border:1px solid #ccc; padding:4px; width:120px;'>{$employee['email']}</td>
    </tr>";
        }
        $html .= '
        </tbody>
    </table>
';
        PDFHelper::generatePDF($html, 'relatorio_funcionarios.pdf');
    }
}

$controller = new ReportController($conn);
$controller->generateReport();

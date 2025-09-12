<?php

use PHPUnit\Framework\TestCase;
use app\model\Employee;

class EmployeeTest extends TestCase
{
    private $conn;

    protected function setUp(): void

    {
        $this->conn = new PDO('sqlite::memory:');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->exec("
            CREATE TABLE tb_employee (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name VARCHAR(100) NOT NULL,
            cpf VARCHAR(14) NOT NULL,
            position VARCHAR(50) NOT NULL,
            sector VARCHAR(50) NOT NULL,
            admission_date DATE NOT NULL,
            wage DECIMAL(10,2) NOT NULL,
            address TEXT NOT NULL,
            telephone VARCHAR(15) NOT NULL,
            email VARCHAR(100) NOT NULL,
            photo VARCHAR(255)
        )
        ");
    }
    public function test_employee_creation_success()
    {
        $employee = new Employee($this->conn, 'jhow', '49552222311', 'Analista', 'TI', '2023-10-10', '3000', 'rua A', '123456789', 'jhow@gmail.com', null);

        $this->assertTrue($employee->registerFunc());
    }


    public function test_get_all_employees()
    {
        $employee = new Employee($this->conn, 'jhow', '49552222311', 'Analista', 'TI', '2023-10-10', '3000', 'rua A', '123456789', 'jhow@gmail.com', null);
        $employee->registerFunc();

        $all = $employee->allEmployees();

        $this->assertIsArray($all);
        $this->assertCount(1, $all);
    }
    public function test_get_employee_by_id()
    {
        $employee = new Employee($this->conn, 'jhow', '49552222311', 'Analista', 'TI', '2023-10-10', '3000', 'rua A', '123456789', 'jhow@gmail.com', null);
        $employee->registerFunc();
        $id = 1;
        $result = $employee->getEmployeeById($id);

        $this->assertIsArray($result);
        $this->assertEquals('jhow', $result['name']);
    }

    public function test_update_employee()
    {
        $employee = new Employee($this->conn, 'jhow', '49552222311', 'Analista', 'TI', '2023-10-10', '3000', 'rua A', '123456789', 'jhow@gmail.com', null);
        $employee->registerFunc();
        $employee->setName('jhow updated');
        $id = 1;
        $result = $employee->updateEmployee($id);

        $this->assertTrue($result);
    }
}

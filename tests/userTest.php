<?php

use PHPUnit\Framework\TestCase;
use app\model\User;

class UserTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        $this->conn = new PDO('sqlite::memory:');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->exec("
            CREATE TABLE tb_user (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            cpf TEXT NOT NULL UNIQUE,
            nome TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        )
        ");
    }


    public function test_user_registration_success()
    {
        $user = new User('123456789', 'davi', 'davi@gmail.com', 'password123', $this->conn);
        $this->assertTrue($user->registerUser());
    }

    public function test_user_login_success()
    {
        $hash = password_hash('password123', PASSWORD_BCRYPT);
        $user = new User('123456789', 'davi', 'davi@gmail.com',   $hash, $this->conn);
        $this->assertTrue($user->registerUser());

        $loginUser = new User("123456789", "", "", "password123", $this->conn);
        $result = $loginUser->Login();
        $this->assertIsArray($result);
    }
    public function test_user_login_failed()
    {
        $hash = password_hash('password123', PASSWORD_BCRYPT);
        $user = new User('123456789', 'davi', 'davi@gmail.com',   $hash, $this->conn);
        $this->assertTrue($user->registerUser());

        $loginUser = new User("123456789", "", "", "password1234", $this->conn);
        $result = $loginUser->Login();
        $this->assertFalse($result);
    }
}

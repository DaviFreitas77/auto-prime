<?php
namespace app\model;

use PDOException;

class User
{
    private  $cpf;
    private  $name;
    private  $email;
    private  $password;
    private  $conn;

    public function __construct($cpf, $name, $email, $password, $conn)
    {
        $this->name = $name;
        $this->cpf =  $cpf;
        $this->email = $email;
        $this->password = $password;
        $this->conn = $conn;
    }

    // Getters
    public function getCpf()
    {
        return $this->cpf;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    // Setters (caso precise alterar)
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCpf($cpf)
    {
        $this->cpf = str_replace(['.', '-'], '', $cpf);
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser()
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO tb_user (cpf,name,email,password) VALUES (:cpf,:name,:email,:password)");

            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->execute();

            return true;
        } catch (\PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public function Login()
    {
        try {
            $cpf =  str_replace(['.', '-'], '', $this->cpf);
            $stmt = $this->conn->prepare("SELECT * FROM  tb_user WHERE cpf = :cpf");
            $stmt->bindParam(':cpf', $cpf);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($user && password_verify($this->password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function logOut(){
        session_destroy();
        header("Location: /login");
        exit();
    }
}

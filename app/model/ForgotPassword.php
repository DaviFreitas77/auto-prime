<?php

namespace app\model;

use PDO;
use PDOException;

class ForgotPassword
{
    private $cpf;
    private $cod;
    private $created_at;
    private $expires_at;
    private $conn;

    public function __construct($cpf, $cod, $created_at, $expires_at, $conn)
    {
        $this->cpf = $cpf;
        $this->cod = $cod;
        $this->created_at = $created_at;
        $this->expires_at = $expires_at;
        $this->conn = $conn;
    }

    // Getters
    public function getCpf()
    {
        return $this->cpf;
    }

    public function getCod()
    {
        return $this->cod;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getExpiresAt()
    {
        return $this->expires_at;
    }

    // Setters
    public function setCpf($cpf)
    {
        $this->cpf = str_replace(['.', '-'], '', $cpf);
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
    }

    public function verifyCpf()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM tb_user WHERE cpf = :cpf");
            $stmt->bindParam(':cpf', $this->cpf, \PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            if ($user) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function saveCode(){
        try{
            $stmt = $this->conn->prepare("INSERT INTO password_reset (cpf, cod, created_at, expires_at) VALUES (:cpf, :cod, :created_at, :expires_at)");
            $stmt->bindParam(':cpf', $this->cpf, \PDO::PARAM_STR);
            $stmt->bindParam(':cod', $this->cod, \PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $this->created_at, \PDO::PARAM_STR);
            $stmt->bindParam(':expires_at', $this->expires_at, \PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }

}

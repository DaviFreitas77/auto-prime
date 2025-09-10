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

    public function saveCode()
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO password_reset (cpf, cod, created_at, expires_at) VALUES (:cpf, :cod, :created_at, :expires_at)");
            $stmt->bindParam(':cpf', $this->cpf, \PDO::PARAM_STR);
            $stmt->bindParam(':cod', $this->cod, \PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $this->created_at, \PDO::PARAM_STR);
            $stmt->bindParam(':expires_at', $this->expires_at, \PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function verifyCod()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM password_reset WHERE cod = :cod");
            $stmt->bindParam(":cod", $this->cod);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);


            if ($result && $result['expires_at'] >= date('Y-m-d H:i:s')) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function changePassword($newPassword)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE tb_user SET password = :password WHERE cpf = :cpf");
            $stmt->bindParam(":password",  $newPassword, \PDO::PARAM_STR);
            $stmt->bindParam(":cpf",$this->cpf, \PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function deleteCode()
    {
        $stmt = $this->conn->prepare("DELETE FROM password_reset WHERE cpf = :cpf");
        $stmt->bindParam(":cpf", $this->cpf, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}

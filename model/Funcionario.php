<?php

class Funcionario
{

    private $id;
    private $name;
    private $cpf;
    private $cargo;
    private $setor;
    private $data_admissao;
    private $salario;
    private $endereco;
    private $telefone;
    private $email;
    private $foto;
    private $conn;
 
    public function __construct(
        $id ,
        $name ,
        $cpf ,
        $cargo ,
        $setor ,
        $data_admissao ,
        $salario ,
        $endereco ,
        $telefone ,
        $email ,
        $foto, 
        $conn
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->cargo = $cargo;
        $this->setor = $setor;
        $this->data_admissao = $data_admissao;
        $this->salario = $salario;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->foto = $foto;
        $this->conn = $conn;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId( $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName( $name)
    {
        $this->name = $name;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf( $cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCargo()
    {
        return $this->cargo;
    }

    public function setCargo( $cargo)
    {
        $this->cargo = $cargo;
    }

    public function getSetor()
    {
        return $this->setor;
    }

    public function setSetor( $setor)
    {
        $this->setor = $setor;
    }

    public function getDataAdmissao()
    {
        return $this->data_admissao;
    }

    public function setDataAdmissao( $data_admissao)
    {
        $this->data_admissao = $data_admissao;
    }

    public function getSalario()
    {
        return $this->salario;
    }

    public function setSalario($salario)
    {
        $this->salario = $salario;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco( $endereco)
    {
        $this->endereco = $endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone( $telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail( $email)
    {
        $this->email = $email;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFoto( $foto)
    {
        $this->foto = $foto;
    }

    public function registerFunc(){
        $stmt = $this->conn->prepare('INSERT INTO funcionario (name, cpf, cargo, setor, data_admissao, salario, endereco, telefone, email, foto) VALUES (:name, :cpf, :cargo, :setor, :data_admissao, :salario, :endereco, :telefone, :email, :foto)');
        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $this->cpf, PDO::PARAM_STR);
        $stmt->bindValue(':cargo', $this->cargo, PDO::PARAM_STR);
        $stmt->bindValue(':setor', $this->setor, PDO::PARAM_STR);
        $stmt->bindValue(':data_admissao', $this->data_admissao, PDO::PARAM_STR);
        $stmt->bindValue(':salario', $this->salario, PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $this->endereco, PDO::PARAM_STR);
        $stmt->bindValue(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindValue(':foto', $this->foto, PDO::PARAM_STR);
        $stmt->execute();
    
    }
}

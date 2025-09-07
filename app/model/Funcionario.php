<?php
namespace app\model;
class Funcionario
{

    private $id;
    private $name;
    private $cpf;
    private $position;
    private $sector;
    private $admission_date;
    private $wage;
    private $address;
    private $telephone;
    private $email;
    private $photo;
    private $conn;
 
    public function __construct(
        $name ,
        $cpf ,
        $position ,
        $sector ,
        $admission_date ,
        $wage ,
        $address ,
        $telephone ,
        $email ,
        $photo, 
        $conn
    ) {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->position = $position;
        $this->sector = $sector;
        $this->admission_date = $admission_date;
        $this->wage = $wage;
        $this->address = $address;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->photo = $photo;
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

    public function getposition()
    {
        return $this->position;
    }

    public function setposition( $position)
    {
        $this->position = $position;
    }

    public function getsector()
    {
        return $this->sector;
    }

    public function setsector( $sector)
    {
        $this->sector = $sector;
    }

    public function getDataAdmissao()
    {
        return $this->admission_date;
    }

    public function setDataAdmissao( $admission_date)
    {
        $this->admission_date = $admission_date;
    }

    public function getwage()
    {
        return $this->wage;
    }

    public function setwage($wage)
    {
        $this->wage = $wage;
    }

    public function getaddress()
    {
        return $this->address;
    }

    public function setaddress( $address)
    {
        $this->address = $address;
    }

    public function gettelephone()
    {
        return $this->telephone;
    }

    public function settelephone( $telephone)
    {
        $this->telephone = $telephone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail( $email)
    {
        $this->email = $email;
    }

    public function getphoto()
    {
        return $this->photo;
    }

    public function setphoto( $photo)
    {
        $this->photo = $photo;
    }

    public function registerFunc(){
        $stmt = $this->conn->prepare('INSERT INTO funcionario (name, cpf, position, sector, admission_date, wage, address, telephone, email, photo) VALUES (:name, :cpf, :position, :sector, :admission_date, :wage, :address, :telephone, :email, :photo)');
        $stmt->bindParam(':name', $this->name, \PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $this->cpf, \PDO::PARAM_STR);
        $stmt->bindParam(':position', $this->position, \PDO::PARAM_STR);
        $stmt->bindParam(':sector', $this->sector, \PDO::PARAM_STR);
        $stmt->bindParam(':admission_date', $this->admission_date, \PDO::PARAM_STR);
        $stmt->bindParam(':wage', $this->wage, \PDO::PARAM_STR);
        $stmt->bindParam(':address', $this->address, \PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $this->telephone, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->email, \PDO::PARAM_STR);
        $stmt->bindParam(':photo', $this->photo, \PDO::PARAM_STR);
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
        
    
    }
}

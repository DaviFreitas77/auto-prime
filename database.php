<?php
$userName = "root";
$password = "";

try{
    $conn = new PDO("mysql:host=localhost;dbname=autoprime",$userName,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
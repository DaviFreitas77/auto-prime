<?php
$userName = "root";
$password = "root";

try{
    $conn = new PDO("mysql:host=mysql;dbname=autoprime",$userName,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo $e->getMessage();
}
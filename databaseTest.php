<?php
$userName = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=mysql;dbname=test", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die($e->getMessage());
}

return $conn;

<?php 
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = "arcadia";
    try{
        $pdo = new PDO("mysql:host={$host};dbname={$database}", $username, $password);
        $pdo -> setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }   catch(PDOException $e) {
        echo $e->getMessage();
    }
?>
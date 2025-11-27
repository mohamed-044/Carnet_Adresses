<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "Carnet";

try {
    $mysqlClient = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
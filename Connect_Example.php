<?php
// Modifiez le nom du fichier en DBConnect.php et changez les valeurs de $host, $user, $password $dbname et $port. 
class DBConnect {
    public static function getPDO():PDO{
$host = "";
$user = "";
$password = "";
$dbname = "";
$port = "";

try {
    $mysqlClient = new PDO(  // Connexion à la base de données
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",  
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    return $mysqlClient;
} catch (Exception $e) {
    die("Erreur de connexion : " . $e->getMessage());    // Sinon message d'erreur
}
}
}
// Affichage des erreurs
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
$pdo = DBConnect::getPDO(); // Objet pdo
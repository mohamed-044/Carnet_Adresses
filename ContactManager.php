<?php
class ContactManager {

    private static function getConnection() {
        require_once(__DIR__ . '/DBConnect.php');   // récupération de la connexion à la base de données
        try {
            return DBConnect::getPDO();
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());   // Sinon message d'erreur
        }
    }

    public static function findAll() : array {
    $mysqlClient = self::getConnection();   // récupération de la connexion à la base de données

    try {
        $stmt = $mysqlClient->query("SELECT * FROM Contact");   // Requête pour tout récupérer dans la table Contact
    } catch (Exception $e) {
        die("Erreur lors de la récupération des contacts : " . $e->getMessage());   // Sinon message d'erreur
    }

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $contacts = [];

    foreach ($rows as $data) {
        $contacts[] = new Contact(  // On stocke tout dans contacts
            (int)$data['id'],
            $data['name'],
            $data['email'],
            $data['phone_number']
        );
    }

    return $contacts;
    }

    public static function findById(int $id) : ?Contact {
        $mysqlClient = self::getConnection();

        try {
            $stmt = $mysqlClient->prepare("SELECT * FROM Contact WHERE id = ?");    // Requête pour tout récupérer dans la table Contact avec l'id
            $stmt->execute([$id]);
        } catch (Exception $e) {
            die("Erreur lors de la récupération : " . $e->getMessage());    // Sinon message d'erreur
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        return new Contact( // On stocke tout dans contacts
            (int)$data['id'],
            $data['name'],
            $data['email'],
            $data['phone_number']
        );
    }

    public static function delete(int $id) : bool {
        $mysqlClient = self::getConnection();   // récupération de la connexion à la base de données

        try {
            $stmt = $mysqlClient->prepare("DELETE FROM Contact WHERE id = ?");  // Requête pour supprimer dans la table Contact
            $stmt->execute([$id]);
        } catch (Exception $e) {
            die("Erreur lors de la suppression : " . $e->getMessage()); // Sinon message d'erreur
        }

        return $stmt->rowCount() > 0;
    }

    public static function create(string $name, string $email, string $phone_number) : bool {
        $mysqlClient = self::getConnection();   // récupération de la connexion à la base de données

        try {
            $stmt = $mysqlClient->prepare(
                "INSERT INTO Contact (name, email, phone_number) VALUES (?, ?, ?)"  // Requête pour insérer dans la table Contact
            );
            $stmt->execute([$name, $email, $phone_number]);
        } catch (Exception $e) {
            die("Erreur lors de la création : " . $e->getMessage());    // Sinon message d'erreur
        }

        return $stmt->rowCount() > 0;
    }

    public static function modify(string $id, string $name, string $email, string $phone_number) : bool {
        $mysqlClient = self::getConnection();   // récupération de la connexion à la base de données

        try {
            $stmt = $mysqlClient->prepare(
                "UPDATE Contact SET name=?, email=?, phone_number=? WHERE id=?" // Requête pour modifier dans la table Contact
            );
            $stmt->execute([$name, $email, $phone_number, $id]);
        } catch (Exception $e) {
            die("Erreur lors de la création : " . $e->getMessage()); // Sinon message d'erreur
        }

        return $stmt->rowCount() > 0;
    }
}

<?php
class ContactManager {

    private static function getConnection() {
        require_once(__DIR__ . '/DBConnect.php');
        try {
            return DBConnect::getPDO();
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public static function findAll() : array {
        $mysqlClient = self::getConnection();

        try {
            $stmt = $mysqlClient->query("SELECT * FROM Contact");
        } catch (Exception $e) {
            die("Erreur lors de la récupération des contacts : " . $e->getMessage());
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id) : ?Contact {
        $mysqlClient = self::getConnection();

        try {
            $stmt = $mysqlClient->prepare("SELECT * FROM Contact WHERE id = ?");
            $stmt->execute([$id]);
        } catch (Exception $e) {
            die("Erreur lors de la récupération : " . $e->getMessage());
        }

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) return null;

        return new Contact(
            (int)$data['id'],
            $data['name'],
            $data['email'],
            $data['phone_number']
        );
    }

    public static function delete(int $id) : bool {
        $mysqlClient = self::getConnection();

        try {
            $stmt = $mysqlClient->prepare("DELETE FROM Contact WHERE id = ?");
            $stmt->execute([$id]);
        } catch (Exception $e) {
            die("Erreur lors de la suppression : " . $e->getMessage());
        }

        return $stmt->rowCount() > 0;
    }

    public static function create(string $name, string $email, string $phone_number) : bool {
        $mysqlClient = self::getConnection();

        try {
            $stmt = $mysqlClient->prepare(
                "INSERT INTO Contact (name, email, phone_number) VALUES (?, ?, ?)"
            );
            $stmt->execute([$name, $email, $phone_number]);
        } catch (Exception $e) {
            die("Erreur lors de la création : " . $e->getMessage());
        }

        return $stmt->rowCount() > 0;
    }
}

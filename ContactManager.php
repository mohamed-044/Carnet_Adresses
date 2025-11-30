<?php
class ContactManager {
    public function findAll() : array{
    require_once(__DIR__ . '/DBConnect.php');     
    $mysqlClient = DBConnect::getPDO();  
    $contactsStatement = $mysqlClient->query('SELECT * FROM Contact');
    $contacts = $contactsStatement->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
    }   
    public function findById(int $id) : ?Contact{
    require_once(__DIR__ . '/DBConnect.php');     
    $mysqlClient = DBConnect::getPDO();  
    $contactsStatement = $mysqlClient->prepare('SELECT * FROM Contact WHERE id = ?');
    $contactsStatement->execute([$id]);
    $data = $contactsStatement->fetch(PDO::FETCH_ASSOC);
    if (!$data) {
        return null;
    }
    return new Contact(
        intval($data['id']),
        $data['name'],
        $data['email'],
        $data['phone_number']
    );   
    }
    public function delete(int $id) : bool{
    require_once(__DIR__ . '/DBConnect.php');     
    $mysqlClient = DBConnect::getPDO();  
    $contactsStatement = $mysqlClient->prepare('DELETE FROM Contact WHERE id = ?');
    $contactsStatement->execute([$id]);
    return $contactsStatement->rowCount() > 0;
    }
}
<?php
class ContactManager {
    public function findAll() : array{
    require_once(__DIR__ . '/DBConnect.php');     
    $mysqlClient = DBConnect::getPDO();  
    $contactsStatement = $mysqlClient->query('SELECT * FROM Contact');
    $contacts = $contactsStatement->fetchAll(PDO::FETCH_ASSOC);
    return $contacts;
    }   
}
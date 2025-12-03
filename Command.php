<?php
require_once(__DIR__ . '/ContactManager.php');
require_once(__DIR__ . '/Contact.php');
Class Command {
    private $result;
    private $id;
    private $delete;
    private $name;
    private $email;
    private $phone_number;
    private $create;

    public function list() {
        $contact = new ContactManager; 
        $contacts = $contact->findAll();
        echo "Liste des contacts : \nid, name, email, phone number\n";
        foreach ($contacts as $contact)
        {
            echo "{$contact['id']}, {$contact['name']}, {$contact['email']}, {$contact['phone_number']}\n";
        }
    }
    public function help() {
        echo "help : affiche cette aide\n";
        echo "list : liste des contacts\n";
        echo "detail [id] : affiche le détail d'un contact\n";
        echo "create [name], [email], [phone number] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "quit : quitte le programme\n";
    }
    public function detailCheck($line){
        if (preg_match("/^detail (\d+)$/", $line, $matches)) {
            $this->id = intval($matches[1]);
            $manager = new ContactManager;
            $this->result = $manager->findById($this->id );
            return true;
    }
    return false;
    }
    public function detail(){
        if ($this->result) {
        echo $this->result->getId() . ", " .
            $this->result->getName() . ", " .
            $this->result->getEmail() . ", " .
            $this->result->getPhoneNumber() . "\n";
        }
        else {
        echo "Aucun contact trouvé avec l'id {$this->id}\n";
    }
    }
    public function deleteCheck($line){
        if (preg_match("/^delete (\d+)$/", $line, $matches)) {
        $this->id = intval($matches[1]);
        $manager = new ContactManager;
        $this->delete = $manager->delete($this->id);
        return true;
    }
    return false;
    }
    public function delete(){
        if ($this->delete) {
            echo "Contact supprimé\n";
            $manager = new ContactManager;
            $contacts = $manager->findAll();
        } 
        else {
            echo "Le contact n'a pas pu être supprimé\n";
        }
    }
    public function createCheck($line){
        if (preg_match("/^create \s*([^,]+),\s*([^,]+),\s*(\S+)$/", $line, $matches)) {
        $this->name = trim($matches[1]);
        $this->email = trim($matches[2]);
        $this->phone_number = trim($matches[3]);
        $manager = new ContactManager;
        $this->create = $manager->create($this->name, $this->email, $this->phone_number);
        return true;
    }
    return false;
    }
    public function create(){
        if ($this->create) {
            echo "Contact créé\n";
            $manager = new ContactManager;
            $contacts = $manager->findAll();
        } 
        else {
            echo "Le contact n'a pas pu être créé\n";
        }
    }
}
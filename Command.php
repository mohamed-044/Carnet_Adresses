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
    private $modify;

    public function list() {
        $contacts = ContactManager::findAll();  // On récupère les contacts
        echo "Liste des contacts : \nid, name, email, phone number\n";
        foreach ($contacts as $contact)
        {
            echo ("{$contact}\n");  // On les affiche
        }
    }
    public function help() {    // On affiche les aides
        echo "help : affiche cette aide\n";
        echo "list : liste des contacts\n";
        echo "detail [id] : affiche le détail d'un contact\n";
        echo "create [name], [email], [phone number] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "modify [id], [name], [email], [phone number] : modifie un contact\n";
        echo "quit : quitte le programme\n";
    }
    public function detailCheck($line){
        if (preg_match("/^detail (\d+)$/", $line, $matches)) {  // On vérifie si il y a detail avec l'id
            $this->id = intval($matches[1]);    // On stocke l'id
            $this->result = ContactManager::findById($this->id ); // On stocke le contact qui correspond à l'id
            return true;
    }
    return false;
    }
    public function detail(){
        if ($this->result) {    // Si l'id existe 
        echo $this->result->getId() . ", " .    // On affiche les details du contact
            $this->result->getName() . ", " .
            $this->result->getEmail() . ", " .
            $this->result->getPhoneNumber() . "\n";
        }
        else {
        echo "Aucun contact trouvé avec l'id {$this->id}\n"; // Sinon un message d'erreur
    }
    }
    public function deleteCheck($line){
        if (preg_match("/^delete (\d+)$/", $line, $matches)) {  // On vérifie si il y a delete avec l'id
        $this->id = intval($matches[1]); // On stocke l'id
        $this->delete = ContactManager::delete($this->id);  // On supprime et stocke le contact qui correspond à l'id
        return true;
    }
    return false;
    }
    public function delete(){
        if ($this->delete) {    // Si l'id existe et est supprimé
            echo "Contact supprimé\n";
        } 
        else {
            echo "Le contact n'a pas pu être supprimé\n";   // Sinon un message d'erreur
        }
    }
    public function createCheck($line){
        if (preg_match("/^create \s*([^,]+),\s*([^,]+),\s*(\S+)$/", $line, $matches)) { // On vérifie si il y a create avec l'id
        $this->name = trim($matches[1]);    // On stocke le name
        $this->email = trim($matches[2]);   // On stocke l'email
        $this->phone_number = trim($matches[3]);    // On stocke le phone number
        $this->create =ContactManager::create($this->name, $this->email, $this->phone_number);  // On crée et stocke le contact qui correspond à l'id
        return true;
    }
    return false;
    }
    public function create(){
        if ($this->create) {    // Si l'id existe et est créé
            echo "Contact créé\n";
        } 
        else {
            echo "Le contact n'a pas pu être créé\n";   // Sinon un message d'erreur
        }
    }
    public function modifyCheck($line){
        if (preg_match("/^modify (\d+),\s*([^,]+),\s*([^,]+),\s*(\S+)$/", $line, $matches)) {   // On vérifie si il y a create avec l'id
        $this->id = intval($matches[1]);
        $this->name = trim($matches[2]);    // On stocke le name
        $this->email = trim($matches[3]);   // On stocke l'email
        $this->phone_number = trim($matches[4]);    // On stocke le phone number
        $this->modify = ContactManager::modify($this->id, $this->name, $this->email, $this->phone_number); // On modifie et stocke le contact qui correspond à l'id
        return true;
    }
    return false;
    }
    public function modify(){
        if ($this->modify) {    // Si l'id existe et est modifié
            echo "Contact modifié\n";
            $contact = ContactManager::findById($this->id);    // On récupère le contact avec l'id
            echo ("{$contact}\n");  // On affiche le contact modifié
        } 
        else {
            echo "Le contact n'a pas pu être modifié\n";    // Sinon un message d'erreur
        }
    }
}
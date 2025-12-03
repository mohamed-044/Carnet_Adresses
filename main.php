<?php
require_once(__DIR__ . '/ContactManager.php');
require_once(__DIR__ . '/Contact.php');
$manager = new ContactManager;
$contacts = $manager->findAll();
echo "Attention à la syntaxe des commandes, les espaces et les virgules sont importants.\n";
while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
    if ($line === 'help') {
        echo "help : affiche cette aide\n";
        echo "list : liste des contacts\n";
        echo "create [name], [email], [phone number] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "quit : quitte le programme\n";
    }
    else if ($line === 'list'){
        echo "Liste des contacts : \nid, name, email, phone number\n";
        foreach ($contacts as $contact)
        {
            echo "{$contact['id']}, {$contact['name']}, {$contact['email']}, {$contact['phone_number']}\n";
        }
    }
    else if (preg_match("/^detail (\d+)$/", $line, $matches)) {
    $id = intval($matches[1]);
    $result = $manager->findById($id);
    if ($result) {
        echo $result->getId() . ", " .
         $result->getName() . ", " .
         $result->getEmail() . ", " .
         $result->getPhoneNumber() . "\n";
    } 
    }
    else if (preg_match("/^delete (\d+)$/", $line, $matches)) {
    $id = intval($matches[1]);
    $delete = $manager->delete($id);
    if ($delete) {
        echo "Contact supprimé\n";
        $contacts = $manager->findAll();
    } 
    else {
        echo "Aucun contact trouvé avec l'id $id\n";
    }
    }
    else if (preg_match("/^create \s*([^,]+),\s*([^,]+),\s*(\S+)$/", $line, $matches)) {
    $name = trim($matches[1]);
    $email = trim($matches[2]);
    $phone_number = trim($matches[3]);
    $create = $manager->create($name, $email, $phone_number);
    if ($create) {
        echo "Contact créé\n";
        $contacts = $manager->findAll();
    } 
    }
    else if ($line === 'quit') {
        exit();
    }
    else {
        echo "Vous avez saisi : $line\n";
    }
}

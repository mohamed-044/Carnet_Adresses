<?php
require_once(__DIR__ . '/ContactManager.php');
$manager = new ContactManager();
$contacts = $manager->findAll();
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === 'list'){
        foreach ($contacts as $contact)
        {
            echo "Id : {$contact['id']}\n";
            echo "Nom : {$contact['name']}\n";
            echo "Email : {$contact['email']}\n";
            echo "Téléphone : {$contact['phone_number']}\n\n";
        }
    }
    else {
        echo "Vous avez saisi : $line\n";
    }
}
<?php
require_once(__DIR__ . '/Command.php');
$command = new Command;
echo "Attention à la syntaxe des commandes, les espaces et les virgules sont importants.\n";
while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, modify, quit) : ");
    if ($line === 'help') {
        $command->help();   // On affiche les aides
    }
    else if ($line === 'list'){
        $command->list();
    }
    else if ($command->detailCheck($line)) {
        $command->detail(); // On affiche les détails du contact
    }
    else if ($command->deleteCheck($line)) {
        $command->delete(); // On supprime le contact
    }
    else if ($command->createCheck($line)) {
        $command->create(); // On crée le contact
    }
    else if ($command->modifyCheck($line)) {
        $command->modify(); // On modifie le contact
    }
    else if ($line === 'quit') {
        exit(); // On quitte 
    }
    else {
        echo "La commande '$line' est incorrect\n"; // On affiche un message d'erreur
    }
}
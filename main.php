<?php
require_once(__DIR__ . '/Command.php');
$command = new Command;
echo "Attention à la syntaxe des commandes, les espaces et les virgules sont importants.\n";
while (true) {
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
    if ($line === 'help') {
        $command->help();
    }
    else if ($line === 'list'){
        $command->list();
    }
    else if ($command->detailCheck($line)) {
        $command->detail();
    }
    else if ($command->deleteCheck($line)) {
        $command->delete();
    }
    else if ($command->createCheck($line)) {
        $command->create();
    }
    else if ($command->modifyCheck($line)) {
        $command->modify();
    }
    else if ($line === 'quit') {
        exit();
    }
    else {
        echo "La commande '$line' est incorrect\n";
    }
}
<?php
require_once(__DIR__ . '/DBConnect.php');  
class Contact{
    
    private int $id = 0;
    private string $name;
    private string $email;
    private string $phone_number;

    public function getId() : ?int {
 
        return $this->id;
    }
    function getName() : ?string {
        
    }
    function setName() : void {

    } 
    function toString() : ?string {

    }
}
$c = new Contact;
$c->getId();
var_dump($c);
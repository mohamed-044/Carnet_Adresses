<?php
require_once(__DIR__ . '/DBConnect.php');  

class Contact{
    
    private int $id = 0;
    private string $name;
    private string $email;
    private string $phone_number;

    public function __construct(int $id, string $name, string $email, string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    public function getId() : ?int {
        return $this->id;
    }
    public function getName() : ?string {
        return $this->name;
    }
    public function getEmail(): ?string{
        return $this->email; 
    }
    public function getPhoneNumber(): ?int{
        return $this->phone_number;
    }
    public function setName(string $name) : void {

    } 
    public function toString() : ?string {

    }
}
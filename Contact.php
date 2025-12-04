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

    public function getId() : ?int {    //fonction pour récupérer l'id
        return $this->id;
    }
    public function getName() : ?string {   //fonction pour récupérer le name
        return $this->name;
    }
    public function getEmail(): ?string{    //fonction pour récupérer le mail
        return $this->email; 
    }
    public function getPhoneNumber(): ?int{ //fonction pour récupérer le phone number
        return $this->phone_number;
    }
    public function __toString() :string{   //méthode magique pour convertir en string
        return sprintf(
        "%d, %s, %s, %s",
        $this->id,
        $this->name,
        $this->email,
        $this->phone_number
    );
    }
}
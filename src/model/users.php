<?php

class UsersModel
{

    public $db;
    public $dataTest;
    public $name;
    public $email;
    public $emailConfirm;
    public $adress;
    public $adressDelivery;
    public $password;
    public $passwordConfirm;
    public $seller;
    public $buyer;
    public $repairer;


    public function __construct(PDO $db)
    {
        $this->db = $db;


        $this->dataTest = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataTest->name) && !empty($this->dataTest->email) && !empty($this->dataTest->password) && !empty($this->dataTest->emailConfirm) && !empty($this->dataTest->passwordConfirm) && !empty($this->dataTest->adress)) {

            $this->name = trim(strip_tags($this->dataTest->name));
            $this->email = trim(strip_tags($this->dataTest->email));
            $this->emailConfirm = trim(strip_tags($this->dataTest->emailConfirm));
            $this->adress = trim(strip_tags($this->dataTest->adress));
            $this->adressDelivery = trim(strip_tags($this->dataTest->adressDelivery));
            $this->password = trim(strip_tags($this->dataTest->password));
            $this->passwordConfirm = trim(strip_tags($this->dataTest->passwordConfirm));
            $this->dataTest->seller = $this->dataTest->seller;
            $this->dataTest->buyer = trim(strip_tags($this->dataTest->buyer));
            $this->dataTest->repairer = trim(strip_tags($this->dataTest->repairer));
        }
    }
}

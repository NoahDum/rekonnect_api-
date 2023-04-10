<?php

class UsersModel
{

    public $db;
    public $dataUser;
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
    public $phone;


    public function __construct(PDO $db)
    {
        $this->db = $db;



        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser)) {
            $this->name = trim(strip_tags($this->dataUser->name));
            $this->email = trim(strip_tags($this->dataUser->email));
            $this->emailConfirm = trim(strip_tags($this->dataUser->emailConfirm));
            $this->password = trim(strip_tags($this->dataUser->password));
            $this->passwordConfirm = trim(strip_tags($this->dataUser->passwordConfirm));
            $this->seller = trim(strip_tags($this->dataUser->seller));
            $this->buyer = trim(strip_tags($this->dataUser->buyer));
            $this->repairer = trim(strip_tags($this->dataUser->repairer));
            $this->phone = trim(strip_tags($this->dataUser->phone));
        }
    }
}

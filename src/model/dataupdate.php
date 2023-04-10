<?php

class dataUpdateModel
{

    public $db;
    public $id;
    public $dataUser;
    public $name;
    public $email;
    public $adress;
    public $adressDelivery;
    public $seller;
    public $buyer;
    public $repairer;
    public $phone;




    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser->id) && !empty($this->dataUser->name) && !empty($this->dataUser->email) && !empty($this->dataUser->adress) && !empty($this->dataUser) && !empty($this->dataUser->adress) && !empty($this->dataUser->phone)) {

            $this->id = trim(strip_tags($this->dataUser->id));
            $this->name = trim(strip_tags($this->dataUser->name));
            $this->email = trim(strip_tags($this->dataUser->email));
            $this->adress = trim(strip_tags($this->dataUser->adress));
            $this->adressDelivery = trim(strip_tags($this->dataUser->adressDelivery));
            $this->seller = trim(strip_tags($this->dataUser->seller));
            $this->buyer = trim(strip_tags($this->dataUser->buyer));
            $this->repairer = trim(strip_tags($this->dataUser->repairer));
            $this->phone = trim(strip_tags($this->dataUser->phone));
        }
    }
}

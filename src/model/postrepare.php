<?php
class PostrepareModel
{
    public $db;
    public $dataUser;
    public $serviceName;
    public $description;
    public $price;
    public $userName;
    public $users_id;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser)) {
            $this->serviceName = trim(strip_tags($this->dataUser->serviceName));
            $this->description = trim(strip_tags($this->dataUser->description));
            $this->price = trim(strip_tags($this->dataUser->price));
            $this->userName = trim(strip_tags($this->dataUser->userName));
            $this->users_id = trim(strip_tags($this->dataUser->users_id));
        }
    }
}
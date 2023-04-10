<?php

class SoldModel
{

    public $db;
    public $id;
    public $sold;
    public $dataUser;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser->sold)) {
            $this->id = trim(strip_tags($this->dataUser->id));
            $this->sold = trim(strip_tags($this->dataUser->sold));
        }
    }
}

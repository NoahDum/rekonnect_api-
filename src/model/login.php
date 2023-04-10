<?php

class LoginModel
{
    public $db;
    public $dataUser;
    public $name;
    public $password;




    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));

        if (!empty($this->dataUser->name) && !empty($this->dataUser->password)) {
            $this->name = trim(strip_tags($this->dataUser->name));
            $this->password = trim(strip_tags($this->dataUser->password));
        }
    }
}

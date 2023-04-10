<?php

class ResetPasswordModel
{

    public $db;
    public $dataUser;
    public $email;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser->email)) {
            $this->email = trim(strip_tags($this->dataUser->email));
        }
    }
}

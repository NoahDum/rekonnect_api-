<?php

class NewPasswordModel
{

    public $db;
    public $token;
    public $dataUser;
    public $password;
    public $passwordConfirm;



    public function __construct(PDO $db)
    {
        $this->db = $db;

        $this->dataUser = json_decode(file_get_contents("php://input"));
        if (!empty($this->dataUser->password) && !empty($this->dataUser->passwordConfirm) && ($this->dataUser->token)) {

            $this->token = trim(strip_tags($this->dataUser->token));
            $this->password = trim(strip_tags($this->dataUser->password));
            $this->passwordConfirm = trim(strip_tags($this->dataUser->passwordConfirm));
        }
    }
}

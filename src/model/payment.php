<?php

class PaymentModel
{
    public $db;
    public $dataUser;
    public $objectIds;
    public $user_id;
    public $totalCmd;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->dataUser = json_decode(file_get_contents("php://input"));

        if (!empty($this->dataUser->user_id)) {
            $this->user_id = trim(strip_tags($this->dataUser->user_id));
            $this->totalCmd = trim(strip_tags($this->dataUser->totalCmd));
            $this->objectIds = $this->dataUser->objectIds;
        } else {
            $msgUser = [];
            $msgUser['msgUser'] = "Le panier est vide !";
            return array("msgUser" => $msgUser);
        }
    }
}

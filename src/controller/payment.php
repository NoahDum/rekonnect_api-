<?php

class PaymentController
{

    public $model;


    public function __construct(PaymentModel $model)
    {
        $this->model = $model;
    }

    public function getWallet()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $msgUser = [];

            // Get value of user wallet
            $query = $this->model->db->prepare("SELECT wallet FROM rekonnect.users where id like :user_id ");
            $query->bindParam(':user_id', $this->model->user_id);

            if ($query->execute()) {
                $result = $query->fetch();
            } else {
                $msgUser['msgUser'] = "Porte-monnaie inexistant";
                return array("msgUser" => $msgUser);
            }

            if ($result['wallet'] > $this->model->totalCmd) {

                // Update wallet user
                $query = $this->model->db->prepare("UPDATE rekonnect.users SET wallet = wallet - :totalCmd where id like :user_id");
                $query->bindParam(':user_id', $this->model->user_id);
                $query->bindParam(':totalCmd', $this->model->totalCmd);

                if ($query->execute() && !empty($this->model->objectIds)) {
                    $ids = implode(",", $this->model->objectIds);

                    $query = $this->model->db->prepare("DELETE FROM rekonnect.postsell WHERE id IN ($ids)");
                    if ($query->execute()) {
                        $msgUser['msgUser'] = "Panier validé avec succès";
                        return array("msgUser" => $msgUser);
                    }
                }
            } else {
                $msgUser['msgUser'] = "Fonds insuffisants dans le porte-monnaie";
                return array("msgUser" => $msgUser);
            }
        }
    }
}

<?php

class dataUpdateController
{

    public $model;


    public function __construct(DataUpdateModel $model)
    {
        $this->model = $model;
    }
    public function update()
    {

        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $errors = [];
            if (!filter_var($this->model->email)) {
                $errors["email"] = "L'email n'est pas validé";
            }



            if (empty($errors)) {
                $query =  $this->model->db->prepare("UPDATE rekonnect.users set name = :name, email = :email, adress = :adress, adress_delivery = :adressDelivery , seller =:seller, buyer = :buyer, repairer = :repairer, phone = :phone where id like :id ");
                $query->bindParam(':id', $this->model->id);
                $query->bindParam(':name', $this->model->name);
                $query->bindParam(':email', $this->model->email);
                $query->bindParam(':adress', $this->model->adress);
                $query->bindParam(':adressDelivery', $this->model->adressDelivery);
                $query->bindParam(':seller', $this->model->seller);
                $query->bindParam(':buyer', $this->model->buyer);
                $query->bindParam(':repairer', $this->model->repairer);
                $query->bindParam(':phone', $this->model->phone);



                if ($query->execute()) {
                    $query = $this->model->db->prepare('SELECT rekonnect.users.id, rekonnect.users.name, rekonnect.users.email, rekonnect.users.adress, rekonnect.users.phone, rekonnect.users.adress_delivery, rekonnect.users.seller, rekonnect.users.buyer, rekonnect.users.repairer, rekonnect.users.avatar, rekonnect.users.wallet from rekonnect.users where id like :id');
                    $query->bindParam(':id', $this->model->id);

                    if ($query->execute()) {
                        $user = $query->fetch(PDO::FETCH_ASSOC);
                        return  $user;
                    }
                } else {
                    return $user = 'une erreur s\'est produite';
                }
            }
        }

        if (!empty($errors)) {
            return $errors;
        }
    }
}

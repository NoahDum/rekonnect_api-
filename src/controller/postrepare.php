<?php
class PostrepareController
{
    public $model;
    public function __construct(PostrepareModel $model)
    {
        $this->model = $model;
    }

    public function insertRepare()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $errors = [];

            if (empty($this->model->serviceName)) {
                $errors["serviceName"] = "Le nom du service est obligatoire";
            }
            if (empty($this->model->description)) {
                $errors["description"] = "Veuillez ajouter une description du service";
            }
            if (empty($this->model->price)) {
                $errors["price"] = "Veuillez ajouter un prix au service";
            }
            if ($this->model->price < 0) {
                $errors["price"] = "Le prix ne peut pas etre inférieur à 0€";
            }


                $query = $this->model->db->prepare('INSERT INTO rekonnect.postrepare (serviceName, description, price, userName, users_id) VALUES (:serviceName, :description, :price, :userName, :users_id)');
                $query->bindParam(':serviceName', $this->model->serviceName);
                $query->bindParam(':description', $this->model->description);
                $query->bindParam(':userName', $this->model->userName);
                $query->bindParam(':users_id', $this->model->users_id);
                $query->bindParam(':price', $this->model->price);
                if ($query->execute()) {
                    return'votre annonce a bien été enregistrée';
                } else {
                   return'echec';
                }
            
        }
    }
}

<?php

class UsersController
{

    public $model;

    public function __construct(UsersModel $model)
    {
        $this->model = $model;
    }
    public function getData()
    {
        $query = $this->model->db->query("SELECT * FROM rekonnect.users");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public function addUser()
    {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $errors = [];
            if (!filter_var($this->model->email)) {
                $errors["email"] = "L'email n'est pas validé";
            }
            $uppercase = preg_match("/[A-Z]/", $this->model->password);
            $lowercase = preg_match("/[a-z]/", $this->model->password);
            $number = preg_match("/[0-9]/", $this->model->password);

            if ($this->model->email != $this->model->emailConfirm) {
                $errors["email"] = "Les adresses mail sont différents";
            }

            if (!$uppercase || !$lowercase || !$number || strlen($this->model->password < 8)) {
                $errors["password"] = "le mots de passe doit contenir une lettre minuscule, une lettre majuscule un chiffre et minimum 8 caractère";
            }

            if ($this->model->password != $this->model->passwordConfirm) {
                $errors["password"] = "les mots de passe ne sont pas identique.";
            }







            if (empty($errors)) {

                $hash = password_hash($this->model->password, PASSWORD_DEFAULT);
                $query =  $this->model->db->prepare('INSERT INTO rekonnect.users (name, email, adress, password, seller, buyer, repairer ) VALUES (:name, :email, :adress, :password, :seller, :buyer, :repairer)');
                $query->bindParam(':name', $this->model->name);
                $query->bindParam(':email', $this->model->email);
                $query->bindParam(':adress', $this->model->adress);
                $query->bindParam(':seller', $this->model->seller);
                $query->bindParam(':buyer', $this->model->buyer);
                $query->bindParam(':repairer', $this->model->repairer);
                $query->bindParam(':password', $hash);


                if ($query->execute()) {
                    return json_encode("success");
                } else {
                    return json_encode("echec");
                }
            }
        }
    }
}

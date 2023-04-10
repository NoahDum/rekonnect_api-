<?php

class UsersController
{

    public $model;

    public function __construct(UsersModel $model)
    {
        $this->model = $model;
    }

    public function addUser()
    {


        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Gestion sécurité
            $errors = [];
            if (!filter_var($this->model->email)) {
                $errors["email"] = "L'email n'est pas validé";
            }
            $uppercase = preg_match("/[A-Z]/", $this->model->password);
            $lowercase = preg_match("/[a-z]/", $this->model->password);
            $number = preg_match("/[0-9]/", $this->model->password);

            if ($this->model->email !== $this->model->emailConfirm) {
                $errors["email"] = "Les adresses mail sont différents";
            }



            if (!$uppercase || !$lowercase || !$number || strlen($this->model->password < 8)) {
                $errors["password"] = "le mot de passe doit contenir une lettre minuscule, une lettre majuscule un chiffre et minimum 8 caractères";
            }

            if ($this->model->password !== $this->model->passwordConfirm) {
                $errors["password"] = "les mots de passe ne sont pas identiques.";
            }

            // verification que le nom ou l'adresse mail n'éxiste pas dans la base de donnée

            $query = $this->model->db->prepare("SELECT rekonnect.users.name, rekonnect.users.email from rekonnect.users where name like :name OR email like :email");
            $query->bindParam('name', $this->model->name);
            $query->bindParam('email', $this->model->email);
            $query->execute();
            $result = $query->fetchAll();


            if ($result) {
                $error = "Nom d'utilisateur ou mot de passe déjà utilisé";
                return array("error" => $error);
            }

            // Enregistrement s'il n'y a pas d'erreur
            if (!empty($errors)) {
                return $errors;
            }

            if (empty($errors)) {

                $hash = password_hash($this->model->password, PASSWORD_DEFAULT);
                $query =  $this->model->db->prepare('INSERT INTO rekonnect.users (name, email, password, seller, buyer, repairer, phone) VALUES (:name, :email, :password, :seller, :buyer, :repairer, :phone)');
                $query->bindParam(':name', $this->model->name);
                $query->bindParam(':email', $this->model->email);
                $query->bindParam(':password', $hash);
                $query->bindParam(':seller', $this->model->seller);
                $query->bindParam(':buyer', $this->model->buyer);
                $query->bindParam(':repairer', $this->model->repairer);
                $query->bindParam(':phone', $this->model->phone);


                if ($query->execute()) {

                    return $result = 'votre inscription a bien été enregistrée';
                } else {
                    return $result = "echec";
                }
            }
        }
    }
}
